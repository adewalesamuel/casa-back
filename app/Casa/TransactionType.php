<?php

namespace App\Casa;

class TransactionType
{
    public const CREDIT = 'credit';
    public const DEBIT = 'debit';
    public const OTHER = 'other';

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }
}
