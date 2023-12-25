<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Models\Role;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\AgentProposal;
use App\Models\ProjectInvoice;
use Illuminate\Support\Carbon;
use App\Models\ProjectMillstone;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Admin\PaymentNotification;
use App\Notifications\Admin\AgentInviteNotification;
use App\Notifications\Admin\UpdateBudgetNotification;
use App\Notifications\Admin\ApprovedInvoiceNotification;
use App\Notifications\User\ClientDelegationNotification;
use App\Notifications\Admin\AcceptAgentProposalNotification;

class ProjectsController extends Controller
{
    // projects
    public function index(){
        $projects = Project::with(['user', 'hscodes', 'files', 'millstone', 'refund'])->orderBy('created_at', 'desc')->get();

        // Calculate percentage increase or decrease in projects from last 30 days
        // $dateFrom = Carbon::now()->subDays(30);
        // $dateTo = Carbon::now();
        // $monthly = Project::whereBetween('created_at', [$dateFrom, $dateTo])->count();
        // $previousDateFrom = Carbon::now()->subDays(60);
        // $previousDateTo = Carbon::now()->subDays(31);
        // $previousMonthly = Project::whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();
        // if ($previousMonthly < $monthly) {
        //     if ($previousMonthly > 0) {
        //         $percent_from = $monthly - $previousMonthly;
        //         (int)  $percent = $percent_from / $previousMonthly * 100; //increase percent
        //     } else {
        //         (int) $percent = 100; 
        //     }
        // } else {
        //     $percent_from = $previousMonthly - $monthly;
        //     (int) $percent = $percent_from / $previousMonthly * 100; 
        // }

        $previousMonthProject = Project::whereMonth('created_at', now()->month - 1)->count();
        $thisMonthProject = Project::whereMonth('created_at', now()->month)->count();
        if ($previousMonthProject > 0) {
        // If it has decreased then it will give you a percentage with '-'
        $differenceInpercentage = ($thisMonthProject - $previousMonthProject) * 100 / $previousMonthProject;
        } else {
        $differenceInpercentage = $thisMonthProject > 0 ? '100%' : '0%';
        }
        
        return view('backend.admin.projects.allProjects', compact('projects','differenceInpercentage','thisMonthProject'));
    }

