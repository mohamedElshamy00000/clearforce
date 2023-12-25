<?php

namespace App\Http\Controllers\Backend\Client;

use PDF;
use Exception;
use DataTables;
use App\Models\Wallet;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\SendInvoiceNotification;

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
        $user = auth()->user();
        // Notification::send($user, new WelcomeNotification);
        $amountSpent = Wallet::select('type','amount')->where('user_id', $user->id)->where('status',1)->where('type','credit')->sum('amount');
        // dd($amountSpent);
        // $company = Company::where('user_id', $user->id)->first();
        $company = $user->companies()->first();
        $projects = $company->projects()->with('hscodes','countryfrom','countryto','shipingMode','port')->orderBy('created_at', 'desc')->paginate(5);
        // $projects = $user->projects()->orderBy('created_at', 'desc')->paginate(5);
        $projectsCount = $company->projects()->select('status')->get();
        return view('backend.client.index', compact('amountSpent', 'projects','projectsCount'));
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
    //withdraw request
    public function withdraw(Request $request)
    {
        $user = auth()->user();
        if(!$user->allowWithdraw($request->amount)) {
            // return error
            return 'Invalid request';
        }
        $data = ['type'  =>  'debit',
                'amount' => $request->amount,
                'description' =>  $request->description,
                'status' => 1,
                ];
        $wallet = $user->transactions()->create($data);
        return $wallet;
    }
    //check available 
    public function checkBalance()
    {
        $user = auth()->user();
        return $user->balance();
    }

    public function paymentInvoices(){
        return view('backend.client.payment.invoices');
    }
    public function clientGetInvoices(){
        $user = auth()->user();
        // dd($user);
        $data = Invoice::where('user_id', $user->id)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function($row){
                return $row->transaction_id;
            })
            ->addColumn('amount', function($row){
                return $row->amount . '<sup> SAR</sup>';
            })

            ->addColumn('discount', function($row){
                if ($row->discount) {
                    return $row->discount ;
                } else {
                    return 0 ;
                }
            })
            ->addColumn('comment', function($row){
                if ($row->comment) {
                    return $row->comment ;
                } else {
                    return "---" ;
                }
            })

            // ->addColumn('tax', function($row){
            //     return $row->tax_type_id;
            // })
            ->addColumn('project', function($row){
                $actionBtn = '<a href="' . route('single.project' ,$row->project->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm "> <i class="fa fa-link"></i> </a> ';
                return $actionBtn;
            })
            ->addColumn('date', function($row){
                $old_date_timestamp = strtotime($row->created_at);
                $new_date = date('Y-m-d H:i:s', $old_date_timestamp);  
                return $new_date;
            })
            ->addColumn('status', function($row){
                if ($row->status == 1) {
                     
                    return '<span class="badge bg-label-success ms-auto">Paid</span>';
                } elseif($row->status == 0){
                    return '<span class="badge bg-dark ms-auto ">Unpaid</span>';
                }
            })
            ->rawColumns(['note', 'amount', 'date','project', 'status'])
            ->make(true);
    }
    public function myTransactions(Type $var = null)
    {
        $user = auth()->user();
        $allInvoices = $user->wallet()->count();
        $unPaidInvoices = $user->wallet()->where('status',0)->where('type','credit')->sum('amount');
        $paidInvoices    = $user->wallet()->where('status',1)->where('type','credit')->sum('amount');
        $withdrawInvoices = $user->wallet()->where('status',1)->where('type','debit')->sum('amount');
        return view('backend.client.payment.transactionHistory', compact('allInvoices', 'withdrawInvoices', 'paidInvoices', 'unPaidInvoices'));
    }
    public function getMyTransactions()
    {
        $data = auth()->user()->transactions();
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('type', function($row){
                if ($row->type == 'debit') {
                    return '<span class="badge bg-label-success ms-auto "><i class="ti ti-arrow-down ti-xs"></i></span>';
                } elseif($row->type == 'credit'){
                    return '<span class="badge bg-label-primary ms-auto "><i class="ti ti-arrow-up ti-xs"></i></span>';
                }
            })
            ->addColumn('description', function($row){
                return $row->description;
            })
            ->addColumn('amount', function($row){
                return $row->amount . '<sup> SAR</sup>';
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('Y-m-d / H:i A');                
            })
            ->addColumn('status', function($row){
                if ($row->status == 1) {
                    return '<span class="badge bg-label-success ms-auto ">Paid</span>';
                } elseif($row->status == 0){
                    return '<span class="badge bg-label-danger ms-auto ">Unpaid</span>';
                }
            })
            
            ->rawColumns(['type', 'description', 'amount', 'date', 'status'])
            ->make(true);
    }

    public function ProjectInvoiceDownload($uuid)
    {
        
        $project = Project::where('uuid', $uuid)->with(['ProjectInvoice','Invoice'])->first();
        if ($project) {
            $projectInvoices = $project->ProjectInvoice->sum('amount');
            // main invoice bu moyasar
            $Invoices = $project->Invoice->sum('amount');
            // totla payments in projetc
            $subtotal = $projectInvoices + $Invoices;
            // taxs
            $taxs     = 0;
            // if tax
            if ($project->Invoice->tax) {
                // get taxs percentage
                $taxs     = $project->Invoice->tax->percentage;
            }
            // dd($project->Invoice->tax);
            // calc taxs 
            $taxsCalc = $Invoices / 100 * $taxs;
            // amount total spent
            $total    = $subtotal + $taxsCalc;

            $data = [
                'project' => $project,
                'subtotal' => $subtotal,
                'taxs' => $taxs,
                'taxsCalc' => $taxsCalc,
                'total' => $total,
                'message' => 0,
            ];

            $pdf = PDF::loadView('emails.invoice', compact('data'));
            return $pdf->download('invoice.pdf');

        }
        return redirect()->back()->with([
            'message' => 'invoice error',
            'alert'  => 'danger'
        ]);

    }

    public function sendInvoiceToMail(Request $request, $uuid)
    {
        // dd($request->all());

        $project = Project::where('uuid', $uuid)->with(['ProjectInvoice','Invoice'])->first();

        if ($project) {
            // project invoices
            
            try {

                $projectInvoices = $project->ProjectInvoice->sum('amount');
                // main invoice bu moyasar
                $Invoices = $project->Invoice->sum('amount');
                // totla payments in projetc
                $subtotal = $projectInvoices + $Invoices;
                // taxs
                $taxs     = 0;
                // if tax
                if ($project->Invoice->tax) {
                    // get taxs percentage
                    $taxs     = $project->Invoice->tax->percentage;
                }
                // dd($project->Invoice->tax);
                // calc taxs 
                $taxsCalc = $Invoices / 100 * $taxs;
                // amount total spent
                $total    = $subtotal + $taxsCalc;
    
                $data = [
                    'project' => $project,
                    'subtotal' => $subtotal,
                    'taxs' => $taxs,
                    'taxsCalc' => $taxsCalc,
                    'total' => $total,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ];
                Notification::route('mail', $request->sendTo)->notify(new SendInvoiceNotification($data, auth()->user()));
                return redirect()->back()->with([
                    'message' => 'sent invoice succesfully ',
                    'alert'  => 'success'
                ]);
                
            } catch (Exception $ex) {
    
                return redirect()->back()->with([
                    'message' => 'error',
                    'alert' => 'danger'
                ]);
    
            }

        }
    }
    
}
