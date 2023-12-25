<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ports extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function mode(){
        return $this->belongsTo(ShipingMode::class, 'shiping_mode_id', 'id');
    }
}
