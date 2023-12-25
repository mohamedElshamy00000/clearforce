<?php

namespace App\Models;

use App\Models\Wallet;
use App\Models\Invoice;
use App\Models\Withdraw;
use App\Models\Userpayoutdata;
use App\Models\AgentInvitation;
use Laravel\Sanctum\HasApiTokens;
use App\Models\VerificationCenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, EntrustUserWithPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new VerifyEmail);
    // }
    

    public function companies(){
        return $this->belongsToMany(Company::class, 'company_users','user_id', 'company_id');
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function withdraw(){
        return $this->hasMany(Withdraw::class);
    }
    public function refunds(){
        return $this->hasMany(Refund::class);
    }
    public function teckits(){
        return $this->hasMany(Support::class);
    }
    public function proposal(){
        return $this->hasMany(AgentProposal::class);
    }
    public function invitations(){
        return $this->hasMany(AgentInvitation::class);
    }
    public function article(){
        return $this->hasMany(Article::class);
    }
    public function Verifiy(){
        return $this->hasMany(VerificationCenter::class);
    }
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    public function Wallet(){
        return $this->hasOne(Wallet::class);
    }

    public function verification(){
        return $this->hasOne(VerificationCenter::class);
    }
    public function payoutdata(){
        return $this->hasOne(Userpayoutdata::class);
    }
    
    public function IfVerified(){
        if ($this->verification()->where('status', 1)->count() > 0) {
            return $this->verification()->where('status', 1)->first();
        } else {
            return false;
        }
    }
    public function tickets(){
        return $this->hasMany(SupportTicket::class);
    }

    // wallet
    public function transactions()
    {
        return $this->hasMany(Wallet::class);
    }
    public function validTransactions()
    {
        return $this->transactions()->where('status', 1);
    }
    public function credit()
    {
        return $this->validTransactions()
                    ->where('type', 'credit')
                    ->sum('amount');
    }
    public function debit()
    {
        return $this->validTransactions()
                    ->where('type', 'debit')
                    ->sum('amount');
    }
    public function balance()
    {
        return $this->credit() - $this->debit();
    }
    public function allowWithdraw($amount) : bool
    {
        return $this->balance() >= $amount;
    }
    
    public function ticketMessages(){
        return $this->hasOne(SupportMessage::class);
    }
    public function deliveryOrders(){
        return $this->hasMany(DeliveryOrder::class);
    }

}