    public function getProjectsData(){
        $data = Project::with(['user', 'files', 'millstone'])->orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('client', function($row){
                return '<span>' .$row->user->name .'<br>' . $row->user->email . '</span>';                
            })
            ->addColumn('Budget', function($row){
                if ($row->Budget == null) {
                    return 'null';
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
                    return '<span class="badge rounded-pill bg-label-secondary">-</span>';
                } else {
                    return '<span class="badge rounded-pill bg-label-success">'. $row->millstone[0]->projectMillStone->name .'</span>';
                }
            })
            ->addColumn('payment_mode', function($row){
                if ($row->payment_mode == 1) {
                    return '<span class="badge rounded-pill bg-label-primary">cash</span>';
                } elseif($row->payment_mode == 2) {
                    return '<span class="badge rounded-pill bg-label-success">credit</span>';
                } else {
                    return '<span class="badge rounded-pill bg-label-success">normal</span>';
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
                $actionBtn = '<a href="' . route('admin.project.single' ,$row->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm ">Show</a> ';
                return $actionBtn;
            })
            ->rawColumns(['client', 'milestones', 'Proposals', 'status', 'payment_mode','action', 'created_at', 'needShiping'])
            ->make(true);
    }
    
    public function projectSingle(Request $req)
    {
        $project = Project::where('uuid', $req->uuid)->with(['user', 'hscodes', 'files', 'millstone', 'refund'])->first();
        // dd($req->uuid);
        $suggestions = User::orderby('id')->where('country', $project->countryto->code)->with(['proposal'])->limit(5)->get();
        $agents = User::orderby('id')->with(['proposal'])->get();
        if ($project->payment_mode == 2) {
            if ($project->ProjectInvoice()->where('client_payment_status', null)->count() > 0) {
                $checkInvoiceIspayed = 0;
            } else {
                $checkInvoiceIspayed = 1;
            }
        } else {
            $checkInvoiceIspayed = 0;
        }
        if ($agents && $suggestions) {
            return view('backend.admin.projects.singleProjects', compact('project','agents','suggestions','checkInvoiceIspayed'));
        }
        return view('backend.admin.projects.singleProjects', compact('project'));

    }
    public function getTProjectInvoices($id){
        $user = Auth::user();

        $data = ProjectInvoice::where('project_id', $id)->orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function($row){
                return $row->id;
            })
            ->addColumn('amount', function($row){

                return '<div class="me-2" style="width:150px">
                            <h6 class="mb-0">'. $row->amount .' <sup>SAR</sup></h6>
                            <small class="text-muted">'. $row->desc .'</small>
                        </div>';
                
            })
            ->addColumn('type', function($row){
                if ($row->invoice_type == 0) {
                    return '<div class="me-2"><span class="badge rounded bg-label-success">Client<small> - '. $row->created_at->format('Y M d') .'</small></span></div>';
                } elseif ($row->invoice_type == 1) {
                    return '<div class="me-2"><span class="badge rounded bg-label-info">paid by Agent<small> - '. $row->created_at->format('Y M d') .'</small></span></div>';
                } elseif ($row->invoice_type == 2) {
                    return '<div class="me-2"><span class="badge rounded bg-label-warning">Funding Request<small> - '. $row->created_at->format('Y M d') .'</small></span></div>';
                }
            })
            ->addColumn('dueDate', function($row){
                return $row->due_date;                
            })

            ->addColumn('unpaid', function($row){
                if ($row->unpaid_invoice_file != null) {
                    $filenamed = $row->unpaid_invoice_file;
                    return '<a href="'. route('files.download', ['invoices', $filenamed]) . '"  class="edit btn btn-label-primary waves-effect btn-md"><i class="fa fa-file-download"></i></a> ';
                }
            })
            ->addColumn('proof', function($row){
                
                if ($row->payment_proof_file != null) {
                    $filenamed = $row->payment_proof_file;
                    return '<a href="'. route('files.download', ['invoices', $filenamed]) . '"  class="edit btn btn-label-success waves-effect btn-md"><i class="fa fa-file-download"></i></a> ';
                }
            })
            ->addColumn('action', function($row){
            
                if ($row->invoice_type == 1 || $row->invoice_type == 0) {
                    if ($row->status != 2) {
                        if ($row->payment_proof_file != null) {
                            # paid by Agent
                            $actionBtn = '<a href="'. route('admin.projectInvoice.accept', $row->id) .'" class="edit btn btn-outline-info waves-effect btn-sm">Accept Invoice</a> ';
                            return $actionBtn;
                        } else {
                            return '<span class="badge rounded bg-danger">proof file dosnt exist<small>';
                        }
                    }
                }
                if ($row->invoice_type == 2) {
                    
                    if ($row->status == 0) { // accept invoice
                        $actionBtn = '<a href="'. route('admin.projectInvoice.accept', $row->id) .'" class="edit btn btn-outline-info waves-effect btn-sm">Accept Request</a> ';
                    }elseif ($row->status == 1) { // confirm payment
                        if ($row->payment_proof_file != null) {
                            $actionBtn = '<a href="'. route('admin.projectInvoice.confirm', $row->id) .'" class="edit btn btn-outline-info waves-effect btn-sm">Confirm payment</a> ';
                        } else {
                            return '<span class="badge rounded bg-danger">proof file dosnt exist<small>';
                        }
                    } else {
                        $actionBtn = '-';
                    }
                    if ($row->unpaid_invoice_file != null) {
                        # paid by Agent
                        return $actionBtn;
                    } else {
                        return '<span class="badge rounded bg-danger">invoice file dosnt exist<small>';
                    }
                    
                }
                
            })

            ->addColumn('status', function($row){
                
                if ($row->status == 0) {
                    return '<span class="badge rounded bg-label-dark">pending<small>';
                }elseif ($row->status == 1) {
                    return '<span class="badge rounded bg-label-info">Accepted<small>';
                }elseif ($row->status == 2) {
                    return '<span class="badge rounded bg-label-success">paid<small>';
                }
            })
            ->rawColumns(['id', 'amount', 'desc', 'dueDate', 'unpaid','proof','status','action','type'])
            ->make(true);
    }

    // admin approve invoice from agent or client by proof file
    public function approveFromInvoiceFile($invoice_id)
    {
        $invoice = ProjectInvoice::where('id', $invoice_id)->first();
        if ($invoice != null) {
            $invoice->update([
                'status' => 2, //paid by client or agent
            ]);
            if ($invoice->invoice_type == 1) { // paid by agent
                $agent = User::where('id', $invoice->user_id)->first();

                if ($agent->hasRole('agent')) {
                    $data = ['type'       => 'credit',
                            'amount'      => $invoice->amount,
                            'description' => 'invoice #' . $invoice->id . 'details : ' . $invoice->desc,
                            'status'      => 1,
                            ];
                    $wallet = $agent->transactions()->create($data);
                    // send notification to agent
                    $agent->notify(new ApprovedInvoiceNotification($invoice->project , $invoice, auth()->user()));
                    return redirect()->back()->with([
                        'message' => 'accepted successfully',
                        'alert'  => 'success'
                    ]);

                }else {
                    return redirect()->back()->with([
                        'message' => 'user in not agent',
                        'alert'  => 'danger'
                    ]);
                }
            } else if($invoice->invoice_type == 2) {
                # funding request
                $invoice->update([
                    'status' => 1, // accepted
                ]);
                return redirect()->back()->with([
                    'message' => 'accepted successfully',
                    'alert'  => 'success'
                ]);
            } else if($invoice->invoice_type == 0) {
                # client has paid it
                $invoice->update([
                    'status' => 2, // paid
                ]);
                return redirect()->back()->with([
                    'message' => 'accepted successfully',
                    'alert'  => 'success'
                ]);
            }
        }else {
            return redirect()->back()->with([
                'message' => 'invoice error "not exist"',
                'alert'  => 'danger'
            ]);
        }
    }
    public function confirmFromInvoiceFile($invoice_id)
    {
        $invoice = ProjectInvoice::where('id', $invoice_id)->first();
        if ($invoice != null) {
            $invoice->update([
                'status' => 2, // clearforce fund this invoice 
            ]);
            
            return redirect()->back()->with([
                'message' => 'confirmed successfully',
                'alert'  => 'success'
            ]);
        }else {
            return redirect()->back()->with([
                'message' => 'invoice error "not exist"',
                'alert'  => 'danger'
            ]);
        }
    }

    public function confirmCreditFromInvoiceFile($project_id)
    {
        if ($project_id) {
            $project = Project::where('uuid', $project_id)->first();
            if ($project) {
                foreach ($project->ProjectInvoice as $key => $invoice) {
                    $invoice->update([
                        'client_payment_status' => 1,
                    ]);
                }

                return redirect()->back()->with([
                    'message' => 'Payment of invoices for this project has been confirmed',
                    'alert'  => 'success'
                ]);

            } else {
                return redirect()->back()->with([
                    'message' => 'project not found',
                    'alert'  => 'danger'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'message' => 'id error',
                'alert'  => 'danger'
            ]);
        }
    }

    public function projectAddProposal(Request $req, $id){
        $validation = Validator::make($req->all(), [
            'note'   => 'nullable|string',
            'budget' => 'required|numeric',
        ]);
        // dd($id);
        $project = Project::find($id);
        $userId = $project->user->id;
        // dd($project);
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.project.single', $project->uuid)->withErrors($validation)->withInput();
        }

        $data['budget']  = $req->budget;
        

        if ($req->note != null) {
            $data['note'] = $req->note;
        } else {
            $data['note'] = null;
        }
        
        $project->update([
            'budget' => $data['budget'],
            'note'   => $data['note'],
            'status' => 1,
        ]);
        $invoice = Invoice::create([
            'due_date'    => now(),
            'amount'      => $data['budget'],
            'user_id'     => $userId,
            'project_id'  => $project->id,
        ]);

        // send notifiaction to user
        $project->user->notify(new PaymentNotification($project, auth()->user()));

        return redirect()->back()->with([
            'message' => 'send successfully',
            'alert'  => 'success'
        ]);
    }
    
    public function projectEditProposal(Request $req, $id){

        $validation = Validator::make($req->all(), [
            'note'   => 'nullable|string',
            'budget' => 'required|numeric',
        ]);
        // dd($id);
        $project = Project::where('id',$id)->first();

        if ($project->Invoice->status == 1) {
            return redirect()->back()->with([
                'message' => 'The price quote cannot be modified because the customer has completed payment',
                'alert'  => 'danger'
            ]);
        }
        if ($project->status == 2) {
            return redirect()->back()->with([
                'message' => 'The price quote cannot be modified because the project is already running',
                'alert'  => 'danger'
            ]);
        }

        $userId = $project->user->id;
        // dd($project);
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.project.single', $project->uuid)->withErrors($validation)->withInput();
        }

        $data['budget']  = $req->budget;
        
        if ($req->note != null) {
            $data['note'] = $req->note;
        } else {
            $data['note'] = null;
        }
        
        $project->update([
            'budget' => $data['budget'],
            'note'   => $data['note'],
        ]);

        $invoice = $project->Invoice->update([
            'amount' => $data['budget'],
        ]);

        // send notifiaction to user
        $project->user->notify(new UpdateBudgetNotification($project, auth()->user()));

        return redirect()->back()->with([
            'message' => 'send successfully',
            'alert'  => 'success'
        ]);
    }

