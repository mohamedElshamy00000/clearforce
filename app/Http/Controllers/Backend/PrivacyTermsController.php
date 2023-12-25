<?php

namespace App\Http\Controllers\Backend;

use App\Models\PrivacyTerms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PrivacyTermsController extends Controller
{
    public function TermsPrivacyUpdate()
    {
        // dd(PrivacyTerms::first());
        if (PrivacyTerms::first() === null) {
            PrivacyTerms::create([
                'privacy_ar' => ' ',
                'privacy_en' => ' ',
                'terms_ar'   => ' ',
                'terms_en'   => ' ',
            ]);
        }
        $settings = PrivacyTerms::first();

        return view('backend.admin.settings.privacyAndTerms', compact('settings'));
    }

    public function privacyUpdate(Request $req)
    {
        $settings = PrivacyTerms::first();
        
        $validation = Validator::make($req->all(), [
            'privacy_ar' => 'nullable|string',
            'privacy_en' => 'nullable|string',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['privacy_ar'] = $req->privacy_ar ;
        $data['privacy_en'] = $req->privacy_en ;

        $settings->update($data);

        return redirect()->back()->with([
            'message' => 'saved',
            'alert'  => 'success'
        ]);
    }
    public function termsUpdate(Request $req)
    {
        $settings = PrivacyTerms::first();
        
        $validation = Validator::make($req->all(), [
            'terms_ar' => 'nullable|string',
            'terms_en' => 'nullable|string',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $datat['terms_ar'] = $req->terms_ar ;
        $datat['terms_en'] = $req->terms_en ;

        $settings->update($datat);

        return redirect()->back()->with([
            'message' => 'saved',
            'alert'  => 'success'
        ]);
    }
}
