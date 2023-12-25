<?php

namespace App\Http\Controllers\Backend;
use DataTables;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Imports\CountryImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class CountryController extends Controller
{
    public function countries(){
        return view('backend.admin.country.countries');
    }
    public function getCountrys()
    {
        $data = Country::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('import', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">no</span>';
                } else {
                    return '<span class="badge bg-label-success">yes</span>';
                }
            })
            ->addColumn('export', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">no</span>';
                } else {
                    return '<span class="badge bg-label-success">yes</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->name . '`, ' .$row->code . ', `' . $row->import . ', `' . $row->export . '`, `' . $row->status . ' )" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','import','export','action'])
            ->make(true);
    }
    public function countryExcelFileStore(Request $req){

        $validation = Validator::make($req->all(), [
            'ExcelFile'      => 'required|mimes:xlsx',
        ]);
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.countries')->withErrors($validation)->withInput();
        }
        
        try {

            Excel::import(new CountryImport, $req->file('ExcelFile'));
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
    public function countrysUpdate(Request $req){
        $validation = Validator::make($req->all(), [
            'id'        => 'required',
            'name'      => 'required|string|unique:countries',
            'code'      => 'required|string|unique:countries',
            'import'    => 'required',
            'export'    => 'required',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.countries')->withErrors($validation)->withInput();
        }

        $data['name']     = $req->general;
        $data['code']     = $req->general;

        if ($req->import == 1) {
            $import = 1;
        } else {
            $import = 0;
        }
        if ($req->export == 1) {
            $export = 1;
        } else {
            $export = 0;
        }
        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['export']   = $export;
        $data['import']   = $import;
        $data['status']   = $status;

        $Country = Country::find($req->id);
        $Country->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }
}