    public function AcceptAgentProposal($id){
        $proposal = AgentProposal::where('id', $id)->first();
        // dd($proposal);
        $invoiceStatus = 0;
        $invoice = Invoice::where('project_id', $proposal->project->id)->first();
        // dd($invoice->status);
        if ($proposal->project->proposals->where('status', 1)->count() == 0) {
            if ($invoice->count() >= 1) {
                $invoiceStatus = $invoice->status;
            }else{
                $invoiceStatus = 0;
            }
            if ($proposal) {
                if ($proposal->project->Budget != null) {
                    if ($proposal->project->status >= 2 && $invoiceStatus == 1) {
                        $proposal->update([
                            'status' => 1,
                        ]);
                        $proposal->project->update([
                            'status' => 2,
                        ]);

                        $data = [
                            'title' => '🔥 Congratulations 🔥',
                            'description' => 'the Proposal has been accepted to a project #' .$proposal->project->id,
                            'uuid' => $proposal->project->uuid,
                        ];
                        $proposal->agent->notify(new AcceptAgentProposalNotification($data, auth()->user()));
                        $proposal->project->user->notify(new ClientDelegationNotification($data, auth()->user()));

                        return redirect()->back()->with([
                            'message' => 'approved successfully',
                            'alert'  => 'success'
                        ]);
                    } else {
                        return redirect()->back()->with([
                            'message' => 'The customer has not paid yet',
                            'alert'  => 'danger'
                        ]);
                    }
                } else {
                    return redirect()->back()->with([
                        'message' => 'A price quote must be sent to the customer by you first',
                        'alert'  => 'danger'
                    ]);
                }
                
            }
        } else {
            return redirect()->back()->with([
                'message' => 'There is already an accepted offer',
                'alert'  => 'danger'
            ]);
        }
        
        return redirect()->back()->with([
            'message' => 'send error',
            'alert'  => 'danger'
        ]);
    }

