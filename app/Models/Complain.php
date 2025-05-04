<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function provider(){
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
