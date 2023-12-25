<?php

namespace App\Http\Controllers\Backend;
use DataTables;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Models\QuestionsCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    public function questions(){
        $categories = QuestionsCategory::where("status", 1)->get();
        return view('backend.admin.questions.questions', compact('categories'));
    }
    public function categorys(){
        return view('backend.admin.questions.categories');
    }
    public function getQAcategorys()
    {
        $data = QuestionsCategory::orderBy('created_at', 'desc')->get();
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
            ->addColumn('date', function($row){
                return $row->created_at->format('d-m-Y');
            })
            ->addColumn('action', function($row){
                $actionBtn = '<span onClick="changeToEdit(' . $row->id . ', `' . $row->name . '`, ' . $row->status . ' )" class="edit btn btn-outline-info waves-effect btn-sm">Edit</span>';
                return $actionBtn;
            })
            ->rawColumns(['status','name','date','action'])
            ->make(true);
    }
    
    public function QAcategorysStore(Request $req){

        $validation = Validator::make($req->all(), [
            'name'      => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.questions.categorys')->withErrors($validation)->withInput();
        }

        $data['name'] = $req->name;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status']   = $status;
        $QuestionsCategory = QuestionsCategory::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }
    public function QAcategorysUpdate(Request $req){
        $validation = Validator::make($req->all(), [
            'id'        => 'required',
            'name'      => 'required|string',
            'status'    => 'required',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.questions.categorys')->withErrors($validation)->withInput();
        }

        $data['name'] = $req->name;

        if ($req->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['status'] = $status;
        $QuestionsCategory = QuestionsCategory::find($req->id);
        $QuestionsCategory->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }

    public function getQAquestions()
    {
        $data = Questions::orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">not active</span>';
                } else {
                    return '<span class="badge bg-label-success">active</span>';
                }
            })
            ->addColumn('question', function($row){
                return $row->question;
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('d-m-Y');
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="' . route('QAquestions.update', $row->id) . '" class="edit btn btn-outline-info waves-effect btn-sm">Edit</a>';
                return $actionBtn;
            })
            ->rawColumns(['status','name','date','action'])
            ->make(true);
    }
    public function QAquestionsStore(Request $req){

        $validation = Validator::make($req->all(), [
            'question'     => 'required|string',
            'description'  => 'required|string',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->route('admin.questions')->withErrors($validation)->withInput();
        }

        $data['question'] = $req->question;
        $data['description'] = $req->description;
        $data['categories_id'] = $req->categoryId;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($req->showLanding) {
            $showLanding = 1;
        } else {
            $showLanding = 0;
        }
        $data['status']   = $status;
        $data['showLanding']   = $showLanding;
        $Questions = Questions::create($data);

        return redirect()->back()->with([
            'message' => 'Added successfully',
            'alert'   => 'success'
        ]);
    }

    public function QAquestionsUpdate($id)
    {
        $question = Questions::where('id', $id)->first();
        $categories = QuestionsCategory::where("status", 1)->get();

        return view('backend.admin.questions.questionsUpdate', compact('question', 'categories'));
    }
    public function QAquestionsChange(Request $req)
    {
        // dd($req->all());
        $validation = Validator::make($req->all(), [
            'question'     => 'required|string',
            'description'  => 'required|string',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation);
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['question'] = $req->question;
        $data['description'] = $req->description;
        $data['categories_id'] = $req->categoryId;
        if ($req->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($req->showLanding) {
            $showLanding = 1;
        } else {
            $showLanding = 0;
        }
        $data['status']   = $status;
        $data['showLanding']   = $showLanding;

        $Questions = Questions::find($req->id);
        $Questions->update($data);

        return redirect()->back()->with([
            'message' => 'Modified successfully',
            'alert'  => 'success'
        ]);
    }
}
