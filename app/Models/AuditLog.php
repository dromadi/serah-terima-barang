<?php

namespace App\Models;

class AuditLog extends BaseModel
{
    protected $table = 'audit_logs';

    protected $casts = [
        'before_json' => 'array',
        'after_json' => 'array',
    ];
}
