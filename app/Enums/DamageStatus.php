<?php

namespace App\Enums;

class DamageStatus
{
    public const REPORTED = 'REPORTED';
    public const VERIFIED = 'VERIFIED';
    public const REPAIR_PLANNED = 'REPAIR_PLANNED';
    public const IN_REPAIR = 'IN_REPAIR';
    public const QA_CHECK = 'QA_CHECK';
    public const COMPLETED = 'COMPLETED';
    public const SCRAPPED = 'SCRAPPED';
}
