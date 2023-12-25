<?php

namespace App\Http\Controllers\Backend\Client;

use DataTables;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\SupportNotification;
use App\Notifications\User\SupportMessageNotification;

class SupportController extends Controller
{
    
    // from project page single
    public function createSupportTicket(Request $request, $id)
    {

        $project = Project::where('id',$id)->first();
        $validation = Validator::make($request->all(), [
            'title'       => 'nullable|string',
            'description' => 'required|string',
            'category'    => 'required|string',
        ]);
        if($validation->fails()){
            return redirect()->route('agent.single.projects', $project->uuid)->withErrors($validation)->withInput();
        }
        if ($project != null) {
            if ($project->user_id == auth()->user()->id) {
                // dd($project->tickets);
                $TS = $project->tickets()->create([
                    'title'        => $request->title,
                    'description'  => $request->description,
                    'category'     => $request->category,
                    'priority'     => 'low',
                    'user_id'      => auth()->user()->id
                ]);

                // send notifiaction to admin
                $ticket = [
                    'subject' => 'new support ticket',
                    'title' => $request->title,
                    'description' => $request->description,
                    'category' => $request->category,
                    'id' => $TS->id,
                ];

                $users = User::whereHas('roles', function($q)
                {
                    $q->where('name', 'admin');
                })->get();

                foreach ($users as $key => $user) {
                    $user->notify(new SupportNotification($ticket, $user));
                }

                return redirect()->back()->with([
                    'message' => 'added successfully',
                    'alert'  => 'success'
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'Error',
            'alert'  => 'danger'
        ]);
    }

    public function getSupportTickets()
    {
        $user = auth()->user();
        $data = SupportTicket::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function($row){
                $actionBtn = '<a href="' . route('client.ticket.single' ,$row->id) . '" class="link"> #SP-'.$row->id .'</a> ';
                return $actionBtn;
            })
            ->addColumn('subject', function($row){
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
            ->rawColumns(['id', 'subject', 'project' ,'category', 'date', 'status'])
            ->make(true);
    }
    public function supportTicketSingle($id)
    {
        $ticket = SupportTicket::where('id', $id)->first();
        if ($ticket) {
            return view('backend.client.help_enter.single', compact('ticket'));
        } else {
            return redirect()->back()->with([
                'message' => 'Error',
                'alert'  => 'danger'
            ]);
        }
    }
    public function getMessages($id){

        $ticket = SupportTicket::with(['user'])->where('id', $id)->first();
        $mesages = SupportMessage::with(['user'])->where('support_ticket_id', $ticket->id)->get();
        return response()->json($mesages);

    }
    public function sendMessage(Request $request, $id)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if($validation->fails()){
            return response()->json(['success'=> $validation]);
        }
        $titcket = SupportTicket::where('id', $id)->first();
        $titcket->messages()->create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
            'status'  => 1
        ]);

        // send notifiaction to admin
        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();
        $ticket = [
            'subject' => 'new support message',
            'title' => $titcket->title,
            'message' => $request->message,
            'category' => $titcket->category,
            'id' => $titcket->id,
        ];
        foreach ($users as $key => $user) {
            $user->notify(new SupportMessageNotification($ticket, auth()->user()));
        }

        return response()->json(['success'=>'sent successfully.']);
        
    }
}
