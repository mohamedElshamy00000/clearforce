<?php

namespace App\Http\Controllers\Backend\Agent;

use DataTables;
use App\Models\User;
use App\Models\Ports;
use App\Models\Country;

use App\Models\Project;
use App\Models\ShipingMode;
use Illuminate\Http\Request;
use App\Models\AgentProposal;
use App\Models\ProjectInvoice;
use App\Models\ProjectMillstone;
use App\Models\VerificationCenter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\ProjectDataNotification;
use App\Notifications\Agent\SendProposalNotification;
use App\Notifications\Agent\FundRequestToAdminNotification;

class ProjectController extends Controller
{
    public function expoloreProjects(){
        $user = Auth::user();
        if ($user->IfVerified() == false) {
            $verifications = VerificationCenter::where('user_id', Auth::user()->id)->get();

            return redirect()->route('agent.verification')->with('verifications', $verifications)->with([
                'message' => 'You must verify your account',
                'alert'  => 'danger'
            ]);
        }

        $projects      = Project::where('status', 1)->orderBy('created_at', 'desc')->paginate(10);
        $shiping_modes = ShipingMode::where('status', 1)->get();
        $ports         = Ports::where('status', 1)->get();
        $countries     = Country::where('status', 1)->get();
        return view('backend.agent.projects.exploreProjects', compact('projects', 'shiping_modes', 'ports', 'countries'));

    }
    public function getPorts(Request $request) {
        $id = $request->id;
        $countryId = $request->countryId;
        // dd ($request->all());
        if ($request->ajax()) {
            return response()->json([
                'ports' => Ports::where('shiping_mode_id', $id)->where('country_id', $countryId)->where('status', 1)->get()
            ]);
        }

    }
    public function exploreSearch(Request $request){

        $shiping_modes = ShipingMode::where('status', 1)->get();
        $ports         = Ports::where('status', 1)->get();
        $countries     = Country::where('status', 1)->get();
        
        $type              = $request->has('plClearanceType') ? $request->get('plClearanceType') : null;
        $shiping_mode_id   = $request->has('plTransportationType') ? $request->get('plTransportationType') : null;
        $countryFrom       = $request->has('plCountryFrom') ? $request->get('plCountryFrom') : null;
        $countryTo         = $request->has('plCountryTo') ? $request->get('plCountryTo') : null;
        $port_id           = $request->has('plports') ? $request->get('plports') : null;
        // dd($request->all());
        $projects = Project::where('status', 1); 

        if ($type != null) {
            $projects = $projects->where('type', $type);
        }

        if ($shiping_mode_id != null) {
            $projects = $projects->where('shiping_mode_id',$shiping_mode_id);
        }
        if ($countryFrom != null) {
            $projects = $projects->where('countryFrom',$countryFrom);
        }
        if ($countryTo != null) {
            $projects = $projects->where('countryTo',$countryTo);
        }
        if ($port_id != null) {
            $projects = $projects->where('port_id',$port_id);
        }

        $projects = $projects->orderBy('id', 'desc')->paginate(10);
        // dd($projects->count());
        $searchCount = $projects->count();
        return view('backend.agent.projects.exploreProjects', compact('searchCount','projects', 'shiping_modes', 'ports', 'countries','type','shiping_mode_id','countryFrom','countryTo','port_id'));

    }
    public function myProposals(){
        $user = Auth::user();
        if ($user->IfVerified() == false) {
            $verifications = VerificationCenter::where('user_id', Auth::user()->id)->get();

            return redirect()->route('agent.verification')->with('verifications', $verifications)->with([
                'message' => 'You must verify your account',
                'alert'  => 'danger'
            ]);

        } 

        $proposal = $user->proposal;
        // dd($proposals);
        $data = AgentProposal::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('backend.agent.projects.myProposals');
    }

    public function agentgetProposalsData(){
        $user = Auth::user();
        $proposal = $user->proposal;
        // dd($proposals);
        $data = AgentProposal::where('user_id', $user->id)->with(['project','agent'])->orderBy('id', 'desc')->get();
        // dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('budget', function($row){
                if ($row->budget == null) {
                    return 'null';
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
                $actionBtn = '<a href="' . route('agent.single.projects' ,$row->project->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm ">'. __('general.Show') .'</a> ';
                return $actionBtn;
            })
            ->rawColumns(['status', 'note', 'action', 'created_at'])
            ->make(true);
    }
    
