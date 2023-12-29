<?php

namespace App\Http\Controllers\Backend;
use DataTables;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Country;
use App\Models\Project;
use App\Models\ContactUs;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Models\ProjectInvoice;
use App\Models\QuestionsCategory;
use App\Models\VerificationCenter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use AndreasElia\Analytics\Nova\Dashboards\Analytics;

class IndexController extends Controller
{
    
    public function index(){

        $user = auth()->user();
        $projects = Project::select('id','status')->get();

        $clients = User::whereHas('roles', function($q)
        {
            $q->where('name', 'client');
        })->get();
        $paidInvoices = 0;

        foreach ($clients as $key => $client) {
            $paidInvoices += $client->transactions->where('status',1)->where('type','credit')->sum('amount');
        }

        $withdrawInvoices = Wallet::where('status',1)->where('type','debit')->sum('amount');
        $clients = Role::where('name', 'client')->first()->users()->count();
        $agents = Role::where('name', 'agent')->first()->users()->count();
        $paidUsers = DB::table("invoices")->select("invoices.*")->join("users","users.id","=","invoices.user_id")->groupBy("user_id")->count();
        $verifiyagents = verificationCenter::where('status',1)->count();
        $verifiyPending = verificationCenter::where('status',0)->count();
        $unpaidSubInvoices = ProjectInvoice::where('client_payment_status', null)->where('invoice_type', '!=', 0)->sum('amount');
        return view('backend.admin.index', compact('unpaidSubInvoices','projects','paidInvoices','withdrawInvoices','clients','agents','paidUsers','verifiyagents','verifiyPending'));
        
    }
    public function download($filename)
    {
        $file = public_path(). "/assets/files/projects/" . $filename;
        if ($file) {
            $ex = File::extension($file);
            dd($ex);
            // if ($ex == 'pdf') {
            //     $headers = array('Content-Type: application/pdf',);
            // } elseif($ex == 'jpeg' || $ex == 'png'){
            //     $headers = array('Content-Type: image/jpeg');
            // } 
            return Response::download($file);
            
        } else {
            return redirect()->back()->with([
                'message' => 'File not found',
                'alert'  => 'danger'
            ]);
        }
    }
    public function downloadFile($path,$filename)
    {
        $file = public_path(). "/assets/files/" . $path .'/'. $filename;

        if ($file) {
            // $headers = array('Content-Type: application/pdf',);
            // return Response::download($file, $filename,$headers);                
            return Response::download($file);                
        } else {
            return redirect()->back()->with([
                'message' => 'File not found',
                'alert'  => 'danger'
            ]);
        }

    }
    public function helpcenter()
    {
        $questions = Questions::where('status',1)->orderBy('created_at', 'desc')->get();
        $qCategory = QuestionsCategory::where('status',1)->orderBy('created_at', 'desc')->get();

        foreach (Auth::user()->roles as $role)
        {
            if ($role->name == 'agent')
            {
                return view('backend.agent.help_enter.home', array('user' => Auth::user(), 'questions' => $questions,'qCategory' => $qCategory));

            } elseif($role->name == 'client'){

                return view('backend.client.help_enter.home', array('user' => Auth::user(), 'questions' => $questions,'qCategory' => $qCategory));

            }
        }
    }
    public function contacts(){
        return view('backend.admin.contactUs');
    }
    public function getContacts()
    {
        $data = ContactUs::orderBy('created_at', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('email', function($row){
                return $row->email;
            })
            ->addColumn('subject', function($row){
                return $row->subject;
            })
            ->addColumn('message', function($row){
                return '<p class="mb-0">' . nl2br($row->message) . '</p>';
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('d/m/Y');
            })
            ->rawColumns(['name','email','subject','message','created_at'])
            ->make(true);
    }
    
}
