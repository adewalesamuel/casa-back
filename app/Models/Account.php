<?php

namespace App\Models;

use App\Casa\Casa;
use App\Casa\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    /**
     * Get all of the transactions for the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function hasMinCreditBalance() {
        $transaction_credit_sum = $this->transactions()
        ->where('type', TransactionType::CREDIT)->sum('amount');
        $transaction_debit_sum = $this->transactions()
        ->where('type', TransactionType::DEBIT)->sum('amount');

        return ($transaction_credit_sum - $transaction_debit_sum) >= Casa::MIN_CREDIT_BALANCE;
    }
}
