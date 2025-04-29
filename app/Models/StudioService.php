<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function studio()
    {
        return $this->belongsTo(ServiceCategory::class, 'category');
    }

    public function provider(){
        return $this->belongsTo(User::class, 'provider_id');
    }

}
