<?php

namespace App\Http\Controllers;

use App\Models\EventLog;
use App\Models\RepairJob;
use App\Services\SoDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    public function index()
    {
        return view('repairs.index', [
            'jobs' => RepairJob::with(['damageReport', 'vendor', 'assignedUser'])->get(),
        ]);
    }

    public function show(RepairJob $repairJob)
    {
        return view('repairs.show', [
            'job' => $repairJob,
        ]);
    }

    public function action(Request $request, RepairJob $repairJob, string $action, SoDService $sod)
    {
        $user = Auth::user();
        if (!$sod->validateRepairSoD($user, $repairJob, $action)) {
            abort(403, 'Konflik SoD terdeteksi.');
        }

        $request->validate(['remark' => ['required', 'min:10']]);

        $repairJob->progress_status = strtoupper($action);
        $repairJob->save();

        EventLog::create([
            'entity_type' => 'repair_jobs',
            'entity_id' => $repairJob->id,
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
