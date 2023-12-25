<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('backend.admin.settings.mainSettings', compact('settings'));
    }

    public function update(Request $req){
        $settings = Setting::where('id',1)->first();
        
        $validation = Validator::make($req->all(), [
            'productName' => 'nullable|string',
            'productDescription_ar' => 'nullable|string',
            'productDescription_en' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'address' => 'nullable|string',
            'footerQuote' => 'nullable|string',
            'twitter' => 'nullable|string',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'youtube' => 'nullable|string',
            'mail_driver' => 'nullable|string',
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_Addesss' => 'nullable|string',
            'mail_from_name' => 'nullable|string',
            'moyasar_api_key' => 'nullable|string',
            's3_access_key' => 'nullable|string',
            's3_secret_key' => 'nullable|string',
            's3_sefault_key' => 'nullable|string',
            's3_bucket' => 'nullable|string',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['productName'] = $req->productName ;
        $data['productDescription_ar'] = $req->productDescription_ar ;
        $data['productDescription_en'] = $req->productDescription_en ;
        $data['phone'] = $req->phone ;
        $data['email'] = $req->email ;
        $data['address_ar'] = $req->address_ar ;
        $data['address_en'] = $req->address_en ;
        $data['footerQuote_ar'] = $req->footerQuote_ar ;
        $data['footerQuote_en'] = $req->footerQuote_en ;
        $data['twitter'] = $req->twitter ;
        $data['facebook'] = $req->facebook ;
        $data['linkedin'] = $req->linkedin ;
        $data['youtube'] = $req->youtube ;
        $data['mail_driver'] = $req->mail_driver ;
        $data['mail_host'] = $req->mail_host ;
        $data['mail_port'] = $req->mail_port ;
        $data['mail_username'] = $req->mail_username ;
        $data['mail_password'] = $req->mail_password ;
        $data['mail_encryption'] = $req->mail_encryption ;
        $data['mail_from_Addesss'] = $req->mail_from_Addesss ;
        $data['mail_from_name'] = $req->mail_from_name ;
        $data['moyasar_api_key'] = $req->moyasar_api_key ;
        $data['s3_access_key'] = $req->s3_access_key ;
        $data['s3_secret_key'] = $req->s3_secret_key ;
        $data['s3_sefault_key'] = $req->s3_sefault_key ;
        $data['s3_bucket'] = $req->s3_bucket ;

        if ($settings == null) {
            Setting::create($data);

        } else {
            $settings->update($data);
        }

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $values['MAIL_MAILER'] = $req->mail_driver ;
        $values['MAIL_HOST'] = $req->mail_host ;
        $values['MAIL_PORT'] = $req->mail_port ;
        $values['MAIL_USERNAME'] = $req->mail_username ;
        $values['MAIL_PASSWORD'] = $req->mail_password ;
        $values['MAIL_ENCRYPTION'] = $req->mail_encryption ;
        $values['MAIL_FROM_ADDRESS'] = $req->mail_from_Addesss ;

        $values['MOYASAR_API_KEY'] = $req->moyasar_api_key ;
        $values['AWS_ACCESS_KEY_ID'] = $req->s3_access_key ;
        $values['AWS_SECRET_ACCESS_KEY'] = $req->s3_secret_key ;
        $values['AWS_DEFAULT_REGION'] = $req->s3_sefault_key ;
        $values['AWS_BUCKET'] = $req->s3_bucket ;

        // if (count($values) > 0) {
            
        //     foreach ($values as $envKey => $envValue) {
        //         $str .= "\n";
        //         $keyPosition = strpos($str, "{$envKey}=");
        //         $endOfLinePosition = strpos($str, "\n", $keyPosition);
        //         $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

        //         if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
        //             $str .= "{$envKey}=\"{$envValue}\"\n";
        //         } else {
        //             $str = str_replace($oldLine, "{$envKey}=\"{$envValue}\"", $str);
        //         }
        //     }
        // }
        
        // $str = substr($str, 0, -1);
        // if (!file_put_contents($envFile, $str)){
        //     return redirect()->back()->with([
        //         'message' => 'error env',
        //         'alert'  => 'danger'
        //     ]);
        // }

        Artisan::call('optimize:clear');
        
        return redirect()->back()->with([
            'message' => 'saved',
            'alert'  => 'success'
        ]);

    }

    public function projectSettings(Request $req)
    {
        // tax, auto approve, comission type[percentage amount, fixed amount]
        // $settings = Setting::where('id',1)->first();
        
        // $validation = Validator::make($req->all(), [
        //     'taxType' => 'nullable|string',
        // ]);

        // if($validation->fails()){
        //     return redirect()->back()->withErrors($validation)->withInput();
        // }

        // $data['taxType'] = $req->taxType ;

        // if ($settings == null) {
        //     Setting::create($data);

        // } else {
        //     $settings->update($data);
        // }
        
        // return redirect()->back()->with([
        //     'message' => 'saved',
        //     'alert'  => 'success'
        // ]);
    }
}
