<?php

namespace App\Enums;

class BorrowStatus
{
    public const DRAFT = 'DRAFT';
    public const SUBMITTED = 'SUBMITTED';
    public const APPROVED_L1 = 'APPROVED_L1';
    public const APPROVED_FINAL = 'APPROVED_FINAL';
    public const REJECTED = 'REJECTED';
    public const DISPATCHED = 'DISPATCHED';
    public const RETURNED = 'RETURNED';
    public const CLOSED = 'CLOSED';
}
