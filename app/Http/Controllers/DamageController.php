<?php

namespace App\Http\Controllers;

use App\Enums\DamageStatus;
use App\Models\Attachment;
use App\Models\DamageReport;
use App\Models\EventLog;
use App\Services\SoDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DamageController extends Controller
{
    public function index()
    {
        return view('damage.index', [
            'reports' => DamageReport::with(['tool', 'workType'])->get(),
        ]);
    }

    public function create()
    {
        return view('damage.create');
    }

    public function show(DamageReport $damageReport)
    {
        return view('damage.show', [
            'report' => $damageReport,
        ]);
    }

    public function action(Request $request, DamageReport $damageReport, string $action, SoDService $sod)
    {
        $user = Auth::user();
        if (!$sod->validateDamageSoD($user, $damageReport, $action)) {
            abort(403, 'Konflik SoD terdeteksi.');
        }

        $remarkRule = in_array($action, ['scrap', 'correction'], true) ? 20 : 10;
        $request->validate(['remark' => ['required', 'min:' . $remarkRule]]);

        if ($action === 'verify') {
            $request->validate([
                'verified_at' => ['required', 'date'],
                'verification_result' => ['required', 'min:20'],
            ]);
            $damageReport->status = DamageStatus::VERIFIED;
        }

        if ($action === 'plan-repair') {
            $damageReport->status = DamageStatus::REPAIR_PLANNED;
        }

        if ($action === 'start-repair') {
            $count = Attachment::where('entity_type', 'damage_reports')
                ->where('entity_id', $damageReport->id)
                ->where('doc_category', 'SJ_REPAIR_KIRIM')
                ->count();
            if ($count === 0) {
                return back()->withErrors(['action' => 'Dokumen SJ Repair Kirim belum lengkap.']);
            }
            $damageReport->status = DamageStatus::IN_REPAIR;
        }

        if ($action === 'qa-check') {
            $count = Attachment::where('entity_type', 'damage_reports')
                ->where('entity_id', $damageReport->id)
                ->whereIn('doc_category', ['SJ_REPAIR_TERIMA', 'BA'])
                ->count();
            if ($count < 2) {
                return back()->withErrors(['action' => 'Dokumen wajib belum lengkap.']);
            }
            $damageReport->status = DamageStatus::QA_CHECK;
        }

        if ($action === 'complete') {
            $damageReport->status = DamageStatus::COMPLETED;
        }

        if ($action === 'scrap') {
            $damageReport->status = DamageStatus::SCRAPPED;
        }

        $damageReport->save();

        EventLog::create([
            'entity_type' => 'damage_reports',
            'entity_id' => $damageReport->id,
            'event_type' => strtoupper($action),
            'remark' => $request->input('remark'),
            'signed_by_user_id' => $user->id,
            'signer_name_snapshot' => $user->name,
            'signer_role_snapshot' => $user->role->name ?? null,
            'signed_at' => now(),
        ]);

        return back();
    }
}
