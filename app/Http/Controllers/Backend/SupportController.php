<?php

namespace App\Http\Controllers\Backend;
use DataTables;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\SupportMessageNotification;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::select('id', 'status')->orderBy('created_at', 'ASC')->get();
        return view('backend.admin.support.index', compact('tickets'));
    }
    public function getTickets()
    {
        $user = Auth::user();

        $data = SupportTicket::orderBy('created_at', 'ASC')->get();
        // dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function($row){
                $actionBtn = '<a href="' . route('admin.ticket.single' ,$row->id) . '" class="link"> #SP-'.$row->id .'</a> ';
                return $actionBtn;
            })
            ->addColumn('user', function($row){
                if ($row->user == null) {
                    return 'null';
                } else {
                    return $row->user->name . ' <br> <span class="text-muted fs-6">'. $row->user->email .'</span>';
                }
            })
            ->addColumn('title', function($row){
                return $row->title;
            })
            ->addColumn('category', function($row){
                if ($row->category == null) {
                    return 'null';
                } else {
                    return $row->category;
                }
            })
            ->addColumn('project', function($row){
                if ($row->project) {
                    $actionBtn = '<a href="' . route('single.project' ,$row->project->uuid) . '" class="edit btn btn-outline-dark waves-effect btn-sm "> <i class="fa fa-link"></i> </a> ';
                    return $actionBtn;
                } else{
                    return 'NULL';
                }
            })
            
            ->addColumn('priority', function($row){
                if ($row->priority == 'low') {
                    return '<span class="badge bg-label-success">low</span>';
                } else if($row->priority == 'medium'){
                    return '<span class="badge bg-label-info">medium</span>';
                } else if($row->priority == 'high'){
                    return '<span class="badge bg-label-danger">high</span>';
                } else if($row->priority == 'critical'){
                    return '<span class="badge bg-danger">critical</span>';
                }
            })
            ->addColumn('date', function($row){
                return $row->created_at->format('Y M D');                
            })
            ->addColumn('status', function($row){
                
                if ($row->status == 0) {
                    return '<span class="badge bg-label-danger">new</span>';
                } else if($row->status == 1){
                    return '<span class="badge bg-label-info">inprogress</span>';
                } else if($row->status == 2){
                    return '<span class="badge bg-label-danger">On-Hold</span>';
                } else if($row->status == 3){
                    return '<span class="badge bg-label-success">solved</span>';
                }
            })
            ->rawColumns(['id', 'title','user', 'project' ,'priority' ,'category', 'date', 'status'])
            ->make(true);
    }
    public function ticketSingle($id)
    {
        $ticket = SupportTicket::where('id', $id)->with(['project', 'user'])->first();
        return view('backend.admin.support.single',compact('ticket'));
    }
    public function sendMessage(Request $request, $id)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if($validation->fails()){
            return response()->json(['success' => $validation]);
        }
        $titcket = SupportTicket::where('id', $id)->first();
        
        if ($request->status) {
            $titcket->update([
                'status' => $request->status,
            ]);
        }
        $titcket->messages()->create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
            'status'  => 1
        ]);

        // send notifiaction to admin
        $ticket = [
            'subject' => 'new support message',
            'title' => $titcket->title,
            'message' => $request->message,
            'category' => $titcket->category,
            'id' => $titcket->id,
        ];
        $titcket->user->notify(new SupportMessageNotification($ticket, auth()->user()));

        return response()->json(['success'=>'sent successfully.']);

    }

    public function ticketEditPriority($id, $priority)
    {

        $titcket = SupportTicket::where('id', $id)->first();
        
        if ($priority) {
            $titcket->update([
                'priority' => $priority,
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Edit Successfully',
            'alert'  => 'success'
        ]);
    }
}
