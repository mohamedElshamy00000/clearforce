<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
