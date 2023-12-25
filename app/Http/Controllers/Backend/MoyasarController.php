<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Moyasar\Moyasar;
use App\Models\Coupon;
use App\Models\Wallet;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\TaxType;
use Illuminate\Http\Request;
use Moyasar\Facades\Payment;
use App\Http\Controllers\Controller;
use Moyasar\Providers\PayoutService;
use Moyasar\Providers\InvoiceService;
use Moyasar\Providers\PaymentService;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\PaymentNotification;

class MoyasarController extends Controller
{
    private $InvoiceService;
    private $paymentService;
    private $payoutService;
    public function __construct(InvoiceService $InvoiceService)
    {
        \Moyasar\Moyasar::setApiKey('sk_test_MoAHsdXRLRvoWQfD7x2Qrbs3sG6NiJaUuSnUJb5V');
        $this->InvoiceService = $InvoiceService;
        $this->paymentService = new \Moyasar\Providers\PaymentService();
        $this->payoutService = new \Moyasar\Providers\PayoutService();
    }



    public function currencyConverter($amount) {	
        return floor($amount);
    }


    public function checkout($invoice)
    {
        $invoice = Invoice::where('id',$invoice)->first();
        if ($invoice->status == 1) {
            return redirect()->back()->withErrors([
                'message' => 'This invoice has been paid',
            ]);
        }
        return view('backend.payments.checkout', compact('invoice'));
    }

    public function payAPI(Request $req, $order){

        $invoiceService = new \Moyasar\Providers\InvoiceService();
        $invoice = Invoice::findorfail($order);
        if ($invoice->status == 1) {
            return redirect()->route('client.index')->with([
                'message' => 'This invoice has been paid',
            ]);
        }
        $validation = Validator::make($req->all(), [
            'number' => 'required|min:17|max:22',
            'cvc'    => 'required|numeric',
            'month'  => 'required|numeric',
            'year'   => 'required|numeric',
            'name'   => 'required|string',
        ]);

        if($validation->fails()){
            return redirect()->route('credit.checkout', $invoice->id)->withErrors($validation)->withInput();
        }
        
        $total = intval($invoice->amount);
        $cardnumber = preg_replace('/(?<=\d)\s+(?=\d)/','',$req->number);

        // if has copone
        // if ($req->has('coupon_id') && ! empty($req->input('coupon_id'))) {

        //     $coupon = Coupon::find($req->input('coupon_id'));

        //     if (! $coupon->isInvalid()) {
        //         if ($coupon->isFixed()) {
        //             $total -= $coupon->value;
        //         } else {
        //             $total -= $total * ($coupon->value / 100);
        //         }
                
        //         session()->put('coupon_id', $coupon->id);
        //     }

        // } else {
        //     session()->forget('coupon_id');
        // }

        // if has tax
        if ($invoice->tax_type_id ) {

            $tax = TaxType::where('id', $invoice->tax_type_id)->first();
            // dd($tax->percentage);
            $total +=  intval($total * ($tax->percentage / 100));
        } 

        try{
            
            $data['amount']      = $total;
            $data['description'] = '#P-' . $invoice->project->id;
            $data['number']      = $cardnumber;
            $data['cvc']         = $req->cvc;
            $data['month']       = $req->month;
            $data['year']        = $req->year;
            $data['name']        = $req->name;

            $body = [

                "amount"       =>  $data['amount'] * 100,
                "currency"     =>  "SAR",
                "description"  =>  $data['description'],
                "callback_url" =>  route("credit.paymeny.callback"),
                // "success_url"  =>  'https://desiignbox.com',
                "source" =>  [
                    "type"    =>  "creditcard",
                    "name"    =>  $data['name'],
                    "number"  =>  $data['number'],
                    "cvc"     =>  $data['cvc'],
                    "month"   =>  $data['month'],
                    "year"    =>  $data['year'],
                ],

            ];
            
            // dd($data);
            
            $response = $this->paymentService->create($body);
            // dd($response);

            if($response->status == "initiated"){
                
                $invoice->transaction_id = $response->id;
                $invoice->comment = $response->description;

                $invoice->save();

                return redirect()->to($response->source->transactionUrl);
            }

        }catch(Exception $ex){

            return redirect()->route('credit.checkout');
            
        }

        // dd($this->InvoiceService->all());
        // dd($this->InvoiceService->fetch('3a69ac43-ab7a-4e1c-829e-483613c2e145'));
        // dd($this->paymentService->all());
        // dd($this->paymentService->fetch('1ba629e6-a3da-4bc7-8d56-3719be9dcdcf'));

        // $payment = $this->paymentService->create([
        //     "amount" =>  10000,
        //     "currency" =>  "SAR",
        //     "description" =>  "Payment for order  2#",
        //     "callback_url" =>  'https://desiignbox.com',
        //     "success_url" =>  'https://desiignbox.com',
        //     '3ds'    => false,
        //     "source" =>  [
        //         "type" =>  "creditcard",
        //         "name" =>  "Mohammed Ali",
        //         "number" =>  "4111111111111111",
        //         "cvc" =>  "123",
        //         "month" =>  "12",
        //         "year" =>  "26",
        //     ],
        // ]);
        // dd($payment->source->transactionUrl);

    }

