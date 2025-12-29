<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tool extends BaseModel
{
    protected $table = 'tools';

    protected $casts = [
        'calibration_required' => 'boolean',
        'last_calibration_date' => 'date',
        'next_calibration_due' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ToolCategory::class, 'category_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(ToolLocation::class, 'location_id');
    }

    public function areaUnit(): BelongsTo
    {
        return $this->belongsTo(AreaUnit::class, 'area_unit_id');
    }

    public function borrowItems(): HasMany
    {
        return $this->hasMany(BorrowItem::class);
    }
}
