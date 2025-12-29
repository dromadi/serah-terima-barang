<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->string('doc_category');
            $table->string('file_path');
            $table->string('sha256_hash');
            $table->boolean('is_confidential')->default(false);
            $table->foreignId('uploaded_by_user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->json('before_json');
            $table->json('after_json');
            $table->foreignId('actor_user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('event_logs', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->string('event_type');
            $table->text('remark')->nullable();
            $table->json('metadata_json')->nullable();
            $table->foreignId('signed_by_user_id')->constrained('users');
            $table->string('signer_name_snapshot');
            $table->string('signer_role_snapshot');
            $table->dateTime('signed_at');
            $table->timestamps();
        });

        Schema::create('correction_notes', function (Blueprint $table) {
            $table->id();
            $table->string('corr_no')->unique();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->string('field_name');
            $table->text('old_value');
            $table->text('new_value');
            $table->text('reason');
            $table->foreignId('requested_by_user_id')->constrained('users');
            $table->foreignId('approved_by_user_id')->nullable()->constrained('users');
            $table->dateTime('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('correction_notes');
        Schema::dropIfExists('event_logs');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('attachments');
    }
};
