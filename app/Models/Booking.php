<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }
    public function provider(){
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function servicebooking(){
        return $this->belongsTo(StudioService::class, 'service_id');
    }


    public function payment(){
        return $this->belongsTo(Payment::class, 'booking_id');
    }
    protected $guarded = [];

}
