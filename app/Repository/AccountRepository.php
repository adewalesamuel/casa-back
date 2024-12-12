<?php

namespace App\Repository;

use App\Models\Account;

class AccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(array $validated): Account {
        $account = new Account;

        $account->is_active = $validated['is_active'] ?? null;
		$account->user_id = $validated['user_id'] ?? null;

        $account->save();

        return $account;
    }
}
