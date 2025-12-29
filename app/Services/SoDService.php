<?php

namespace App\Services;

use App\Models\BorrowRequest;
use App\Models\DamageReport;
use App\Models\RepairJob;
use App\Models\User;

class SoDService
{
    public function validateBorrowApproval(User $actor, BorrowRequest $request, string $action): bool
    {
        if ($action === 'approve-l1' && $request->requester_user_id === $actor->id) {
            return false;
        }

        if ($action === 'approve-final' && $request->approved_l1_by === $actor->id) {
            return false;
        }

        if ($action === 'dispatch' && $request->dispatched_by === $actor->id) {
            return false;
        }

        if ($action === 'return' && $request->dispatched_by === $actor->id) {
            return false;
        }

        return true;
    }

    public function validateDamageSoD(User $actor, DamageReport $report, string $action): bool
    {
        if ($action === 'verify' && $report->reported_by_user_id === $actor->id) {
            return false;
        }

        if ($action === 'qa-check' && $report->verified_by === $actor->id) {
            return false;
        }

        return true;
    }

    public function validateRepairSoD(User $actor, RepairJob $job, string $action): bool
    {
        if (in_array($action, ['verify', 'qa-check', 'complete'], true) && $actor->role->name === 'TECH_VENDOR') {
            return false;
        }

        return true;
    }
}
