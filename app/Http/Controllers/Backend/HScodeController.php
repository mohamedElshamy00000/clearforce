<?php

namespace App\Http\Controllers\Backend;

use DataTables;
use App\Models\HsCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Imports\HscodeImport;
use Maatwebsite\Excel\Facades\Excel;

class HScodeController extends Controller
{
    public function HScode(){
        return view('backend.admin.projects.HScode');
    }
    public function getHScode(){

        $data = HsCode::orderBy('created_at', 'desc')->get();
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
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->hs_code . '`, ' .$row->status . ')" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','action','created_at'])
            ->make(true);
    }
    public function HscodeExcelFileStore(Request $req){

        $validation = Validator::make($req->all(), [
            'ExcelFile' => 'required|mimes:xlsx',
        ]);
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.HScode')->withErrors($validation)->withInput();
        }
        
        try {

            Excel::import(new HscodeImport, $req->file('ExcelFile'));
            return redirect()->back()->with([
                'message' => 'Added successfully',
                'alert'   => 'success'
            ]);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($failures);
            return redirect()->back()->with('import_errors', $failures); 
            // foreach ($failures as $failure) {
            //     $failure->row(); // row that went wrong
            //     $failure->attribute(); // either heading key (if using heading row concern) or column index
            //     $failure->errors(); // Actual error messages from Laravel validator
            //     $failure->values(); // The values of the row that has failed.
            // }
        }

    }
    public function HscodeUpdate(Request $req){
        $validation = Validator::make($req->all(), [
            'id'        => 'required',
            'general'   => 'required|string|unique:hs_codes',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.HScode')->withErrors($validation)->withInput();
        }

        $data['general'] = $req->general;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;

        $HsCode = HsCode::find($req->id);
        $HsCode->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }
}
