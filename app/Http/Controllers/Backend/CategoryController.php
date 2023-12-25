<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Models\Ports;
use App\Models\Country;
use App\Models\ProductType;
use App\Models\ShipingMode;
use App\Imports\PortsImport;
use Illuminate\Http\Request;
use App\Models\ProductFileType;
use App\Models\ProjectMillstone;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function productFileType(){
        $productFileTypes = ProductFileType::get();
        return view('backend.admin.projects.fileType', compact('productFileTypes'));
    }

    public function getproductFileTypes(){

        $data = ProductFileType::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->name_en . '`, `'. $row->name_ar . '`, ' .$row->status . ')" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','action','created_at'])
            ->make(true);

    }
    public function productFileTypeStore(Request $req){

        $validation = Validator::make($req->all(), [
            'name_en'   => 'required|string',
            'name_ar'   => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.product.fileType')->withErrors($validation)->withInput();
        }

        $data['name_en'] = $req->name_en;
        $data['name_ar'] = $req->name_ar;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;
        $property = ProductFileType::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
    public function productFileTypeUpdate(Request $req){

        $validation = Validator::make($req->all(), [
            'id'        => 'required|numeric',
            'name_en'   => 'required|string',
            'name_ar'   => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.product.fileType')->withErrors($validation)->withInput();
        }

        $data['name_en'] = $req->name_en;
        $data['name_ar'] = $req->name_ar;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status'] = $status;

        $ProductFileType = ProductFileType::find($req->id)->first();

        $ProductFileType->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }


    // shipping ways
    public function shippingWays(){
        $shippingModes = ShipingMode::get();
        return view('backend.admin.projects.shippingWay', compact('shippingModes'));
    }

    public function getshippingWay(){

        $data = ShipingMode::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('ports', function($row){
                return $row->ports->count();                
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->name . '`, ' .$row->status . ')" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','action','created_at','ports'])
            ->make(true);

    }
    public function shippingWayStore(Request $req){

        $validation = Validator::make($req->all(), [
            'name'      => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.shipping.way')->withErrors($validation)->withInput();
        }

        $data['name']     = $req->name;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;
        $property = ShipingMode::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
    public function shippingWayUpdate(Request $req){

        $validation = Validator::make($req->all(), [
            'id'        => 'required',
            'name'      => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.shipping.way')->withErrors($validation)->withInput();
        }

        $data['name']     = $req->name;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;

        $ProductType = ShipingMode::find($req->id);
        $ProductType->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }

    // ports ---------------------

    public function shippingWayPort(){
        $ports = Ports::get();
        $shippingModes = ShipingMode::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();

        return view('backend.admin.projects.ports', compact('ports','shippingModes','countries'));
    }

    public function getPorts(){

        $data = Ports::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name_en', function($row){
                return $row->name_en;                
            })
            ->addColumn('name_ar', function($row){
                return $row->name_ar;                
            })
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('d M Y');                
            })
            // ->addColumn('shipingWay', function($row){
            //     return $row->mode->name;                
            // })
            ->addColumn('country', function($row){
                return $row->country;                
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->name_en . '`, `' . $row->name_ar . '`, `' . $row->country . '`, '  .$row->status . ')" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','action','created_at','name_en','name_ar'])
            ->make(true);

    }
    public function portStore(Request $req){

        $validation = Validator::make($req->all(), [
            'name'            => 'required|string',
            'shiping_mode_id' => 'required',
            'country_id' => 'required',
            'status'          => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.shipping.way.port')->withErrors($validation)->withInput();
        }

        $data['name']            = $req->name;
        $data['shiping_mode_id'] = $req->shiping_mode_id;
        $data['country_id']      = $req->country_id;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;
        $property = Ports::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
    public function portUpdate(Request $req){

        $validation = Validator::make($req->all(), [
            'id'         => 'required',
            'name_en'    => 'required|string',
            'name_ar'    => 'required|string',
            'status'     => 'required',
            // 'country'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.shipping.way.port')->withErrors($validation)->withInput();
        }

        $data['name_en'] = $req->name_en;
        $data['name_ar'] = $req->name_ar;
        // $data['country'] = $req->country;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;

        $Ports = Ports::find($req->id);
        // dd($Ports);
        $Ports->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }
    public function portExcelFileStore(Request $req){

        $validation = Validator::make($req->all(), [
            'ExcelFile'      => 'required|mimes:xlsx',
        ]);
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.shipping.way.port')->withErrors($validation)->withInput();
        }
        
        try {

            Excel::import(new PortsImport, $req->file('ExcelFile'));
            return redirect()->back()->with([
                'message' => 'Added successfully',
                'alert'   => 'success'
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($failures);
            return redirect()->back()->with('import_errors', $failures);
        }
    }
    public function millstones() {
        return view('backend.admin.millstones.allMillstones'); 
    }
    public function getmillstones() {
        $data = ProjectMillstone::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('created_at', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->name . '`, ' .$row->status . ')" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','action','created_at'])
            ->make(true);
    }
    public function millstonesStore(Request $req) {
        
        $validation = Validator::make($req->all(), [
            'name'      => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.millstones')->withErrors($validation)->withInput();
        }

        $data['name']     = $req->name;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;
        $property = ProjectMillstone::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
    public function millstonesUpdate(Request $req) {
        $validation = Validator::make($req->all(), [
            'id'        => 'required',
            'name'      => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.millstones')->withErrors($validation)->withInput();
        }

        $data['name']     = $req->name;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;

        $ProductType = ProjectMillstone::find($req->id);
        $ProductType->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }
}
