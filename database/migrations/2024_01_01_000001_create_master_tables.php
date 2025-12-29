<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('area_units', function (Blueprint $table) {
            $table->id();
            $table->string('area_code')->unique();
            $table->string('area_name');
            $table->string('region')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('area_unit_id')->nullable()->constrained('area_units');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tool_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code')->unique();
            $table->string('category_name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tool_locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_code')->unique();
            $table->string('location_name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('work_types', function (Blueprint $table) {
            $table->id();
            $table->string('work_code')->unique();
            $table->string('work_name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code')->unique();
            $table->string('vendor_name');
            $table->string('npwp')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sla_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('escalation_matrix', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->unsignedInteger('breach_level');
            $table->string('notify_role');
            $table->unsignedInteger('after_business_hours');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escalation_matrix');
        Schema::dropIfExists('sla_settings');
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('work_types');
        Schema::dropIfExists('tool_locations');
        Schema::dropIfExists('tool_categories');
        Schema::dropIfExists('users');
        Schema::dropIfExists('area_units');
        Schema::dropIfExists('roles');
    }
};
