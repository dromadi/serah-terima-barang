<?php

namespace App\Http\Controllers;

use App\Enums\BorrowStatus;
use App\Models\Attachment;
use App\Models\BorrowRequest;
use App\Models\EventLog;
use App\Models\Tool;
use App\Services\SoDService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        return view('borrow.index', [
            'requests' => BorrowRequest::with(['requester', 'workType', 'areaUnit'])->get(),
        ]);
    }

    public function create()
    {
        return view('borrow.create');
    }

    public function show(BorrowRequest $borrowRequest)
    {
        return view('borrow.show', [
            'request' => $borrowRequest->load(['items.tool', 'shipment', 'returnEntry.items']),
        ]);
    }

    public function action(Request $request, BorrowRequest $borrowRequest, string $action, SoDService $sod)
    {
        $user = Auth::user();
        if (!$sod->validateBorrowApproval($user, $borrowRequest, $action)) {
            abort(403, 'Konflik SoD terdeteksi.');
        }

        $remarkRule = in_array($action, ['reject', 'scrap', 'correction'], true) ? 20 : 10;
        if ($action !== 'submit') {
            $request->validate(['remark' => ['required', 'min:' . $remarkRule]]);
        }

        $requiredDocs = [];
        if ($action === 'dispatch') {
            $requiredDocs[] = 'SJ_KIRIM';
        }
        if ($action === 'return') {
            $requiredDocs[] = 'SJ_KEMBALI';
        }
        if (!empty($requiredDocs)) {
            $missing = Attachment::where('entity_type', 'borrow_requests')
                ->where('entity_id', $borrowRequest->id)
                ->whereIn('doc_category', $requiredDocs)
                ->count();
            if ($missing === 0) {
                return back()->withErrors(['action' => 'Dokumen wajib belum lengkap.']);
            }
        }

        switch ($action) {
            case 'submit':
                $borrowRequest->status = BorrowStatus::SUBMITTED;
                break;
            case 'approve-l1':
                $borrowRequest->status = BorrowStatus::APPROVED_L1;
                $borrowRequest->approved_l1_by = $user->id;
                break;
            case 'approve-final':
                $borrowRequest->status = BorrowStatus::APPROVED_FINAL;
                $borrowRequest->approved_final_by = $user->id;
                break;
            case 'reject':
                $borrowRequest->status = BorrowStatus::REJECTED;
                break;
            case 'dispatch':
                $borrowRequest->status = BorrowStatus::DISPATCHED;
                $borrowRequest->dispatched_by = $user->id;
                Tool::whereIn('id', $borrowRequest->items()->pluck('tool_id'))
                    ->update(['availability_status' => 'ON_LOAN']);
                break;
            case 'return':
                $borrowRequest->status = BorrowStatus::RETURNED;
                break;
            case 'close':
                $borrowRequest->status = BorrowStatus::CLOSED;
                break;
            default:
                abort(400, 'Action tidak dikenal.');
        }

        $borrowRequest->save();

        EventLog::create([
            'entity_type' => 'borrow_requests',
            'entity_id' => $borrowRequest->id,
            'event_type' => strtoupper($action),
            'remark' => $request->input('remark', ''),
            'signed_by_user_id' => $user->id,
            'signer_name_snapshot' => $user->name,
            'signer_role_snapshot' => $user->role->name ?? null,
            'signed_at' => now(),
        ]);

        return back();
    }
}
