<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFileType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
