<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\TaxType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxController extends Controller
{
    public function index(){
        return view('backend.admin.tax.taxs');
    }

    public function getTaxTypes()
    {
        $data = TaxType::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('percentage', function($row){
                return $row->percentage . ' %';
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' .  $row->name . '`, ' . $row->percentage . ',' . $row->status . ')" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','percentage','name','action'])
            ->make(true);
    }

    public function TaxUpdate(Request $req){
        $validation = Validator::make($req->all(), [
            'id'         => 'required',
            'name'       => 'required|string',
            'percentage' => 'required|numeric',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.taxs')->withErrors($validation)->withInput();
        }

        $data['name']       = $req->name;
        $data['percentage'] = $req->percentage;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;

        $TaxType = TaxType::find($req->id);
        $TaxType->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }

    public function TaxCreate(Request $req)
    {
        $validation = Validator::make($req->all(), [
            'name'       => 'required|string',
            'percentage' => 'required|numeric',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.taxs')->withErrors($validation)->withInput();
        }

        $data['name']       = $req->name;
        $data['percentage'] = $req->percentage;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;
        $TaxType = TaxType::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
}
