<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairJob extends BaseModel
{
    protected $table = 'repair_jobs';

    protected $casts = [
        'planned_finish_at' => 'datetime',
        'sent_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    public function damageReport(): BelongsTo
    {
        return $this->belongsTo(DamageReport::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}
