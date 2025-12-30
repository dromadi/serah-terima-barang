<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DamageReport extends BaseModel
{
    protected $table = 'damage_reports';

    protected $casts = [
        'reported_at' => 'datetime',
        'verified_at' => 'datetime',
        'planned_return_at' => 'datetime',
        'sla_breached_at' => 'datetime',
    ];

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }

    public function workType(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by_user_id');
    }

    public function repairJob(): HasOne
    {
        return $this->hasOne(RepairJob::class);
    }
}
