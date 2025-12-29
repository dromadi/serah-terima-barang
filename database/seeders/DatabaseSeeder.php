<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AreaUnit;
use App\Models\BorrowRequest;
use App\Models\BorrowItem;
use App\Models\DamageReport;
use App\Models\RepairJob;
use App\Models\Role;
use App\Models\Tool;
use App\Models\ToolCategory;
use App\Models\ToolLocation;
use App\Models\User;
use App\Models\Vendor;
use App\Models\WorkType;
use App\Models\SlaSetting;
use App\Models\EscalationMatrix;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = collect([
            'ADMIN_TRL', 'STAFF_TRL', 'REQUESTER', 'TECH_VENDOR', 'VIEWER', 'APPROVER_L1', 'APPROVER_FINAL',
        ])->map(fn ($name) => Role::create(['name' => $name]));

        $areas = collect([
            ['area_code' => 'AU-UPHK', 'area_name' => 'Unit Pusat Hukum'],
            ['area_code' => 'AU-OMBL', 'area_name' => 'Operasi Mobile'],
            ['area_code' => 'AU-PRIO', 'area_name' => 'Project Prioritas'],
        ])->map(fn ($data) => AreaUnit::create($data));

        $categories = collect([
            ['category_code' => 'CAT-MEC', 'category_name' => 'Mechanical'],
            ['category_code' => 'CAT-ELC', 'category_name' => 'Electrical'],
            ['category_code' => 'CAT-INS', 'category_name' => 'Instrument'],
            ['category_code' => 'CAT-NDT', 'category_name' => 'NDT'],
            ['category_code' => 'CAT-LFT', 'category_name' => 'Lifting'],
        ])->map(fn ($data) => ToolCategory::create($data));

        $locations = collect([
            ['location_code' => 'LOC-LON', 'location_name' => 'Workshop Lontar'],
            ['location_code' => 'LOC-KST', 'location_name' => 'Gudang KST'],
            ['location_code' => 'LOC-GSA', 'location_name' => 'GSA Yard'],
        ])->map(fn ($data) => ToolLocation::create($data));

        $workTypes = collect([
            ['work_code' => 'WORK-SE', 'work_name' => 'Service'],
            ['work_code' => 'WORK-RLA', 'work_name' => 'Relocation'],
            ['work_code' => 'WORK-OH', 'work_name' => 'Overhaul'],
            ['work_code' => 'WORK-INS', 'work_name' => 'Inspection'],
        ])->map(fn ($data) => WorkType::create($data));

        $vendors = collect([
            ['vendor_code' => 'VND-0001', 'vendor_name' => 'PT Prima Teknik'],
            ['vendor_code' => 'VND-0002', 'vendor_name' => 'CV Mitra Kalibrasi'],
        ])->map(fn ($data) => Vendor::create($data));

        $adminRole = $roles->firstWhere('name', 'ADMIN_TRL');
        $staffRole = $roles->firstWhere('name', 'STAFF_TRL');
        $requesterRole = $roles->firstWhere('name', 'REQUESTER');
        $vendorRole = $roles->firstWhere('name', 'TECH_VENDOR');
        $viewerRole = $roles->firstWhere('name', 'VIEWER');
        $approverL1 = $roles->firstWhere('name', 'APPROVER_L1');
        $approverFinal = $roles->firstWhere('name', 'APPROVER_FINAL');

        User::insert([
            [
                'name' => 'Admin TRL',
                'email' => 'admin@trl.local',
                'password' => Hash::make('Admin123!'),
                'role_id' => $adminRole->id,
                'area_unit_id' => $areas[0]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff TRL',
                'email' => 'staff@trl.local',
                'password' => Hash::make('Staff123!'),
                'role_id' => $staffRole->id,
                'area_unit_id' => $areas[1]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Requester TRL',
                'email' => 'requester@trl.local',
                'password' => Hash::make('Req123!'),
                'role_id' => $requesterRole->id,
                'area_unit_id' => $areas[2]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor TRL',
                'email' => 'vendor@trl.local',
                'password' => Hash::make('Vendor123!'),
                'role_id' => $vendorRole->id,
                'area_unit_id' => $areas[0]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Viewer TRL',
                'email' => 'viewer@trl.local',
                'password' => Hash::make('View123!'),
                'role_id' => $viewerRole->id,
                'area_unit_id' => $areas[0]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Approver L1',
                'email' => 'approverl1@trl.local',
                'password' => Hash::make('Approve123!'),
                'role_id' => $approverL1->id,
                'area_unit_id' => $areas[1]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Approver Final',
                'email' => 'approverfinal@trl.local',
                'password' => Hash::make('Approve123!'),
                'role_id' => $approverFinal->id,
                'area_unit_id' => $areas[2]->id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $tools = collect(range(1, 12))->map(function ($i) use ($categories, $locations, $areas) {
            return Tool::create([
                'asset_no' => sprintf('AST-%04d', $i),
                'barcode' => sprintf('BC-%04d', $i),
                'tool_name' => 'Tool ' . $i,
                'category_id' => $categories[$i % $categories->count()]->id,
                'location_id' => $locations[$i % $locations->count()]->id,
                'area_unit_id' => $areas[$i % $areas->count()]->id,
                'acquisition_year' => 2019 + ($i % 5),
                'condition_status' => $i % 4 === 0 ? 'RUSAK' : 'BAIK',
                'availability_status' => $i % 4 === 0 ? 'IN_REPAIR' : 'AVAILABLE',
                'calibration_required' => $i % 3 === 0,
                'calibration_interval_months' => $i % 3 === 0 ? 12 : null,
                'last_calibration_date' => $i % 3 === 0 ? now()->subMonths(12) : null,
                'next_calibration_due' => $i % 3 === 0 ? now()->subDays(1) : null,
            ]);
        });

        $requester = User::where('email', 'requester@trl.local')->first();
        $staff = User::where('email', 'staff@trl.local')->first();

        $submitted = BorrowRequest::create([
            'request_no' => 'TRL-BRR-' . now()->format('Y') . '-0001',
            'requested_at' => now()->subDay(),
            'work_type_id' => $workTypes[0]->id,
            'requester_user_id' => $requester->id,
            'peminjam_display_name' => 'Requester TRL',
            'area_unit_id' => $areas[0]->id,
            'planned_start_at' => now()->addDay(),
            'planned_return_at' => now()->addDays(3),
            'status' => 'SUBMITTED',
        ]);

        BorrowItem::create([
            'borrow_request_id' => $submitted->id,
            'item_no' => 1,
            'permintaan_alat' => 'Pompa hidrolik',
        ]);

        $approved = BorrowRequest::create([
            'request_no' => 'TRL-BRR-' . now()->format('Y') . '-0002',
            'requested_at' => now()->subDays(2),
            'work_type_id' => $workTypes[1]->id,
            'requester_user_id' => $requester->id,
            'peminjam_display_name' => 'Requester TRL',
            'area_unit_id' => $areas[1]->id,
            'planned_start_at' => now()->addDay(),
            'planned_return_at' => now()->addDays(2),
            'status' => 'APPROVED_L1',
        ]);

        BorrowItem::create([
            'borrow_request_id' => $approved->id,
            'item_no' => 1,
            'permintaan_alat' => 'Multimeter',
            'tool_id' => $tools[1]->id,
        ]);

        $dispatched = BorrowRequest::create([
            'request_no' => 'TRL-BRR-' . now()->format('Y') . '-0003',
            'requested_at' => now()->subDays(3),
            'work_type_id' => $workTypes[2]->id,
            'requester_user_id' => $requester->id,
            'peminjam_display_name' => 'Requester TRL',
            'area_unit_id' => $areas[2]->id,
            'planned_start_at' => now()->subDay(),
            'planned_return_at' => now()->addDay(),
            'status' => 'DISPATCHED',
        ]);

        BorrowItem::create([
            'borrow_request_id' => $dispatched->id,
            'item_no' => 1,
            'permintaan_alat' => 'Kalibrator',
            'tool_id' => $tools[2]->id,
        ]);

        $returned = BorrowRequest::create([
            'request_no' => 'TRL-BRR-' . now()->format('Y') . '-0004',
            'requested_at' => now()->subDays(5),
            'work_type_id' => $workTypes[3]->id,
            'requester_user_id' => $requester->id,
            'peminjam_display_name' => 'Requester TRL',
            'area_unit_id' => $areas[0]->id,
            'planned_start_at' => now()->subDays(4),
            'planned_return_at' => now()->subDay(),
            'status' => 'RETURNED',
        ]);

        BorrowItem::create([
            'borrow_request_id' => $returned->id,
            'item_no' => 1,
            'permintaan_alat' => 'Generator',
            'tool_id' => $tools[3]->id,
            'kondisi_kembali' => 'RUSAK',
        ]);

        DamageReport::create([
            'ticket_no' => 'TRL-DMG-' . now()->format('Y') . '-0001',
            'reported_at' => now()->subDays(2),
            'tool_id' => $tools[3]->id,
            'work_type_id' => $workTypes[3]->id,
            'reported_by_user_id' => $staff->id,
            'uraian_kerusakan' => 'Ditemukan saat pengembalian TRL-BRR-' . now()->format('Y') . '-0004',
            'priority' => 'MEDIUM',
            'status' => 'QA_CHECK',
            'verified_at' => now()->subDay(),
            'verification_result' => 'Kerusakan pada sistem pengapian perlu kalibrasi ulang.',
            'recommendation' => 'CALIBRATION',
        ]);

        RepairJob::create([
            'job_no' => 'TRL-RPJ-' . now()->format('Y') . '-0001',
            'damage_report_id' => DamageReport::first()->id,
            'assigned_to_user_id' => $staff->id,
            'vendor_id' => $vendors[1]->id,
            'planned_finish_at' => now()->addDays(5),
            'sent_at' => now()->subDay(),
            'surat_jalan_kirim' => 'SJRP-TRL/LOC-LON/' . now()->format('Y') . '/0001',
            'received_at' => now(),
            'surat_jalan_terima' => 'SJRP-TRL/LOC-LON/' . now()->format('Y') . '/0002',
            'repair_cost_idr' => 1200000,
            'hasil_akhir' => 'Kalibrasi selesai dan tool kembali normal.',
            'progress_status' => 'COMPLETED',
        ]);

        SlaSetting::insert([
            ['key' => 'SLA_APPROVAL_1', 'value' => '8'],
            ['key' => 'SLA_APPROVAL_2', 'value' => '8'],
            ['key' => 'SLA_DISPATCH', 'value' => '16'],
            ['key' => 'SLA_RETURN_OVERDUE', 'value' => '0'],
            ['key' => 'SLA_VERIFY_DAMAGE', 'value' => '16'],
            ['key' => 'SLA_REPAIR_START', 'value' => '16'],
            ['key' => 'SLA_QA_CHECK', 'value' => '16'],
            ['key' => 'SLA_COMPLETE', 'value' => '8'],
        ]);

        EscalationMatrix::insert([
            ['event_type' => 'SLA_BREACH', 'breach_level' => 1, 'notify_role' => 'ROLE_OWNER', 'after_business_hours' => 0],
            ['event_type' => 'SLA_BREACH', 'breach_level' => 2, 'notify_role' => 'ADMIN_TRL', 'after_business_hours' => 8],
            ['event_type' => 'SLA_BREACH', 'breach_level' => 3, 'notify_role' => 'APPROVER_FINAL', 'after_business_hours' => 16],
        ]);
    }
}
