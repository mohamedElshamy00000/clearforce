<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\ShipingMode;
use Illuminate\Support\Str;
use App\Models\SupportTicket;
use App\Models\AgentInvitation;
use App\Models\ProjectEndRequest;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SearchableTrait;
    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'projects.type' => 2,
            'projects.countryTo' => 2,
            'projects.countryFrom' => 2,
            'projects.port_id' => 2,
            'projects.shiping_mode_id' => 2,
        ],
        // 'joins' => [
        //     'user_skills' => ['users.id', 'user_skills.user_id' ],
        // ]
    ];

    // status 
    // 0 = new
    // 1 = accepted
    // 2 = Ongoing
    // 3 = Completed
    // 4 = rejected

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    // public function hscode(){
    //     return $this->belongsTo(HsCode::class, 'hs_code_id');
    // }
    public function hscodes()
    {
        return $this->belongsToMany(HsCode::class, 'project_hscodes');
    }
    public function port(){
        return $this->belongsTo(Ports::class);
    }
    public function shipingMode(){
        return $this->belongsTo(ShipingMode::class);
    }
    public function files(){
        return $this->hasMany(ProjectFile::class);
    }
    public function ProjectInvoice(){
        return $this->hasMany(ProjectInvoice::class);
    }
    public function deliveryOrders(){
        return $this->hasMany(DeliveryOrder::class);
    }
    public function Invoice(){
        return $this->hasOne(Invoice::class);
    }
    public function proposals(){
        return $this->hasMany(AgentProposal::class);
    }
    public function invitations(){
        return $this->hasMany(AgentInvitation::class);
    }
    public function millstone(){
        return $this->hasMany(Millstone::class);
    }
    public function ProjectStatus(){
        return $this->hasMany(ProjectStatus::class);
    }
    public function refund(){
        return $this->hasMany(Refund::class);
    }
    public function tickets(){
        return $this->hasMany(SupportTicket::class);
    }
    public function countryfrom(){
        return $this->belongsTo(Country::class, 'countryFrom', 'id');
    }
    public function countryto(){
        return $this->belongsTo(Country::class, 'countryTo', 'id');
    }

    public function endRequests(){
        return $this->hasMany(ProjectEndRequest::class);
    }
    
    public function Status(){

        if ($this->status == 0) {
            return '<span class="badge bg-label-dark ms-auto mb-3">Pending</span>';
        } elseif($this->status == 1){
            return '<span class="badge bg-label-info ms-auto mb-3">accepted</span>';
        } elseif($this->status == 2){
            return '<span class="badge bg-label-success ms-auto mb-3">Ongoing</span>';
        } elseif($this->status == 3){
            return '<span class="badge bg-label-primary ms-auto mb-3">Completed</span>';
        } elseif($this->status == 4){
            return '<span class="badge bg-label-danger ms-auto mb-3">rejected</span>';
        }
    }

    public function ActiveProposal(){
        if ($this->proposals->where('status', 1)->count() > 0) {
            return $this->proposals->where('status', 1)->first();
        } else {
            return false;
        }
    }
}
