<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('asset_no')->unique();
            $table->string('barcode')->unique();
            $table->string('tool_name');
            $table->foreignId('category_id')->constrained('tool_categories');
            $table->foreignId('location_id')->constrained('tool_locations');
            $table->foreignId('area_unit_id')->nullable()->constrained('area_units');
            $table->year('acquisition_year');
            $table->string('condition_status');
            $table->string('availability_status');
            $table->boolean('calibration_required')->default(false);
            $table->unsignedInteger('calibration_interval_months')->nullable();
            $table->date('last_calibration_date')->nullable();
            $table->date('next_calibration_due')->nullable();
            $table->unsignedInteger('row_version')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('borrow_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_no')->unique();
            $table->dateTime('requested_at');
            $table->foreignId('work_type_id')->constrained('work_types');
            $table->foreignId('requester_user_id')->constrained('users');
            $table->string('peminjam_display_name');
            $table->foreignId('area_unit_id')->constrained('area_units');
            $table->dateTime('planned_start_at');
            $table->dateTime('planned_return_at');
            $table->text('tujuan_pekerjaan')->nullable();
            $table->string('status');
            $table->boolean('sla_breached')->default(false);
            $table->dateTime('sla_breached_at')->nullable();
            $table->unsignedInteger('row_version')->default(1);
            $table->unsignedBigInteger('approved_l1_by')->nullable();
            $table->unsignedBigInteger('approved_final_by')->nullable();
            $table->unsignedBigInteger('dispatched_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('borrow_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_request_id')->constrained('borrow_requests');
            $table->unsignedInteger('item_no');
            $table->string('permintaan_alat');
            $table->foreignId('tool_id')->nullable()->constrained('tools');
            $table->string('kondisi_kembali')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_request_id')->unique()->constrained('borrow_requests');
            $table->dateTime('sent_at');
            $table->string('surat_jalan_kirim');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_request_id')->unique()->constrained('borrow_requests');
            $table->dateTime('received_at');
            $table->string('surat_jalan_kembali');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_id')->constrained('returns');
            $table->foreignId('borrow_item_id')->constrained('borrow_items');
            $table->string('kondisi_kembali');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('damage_reports', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->unique();
            $table->dateTime('reported_at');
            $table->foreignId('tool_id')->constrained('tools');
            $table->foreignId('work_type_id')->constrained('work_types');
            $table->foreignId('reported_by_user_id')->constrained('users');
            $table->text('uraian_kerusakan');
            $table->string('priority');
            $table->string('status');
            $table->dateTime('verified_at')->nullable();
            $table->text('verification_result')->nullable();
            $table->string('recommendation')->nullable();
            $table->string('surat_kerusakan')->nullable();
            $table->boolean('sla_breached')->default(false);
            $table->dateTime('sla_breached_at')->nullable();
            $table->unsignedInteger('row_version')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('repair_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_no')->unique();
            $table->foreignId('damage_report_id')->unique()->constrained('damage_reports');
            $table->foreignId('assigned_to_user_id')->constrained('users');
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->dateTime('planned_finish_at');
            $table->dateTime('sent_at')->nullable();
            $table->string('surat_jalan_kirim')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->string('surat_jalan_terima')->nullable();
            $table->decimal('repair_cost_idr', 16, 2)->nullable();
            $table->text('hasil_akhir')->nullable();
            $table->string('progress_status')->nullable();
            $table->unsignedInteger('row_version')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_jobs');
        Schema::dropIfExists('damage_reports');
        Schema::dropIfExists('return_items');
        Schema::dropIfExists('returns');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('borrow_items');
        Schema::dropIfExists('borrow_requests');
        Schema::dropIfExists('tools');
    }
};
