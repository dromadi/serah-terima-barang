<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private array $rowVersionTables = [
        'roles',
        'area_units',
        'users',
        'tool_categories',
        'tool_locations',
        'work_types',
        'vendors',
        'holidays',
        'sla_settings',
        'escalation_matrix',
        'attachments',
        'audit_logs',
        'event_logs',
        'correction_notes',
        'borrow_items',
        'shipments',
        'returns',
        'return_items',
    ];

    public function up(): void
    {
        foreach ($this->rowVersionTables as $table) {
            if (!Schema::hasColumn($table, 'row_version')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->unsignedInteger('row_version')->default(1);
                });
            }
        }

        foreach (['audit_logs', 'event_logs', 'correction_notes'] as $table) {
            if (!Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['audit_logs', 'event_logs', 'correction_notes'] as $table) {
            if (Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
            }
        }

        foreach ($this->rowVersionTables as $table) {
            if (Schema::hasColumn($table, 'row_version')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('row_version');
                });
            }
        }
    }
};
