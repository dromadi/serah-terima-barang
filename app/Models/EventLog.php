<?php

namespace App\Models;

class EventLog extends BaseModel
{
    protected $table = 'event_logs';

    protected $casts = [
        'metadata_json' => 'array',
        'signed_at' => 'datetime',
    ];
}
