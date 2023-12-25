<?php

namespace App\Models;

use App\Models\Millstone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectMillstone extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function millstone(){
        return $this->hasMany(Millstone::class);
    }
    
}
