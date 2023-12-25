<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data['productName']       = 'ClearForce' ;
        $data['productDescription_ar'] = 'شريكك الموثوق لحلول التخليص الجمركي وتيسير عبور البضائع عبر الحدود' ;
        $data['productDescription_en'] = 'Your Trusted Partner for Seamless customs Clearance Solutions' ;
        $data['phone']             = '' ;
        $data['email']             = 'info@clearforce.co' ;
        $data['address_en']        = 'saudi arabia' ;
        $data['address_ar']        = 'المملمة العربية السعودية' ;
        $data['footerQuote_en']    = 'Your Trusted Partner for Seamless customs clearance Efficient, Reliable, and Cost-Effective Customs Clearance Services to Meet Business Needs' ;
        $data['footerQuote_ar']    = 'شريكك الموثوق به لتخليص جمركي سلس خدمات تخليص جمركي تتسم بالكفاءة والموثوقية والفعالية من حيث التكلفة لتلبية احتياجات العمل' ;
        $data['twitter']           = 'https://clearforce.co/' ;
        $data['facebook']          = 'https://clearforce.co/' ;
        $data['linkedin']          = 'https://clearforce.co/' ;
        $data['youtube']           = 'https://clearforce.co/' ;
        $data['mail_driver']       = 'smtp' ;
        $data['mail_host']         = 'smtp.hostinger.com' ;
        $data['mail_port']         = '465' ;
        $data['mail_username']     = 'info@hurryin.co' ;
        $data['mail_password']     = '1?Pc=#jPO>' ;
        $data['mail_encryption']   = 'ssl' ;
        $data['mail_from_Addesss'] = 'info@hurryin.co' ;
        $data['mail_from_name']    = '${APP_NAME}' ;
        $data['moyasar_api_key']   = 'pk_test_56GSNL3xg1qE9oaMQz2q7LTRNzuAndx45jW9FRAN' ;
        $data['s3_access_key']     = '' ;
        $data['s3_secret_key']     = '' ;
        $data['s3_sefault_key']    = '' ;
        $data['s3_bucket']         = '' ;

        Setting::create($data);
        
    }
}
