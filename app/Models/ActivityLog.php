<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_id', 'activity'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
