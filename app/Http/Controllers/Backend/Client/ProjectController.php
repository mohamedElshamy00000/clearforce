<?php

namespace App\Http\Controllers\Backend\Client;

use DataTables;
use App\Models\User;
use App\Models\Ports;
use App\Models\HsCode;
use GuzzleHttp\Client;
use App\Models\Company;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\ProjectFile;
use App\Models\ShipingMode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProjectInvoice;
use App\Models\ProductFileType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\ProjectDataNotification;
use App\Notifications\User\SendInvoiceNotification;
use App\Notifications\User\CreateProjectNotification;

class ProjectController extends Controller
{
    // get all client projects

    public function allProjects(){
        $user = Auth()->user();
        $projects = $user->companies()->first()->projects()->with('hscodes','countryfrom','countryto','shipingMode','port')->orderBy('created_at', 'desc')->paginate(10);
        // $projects = Project::with('hscodes','countryfrom','countryto','shipingMode','port')->get();
        // dd($projects);
        return view('backend.client.projects.allProjects', compact('projects'));
    }

    public function create_project(){
        $user = auth()->user();
        $shiping_modes = ShipingMode::where('status', 1)->get();
        $ports         = Ports::where('status', 1)->get();
        $countries     = Country::where('status', 1)->get();
        $company       = $user->companies->first();
        $fileTypes     = ProductFileType::where('status', 1)->get();
        // dd($company);
        return view('backend.client.projects.projectCreate', compact('fileTypes','shiping_modes', 'ports', 'countries', 'company'));
    }

    public function projectStore(Request $req){

        $validation = Validator::make($req->all(), [
            'plClearanceType' => 'required|string',
            // 'plGoodsType'     => 'required|string',
            'needShiping'     => 'nullable|string',
            'truckType'       => 'nullable|string',
            'deliveryPlace'   => 'nullable|string',
            'plCountryFrom'   => 'required|string',
            'plCountryTo'     => 'required|string',
            'plArrival'       => 'required|date',
            'plBill'          => 'required|string',
            'plports'         => 'required|numeric',
            // 'plShsearch[]'      => 'nullable|numeric',
            "plTransportationType" => 'required|numeric',
            'company' => 'required',
            'media'   => 'required',
            'media.*' => 'mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg',
            'file_type.*' => 'required',
        ]);
        
        // dd($req->all());
        // dd($req->file_type[0]);
        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->route('client.project.create')->withErrors($validation)->withInput();
        }

        if ($req->needShiping == 1) {
            if ($req->deliveryPlace == null) {
                 return redirect()->back()->with([
                     'message' => 'Once the transfer is activated, the delivery Place must not be left empty ',
                     'alert'  => 'danger'
                 ]);
            }
        }

        $data['type']               = $req->plClearanceType;
        // $data['Goodstype']          = $req->plGoodsType;
        $data['needShiping']        = $req->needShiping == "1" ? 1 : 0;
        $data['truckType']          = $req->truckType != null ? $req->truckType : null;
        $data['deliveryPlace']      = $req->deliveryPlace != null ? $req->deliveryPlace : null;
        $data['countryFrom']        = $req->plCountryFrom;
        $data['countryTo']          = $req->plCountryTo;
        $data['arrivalDate']        = $req->plArrival;
        $data['shiping_mode_id']    = $req->plTransportationType;
        $data['Waybill']            = $req->plBill;
        $data['user_id']            = auth()->user()->id;
        $data['company_id']         = $req->company;
        $data['port_id']            = $req->plports;
        $data['payment_mode']       = $req->payment_mode;
        $data['status']             = 0;
        
        // dd($data);
        
        $Project = Project::create($data);

        if ($req->media && count($req->media) > 0) {
            $i = 1;
            foreach($req->media as $key => $file){
                $filename = $Project->uuid . '-' . $i . '.' . $file->getClientOriginalExtension();
                $file->move(public_path("/assets/files/projects/"), $filename);

                $Project->files()->create([
                    'file_name' => $filename,
                    'product_file_type_id' => $req->file_type[$key]
                ]);
                $i++;
            }
        }
        
        if($req->plShsearch){
            $Project->hscodes()->sync($req->plShsearch);
        }

        // send notifiaction to admin
        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();

        foreach ($users as $key => $user) {
            $user->notify(new CreateProjectNotification($Project, auth()->user()));
        }

