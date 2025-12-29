<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class AutoNumberService
{
    public function generate(string $prefix, string $dateFormat = 'Y'): string
    {
        $year = now()->format($dateFormat);
        $cacheKey = sprintf('%s:%s', $prefix, $year);
        $counter = Cache::increment($cacheKey);

        return sprintf('%s-%s-%04d', $prefix, $year, $counter);
    }

    public function exportBatchId(): string
    {
        return sprintf('TRL-EXP-%s', now()->format('Ymd-His'));
    }
}
