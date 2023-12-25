<?php

namespace App\Http\Controllers\Backend;

use Session;
use DataTables;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\AgentProposal;
use Illuminate\Support\Carbon;
use App\Models\VerificationCenter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Admin\PayoutNotification;

class UsersController extends Controller
{
    // clients
    public function clients(){

        $clients = Role::where('name', 'client')->first()->users()->with(['projects', 'refunds', 'teckits', 'Verifiy', 'Wallet', 'invoices'])->orderBy('created_at', 'desc')->get();
        $paidUsers = DB::table("invoices")->select("invoices.*")->join("users","users.id","=","invoices.user_id")->groupBy("user_id")->count();
        return view('backend.admin.users.clients', compact('clients','paidUsers'));

    }

    public function getClientData(){

        $data = Role::where('name', 'client')->first()->users()->orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('company', function($row){
                return $row->companies()->first()->name;
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('admin.users.details' , $row->id) . '" class="edit btn btn-outline-info waves-effect btn-sm ">Edit</a> ';
                return $actionBtn;

            })
            ->rawColumns(['status','action','company'])
            ->make(true);
    }

    // agents
    public function agents(){

        $agents = Role::where('name', 'agent')->first()->users()->with(['projects', 'refunds', 'teckits', 'Verifiy', 'Wallet'])->orderBy('created_at', 'desc')->get();
        $verifiyagents = verificationCenter::where('status',1)->count();
        $verifiyPending = verificationCenter::where('status',0)->count();

        // dd($percent);

        return view('backend.admin.users.agents', compact('agents','verifiyagents','verifiyPending'));
    }

    public function getAgentsData(){

        $data = Role::where('name', 'agent')->first()->users()->orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('admin.users.details', $row->id) . '" class="edit btn btn-outline-info waves-effect btn-sm ">Edit</a> ';
                return $actionBtn;
                
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }

    public function roles(){
        
    }
    
