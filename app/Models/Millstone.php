<?php

namespace App\Models;

use App\Models\ProjectMillstone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Millstone extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function projectMillStone(){
        return $this->belongsTo(ProjectMillstone::class, 'project_millstone_id');
    }
}
