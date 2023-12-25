<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function user(){
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
    public function users(){
        return $this->belongsToMany(User::class, 'company_users');
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function deliveryOrders(){
        return $this->hasMany(DeliveryOrder::class);
    }
}
