<?php

namespace App\Services;

use App\Models\Holiday;
use Carbon\Carbon;

class BusinessTimeService
{
    public function isBusinessDay(Carbon $date): bool
    {
        if ($date->isWeekend()) {
            return false;
        }

        return !Holiday::whereDate('date', $date->toDateString())->exists();
    }

    public function businessDurationInHours(Carbon $start, Carbon $end): float
    {
        if ($end->lessThanOrEqualTo($start)) {
            return 0;
        }

        $totalMinutes = 0;
        $cursor = $start->copy();

        while ($cursor->lessThan($end)) {
            $dayStart = $cursor->copy()->setTime(8, 0);
            $dayEnd = $cursor->copy()->setTime(17, 0);

            if ($this->isBusinessDay($cursor)) {
                $rangeStart = $cursor->copy()->greaterThan($dayStart) ? $cursor->copy() : $dayStart;
                $rangeEnd = $end->copy()->lessThan($dayEnd) ? $end->copy() : $dayEnd;

                if ($rangeEnd->greaterThan($rangeStart)) {
                    $totalMinutes += $rangeEnd->diffInMinutes($rangeStart);
                }
            }

            $cursor = $cursor->addDay()->startOfDay();
        }

        return round($totalMinutes / 60, 2);
    }
}
