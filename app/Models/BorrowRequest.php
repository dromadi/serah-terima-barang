<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BorrowRequest extends BaseModel
{
    protected $table = 'borrow_requests';

    protected $casts = [
        'requested_at' => 'datetime',
        'planned_start_at' => 'datetime',
        'planned_return_at' => 'datetime',
        'sla_breached_at' => 'datetime',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_user_id');
    }

    public function workType(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }

    public function areaUnit(): BelongsTo
    {
        return $this->belongsTo(AreaUnit::class, 'area_unit_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(BorrowItem::class);
    }

    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class, 'borrow_request_id');
    }

    public function returnEntry(): HasOne
    {
        return $this->hasOne(ReturnEntry::class, 'borrow_request_id');
    }
}