    public function agentExpoloreSingleProjectData($id){

        $minproject = Project::where('id', $id)->with(['hscodes','shipingMode','port','countryfrom','countryto'])->first();
        $minproject->hscode;
        if ($minproject) {
            return response()->json($minproject);
        }
        return false;
    }

    public function singleProjects($uuid){
        $allmillstones = ProjectMillstone::where('status', 1)->get();
        $user = Auth::user();
        if ($user->IfVerified() == false) {
            $verifications = VerificationCenter::where('user_id', Auth::user()->id)->get();

            return redirect()->route('agent.verification')->with('verifications', $verifications)->with([
                'message' => 'You must verify your account',
                'alert'  => 'danger'
            ]);

        } 

        $project  = Project::where('uuid', $uuid)->with(['proposals'])->orderBy('created_at', 'desc')->first();
        $proposal = $project->proposals->where('user_id', Auth::user()->id)->first();
        // dd($project);
        return view('backend.agent.projects.singleProject', compact('project','proposal','allmillstones'));
    }

    public function agentprojectAddProposal(Request $req, $id){

        $user = Auth::user();
        if ($user->IfVerified() == false) {
            $verifications = VerificationCenter::where('user_id', Auth::user()->id)->get();

            return redirect()->route('agent.verification')->with('verifications', $verifications)->with([
                'message' => 'You must verify your account',
                'alert'  => 'danger'
            ]);

        }

        $validation = Validator::make($req->all(), [
            'note'   => 'nullable|string',
            'budget' => 'required|numeric',
        ]);
        // dd($req->all());
        $project = Project::find($id);
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('agent.my.projects', $project->uuid)->withErrors($validation)->withInput();
        }

        $data['budget']  = $req->budget;
        

        if ($req->note != null) {
            $data['note'] = $req->note;
        } else {
            $data['note'] = null;
        }
        // dd(Auth::user()->id);
        $project->proposals()->create([
            'budget'  => $data['budget'],
            'note'    => $data['note'],
            'user_id' => Auth::user()->id,
        ]);

        // send notifiaction to admin
        $admins = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();

        foreach ($admins as $key => $admin) {
            $admin->notify(new SendProposalNotification($project, auth()->user()));
        }

