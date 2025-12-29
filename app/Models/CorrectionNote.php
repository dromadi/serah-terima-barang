<?php

namespace App\Models;

class CorrectionNote extends BaseModel
{
    protected $table = 'correction_notes';

    protected $casts = [
        'approved_at' => 'datetime',
    ];
}