        return redirect()->route('client.all.projects')->with([
            'message' => 'The project has been added successfully',
            'alert'  => 'success'
        ]);

    }
    
    // public function projectStore(Request $req){

    //     $validation = Validator::make($req->all(), [
    //         'plClearanceType' => 'required|string',
    //         // 'plGoodsType'     => 'required|string',
    //         'needShiping'     => 'nullable|string',
    //         'truckType'       => 'nullable|string',
    //         'deliveryPlace'   => 'nullable|string',
    //         'plCountryFrom'   => 'required|string',
    //         'plCountryTo'     => 'required|string',
    //         'plArrival'       => 'required|date',
    //         'plBill'          => 'required|string',
    //         'plports'         => 'required|numeric',
    //         // 'plShsearch[]'      => 'nullable|numeric',
    //         "plTransportationType" => 'required|numeric',
    //         'company' => 'required',
    //         'media'   => 'required',
    //         'media.*' => 'mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg',
    //         'file_type.*' => 'required',
    //     ]);
        
    //     // dd($req->all());
    //     // dd($req->file_type[0]);
    //     if($validation->fails()){
    //         // dd($validation->errors());
    //         return redirect()->route('client.project.create')->withErrors($validation)->withInput();
    //     }

    //     if ($req->needShiping == 1) {
    //         if ($req->deliveryPlace == null) {
    //              return redirect()->back()->with([
    //                  'message' => 'Once the transfer is activated, the delivery Place must not be left empty ',
    //                  'alert'  => 'danger'
    //              ]);
    //         }
    //     }

    //     $data['type']               = $req->plClearanceType;
    //     // $data['Goodstype']          = $req->plGoodsType;
    //     $data['needShiping']        = $req->needShiping == "1" ? 1 : 0;
    //     $data['truckType']          = $req->truckType != null ? $req->truckType : null;
    //     $data['deliveryPlace']      = $req->deliveryPlace != null ? $req->deliveryPlace : null;
    //     $data['countryFrom']        = $req->plCountryFrom;
    //     $data['countryTo']          = $req->plCountryTo;
    //     $data['arrivalDate']        = $req->plArrival;
    //     $data['shiping_mode_id']    = $req->plTransportationType;
    //     $data['Waybill']            = $req->plBill;
    //     $data['user_id']            = auth()->user()->id;
    //     $data['company_id']         = $req->company;
    //     $data['port_id']            = $req->plports;
    //     $data['payment_mode']       = $req->payment_mode;
    //     $data['status']             = 0;
        
    //     // dd($data);
        
    //     $Project = Project::create($data);

    //     if ($req->media && count($req->media) > 0) {
    //         $i = 1;
    //         foreach($req->media as $key => $file){
    //             $filename = $Project->uuid . '-' . $i . '.' . $file->getClientOriginalExtension();
    //             $file->move(public_path("/assets/files/projects/"), $filename);

    //             $Project->files()->create([
    //                 'file_name' => $filename,
    //                 'product_file_type_id' => $req->file_type[$key]
    //             ]);
    //             $i++;
    //         }
    //     }
        
    //     if($req->plShsearch){
    //         $Project->hscodes()->sync($req->plShsearch);
    //     }

    //     // send notifiaction to admin
    //     $users = User::whereHas('roles', function($q)
    //     {
    //         $q->where('name', 'admin');
    //     })->get();

    //     foreach ($users as $key => $user) {
    //         $user->notify(new CreateProjectNotification($Project, auth()->user()));
    //     }

    //     return redirect()->route('client.all.projects')->with([
    //         'message' => 'The project has been added successfully',
    //         'alert'  => 'success'
    //     ]);

    // }

    // Fetch product type
    public function ProductTypeSearch(Request $request){

        if($request->ajax()) {
            $output="";
            $ProductTypes = ProductType::where('name','LIKE','%'.$request->search."%")->paginate(50);
            // dd($HsCodes);
            if($ProductTypes) {
                foreach ($ProductTypes as $key => $ProductType) {
                    $output.='<tr>'.
                        '<td>'.$ProductType->id.'</td>'.
                        '<td>'.$ProductType->name.'</td>'.
                    '</tr>';
                }
                return Response($output);
            }
        }

    }

    // Fetch records
    public function getHsCodes(Request $request){
        $search = $request->search;

        $HsCodes = HsCode::orderby('id')->select('id','hs_code', 'item_ar','item_en')
        ->where('hs_code', 'like', '%' .$search . '%')
        ->orWhere('item_ar', 'like', '%' .$search . '%')
        ->orWhere('item_en', 'like', '%' .$search . '%')->limit(5)->get();
        $response = array();
        foreach($HsCodes as $HsCode){
            if(App::isLocale('ar')){
                $hsname = $HsCode->item_ar;
            }else {
                $hsname = $HsCode->item_en;
            }
            $response[] = array(
                "id"    => $HsCode->id,
                "text"  => $HsCode->hs_code . ' ' . $hsname,
            );

        }
        return response()->json($response); 
    } 

    public function getPorts(Request $request) {
        $id = $request->id;
        $countryId = $request->countryId;
        // dd ($request->all());
        if ($request->ajax()) {
            return response()->json([
                'ports' => Ports::where('country', $countryId)->where('status', 1)->get()
            ]);
        }

    }

    public function singleProject(Request $request) {
        $project = Project::where('uuid', $request->uuid)->first();

        if ($project != null) {
            $invoice = Invoice::where('project_id', $project->id)->first();
            return view('backend.client.projects.singleProject', compact('project','invoice'));
        }else {
            return redirect()->back()->with([
                'message' => 'error',
                'alert'  => 'danger'
            ]);
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
            ->addColumn('date', function($row){
                return $row->created_at->format('Y M d');                
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
                
                $actionBtn = '<a href="javascript:void(0)" id="show-details" data-url="'. route('client.payment.show', $row->id) . '" class="edit btn btn-outline-info waves-effect btn-sm">'. __('general.proof') .'</a> ';
                if ($row->payment_proof_file == null && $row->project->payment_mode == 1 ) {
                    return $actionBtn;
                } else {
                    // $filenamed = $row->file_name;
                    // return '<a href="'. route('files.download', ['invoices', $filenamed]) . '"  class="edit btn btn-primary waves-effect btn-sm">download</a> ';
                }
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
            ->rawColumns(['status', 'amount', 'desc', 'date', 'action','unpaid','proof'])
            ->make(true);
    }
    public function invoiceShow($id)
    {
        $invoice = ProjectInvoice::where('id',$id)->first();
        return response()->json($invoice);
    }
    public function clientConfirmInvoicePayment(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'media'   => 'required',
            'media.*' => 'mimes:png,jpg,jpeg,pdf,docx',
            'id'   => 'required',
        ]);
        
        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $invoice = ProjectInvoice::where('id', $request->id)->first();
        // dd($agent);
        if ($request->media) {

            $filename = 'payment_proof_file_' . now() . '.' . $request->media->getClientOriginalExtension();
            $request->media->move('assets/files/invoices/' , $filename);
            $invoice->update([
                'payment_proof_file' => $filename,
            ]);
        }
        // if ($request->media && count($request->media) > 0) {
        //     $i = 1;
        //     foreach($request->media as $file){
        //         $filename = now() . '-' . $i . '.' . $file->getClientOriginalExtension();
        //         $file->move(public_path("/assets/files/invoices/"), $filename);

        //         $invoice->update([
        //             'payment_proof_file' => $filename,
        //         ]);
        //         $i++;
        //     }
        // }

        // send notifiaction to user
        if ($invoice->project->ActiveProposal()) {
            $agent = $invoice->project->ActiveProposal()->agent;
            $data = [
                'title' => 'project invoice payment',
                'description' => 'A project invoice payment voucher is attached #'.$invoice->project->id,
                'uuid' => $invoice->project->uuid,
            ];
            $agent->notify(new ProjectDataNotification($data, auth()->user()));
        }
        
        return redirect()->back()->with([
            'message' => 'The invoice has been added successfully',
            'alert'  => 'success'
        ]);

    }

    public function confirmEndProject($uuid)
    {
        $project = Project::where('uuid', $uuid)->first();

        if ($project) {
            $UnpaidInvoice = $project->ProjectInvoice->where('file_name', null)->count();
            $proposal = $project->proposals->where('status', 1)->first();
            // dd($proposal);
            if ($proposal != null) {
                if ($UnpaidInvoice == 0) {
                    $project->update([
                        'status' => 3,
                    ]);
                    $proposal->update([
                        'status' => 2,
                    ]);
    
                    $agent = $proposal->agent;
                    // dd($agent);
                    // Transferring funds from the client’s account to the agent’s account
                    $data = ['type'       => 'credit',
                            'amount'      => $proposal->budget,
                            'description' => 'complete project #' . $project->id,
                            'status'      => 1,
                            ]; 
                    $agentWallet = $agent->transactions()->create($data);
                    
                    $clientWallet = $project->user->transactions()->create([
                        'type'       => 'debit',
                        'amount'      => $proposal->budget,
                        'description' => 'project #' . $project->id,
                        'status'      => 1,
                    ]);
                    // send notifiaction to user

                    $data = [
                        'title' => '🔥 Congratulations 🔥',
                        'description' => 'the project was successfully Ended #'.$project->id,
                        'uuid' => $project->uuid,
                    ];
                    $agent->notify(new ProjectDataNotification($data, auth()->user()));
            
                } else {
                    return redirect()->back()->with([
                        'message' => 'ERROR : unpaid invoices',
                        'alert'  => 'danger'
                    ]);
                }
            } else {
                return redirect()->back()->with([
                    'message' => 'proposal not found',
                    'alert'  => 'danger'
                ]);
            }
            return redirect()->back()->with([
                'message' => 'The project status has been changed to completed',
                'alert'  => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'project error',
            'alert'  => 'danger'
        ]);

        return $project;
    }
    public function singleProjectInvoice($uuid)
    {

        $project = Project::where('uuid', $uuid)->with(['ProjectInvoice','Invoice'])->first();

        if ($project) {
            // project invoices
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

            return view('backend.client.invoices.invoice', compact('project', 'subtotal','taxs','taxsCalc','total'));
        }
        return redirect()->back()->with([
            'message' => 'invoice error',
            'alert'  => 'danger'
        ]);
    }
}
