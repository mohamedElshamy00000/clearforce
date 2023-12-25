<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipingMode extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ports(){
        return $this->hasMany(Ports::class);
    }
    public function projects(){
        return $this->hasMany(Ports::class);
    }
}
