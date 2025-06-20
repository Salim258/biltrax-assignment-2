<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'cancelled_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billingRecords()
    {
        return $this->hasMany(BillingRecord::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}