    public function verificationCenter(){
        
        return view('backend.admin.users.verificationCenter');
    }
    public function getVerifications(){
        $data = VerificationCenter::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('agent', function($row){
                return '<span>' .$row->user->name .'<br>' . $row->user->email . '</span>';                
            })
            ->addColumn('note', function($row){
                if ($row->note == null) {
                    return '--------';
                } else {
                    return $row->note;
                }
            })
            ->addColumn('number', function($row){
                if ($row->number == null) {
                    return 'not yet';
                } else {
                    return $row->number;
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-dark ms-auto ">Pending</span>';
                } elseif($row->status == 1){
                    return '<span class="badge bg-label-info ms-auto ">accepted</span>';
                }
            })
            ->addColumn('action', function($row){
                if ($row->status == 0) {
                    return '<a onclick="return confirm()" href="' . route('admin.users.verificationsAccept' , $row->id) . '"  class=" btn btn-outline-success waves-effect btn-sm ">Accept</a> ';
                }else{
                    return '<a onclick="return confirm()" href="' . route('admin.users.verificationsReject' , $row->id) . '" class=" btn btn-outline-danger waves-effect btn-sm ">Reject</a> ';
                }
            })
            ->addColumn('documents', function($row){
                $actionBtn = '<a href="' . route('agent.file.download' , $row->documents ) . '" class="edit btn btn-outline-dark waves-effect btn-sm ">Download</a> ';
                return $actionBtn;
            })
            ->rawColumns(['agent', 'note', 'status', 'action', 'documents', 'created_at'])
            ->make(true);
    }
    public function verificationsAccept($id){

        $Verification = VerificationCenter::where('id',$id)->first();
        if ($Verification) {
            $Verification->update([
                'status' => 1,
            ]);
            $Verification->user->update([
                'verification' => 1,
            ]);
            return redirect()->back()->with([
                'message' => 'Done',
                'alert'  => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }
    }
    public function verificationsReject($id){

        $Verification = VerificationCenter::where('id',$id)->first();
        if ($Verification) {
            $Verification->update([
                'status' => 0,
            ]);
            $Verification->user->update([
                'verification' => 0,
            ]);
            return redirect()->back()->with([
                'message' => 'Done',
                'alert'  => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }
    }
    public function transactionHistory(){
        $allInvoices = Wallet::count();
        $paidInvoices = Wallet::where('status',1)->where('type','credit')->sum('amount');
        $unPaidInvoices = Wallet::where('status',0)->where('type','credit')->sum('amount');
        $withdrawInvoices = Wallet::where('status',1)->where('type','debit')->sum('amount');
        return view('backend.admin.transactions.transactionHistory', compact('allInvoices','unPaidInvoices', 'paidInvoices', 'withdrawInvoices'));
    }
    public function getTransactions(){
        $data = Wallet::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function($row){
                return '<span>' .$row->user->name .'<br>' . $row->user->email . '</span>';                
            }) 
            ->addColumn('type', function($row){
                if ($row->type == 'debit') {
                    return '<span class="badge bg-label-primary ms-auto ">debit <i class="ti ti-arrow-up ti-xs"></i></span>';
                } elseif($row->type == 'credit'){
                    return '<span class="badge bg-label-success ms-auto ">credit <i class="ti ti-arrow-down ti-xs"></i></span>';
                }
            })
            ->addColumn('description', function($row){
                return $row->description;
            })
            ->addColumn('amount', function($row){
                return $row->amount . '<sup> SAR</sup>';
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 1) {
                    return '<span class="badge bg-label-success ms-auto ">Paid</span>';
                } elseif($row->status == 0){
                    return '<span class="badge bg-label-danger ms-auto ">Unpaid</span>';
                }
            })
            ->addColumn('action', function($row){
                if ($row->status == 0) {
                    $actionBtn = '
                    <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                        <div class="dropdown">
                            <i class="ti ti-settings ti-xs cursor-pointer more-options-dropdown" role="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"></i>
                            <form method="post" action="'. route('admin.edit.transaction', $row->id) .'">
                                
                                <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                <div class="dropdown-menu dropdown-menu-end w-px-300 p-3" aria-labelledby="dropdownMenuButton">
                                    <div class="row g-3 p-3">
                                        <div class="col-md-12">
                                            <label for="method" class="form-label">method</label>
                                            <select name="method" id="method" class="form-select tax-select">
                                                <option value="Bank transfer">Bank transfer</option>
                                                <option value="Cash">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider my-3"></div>
                                    <button type="submit" class="mb-3 mx-3 btn btn-label-primary btn-apply-changes waves-effect">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>';

                    return $actionBtn;
                }
            })
            ->rawColumns(['user', 'type', 'description', 'amount', 'date', 'status','action'])
            ->make(true);
    }
    public function editTransaction(Request $req, $id)
    {
        $transaction = Wallet::where('id',$id)->first();
        // dd($transaction);
        if ($transaction->status == 0) {
            $transaction->update([
                'status' => 1,
                'description' => $req->method,
            ]);

            // $wallet = $user->transactions()->create($data);

            return redirect()->back()->with([
                'message' => 'Done',
                'alert'  => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }
    }
    public function withdrawHistory(){
        return view('backend.admin.withdraw.history');
    }
    public function getTPayoutHistory(){
        $data = Withdraw::get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function($row){
                return '<span>' .$row->user->name .'<br>' . $row->user->email . '</span>';                
            })
            ->addColumn('purpose', function($row){
                return $row->purpose;
            })
            ->addColumn('type', function($row){
                return $row->transactionType ;
            })
            ->addColumn('amount', function($row){
                return $row->transactionAmount . '<sup> SAR</sup>';
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 1) {
                    return '<span class="badge bg-label-success ms-auto ">Completed</span>';
                } elseif($row->status == 0){
                    return '<span class="badge bg-dark ms-auto ">Pending</span>';
                }
            })
            ->addColumn('action', function($row){
                
                $actionBtn = '<a href="javascript:void(0)" data-url="'. route('admin.debit.payout.show', $row->id) . '" class="show-detailss edit btn btn-outline-info waves-effect btn-sm">Show</a> ';
                return $actionBtn;
            })
            ->rawColumns(['user', 'purpose', 'amount','type', 'date', 'status', 'action'])
            ->make(true);
    }

    
    public function withdrawRequests(){
        return view('backend.admin.withdraw.requests');
    }
    public function getTPayoutRequests(){
        $data = Withdraw::where('status',0)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function($row){
                return '<span>' .$row->user->name .'<br>' . $row->user->email . '</span>';                
            })
            ->addColumn('purpose', function($row){
                return $row->purpose;
            })
            ->addColumn('type', function($row){
                return $row->transactionType ;
            })
            ->addColumn('amount', function($row){
                return $row->transactionAmount . '<sup> SAR</sup>';
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 1) {
                    return '<span class="badge bg-label-success ms-auto ">Completed</span>';
                } elseif($row->status == 0){
                    return '<span class="badge bg-dark ms-auto ">Pending</span>';
                }
            })
            ->addColumn('action', function($row){
                
                $actionBtn = '<a href="javascript:void(0)" data-url="'. route('admin.debit.payout.show', $row->id) . '" class="show-detailss edit btn btn-outline-info waves-effect btn-sm">Show</a> ';
                return $actionBtn;
            })
            ->rawColumns(['user', 'purpose','type', 'amount', 'date', 'status', 'action'])
            ->make(true);
    }

