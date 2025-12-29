<?php

namespace App\Http\Controllers;

use App\Models\BorrowRequest;
use App\Models\DamageReport;
use App\Models\Tool;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'toolCounts' => [
                'available' => Tool::where('availability_status', 'AVAILABLE')->count(),
                'on_loan' => Tool::where('availability_status', 'ON_LOAN')->count(),
                'in_repair' => Tool::where('availability_status', 'IN_REPAIR')->count(),
                'out_of_service' => Tool::where('availability_status', 'OUT_OF_SERVICE')->count(),
            ],
            'overdue' => BorrowRequest::whereIn('status', ['APPROVED_FINAL', 'DISPATCHED'])
                ->whereDate('planned_return_at', '<', now()->toDateString())
                ->count(),
            'repairCostMonth' => DamageReport::whereMonth('created_at', now()->month)->sum('repair_cost_idr'),
        ]);
    }
}
