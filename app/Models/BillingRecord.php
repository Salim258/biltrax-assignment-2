<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingRecord extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_id', 'status', 'amount'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}