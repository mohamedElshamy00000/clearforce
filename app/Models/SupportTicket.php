<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function messages()
    {
        return $this->hasMany(SupportMessage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
