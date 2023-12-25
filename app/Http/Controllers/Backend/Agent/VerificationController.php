<?php

namespace App\Http\Controllers\Backend\Agent;

use Illuminate\Http\Request;
use App\Models\VerificationCenter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{

    public function index(){
        $verifications = VerificationCenter::where('user_id', Auth::user()->id)->get();
        return view('backend.agent.verification_center.verification', compact('verifications'));
    }

    public function storeVerificationFiles(Request $req){

        $validation = Validator::make($req->all(), [
            'number'  => 'required|numeric',
            'media'   => 'required|mimes:doc,pdf,docx,pptx,zip',
        ]);
        // dd($req->all());
        if($validation->fails()){
            // toast('The files has been added successfully!');
            // dd($validation);
            return redirect()->route('agent.verification')->withErrors($validation)->withInput();
        }
        
        $user = Auth::user();
        $data['number'] = $req->number;
        $data['user_id'] = $user->id;
        $data['status'] = 0;

        $VerificationCenter = VerificationCenter::create($data);

        if ($req->media) {

            $filename = $req->number . '-' . $user->id .'-' . $req->media->getClientOriginalExtension();
            $req->media->move('assets/files/verification/' , $filename);

            $VerificationCenter->update([
                'documents' => $filename
            ]);
        }

        toast('The files has been added successfully!');

        return redirect()->back()->with([
            'message' => 'The files has been added successfully',
            'alert'  => 'success'
        ]);
    }

}
