<?php

namespace App\Http\Controllers\Backend\Agent;

use DataTables;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Project;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\Userpayoutdata;
use App\Models\AgentInvitation;
use App\Models\VerificationCenter;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Agent\PayoutRquestNotification;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        if ($user->IfVerified() == false) {
            $verifications = VerificationCenter::where('user_id', Auth::user()->id)->get();

            return redirect()->route('agent.verification')->with('verifications', $verifications)->with([
                'message' => 'You must verify your account',
                'alert'  => 'danger'
            ]);

        } 
        $countries = Country::where('status', 1)->get();

        $totalAmount = Wallet::where('type', 'credit')->where('user_id', $user->id)->sum('amount');
        $proposals = $user->proposal;
        
        if ($user->payoutdata) {
            $userPayoutTypes = $user->payoutdata->where('status',1)->first();
        } else {
            $userPayoutTypes = null;
        }
        // dd($userPayoutTypes);
        return view('backend.agent.index', compact('proposals','userPayoutTypes', 'countries', 'totalAmount'));
    }
    public function helpcenter(){
        return view('backend.help_enter.home');
    }
    public function download($filename)
    {
        $file = public_path(). "/assets/files/verification/" . $filename;
        $headers = array('Content-Type: application/pdf',);
        return Response::download($file, $filename,$headers);
    }

    // store credit/debit transaction
    public function Walletstore(Request $request)
    {
        $user = auth()->user();
        $data = ['type'  =>  'credit',
                'amount' => $request->amount,
                'description' =>  $request->description,
                'status' => 1,
                ]; 
        $wallet = $user->transactions()->create($data);
        return $wallet;
    }

    public function withdrawHistory(){
        $user = auth()->user();
        $totalAmount = Wallet::where('type', 'credit')->where('user_id', $user->id)->sum('amount');
        $availableAmount = $user->balance();
        // dd($totalAmount);
        return view('backend.agent.payment.withdraw', compact('availableAmount','totalAmount'));
    }
    public function getTPayoutHistory(){
        $user = auth()->user();
        // dd($user);
        $data = Withdraw::where('user_id', $user->id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('purpose', function($row){
                return $row->purpose;
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
            ->rawColumns(['purpose', 'amount', 'date', 'status'])
            ->make(true);
    }

    public function getTAgentInviets(){
        $user = auth()->user();
        // dd($user);
        $data = AgentInvitation::where('user_id', $user->id)->with(['project' => function($q){
            $q->with(['countryfrom','countryto']);
        }])->get();
        // dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('type', function($row){
                if ($row->project->type == 1){
                    return '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transfer-in" width="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                        <path d="M4 14h9"></path>
                        <path d="M10 11l3 3l-3 3"></path>
                    </svg>';
                } else {
                    return '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transfer-out" width="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 19v2h16v-14l-8 -4l-8 4v2"></path>
                    <path d="M13 14h-9"></path>
                    <path d="M7 11l-3 3l3 3"></path>
                </svg>';
                }
            })

            ->addColumn('countryTo', function($row){
                return $row->project->countryto->name ;
            })
            ->addColumn('countryFrom', function($row){
                return $row->project->countryfrom->name ;
            })
            ->addColumn('port', function($row){
                if (App::isLocale('ar')) {
                    return $row->project->port->name_ar ;
                } else {
                    return $row->project->port->name_en ;
                }
            })
            ->addColumn('arrivalDate', function($row){
                return $row->project->arrivalDate ;
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('agent.single.projects' ,$row->project->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm ">'. __('general.Show') .'</a> ';
                if ($row->project->status > 1) {
                    return $actionBtn;
                } else {
                    return $actionBtn;
                }
            })
            ->rawColumns(['type', 'countryTo','countryFrom','arrivalDate','port', 'date','action'])
            ->make(true);
    }
    public function payoutUserDataStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'iban'    => 'nullable|string',
            'country' => 'required|string',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = auth()->user();
        $userId = $user->payoutdata()->create([
            'iban'    => $request->iban,
            'country' => $request->country,
            'status'  => 1,
        ]);

        return redirect()->back()->with([
            'message' => 'added successfully',
            'alert'  => 'success'
        ]);        
        // return $request->all();
    }

    public function sendWithdrawrequest(Request $request)
    {
        $user = auth()->user();
        if(!$user->allowWithdraw($request->amount)) {
            // return error
            return redirect()->back()->with([
                'message' => 'Invalid request, your balance ' . $user->balance(),
                'alert'  => 'danger'
            ]); 
        }
        if($request->amount < 100) {
            // return error
            return redirect()->back()->with([
                'message' => 'The minimum withdrawal is 100 SAR',
                'alert'  => 'danger'
            ]); 
        }
        $data = ['transactionType'  =>  'bank',
                'transactionAmount' => $request->amount,
                'purpose' =>  'payout',
                'status' => 0,
                ];

        $wallet = $user->withdraw()->create($data);

        // send notifiaction to admin
        $admins = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();
        foreach ($admins as $key => $admin) {
            $admin->notify(new PayoutRquestNotification(auth()->user()));
        }

        return redirect()->back()->with([
            'message' => 'sent successfully',
            'alert'  => 'success'
        ]); 

        // return $request->all();
    }

}