    protected function payout(Request $req, $order){

        $invoiceService = new \Moyasar\Providers\PayoutService();
        $payout        = Wallet::findorfail($order);
        
        $total = intval($payout->amount);
        
        try{
            
            $data['amount']      = $total;
            $data['source_id']   = $req->source_id;
            $data['purpose']     = $req->purpose;
            $data['name']        = $req->name;
            $data['mobile']      = $req->mobile;
            $data['type']        = $req->type;
            $data['iban']        = $req->iban;
            $data['country']     = $req->country;
            $data['city']        = $req->city;

            $body = [

                "source_id" => '94968f8a-6229-4175-90a6-61380d7ba2eb',
                "amount"    => 200,
                "purpose"   => 'payroll_benefits',
                "destination" => [
                    "name"   =>  'Abdulaziz' ,
                    "mobile" =>  '0544424173' ,
                    "type"   =>  'bank' ,
                    "iban"   =>  'SA5330400108057386290014' ,
                    "country" =>  'KSA' ,
                    "city"    =>  'Riyadh'
                ]
            ];
            
            // dd($body);
            
            $response = $this->payoutService->create($body);

            // dd($response);

        }catch(Exception $ex){
            return redirect()->route('credit.checkout');   
        }
    }

    protected function succeeded($invoice)
    {
        $user = auth()->user();
        // add to wallet
        $data = ['type'  =>  'credit',
                'amount' => $invoice->amount,
                'description' =>  $invoice->comment,
                'status' => 1,
                ];
        $wallet = $user->transactions()->create($data);
        // active invoice
        $invoice->update(['status' => 1 ]);
        // active project
        $project = Project::find($invoice->project_id);
        $project->update([ 'status' => 2 ]);

        // send notifiaction to admin
        $users = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();

        foreach ($users as $key => $user) {
            $user->notify(new PaymentNotification($project, auth()->user()));
        }

        return redirect()->route('payment.success', $project->uuid);
    }
    public function paymentSuccess(Request $req, $uuid){
        $myproject = Project::where('uuid',$uuid)->first();
        return view('backend.payments.paymentSuccess', compact('myproject'));
    }
    /**
     * Transaction voided.
     *
     * @param  object  $order
     * @return void
     */
    protected function voided($order)
    {
        // $order->update(['status' => 0 ]);

        // return redirect()->route('dashboard.paymentError');
    }

    /**
     * Transaction refunded.
     *
     * @param  object  $order
     * @return void
     */
    protected function refunded($order)
    {
        # code...
    }

    // redirect to error page if payment error 
    public function payError(){

        // return view('dashboard.paymentError');
            
    }
    /**
     * Transaction failed.
     *
     * @param  object  $order
     * @return void
     */
    protected function failed($invoice){
        return view('backend.payments.paymentError', compact('invoice'));
    }

    /**
     * Processed callback from PayMob servers.
     * Save the route for this method in PayMob dashboard >> processed callback route.
     *
     * @param  \Illumiante\Http\Request  $request
     * @return  Response
     */
    public function processedCallback(Request $req)
    {
        // dd($req->all());

        // "id" => "71fb3190-2052-444a-a191-f9abf95a5799"
        // "status" => "paid"
        // "amount" => "50000"
        // "message" => "APPROVED"

        $transaction_id = $req->id;
        $status         = $req->status;
        $message        = $req->message;
        
        $invoice   = Invoice::where('transaction_id', $transaction_id)->first();
        
        if($invoice){
            
            // Statuses.
            $isSuccess   = filter_var($status == 'paid' , FILTER_VALIDATE_BOOLEAN);
            $isVoided    = filter_var($status == 'voided', FILTER_VALIDATE_BOOLEAN);
            $isFailed    = filter_var($status == 'failed', FILTER_VALIDATE_BOOLEAN);
            $isCaptured  = filter_var($status == 'captured', FILTER_VALIDATE_BOOLEAN);
            $isVerified  = filter_var($status == 'verified', FILTER_VALIDATE_BOOLEAN);
            $isRefunded  = filter_var($status == 'refunded', FILTER_VALIDATE_BOOLEAN);
            // paid // failed // authorized // captured // refunded // voided // verified

            if ($isSuccess && !$isVoided && !$isRefunded) { // transcation succeeded.
                return $this->succeeded($invoice);
            } elseif ($isSuccess && $isVoided) { // transaction voided.
                return $this->voided($invoice);
            } elseif ($isSuccess && $isRefunded) { // transaction refunded.
                return $this->refunded($invoice);
            } elseif (!$isSuccess) { // transaction failed.
                return $this->failed($invoice);
            }

            // return response()->json(['success' => true], 200);

        } else {
            return $this->failed($invoice);
        }
    }

    /**
     * Display invoice page (PayMob response callback).
     * Save the route for this method to PayMob dashboard >> response callback route.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function invoice(Request $request)
    {
        # code...
    }

    
}
