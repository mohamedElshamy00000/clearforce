<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Projects::class);
    }

    public function fileType()
    {
        return $this->belongsTo(ProductFileType::class, 'product_file_type_id');
    }
    
}
