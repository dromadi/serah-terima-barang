<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowItem extends BaseModel
{
    protected $table = 'borrow_items';

    public function borrowRequest(): BelongsTo
    {
        return $this->belongsTo(BorrowRequest::class);
    }

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
