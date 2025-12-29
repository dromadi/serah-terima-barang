<?php

namespace App\Services;

use App\Models\SlaSetting;
use Carbon\Carbon;

class SlaService
{
    public function getTargetHours(string $key): float
    {
        return (float) (SlaSetting::where('key', $key)->value('value') ?? 0);
    }

    public function isBreached(Carbon $start, Carbon $end, float $targetHours, BusinessTimeService $businessTime): bool
    {
        return $businessTime->businessDurationInHours($start, $end) > $targetHours;
    }
}
