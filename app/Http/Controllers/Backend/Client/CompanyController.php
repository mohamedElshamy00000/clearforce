<?php

namespace App\Http\Controllers\Backend\Client;
use DataTables;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\CompanySendInvitationNotification;

class CompanyController extends Controller
{
    public function index($id)
    {
        $companys = auth()->user()->companies();
        $company  = Company::where('id', $id)->first();
        if ($company && $company->user_id == auth()->user()->id) {
            return view('backend.client.company.company_details', compact('companys','company'));
        }else{
            return redirect()->route('client.index')->with([
                'message' => 'access forbidden',
                'alert'  => 'danger'
            ]);
        }
        
    }

    public function createUser(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'numeric', 'unique:users'],
            'country'  => ['required', 'string'],
            'company'  => ['required', 'string'],
        ]);

        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->route('client.company',$request->company)->withErrors($validation)->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'country'  => $request->country,
            'password' => Hash::make('C#SDSRBR%33'),
            'type'     => 1,
        ]);
        $company = Company::where('id', $request->company)->first();
        $company->users()->attach($user);
        $role = Role::where('name', '=', 'client')->first();  //choose the default role upon user creation.        
        $user->attachRole($role);

        Notification::send($user, new CompanySendInvitationNotification($company , auth()->user()));
        return redirect()->route('client.company',$request->company)->with([
            'message' => 'The user has been added successfully',
            'alert'  => 'success'
        ]);
    }

    public function updateUser(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'numeric', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $company = Company::where('user_id', auth()->user()->id)->first();

        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->route('client.company',$company->id)->withErrors($validation)->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        Notification::send($user, new CompanySendInvitationNotification($request->company , auth()->user()));
        return redirect()->route('client.company',$company)->with([
            'message' => 'edite successfully',
            'alert'  => 'success'
        ]);
    }

    public function storage($id)
    {
        $company = Company::select('id')->where('id', $id)->first();
        if ($company) {
            return view('backend.client.company.storage.storage', compact('company'));
        }else{
            return redirect()->route('client.index')->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }
    }
    public function createDeliveryOrder($project_id)
    {
        $project = Project::where('uuid',$project_id)->first();
        $company = $project->company;
        if ($company->address == null || $company->registration == null) {
            return redirect()->route('client.company', $company->id)->with([
                'message'    => 'Add address and registration NO',
                'edit_model' => 'true',
                'alert'      => 'danger'
            ]);
        }
        if ($company && $project) {
            return view('backend.client.company.storage.create_delivary_order', compact('company', 'project'));
        }else{
            return redirect()->route('client.index')->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }
    }
    public function storeDeliveryOrder(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'deliver_date'    => 'required|string',
            'deliver_time'    => 'required|string',
            'deliver_to'      => 'required|string',
            'deliver_address' => 'required|string',
            'description'     => 'required|string',
            'qty'             => 'required|string',
            'remarks'         => 'nullable|string',
        ]);
        
        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $company = Company::where('id', $request->company_id)->first();
        $data['company_name']     = $company->name;
        $data['company_id']       = $request->company_id;
        $data['project_id']       = $request->project_id;
        $data['user_id']          = auth()->user()->id;
        
        $data['deliver_date']     = $request->deliver_date;
        $data['deliver_time']     = $request->deliver_time;
        $data['deliver_to']       = $request->deliver_to;
        $data['deliver_address']  = $request->deliver_address;
        $data['remarks']          = $request->remarks;
        $data['address']          = $company->address;
        $data['description']      = $request->description;
        $data['qty']              = $request->qty;
        
        // dd($data);
        
        $DeliveryOrder = DeliveryOrder::create($data);

        // send notifiaction to admin
        // $users = User::whereHas('roles', function($q)
        // {
        //     $q->where('name', 'admin');
        // })->get();

        // foreach ($users as $key => $user) {
        //     $user->notify(new CreateProjectNotification($Project, auth()->user()));
        // }

        return redirect()->route('client.storage',$request->company_id)->with([
            'message' => 'Delivery Order has been added successfully',
            'alert'  => 'success'
        ]);

    }
    public function GetDeliveryOrder($company_id)
    {
        $data = DeliveryOrder::where('company_id', $company_id)->orderBy('id', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function($row){
                return '<div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded-circle bg-label-secondary text-body">
                            <i class="ti ti-truck"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a class="text-body fw-medium" href="'. route('client.storage.view.deliveryOrder', $row->id) .'">DO-'. $row->id.'</a>
                </div>
            </div>';
            })
            ->addColumn('arivalDate', function($row){
                return '<div class="d-flex justify-content-start align-items-center"><div class="me-2"><i class="ti ti-clock mt-n1"></i></div><h6 class="mb-0 fw-normal">'. $row->deliver_date .'</h6></div>';
            })
            ->addColumn('starting', function($row){
                return $row->project->port->name_en;
            })
            ->addColumn('ending', function($row){
                return $row->deliver_address;              
            })
            ->addColumn('project', function($row){
                
                $actionBtn = '<a href="'. route('single.project', $row->project->uuid) .'" id="show-details" class="edit btn btn-outline-info waves-effect btn-sm">'. 'P-#'. $row->project->id .'</a> ';
                if ($row->project != null) {
                    return $actionBtn;
                }
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge rounded bg-label-info">Waiting</span>';
                }  elseif ($row->status == 1){
                    return '<span class="badge rounded bg-label-warning">Loading</span>';
                }  elseif ($row->status == 2){
                    return '<span class="badge rounded bg-label-primary">On the way</span>';
                }  elseif ($row->status == 3){
                    return '<span class="badge rounded bg-label-success">in warehouse</span>';
                }          
            })
            ->addColumn('progress', function($row){
                $progress = '0';
                if ($row->status == 1){
                    $progress = '15%';
                }  elseif ($row->status == 2){
                    $progress = '50%';
                }  elseif ($row->status == 3){
                    $progress = '100%';
                }  
                return '<div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: '.$progress.'" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100"></div>
              </div>';             
            })
            ->rawColumns(['id','arivalDate', 'starting', 'ending', 'project','status', 'progress'])
            ->make(true);
    }

    public function viewDeliveryOrder($id)
    {
        $order = DeliveryOrder::where('id', $id)->first();

        if ($order) {
            $company = Company::where('id', $order->company_id)->first();
            $project = Project::where('id', $order->project_id)->first();
            return view('backend.client.company.storage.view_delivery_order', compact('order','company','project'));
        }else{
            return redirect()->route('client.index')->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }

    }

    public function companyEdit(Request $request, $id)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name'         => 'required|string',
            'address'      => 'required|string',
            'registration' => 'required|string',
        ]);
        
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $company = Company::where('id', $id)->first();
        if ($company) {
            
            $data['name']         = $company->name;
            $data['address']      = $request->address;
            $data['registration'] = $request->registration;
            
            $company->update($data);
            return redirect()->route('client.company', $id)->with([
                'message' => 'done',
                'alert'  => 'success'
            ]);
        }
        return redirect()->route('client.index')->with([
            'message' => 'Error',
            'alert'  => 'danger'
        ]);
    }
}
