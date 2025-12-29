<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnItem extends BaseModel
{
    protected $table = 'return_items';

    public function returnEntry(): BelongsTo
    {
        return $this->belongsTo(ReturnEntry::class, 'return_id');
    }
}