    public function projectInviteAgent(Request $req,){
        $validation = Validator::make($req->all(), [
            'projectId' => 'required|numeric',
            'agents.*' => 'required|numeric'
        ]);

        if($validation->fails()){
            return redirect()->route('admin.project.single', $req->projectId)->withErrors($validation)->withInput();
        }

        $Project = Project::find($req->projectId);
        
        if ($req->agents && count($req->agents) > 0) {
            $i = 1;
            foreach($req->agents as $agent){
                $Project->invitations()->create([
                    'user_id' => $agent
                ]);
                // send notifiaction to agent
                $user = User::where('id', $agent)->first();
                $user->notify(new AgentInviteNotification($Project, auth()->user()));

                $i++;
            }
        }

        return redirect()->back()->with([
            'message' => 'Sent successfully',
            'alert'  => 'success'
        ]);
    }

    // Fetch agents
    public function getAgents(Request $request){
        $search = $request->search;
        $agents = User::orderby('id')->select('id','name', 'email','phone')->with(['proposal'])->where('name', 'like', '%' .$search . '%')->orWhere('email', 'like', '%' .$search . '%')->limit(5)->get();
        $response = array();
        foreach($agents as $agent){
            if ($agent->hasRole('agent')) {
                $response[] = array(
                    "id"    => $agent->id,
                    "text"  => $agent->name . ' - ' . $agent->email
                );
            }
        }
        return response()->json($response); 
    } 
}
