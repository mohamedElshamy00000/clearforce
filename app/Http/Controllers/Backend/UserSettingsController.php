<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserSettingsController extends Controller
{
    
    public function userSettingInfo()
    {
        $countries = Country::where('status',1)->orderBy('created_at', 'desc')->get();

        foreach (Auth::user()->roles as $role)
        {
            if ($role->name == 'agent')
            {
                return view('backend.agent.user_setting.info', array('user' => Auth::user(),'countries' => $countries));

            } elseif($role->name == 'client'){

                return view('backend.client.user_setting.info', array('user' => Auth::user(),'countries' => $countries));

            }
        }
    }
    public function userUpdateInfo(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        if ($user && $user->id == auth()->user()->id) {
            
        } 
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string',
            'phone'   => 'required|string',
            'address' => 'required|string',
            'zipCode' => 'nullable|string',
            'country' => 'required|string',
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

            // 'media'   => 'required',
            // 'media.*' => 'mimes:doc,pdf,docx,pptx,zip'

        ]);
        // dd($req->all());
        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->route('user.userSettingInfo', $user->id)->withErrors($validation)->withInput();
        }

        $data['name']    = $request->name;
        $data['phone']   = $request->phone;
        $data['address'] = $request->address;
        $data['zipCode'] = $request->zipCode;
        $data['country'] = $request->country;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        // dd($data);
        $user->update($data);

        return redirect()->route('user.userSettingInfo', $user->id)->with([
            'message' => 'Edit successfully',
            'alert'  => 'success'
        ]);

    }
}
