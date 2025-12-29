<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->row_version = 1;
        });

        static::updating(function (self $model) {
            $model->row_version = $model->row_version + 1;
        });
    }
}