        return redirect()->back()->with([
            'message' => 'send successfully',
            'alert'  => 'success'
        ]);
    }

    public function addNewMillstone( $millstoneId,$projectId){
        $project = Project::where('id',$projectId)->first();
        // dd($project->id);
        if ($millstoneId != null && $project) {

            $millstone = ProjectMillstone::where('id',$millstoneId)->first();
            $project->millstone()->create([
                'project_millstone_id'  => $millstoneId,
            ]);
            // send notifiaction to user
            $data = [
                'title' => 'new millestone',
                'description' => 'A new action has been added to a project #' .$project->id,
                'uuid' => $project->uuid,
            ];
            $project->user->notify(new ProjectDataNotification($data, auth()->user()));

            return redirect()->back()->with([
                'message' => 'added successfully',
                'alert'  => 'success'
            ]);
        }

        return redirect()->back()->withErrors([
            'message' => 'Error',
            'alert'  => 'danger'
        ]);
    }
    public function addNewCustomMillstone(Request $req, $projectId){
        $project = Project::where('id',$projectId)->first();
        $validation = Validator::make($req->all(), [
            'name'   => 'nullable|string',
            'desc' => 'required|string',
        ]);
        if($validation->fails()){
            return redirect()->route('agent.single.projects', $project->uuid)->withErrors($validation)->withInput();
        }

        if ($project != null) {

            $project->millstone()->create([
                'name'  => $req->name,
                'desc'  => $req->desc
            ]);
            // send notifiaction to user
            $data = [
                'title' => 'new millestone',
                'description' => 'A new action has been added to a project #' .$project->id,
                'uuid' => $project->uuid,
            ];
            $project->user->notify(new ProjectDataNotification($data, auth()->user()));

            return redirect()->back()->with([
                'message' => 'added successfully',
                'alert'  => 'success'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Error',
            'alert'  => 'danger'
        ]);
    }

    public function addNewCustomInvoice(Request $req, $projectId){

        $project = Project::where('id',$projectId)->first();

        $validation = Validator::make($req->all(), [
            'code'   => 'nullable|string',
            'amount' => 'required|numeric',
            'desc'   => 'required|string',
            'invType'      => 'required|string',
            'invoice_file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:2048',
        ]);

        if($validation->fails()){
            return redirect()->route('agent.single.projects', $project->uuid)->withErrors($validation)->withInput();
        }

        if ($project != null) {

            $Pinvoice = $project->ProjectInvoice()->create([
                'code'        => $req->code,
                'amount'      => $req->amount,
                'desc'        => $req->desc,
                'project_id'  => $project->id,
                'user_id'     => auth()->user()->id,
                'invoice_type'=> $req->invType,
                'due_date'    => $req->due_date,
            ]);

            if ($req->invoice_file) {

                if ($req->invType == 1) { // agent

                    $filename = 'payment_proof_file_' . now() . '.' . $req->invoice_file->getClientOriginalExtension();
                    $req->invoice_file->move('assets/files/invoices/' , $filename);
                    $Pinvoice->update([
                        'payment_proof_file' => $filename,
                    ]);

                } else if ($req->invType == 2 || $req->invType == 0) { // clearforce funding request || project mode cash

                    $filename = 'unpaid_invoice_file_' . now() . '.' . $req->invoice_file->getClientOriginalExtension();
                    $req->invoice_file->move('assets/files/invoices/' , $filename);

                    $Pinvoice->update([
                        'unpaid_invoice_file' => $filename,
                    ]);

                } else {
                    if ($project->payment_mode == 2) {
                        return redirect()->back()->with([
                            'message' => 'Error',
                            'alert'  => 'danger'
                        ]);
                    }
                }

            }
            
            // send notifiaction to user
            $data = [
                'title' => 'New Project Invoice',
                'description' => 'A new invoice " '.$req->desc.' " related to your project P-#' .$project->id,
                'uuid' => $project->uuid,
            ];
            $project->user->notify(new ProjectDataNotification($data, auth()->user()));
            
            // send notifiaction to admin 
            $data = [
                'title' => ($req->invType == 1 ) ? 'New Project Invoice (payed invoice)' : 'New Project Invoice (Request funding)',
                'description' => $req->desc.' related to project P-#' .$project->id,
                'uuid' => $project->uuid,
            ];
            // get admins
            $admins = User::whereHas('roles', function($q) {$q->where('name', 'admin'); })->get();
            foreach ($admins as $key => $admin) {
                $admin->notify(new FundRequestToAdminNotification($data, auth()->user()));
            }
            
            return redirect()->back()->with([
                'message' => 'added successfully',
                'alert'  => 'success'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Error',
            'alert'  => 'danger'
        ]);
    }
    public function uploadProofFile(Request $request, $PinvoiceId)
    {

        $Pinvoice = ProjectInvoice::where('id', $PinvoiceId)->first();

        $validation = Validator::make($request->all(), [
            'proof_file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:2048',
        ]);

        if($validation->fails()){
            return redirect()->route('agent.single.projects', $project->uuid)->withErrors($validation)->withInput();
        }

        if ($Pinvoice != null) {
            if ($request->proof_file) { // agent
                $filename = 'payment_proof_file_' . now() . '.' . $request->proof_file->getClientOriginalExtension();
                $request->proof_file->move('assets/files/invoices/' , $filename);
                $Pinvoice->update([
                    'payment_proof_file' => $filename,
                ]);
                return redirect()->back()->with([
                    'message' => 'added successfully',
                    'alert'  => 'success'
                ]);
            }
        }
    }
    public function getTProjectInvoices($id){

        $user = Auth::user();
        $data = ProjectInvoice::where('project_id', $id)->orderBy('id', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('amount', function($row){
                if ($row->amount == null) {
                    return 'null';
                } else {
                    return $row->amount . " SAR";
                }
            })
            ->addColumn('desc', function($row){
                if ($row->desc == null) {
                    return 'null';
                } else {
                    return $row->desc;
                }
            })
            ->addColumn('invoice_type', function($row){
                if( $row->invoice_type == 0){
                    return 'Payment request';
                } else if ($row->invoice_type == 1) {
                    return 'payed invoice';
                } else if( $row->invoice_type == 2) {
                    return "Request to clearforce";
                }
            })

            ->addColumn('date', function($row){
                return $row->created_at->format('Y M d');                
            })
            ->addColumn('duedate', function($row){
                return $row->due_date;                
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-dark ms-auto ">Pending</span>';
                } elseif($row->status == 1){
                    return '<span class="badge bg-label-info ms-auto ">Accepted</span>';
                } elseif($row->status == 2){
                    return '<span class="badge bg-label-success ms-auto ">Paid</span>';
                }
            })
            ->addColumn('unpaid', function($row){
                if ($row->unpaid_invoice_file != null) {
                    $filenamed = $row->unpaid_invoice_file;
                    return '<a href="'. route('files.download', ['invoices', $filenamed]) . '"  class="edit btn btn-primary waves-effect btn-sm"><i class="fa fa-file"></i></a> ';
                }
            })
            ->addColumn('proof', function($row){
                
                if ($row->payment_proof_file != null) {
                    $filenamed = $row->payment_proof_file;
                    return '<a href="'. route('files.download', ['invoices', $filenamed]) . '"  class="edit btn btn-primary waves-effect btn-sm"><i class="fa fa-file"></i></a> ';
                } else {
                    if ($row->invoice_type > 0) {
                        return '
                        <div class="dropdown ms-2">
                            <i class="ti ti-settings ti-xs cursor-pointer more-options-dropdown" role="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"></i>
                            <div class="dropdown-menu dropdown-menu-end w-px-300 p-3" style="padding: 1rem !important" aria-labelledby="dropdownMenuButton">
                                <div class="p-3 g-3">
                                <h6 class="mb-2">'. __('general.Upload') .'</h6>
                                    <form method="post" action=" '.route('agent.upload.ProofFile', $row->id).' " enctype="multipart/form-data">
                                        '.csrf_field().'
                                        <div class="mb-3">
                                            <label class="form-label w-100" for="proof_file">'.__('general.A copy of "invoice file"').' <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <input id="proof_file" name="proof_file" value="'. old('proof_file') .'" class="form-control " type="file" />
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100">'.__('general.Submit').'</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    ';
                    }
                }
            })
            ->rawColumns(['status','duedate', 'invoice_type','amount', 'desc', 'date', 'status','proof','unpaid'])
            ->make(true);
    }

    public function sendCompleteRequest(Request $request, $uuid)
    {
        $project = Project::where('uuid',$uuid)->first();

        $UnpaidInvoice = $project->ProjectInvoice->where('file_name', null)->count();

        // dd($request->certification);
        $validation = Validator::make($request->all(), [
            'certification'    => 'required|mimes:doc,pdf,docx,pptx,zip',
            'restrictions'     => 'nullable',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        if ($UnpaidInvoice == 0 || $UnpaidInvoice == 1) {        
            $endR = $project->endRequests()->create([
                'file_name' => $request->certification,
                'restrictions' => $request->restrictions,
            ]);
            if ($request->certification) {
            
                $filename = 'certification-' . now() . '.' . $request->certification->getClientOriginalExtension();
                $request->certification->move('assets/files/certification/' , $filename);
                $endR->update([
                    'file_name' => $filename,
                ]);
            }

        } else {
            return redirect()->back()->with([
                'message' => 'ERROR : unpaid invoices',
                'alert'  => 'danger'
            ]);
        }

        // send notifiaction to user
        $data = [
            'title' => 'Complete Request project #' .$project->id,
            'description' => '🔥 The contractor sent a request to deliver the project. You must review all files and invoices before approval',
            'uuid' => $project->uuid,
        ];
        $project->user->notify(new ProjectDataNotification($data, auth()->user()));
        
        return redirect()->back()->with([
            'message' => 'The request has been sent successfully',
            'alert'  => 'success'
        ]);

    }
    public function getEndRequest($uuid)
    {
        $minproject = Project::where('uuid', $uuid)->with(['endRequests'])->first();
        // dd($minproject->endRequests->first());
        if ($minproject) {
            return response()->json($minproject->endRequests->first());
        }
        return false;
    }
    public function editCompleteRequest(Request $request, $uuid)
    {
        $project = Project::where('uuid',$uuid)->first();

        // dd($request->certification);
        $validation = Validator::make($request->all(), [
            'certification'    => 'nullable|mimes:doc,pdf,docx,pptx,zip',
            'restrictions'     => 'nullable',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['file_name']    = $request->certification;
        $data['restrictions'] = $request->restrictions;

        $endR = $project->endRequests()->update([
            'restrictions' => $data['restrictions'],
        ]);

        if ($request->certification) {
            
            $filename = 'certification-' . now() . '.' . $request->certification->getClientOriginalExtension();
            $request->certification->move('assets/files/certification/' , $filename);
            $project->endRequests()->update([
                'file_name' => $filename,
            ]);
        }

        // send notifiaction to user
        $data = [
            'title' => 'Modification of project #'.$project->id.' Complete request ',
            'description' => '',
            'uuid' => $project->uuid,
        ];
        $project->user->notify(new ProjectDataNotification($data, auth()->user()));
        
        return redirect()->back()->with([
            'message' => 'The request has been sent successfully',
            'alert'  => 'success'
        ]);

    }
}
