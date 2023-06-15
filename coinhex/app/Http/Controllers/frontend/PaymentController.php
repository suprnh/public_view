<?php


namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Redirect;
use Storage;
use App\Transaction;
use DB;
use Stripe;
class PaymentController extends Controller
{
    public function getInvoiceInfo($id){
        dd($this->apiCall('get_tx_info',['txid'=>$id,'full'=>1]));
        
        
    }
    public function apiCall($cmd, $req = array()){
		
		$user_detail = get_user_detail_by_id(get_current_front_user_id());
		//$debug_email = 'sakilmahmudmolla@gmail.com';
        $debug_email = $user_detail->email;
        $public_key = '10cb013e48cb55ea5c86654ee3289a378161252ab796a5e4ee34c194925714c2';
        $private_key = 'a5478a01056D24489Ee378C33506D89BbfbC8547E4935e8e7b7227B29941C3b4';
		
        
        $req['version'] = 1; 
        $req['cmd'] = $cmd; 
        $req['key'] = $public_key; 
        $req['format'] = 'json'; //supported values are json and xml  
        $req['buyer_email'] = $debug_email;
        // Generate the query string 
        $post_data = http_build_query($req, '', '&'); 
        // Calculate the HMAC signature on the POST data 
        $hmac = hash_hmac('sha512', $post_data, $private_key); 
        // Create cURL handle and initialize (if needed) 
        static $ch = NULL; 
        if ($ch === NULL) { 
            $ch = curl_init('https://www.coinpayments.net/api.php'); 
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        } 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac)); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
        
        // Execute the call and close cURL handle      
        $data = curl_exec($ch);                 
        // Parse and return data if successful. 
        if ($data !== FALSE) { 
            if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) { 
                // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP 
                $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING); 
            } else { 
                $dec = json_decode($data, TRUE); 
            } 
            if ($dec !== NULL && count($dec)) { 
                return $dec; 
            } else { 
                // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message 
                return array('error' => 'Unable to parse JSON result ('.json_last_error().')'); 
            } 
        } else { 
            return array('error' => 'cURL error: '.curl_error($ch)); 
        }    
    }
    public function pay(Request $request){
		
		//print_r($_POST); die;
		
        $params = $request->all();
		//$amount = $params['payable_crypto_amount'];
		$amount = $params['contribution_amount'];
        //$coin = $params['choosen_crypto'];
        $coin = $params['payOption'];
        $bonus_percentage = $params['bonus_percentage'];
		
        $coins = ['BTC','LTC','ETH','LTCT'];
		
        if(strcmp(Session::get("is_frontend_user_logged_in"),"yes")==0){
			//echo 'enter 1'; die;
            if(isset($amount) && $amount>0 && in_array($coin,$coins)){
				//echo 'enter 2'; die;
                $response = $this->apiCall('create_transaction',['amount'=>$amount, 'currency1'=>'USD' , 'currency2'=>$coin , 'custom'=>$amount , 'buyer_name' => Session::get("frontend_userid"),"ipn_url"=>"https://ownii.net/done","succes_url"=>"https://ownii.net/dashboard","cancel_url"=>"https://ownii.net/dashboard"]);
                //dd($response); die;
                if(strcmp($response['error'],"ok")==0){
                    DB::table("contribution")->insert(['status'=>0,'submitted_by'=>Session::get("frontend_userid"),'approved_by'=>0,'transfer_proof'=>$response['result']['txn_id'],'status_url'=>$response['result']['status_url'],'checkout_url'=>$response['result']['checkout_url']]);
					
					$txn_id = $response['result']['txn_id'];
					
					$contribution_id = DB::table("contribution")->where('transfer_proof','=',$txn_id)->first()->ID;
					
					
					$bonus_percentage = get_settings('bonus_percentage');
					$bonus_amount = 0;
					
					$base_amount = $amount*100;

					if($bonus_percentage > 0){
						$bonus_amount = (float)($base_amount*($bonus_percentage/100));
					}
					
					$total_amount = (float)$base_amount+(float)$bonus_amount;
					
					DB::table("transaction")->insert(['type'=>1,'parent_type'=>'contribution','parent_id'=>$contribution_id,'amount'=>$total_amount,'transaction_for'=>get_current_front_user_id(),'exchange_currency'=>$coin]);
					
                    return Redirect::to($response['result']['checkout_url']);
                }else{
                    return Redirect::route("dashboard")->with("message","Something went wrong...");
                }
            }
        }else{
            return Redirect::route('dashboard')->with("message","Amount Parameters!!");
        }

        
    }
	
	public function paystripe(Request $request){
		
		//echo "<pre>"; print_r($_POST); die;
		
		$input = $request->all();
		
		$email = $input['email']; 
		$user_id = $input['user_id']; 
		$full_name = $input['full_name']; 
		$token_amount = $input['token_amount']; 
		$amount = $input['usd_amount']; 
		$amountPay = $amount*100;
		$tx_hash = $input['tx_hash']; 
		
		$country = 'India';
		$city = 'kolkata';
		$address = 'lakegardens';
		$state = 'West Bengal';
		$zipCode = '700045';
		
		$token = $input['stripeToken'];
		$stripeEmail = $input['stripeEmail']; 
		
		\Stripe\Stripe::setApiKey("sk_test_Uip5PNLFHOLlJbZFDUYDoR2P");
		
		$customer = \Stripe\Customer::create(array(
				'name' => $full_name,
				'description' => 'test description',
				'email' => $stripeEmail,
				"address" => ["city" => $city, "country" => $country, "line1" => $address, "line2" => "", "postal_code" => $zipCode, "state" => $state]
			));
			
		\Stripe\Customer::createSource(
			$customer->id,
			['source' => $token]
		);
		
		
		$charge = \Stripe\Charge::create ([
				
				"customer" => $customer->id, 
				
                "amount" => $amountPay,

                "currency" => "inr",

                "description" => "Test payment from onwii.com." 

        ]);
		 if($charge['status'] == 'succeeded') {
			/**
			* Write Here Your Database insert logic.
			*/
			
			
			$data['email'] = $stripeEmail;
			$data['currency'] = 'usd';
			$data['amount'] = $amount;
			$data['transfer_proof'] = $tx_hash;
			$data['base_currency'] = 'DDT';
			$data['base_amount'] = $token_amount;
			$data['submitted_by'] = $user_id;
			$data['status'] = '3';
			$con_id = DB::table('contribution')->insertGetId($data);
			if($con_id > 0){
				
				$transaction_data_comm = array();
				$transaction_data_comm['type'] = '1';
				$transaction_data_comm['parent_type'] = 'contribution';
				$transaction_data_comm['parent_id'] = $con_id;
				$transaction_data_comm['amount'] = $token_amount;
				$transaction_data_comm['status'] = '1';
				
				$transaction_data_comm['transaction_for'] = $user_id;
				$transaction_id = DB::table('transaction')->insertGetId($transaction_data_comm);
			 }
			 
			return Redirect::route('token')->with("message","Payment success");
			
		} else {
			/* \Session::put('error','Money not add in wallet!!');
			return redirect()->route('products'); */
			//echo "faild";
			
			 return Redirect::route('products')->with("message","Payment Faild!!");
		}

        
    }
	
    public function save(Request $request){
        
       Storage::put('postData.txt',json_encode($request->all()));
        $params = $request->all();
        // Fill these in with the information from your CoinPayments.net account. 
		
        $cp_merchant_id = '66b6c33ee2d306c64cf106377fd3bbad'; 
        $cp_ipn_secret = 'OWNii@24by7';
        $cp_debug_email = 'sakilmahmudmolla@gmail.com'; 
		//$user_detail = get_user_detail_by_id($params['buyer_name']);
		//$debug_email = 'sakilmahmudmolla@gmail.com';
        //$cp_debug_email = $user_detail->email;
    
        // //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field. 
        $order_currency = 'USD'; 
       
        function errorAndDie($error_msg) { 
            global $cp_debug_email; 
            global $params;
            if (!empty($cp_debug_email)) { 
                $report = 'Error: '.$error_msg."\n\n"; 
                $report .= "POST Data\n\n"; 
                foreach ($params as $k => $v) { 
                    $report .= "|$k| = |$v|\n"; 
                } 
                mail($cp_debug_email, 'CoinPayments IPN Error', $report); 
            } 
            Storage::put('ipn.txt' , 'IPN Error: '.$error_msg ); 
            die();
        } 
    
        if (!isset($params['ipn_mode']) || $params['ipn_mode'] != 'hmac') { 
            errorAndDie('IPN Mode is not HMAC'); 
        }
        //  if (request()->server('HTTP_HMAC')==null || empty(request()->server('HTTP_HMAC'))) 
        // { 
        //     errorAndDie('No HMAC signature sent.');
        // }

        // if (request()->server(['HTTP_HMAC'])!=null || empty(request()->server('HTTP_HMAC'))) { 
        //     errorAndDie('No HMAC signature sent.'); 
        // }
        
        if ($params === FALSE || empty($params)) { 
            errorAndDie('Error reading POST data'); 
        } 
        if (!isset($params['merchant']) || $params['merchant'] != trim($cp_merchant_id)) { 
            errorAndDie('No or incorrect Merchant ID passed'); 
        }
        // dd(gettype($params));
        // $hmac = hash_hmac("sha512", $params, trim($cp_ipn_secret)); 
        // // if (!hash_equals($hmac, request()->server('HTTP_HMAC'))) { 
        // if ($hmac != request()->server('HTTP_HMAC')) { 
        //     errorAndDie('HMAC signature does not match'); 
        // } 
        
        // HMAC Signature verified at this point, load some variables. 
        
        $txn_id = $params['txn_id']; 
        $amount1 = floatval($params['amount1']); 
        $amount2 = floatval($params['amount2']); 
        $currency1 = $params['currency1']; 
        $currency2 = $params['currency2']; 
        $status = intval($params['status']); 
        $status_text = $params['status_text']; 
        $user_id = $params['buyer_name'];
        $amount=$params['custom'];
        //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point 
        
        
    
        // Check the original currency to make sure the buyer didn't change it. 
        if ($currency1 != $order_currency) { 
            errorAndDie('Original currency mismatch!'); 
        }     
        $order_total = $amount;
        // Check amount against order total 
        if ($amount1 < $order_total) { 
            errorAndDie('Amount is less than order total!'); 
        } 
        
        if ($status >= 100 || $status == 2) { 
            // payment is complete or queued for nightly payout, success 
            if($status>=100){
				
				$bonus_percentage = get_settings('bonus_percentage');
				$bonus_amount = 0;
				
				$base_amount = $amount1*100;

				if($bonus_percentage > 0){
					$bonus_amount = (float)($base_amount*($bonus_percentage/100));
				}
								
                DB::table('contribution')->where('transfer_proof','=',$txn_id)->update(['email'=>DB::table("users")->where('id','=',$user_id)->first()->email,'base_currency'=>'OWNII','base_amount'=>$amount1*100,'amount'=>$amount2,'currency'=>$currency2,'submitted_by'=>$user_id,'bonus_percentage'=>$bonus_percentage,'bonus_amount'=>$bonus_amount,'status_msg'=>$status_text,'status'=>3]);
				
               $contribution_id = DB::table("contribution")->where('transfer_proof','=',$txn_id)->first()->ID;
								
				DB::table('transaction')->where('parent_id', '=', $contribution_id)->where('parent_type', '=', 'contribution')->update(['status'=>1]);
				
						
				$get_user_info = get_user_info($user_id);
						
				if(!empty($get_user_info)){
					
					$high_token_amount = $get_user_info->high_token_amount;
					
					if($high_token_amount !=""){
						$total_amount = (float)$high_token_amount + (float)$total_amount;
					}
					
					$update_user_data['high_token_amount'] = $total_amount;
					
					$update2 = DB::table('users')
							  ->where('ID','=',$user_id)
							  ->update($update_user_data);
					if($update2 == 1){
						return back()->with('contribution_success','Contribution Updated Successfully ! Transaction and Total OWNII Token also updated');
					}
				}
            }

        }
    
    }
	
	
	public function subscriber_plan(Request $request){
		
		//echo "<pre>"; print_r($_POST); die;
		$user_id = get_current_front_user_id();
		
		$subscriptions_id = "";
		$latest_invoice_id = "";
		
		$user_detail = get_user_detail_by_id($user_id);
		$sub_plan_details = subscriber_plan_details($user_id);
	
		$amount = 0;
		
		if(!empty($sub_plan_details)){
			
			$plan_id = $sub_plan_details->plan_id;
			
			$plan_details = plan_details($plan_id);
			
			if(!empty($plan_details)){
				$amount = $plan_details->plan_amount;
			}
		}
		
		//echo "<pre>"; print_r($user_detail); die;
		
		$email = $user_detail->email;
		$full_name = $user_detail->full_name;
		$amountPay = $amount*100;
		$tx_hash = 'tx_'.time();
		
		$country = 'India';
		$city = 'kolkata';
		$address = 'lakegardens';
		$state = 'West Bengal';
		$zipCode = '700045';
		
		$token = $_POST['stripeToken'];
		$stripeEmail = $_POST['stripeEmail']; 
		
		\Stripe\Stripe::setApiKey("sk_test_Uip5PNLFHOLlJbZFDUYDoR2P");
		
		$customer = \Stripe\Customer::create(array(
				'name' => $full_name,
				'description' => 'Member for Hilite Coin',
				'email' => $stripeEmail,
				"address" => ["city" => $city, "country" => $country, "line1" => $address, "line2" => "", "postal_code" => $zipCode, "state" => $state]
			));
		$stripe_data['customer'] = $customer;
		
		if(!empty($stripe_data['customer'])){
			
			\Stripe\Customer::createSource(
					$customer->id,
					['source' => $token]
				);
			
			$stripe = new \Stripe\StripeClient(
							'sk_test_Uip5PNLFHOLlJbZFDUYDoR2P'
						);
			
			$customer_id = $customer->id;
			
			if($plan_id == 1){ //Monthly plan				
			
				/* $prices_data = $stripe->prices->create([
					  'unit_amount' => $amountPay,
					  'currency' => 'inr',
					  'recurring' => ['interval' => 'month'],
					  'product' => 'prod_Kw7wJBcFR4ZhEv',
					]); */
				$stripe_data['subscriptions'] = $stripe->subscriptions->create([
				  'customer' => $customer_id,
				  'items' => [
						['price' => 'price_1KGH7mFJ5LXx0AxzYESWbegj'],
					],
				]);

			}elseif($plan_id == 2){ //Yearly plan
			
				$stripe_data['subscriptions'] = $stripe->subscriptions->create([
				  'customer' => $customer_id,
				  'items' => [
						['price' => 'price_1KGId9FJ5LXx0AxzhdUnAFkj'],
					],
				]);
			}
			
			//echo "<pre>"; print_r($stripe_data); die;
			
			if(!empty($stripe_data['subscriptions'])){
				$subscriptions_id = $stripe_data['subscriptions']->id;
				$latest_invoice_id = $stripe_data['subscriptions']->latest_invoice;
			}
		}
		
		
		
		if($subscriptions_id != '') {
			
			/**
			* Write Here Your Database insert logic.
			*/
			
			$data['user_id'] = $user_id;
			$data['amount'] = $amount;
			$data['plan_id'] = $plan_id;
			$data['subscriptions_id'] = $subscriptions_id;
			$data['latest_invoice_id'] = $latest_invoice_id;
			$data['status'] = 1;
			
			$mt_id = DB::table('membership_transactions')->insertGetId($data);
			
			if($mt_id > 0){
			 
				return back()->with("message","Payment Success. You are now our Member");
			}else{
			 
				return back()->with("message","Payment Failed");
			}
		} else {
			 return back()->with("message","User creation faild on stripe!!");
		}
    }
}