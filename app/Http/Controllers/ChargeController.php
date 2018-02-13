<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charge;
use Auth;
use Config;
use Session;
class ChargeController extends Controller
{
	private $stripeseceretKey;
	public function __construct(){
		$this->stripeseceretKey = Config::get('services.stripe.secret');
	}

    function Charge(Request $request)
    {   
    	try {
			\Stripe\Stripe::setApiKey($this->stripeseceretKey);
			// Token is created using Checkout or Elements!
			// Get the payment token ID submitted by the form:
			$token = $request->stripeToken;
			// Charge the user's card:
			$charge = \Stripe\Charge::create(array(
			  "amount" => $request->amount,
			  "currency" => "usd",
			  "description" => "Charge",
			  "source" => $token,
			));
			$chargedata = new Charge();
			$chargedata->userid = Auth::user()->id;
			$chargedata->status = $charge->status;
			$chargedata->amount = $charge->amount/100;
			$chargedata->response = json_encode($charge);
			$chargedata->save();
	 		Session::flash('success','Charge created successfully');
            return redirect('/');
	 	} catch (Exception $e) {
	 		Session::flash('failure', $e->getMessage());
            return redirect('/');
	 	} 	
    	
    }
}
