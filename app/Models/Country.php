<?php

namespace App\Models;

use App\Models\Ports;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ports(){
        return $this->hasMany(Ports::class);
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
