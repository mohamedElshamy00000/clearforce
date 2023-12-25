<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function userSettingInfo()
    {
        $countries = Country::where('status',1)->orderBy('created_at', 'desc')->get();

        return view('backend.agent.user_setting.info', array('user' => Auth::user(),'countries' => $countries));

    }
    public function userUpdateInfo(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        if ($user && $user->id == auth()->user()->id) {
            
        }
        $validation = Validator::make($req->all(), [
            'name'    => 'required|string',
            'phone'   => 'required|numeric',
            'address' => 'required|string',
            'zipCode' => 'nullable|string',
            // 'media'   => 'required',
            // 'media.*' => 'mimes:doc,pdf,docx,pptx,zip'

        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->route('user.userSettingInfo')->withErrors($validation)->withInput();
        }

        $data['name']    = $req->name;
        $data['phone']   = $req->phone;
        $data['address'] = $req->address;
        $data['zipCode'] = $req->zipCode;

        // dd($data);
        $user->update($data);

        // if ($req->media && count($req->media) > 0) {
        //     $i = 1;
        //     foreach($req->media as $file){
        //         $filename = $Project->uuid . '-' . $i . '.' . $file->getClientOriginalExtension();
        //         $file->move('backend/assets/files/projects/' , $filename);
        //         $Project->files()->create([
        //             'file_name' => $filename
        //         ]);
        //         $i++;
        //     }
        // }

        return redirect()->route('client.all.projects')->with([
            'message' => 'Edit successfully',
            'alert'  => 'success'
        ]);

    }

}