    // client Wallet Charging
    public function clientWalletCharging(Request $request, $id)
    {
        // dd($request->all());
        $user = User::where('id', $id)->first();
        // dd($user->name);
        if ($user) {
            $validation = Validator::make($request->all(), [
                'amount'      => 'required|numeric',
                'paymentType' => 'required|numeric',
    
            ]);
            // dd($id);
            if($validation->fails()){
                // dd($validation);
                return redirect()->route('admin.users.details', $user->id)->withErrors($validation)->withInput();
            }        
    
            $data['amount'] = $request->amount;
            $type = 0;
            if ($request->paymentType == 1) { // bank
                $type = 'Bank transfer';
            } elseif($request->paymentType == 0){ // unpaid
                $type = 'unpaid charging';
            }

            $data = ['type'  =>  'credit',
                'amount' => $data['amount'],
                'description' => $type,
                'status' => $request->paymentType,
            ];

            $wallet = $user->transactions()->create($data);
            return redirect()->back()->with([
                'message' => 'Added successfully',
                'alert'  => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'error',
                'alert'  => 'danger'
            ]);
        }
    }

    public function payoutShow($id)
    {
        $withdraw = Withdraw::where('id',$id)->with(['user' => function($q){
            $q->with(['payoutdata']);
        }])->first();
        return response()->json($withdraw);
    }
    public function payoutApprove(Request $req, $id){
        
        $withdraw = Withdraw::where('id',$id)->first();
        // dd($withdraw);
        if ($withdraw) {
            
            $user = $withdraw->user;
            // return $user->balance();
            if(!$user->allowWithdraw($withdraw->transactionAmount)) {
                // return error
                return redirect()->back()->with([
                    'message' => 'Invalid request',
                    'alert'  => 'danger'
                ]);
            }

            if ($withdraw) {
                $withdraw->update([
                    'status' => 1,
                ]);
    
                $data = ['type'  =>  'debit',
                        'amount' => $withdraw->transactionAmount,
                        'description' =>  $withdraw->purpose,
                        'status' => 1,
                        ];
                $wallet = $user->transactions()->create($data);
                // send notifiaction to agent
                $user->notify(new PayoutNotification(auth()->user()));
                
            } else{
                return redirect()->back()->with([
                    'message' => 'error',
                    'alert'  => 'danger'
                ]);
            }
            return redirect()->back()->with([
                'message' => 'done',
                'alert'  => 'success'
            ]);
        }
    }
    public function userDetails($id)
    {
        $user = User::where('id', $id)->with(['projects', 'withdraw','proposal','verification','invoices','transactions'])->first();
        $wallet = Wallet::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $countries = Country::get();

        return view('backend.admin.users.userDetails', compact('user','wallet','countries'));
    }
    public function getClientProjects($id)
    {
        $data = Project::where('user_id', $id)->with(['user', 'files', 'millstone'])->orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('Budget', function($row){
                if ($row->Budget == null) {
                    return 'notYet';
                } else {
                    return $row->Budget;
                }
            })
            ->addColumn('Proposals', function($row){
                if ($row->proposals == null) {
                    return 'not yet';
                } else {
                    return $row->proposals->count();
                }
            })
            ->addColumn('needShiping', function($row){
                if ($row->needShiping == 0) {
                    return 'no';
                } else {
                    return 'yes';
                }
            })
            ->addColumn('milestones', function($row){
                if ($row->millstone->count() == 0) {
                    return '<span class="badge rounded-pill bg-label-secondary">Not Yet</span>';
                } else {
                    return '<span class="badge rounded-pill bg-label-success">'. $row->millstone[0]->projectMillStone->name .'</span>';
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-dark ms-auto ">Pending</span>';
                } elseif($row->status == 1){
                    return '<span class="badge bg-label-info ms-auto ">accepted</span>';
                } elseif($row->status == 2){
                    return '<span class="badge bg-label-success ms-auto ">Ongoing</span>';
                } elseif($row->status == 3){
                    return '<span class="badge bg-label-primary ms-auto ">Completed</span>';
                } elseif($row->status == 4){
                    return '<span class="badge bg-label-danger ms-auto ">rejected</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('admin.project.single' ,$row->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm "><i class="fa-solid fa-eye"></i></a> ';
                return $actionBtn;
            })
            ->rawColumns([ 'milestones', 'Proposals', 'status', 'action', 'created_at', 'needShiping'])
            ->make(true);
    }

    public function getAgentProposals($id)
    {

        $data = AgentProposal::where('user_id', $id)->with(['project','agent'])->get();
        // dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('budget', function($row){
                if ($row->budget == null) {
                    return '---';
                } else {
                    return $row->budget . " SAR";
                }
            })
            ->addColumn('note', function($row){
                if ($row->note == null) {
                    return 'null';
                } else {
                    return $row->note;
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-dark ms-auto ">Pending</span>';
                } elseif($row->status == 1){
                    return '<span class="badge bg-label-info ms-auto ">Accepted</span>';
                } elseif($row->status == 2){
                    return '<span class="badge bg-label-success ms-auto ">Completed</span>';
                } elseif($row->status == 3){
                    return '<span class="badge bg-label-danger ms-auto ">rejected</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('agent.single.projects' ,$row->project->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm ">Show</a> ';
                return $actionBtn;
            })
            ->rawColumns(['budget','status', 'note', 'action', 'created_at'])
            ->make(true);
    }
    public function userUpdate(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $validation = Validator::make($request->all(), [
            'name'     => 'nullable|string',
            'phone'    => 'nullable|string',
            'address'  => 'nullable|string',
            'country'  => 'nullable|string',
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

        ]);
        // dd($request->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.users.details', $user->id)->withErrors($validation)->withInput();
        }        

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['supportTransfer'] = $request->supportTransfer ?? 0;
        $data['status'] = $request->status;
        $data['country'] = $request->country;
        $data['project_payment_mode'] = $request->project_payment_mode;

        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->back()->with([
            'message' => 'Saved successfully',
            'alert'  => 'success'
        ]);
    }
}
