<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends BaseModel
{
    protected $table = 'shipments';

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function borrowRequest(): BelongsTo
    {
        return $this->belongsTo(BorrowRequest::class);
    }
}
