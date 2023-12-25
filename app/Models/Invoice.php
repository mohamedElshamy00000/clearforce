<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function tax(){
        return $this->belongsTo(TaxType::class, 'tax_type_id', 'id');
    }

}
