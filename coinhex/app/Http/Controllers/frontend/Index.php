<?php

namespace App\Http\Controllers\frontend;
use App\Glib\GoogleAuthenticator;
use Auth;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Form;

use Mail;
use Hash;
use Session;

class Index extends Controller
{
    public function __construct()
    {
		set_front_language();
	}
	
    function save_newsletter(Request $request)
    {
    	if($request->input('email') != "")
    	{
    		$email = $request->input('email');
    		$created_date = date('Y-m-d');
    		$updated_date = date('Y-m-d');

            $chk = DB::table('subscribers')
                 ->where('email','=',$email)
                 ->first();

            if(!empty($chk)){

                echo "EXIST";
                
            } else {

    		    $insert = DB::table('subscribers')
    				->insert(['email'=>$email,'created_date'=>$created_date,'updated_date'=>$updated_date]);

        		if($insert){
        			echo "OK";
        		}
            }

    	}
    }
	
	
	
	function update_logo(Request $request){
		$author_id = get_current_front_user_id();
		$return_upload_id = 0;
		$msg = 'Your profile picture not updated, Please try again !';
		
		$validator = Validator::make($request->all(), [
            'logo' => 'required|mimes:jpeg,png,jpg',
        ]);
		
		if ($validator->fails()) {
			$msg = 'Your profile picture not updated, Required extension jpeg, png, jpg';
			return back()->with('error', $msg);
		}
		if($request->hasFile('logo'))
        {
            $image = $request->file('logo');
            $upload_id = do_upload($image,'users',$author_id);
            if($upload_id > 0)
            {
                $return_upload_id = $upload_id;
				$update = DB::table('users')->where('ID', $author_id)->update(['logo_id' => $upload_id]);
				$msg = 'Your profile picture has been updated !';
            }

        }
		
		if($return_upload_id > 0){
		return back()->with('message', $msg);
		}else{
		return back()->with('error', $msg);
		}
	}
	
	function signup(Request $request)
	{
		$this->validate($request,[
		
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6',
			'password_confirmation' => 'required_with:password|same:password|min:6',
			'term' => 'required'
        ],[
            'first_name.required' => 'Please enter your first name !',
            'last_name.required' => 'Please enter your last name !',
            'email.required' => 'Please enter your email !',
            'email.unique' => 'This email already exist, please try with another !',
            'email.email' => 'Please enter valid email !',
            'password.required' => 'Please enter password !',
            'password.confirmed' => 'Please confirm password !',
            'password_confirmation.required_with' => 'Please confirm password !',
            'password_confirmation.same' => 'Please confirm password !',
            'term.required' => 'Please agree terms and policies !'
        ]);
		
		$ga = new GoogleAuthenticator();
		$secret = $ga->createSecret();

		 $first_name = trim($request->input('first_name'));
		 $last_name = trim($request->input('last_name'));
		 $email = trim($request->input('email'));
		 $wallet = trim($request->input('wallet'));
		 $password = trim($request->input('password'));
		 //$second_auth = trim($request->input('second_auth'));
		 $subscription = trim($request->input('subscription'));
		 $google_auth_code = $secret;
		 
		 $name = $first_name.' '.$last_name;
		 $referral_code = trim($request->input('referral_code'));
		 
		 $user_token = strtoupper(uniqid('HIL',true));
		 $my_referral_code = strtoupper(uniqid('HIL',false));
		 
		 $password = Hash::make($password);
		 $status = 1;
		 $is_activated = '1';
		
		$insert_data = array('email'=>$email,
				'role_id'=>'2',
				'password'=>$password,
				'full_name'=>$name,
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'status'=>$status,				
				'user_token'=>$user_token,
				'referral_code'=>$my_referral_code,
				'is_activated'=>$is_activated,
				'wallet_address'=>$wallet,
				'google_auth_code'=>$google_auth_code
				);
				
		$user_id = DB::table('users')->insertGetId($insert_data);
			
		if($user_id > 0){
						
			// opt in for subscription
			if(!empty($subscription) && $subscription==1){
				/********/
				 
				$subscriber = DB::table('subscribers')->where('email',$email)->first();
				if(isset($subscriber) && !empty($subscriber)){
					
				}else{
					$sql_qry = DB::table('subscribers')->insert(['email'=>$email]);
				}
				
				/********/
			}
			
			// referral
			 if(!empty($referral_code)){
				 $users = DB::table('users')->where(array('referral_code' => trim($referral_code)))->first();
				 if(!empty($users)){
					 $parent_id = $users->ID;
					 $child_id = $user_id;
					 
					 $ref_insertion['parent_user_id'] = $parent_id;
					 $ref_insertion['child_user_id'] = $child_id;
					 $ref_insertion['status'] = '1';
					 
					 $ref_insertion_id = DB::table('referral')->insertGetId($ref_insertion);
				 }
			 }
			 
			return Redirect::route('login')->with('message', 'Thank you! Your singup process is almost done.');

			//return back()->with('signup_success', 'Thank you! Your singup process is almost done.');
		}
	}
	
	function login(Request $request){
		$this->validate($request,[
            'email' => 'required',
			'password' => 'required'
        ],[
            'email.required' => 'Please enter email !',
            'password.required' => 'Please enter password !',
        ]);
		
		$auth = false;
		$email = trim($request->input('email'));
		$password = trim($request->input('password'));
		$users = DB::table('users')->where(array('email' => trim($email)))->first();
		if(!empty($users) && Hash::check($password, $users->password)) {
		  if($users->status==1){
			  if($users->is_activated==1){
				$auth=true;
			  }else{
				$user_token = strtoupper(uniqid('HIL',true));
				DB::table('users')->where('ID', $users->ID)->update(['user_token' => $user_token]);
				
			  return Redirect::route('login')->with('message', 'Your email is not verified ! Please verify your 
			   account email, we have just sent varification mail again.');   
			  }
		  }else{
			 return Redirect::route('login')->with('message', 'Your account is inactive ! Please contact 
			  customer support.'); 
		  }
        }else{
			return Redirect::route('login')->with('message', 'Invalid credential !'); 
		}
			  
              
		if($auth==true){
          if (isset($users)) {
				if($users->is_second_auth==1){
					Session::put('otp_user', $users->ID);
					DB::table('otp')->where('user_id', $users->ID)->update(['status' => '0']);
					$generated_otp = rand(100000,999999);
					$ga = new GoogleAuthenticator();
					$secret = $ga->createSecret();
					$generated_otp = $secret;
					$otp_data['otp'] = $generated_otp;
					$otp_data['status'] = '1';
					$otp_data['user_id'] = $users->ID;
					$otp_data['duration'] = '180';
					$otp_id = DB::table('otp')->insertGetId($otp_data);
					
					$extended_auth = $users->google_auth_code.$generated_otp;
					
					$qrCodeUrl = $ga->getQRCodeGoogleUrl($users->email, $generated_otp,'HIL | Crypto Exchange Platform');
					
					if($otp_id > 0){
												
					Session::put('qrCodeUrl', $qrCodeUrl);
					//return Redirect::route('login',['otp' => 'yes'])->with('otp_message','QR code generated ');
					return Redirect::route('login',['otp' => 'yes']);
					}else{
					return Redirect::route('login',['otp' => 'yes'])->with('otp_error','Sorry ! QR code not generated !');
					}
				}
                if(what_my_role($users->ID)=='admin'){
					 Session::put('username', $users->email);
					 Session::put('userid', $users->ID);
					 Session::put('is_admin_logged_in', 'yes');
                    return Redirect::route('admin-dashboard')->with('message', 'Welcome to Admin Dashboard !');
                }else if(what_my_role($users->ID)=='user'){
					 Session::put('frontend_username', $users->email);
					 Session::put('frontend_userid', $users->ID);
					 Session::put('is_frontend_user_logged_in', 'yes');
                    return Redirect::route('dashboard')->with('message', 'Welcome to dashboard !');
                }else if(what_my_role($users->ID)=='partner'){
					 Session::put('frontend_username', $users->email);
					 Session::put('frontend_userid', $users->ID);
					 Session::put('is_frontend_user_logged_in', 'yes');
                    return Redirect::route('dashboard')->with('message', 'Welcome to dashboard !');
                }
          }
        }
	}
	function resendotp(Request $request){
		$otp_user = Session::get('otp_user');
		if($otp_user > 0){
			$users = DB::table('users')->where(array('ID' => trim($otp_user)))->first();
			
			DB::table('otp')->where('user_id', $otp_user)->update(['status' => '0']);
			$generated_otp = rand(100000,999999);
			$ga = new GoogleAuthenticator();
			$secret = $ga->createSecret();
			$generated_otp = $secret;
			$otp_data['otp'] = $generated_otp;
			$otp_data['status'] = '1';
			$otp_data['user_id'] = $users->ID;
			$otp_data['duration'] = '180';
			$otp_id = DB::table('otp')->insertGetId($otp_data);
			if($otp_id > 0){
				
			$extended_auth = $users->google_auth_code.$generated_otp;
			//$ga = new GoogleAuthenticator();
			$qrCodeUrl = $ga->getQRCodeGoogleUrl($users->email, $generated_otp,'Peer 2 Peer Global Network');
			Session::put('qrCodeUrl', $qrCodeUrl);
			//return Redirect::route('login',['otp' => 'yes'])->with('otp_message','OTP sent to your registered email, Please check inbox and put that below box !');
			return Redirect::route('login',['otp' => 'yes']);
			}else{
			return Redirect::route('login',['otp' => 'yes'])->with('otp_error','Sorry ! QR code not generated !');
			}
		}
	}
	
	function submit_otp(Request $request){
		$this->validate($request,[
            'otp_value' => 'required',
        ],[
            'otp_value.required' => 'OTP is required !',
        ]);
		
		$otp_value = $request->input('otp_value');
		$otp_user = Session::get('otp_user');
		if($otp_user > 0){
		$user_detail = DB::table('users')->where(array('ID' => trim($otp_user)))->first();
		$otp_user = DB::table('otp')->where(array('user_id' => trim($otp_user),'status'=>'1'))->first();
		$extended_auth = $user_detail->google_auth_code.$otp_user->otp;
		$ga = new GoogleAuthenticator();
		$checkResult = $ga->verifyCode($otp_user->otp, $otp_value, 2);
		if ($checkResult)
		{
			Session::put('frontend_username', $user_detail->email);
			Session::put('frontend_userid', $user_detail->ID);
			Session::put('is_frontend_user_logged_in', 'yes');
			Session::forget('otp_user');
			return Redirect::route('dashboard')->with('message', 'Welcome to dashboard !');
		}else{
			return Redirect::route('login',['otp' => 'yes'])->with('otp_error','Authentication Failed !');
		}
		}else{
			return Redirect::route('login')->with('msg','Session Expired, Please login again !');
		}
		
	}
	
	
	function verifyemail(Request $request){
		$msg_type = 0;
		if(isset($request->token) && !empty($request->token) ){
			$token = trim($request->token);
			$users = DB::table('users')->where(array('user_token' => trim($token)))->first();
			if(!empty($users)){
				if($users->is_activated == 0){
					DB::table('users')->where('ID', $users->ID)->update(['user_token' => 'activated','is_activated' => '1']);
					if(empty($users->password)){
					$msg_type = 6; // varified and need to set password	
					
					$reset_password_token = strtoupper(uniqid('HIL',true));
					DB::table('users')->where('ID', $users->ID)->update(['reset_password_token' => $reset_password_token]);
					
					$mail_content = get_email_template_body('recovery-password-highbank');
					$mail_subject = get_email_template_subject('recovery-password-highbank');
					$data = array('name'=>$users->first_name,'email'=>$users->email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$reset_password_token);
					
					//$data = array('name'=>$users->full_name,'email'=>$users->email,'token'=>$reset_password_token);
					$res = Mail::send('mail.temp-recovery', $data, function ($message) use ($data) {
						//
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					});
					
					}else{
					$msg_type = 1; // verified
					}
				}else{
					if($request->rq=='cr' && !empty($users->email_change_request)){
					$new_email = $users->email_change_request;
					$old_email = $users->email;
					DB::table('users')->where('ID', $users->ID)->update(['user_token' => 'activated','is_activated' => '1','email'=>$new_email,'email_change_request'=>'']);
					$msg_type = 5; // email change request
					}else{
					$msg_type = 2; // already varified
					}
				}
			}else{
				$msg_type = 3; // token not found
			}
		}else{
			$msg_type = 4; // not a valid url
		}
		return view('frontend.verify',['msg_type'=>$msg_type]);
		
	}
	
	function sendrecovery(Request $request){
		$msg_type = 0;
		$this->validate($request,[
            'email' => 'required|email',
        ],[
            'email.required' => 'Please enter email !',
            'email.email' => 'Please enter valid !',
        ]);
		
		$email = $request->input('email');
		
			$token = trim($request->token);
			$users = DB::table('users')->where(array('email' => trim($email)))->first();
			if(!empty($users)){
				if($users->is_activated == 1){
					$reset_password_token = strtoupper(uniqid('HIL',true));
					DB::table('users')->where('ID', $users->ID)->update(['reset_password_token' => $reset_password_token]);
					
					$data = array('name'=>$users->full_name,'email'=>$users->email,'token'=>$reset_password_token);
					
					$mail_content = get_email_template_body('recovery-password-highbank');
					$mail_subject = get_email_template_subject('recovery-password-highbank');
					$data = array('name'=>$users->first_name,'email'=>$users->email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$reset_password_token);
					
					$res = Mail::send('mail.temp-recovery', $data, function ($message) use ($data) {
						//
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					});
		
					$msg_type = 1; // sent reset mail
				}else{
					$user_token = strtoupper(uniqid('HIL',true));
					DB::table('users')->where('ID', $users->ID)->update(['user_token' => $user_token]);

					//$data = array('name'=>$users->full_name,'email'=>$users->email,'token'=>$user_token);
					
					$mail_content = get_email_template_body('email-verification');
					$mail_subject = get_email_template_subject('email-verification');
					$data = array('name'=>$users->first_name,'email'=>$users->email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$user_token);
					
					$res = Mail::send('mail.temp-verification', $data, function ($message) use ($data) {
						//
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					});
					$msg_type = 2; // user not activated
				}
			}else{
				$msg_type = 3; // user not exist
			}
		
		return view('frontend.recovery',['msg_type'=>$msg_type]);
		
	}
	
	function resetpassword(Request $request){
		$msg_type = 0;
		if(isset($request->token) && !empty($request->token) ){
			$token = trim($request->token);
			$users = DB::table('users')->where(array('reset_password_token' => trim($token)))->first();
			if(!empty($users)){
				if($users->status == 1){
					//DB::table('users')->where('ID', $users->ID)->update(['reset_password_token' => 'reset']);
					$msg_type = 1; // reset ok
				}else{
					$msg_type = 2; // user is inactive
				}
			}else{
				$msg_type = 3; // token not found
			}
		}else{
			$msg_type = 4; // not a valid url
		}
		return view('frontend.resetpassword',['msg_type'=>$msg_type]);
	}
	
	function save_resetpassword(Request $request){
		$this->validate($request,[
			'password' => 'required|confirmed|min:6',
        ],[
            'password.required' => 'Please enter password !',
            'password.confirmed' => 'Please confirm password !',
        ]);
		$reset_password_token = trim($request->input('reset_password_token'));
		$password = trim($request->input('password'));
		$users = DB::table('users')->where(array('reset_password_token' => trim($reset_password_token)))->first();
			if(!empty($users)){
				if($users->status == 1 || $users->status== 0){
					$password = Hash::make($password);
					DB::table('users')->where('ID', $users->ID)->update(['reset_password_token' => 'reset','password'=>$password]);
					return Redirect::route('login')->with('otp_message','Password updated successfully! Please login with updated password.');
					$msg_type = 5; // reset ok/ password updated
				}else{
					$msg_type = 6; // user is inactive
				}
			}else{
				$msg_type = 7; // user not found
			}
		return view('frontend.resetpassword',['msg_type'=>$msg_type]);
	}
	
	function account(Request $request){
		$front_user_id = get_current_front_user_id();
		$account_detail = '';
		if($front_user_id > 0){
			$account_detail = DB::table('users')->where('ID', $front_user_id)->first();
		}
		return view('frontend.account',['account_detail'=>$account_detail]);
	}
	function partner_account(Request $request){
		$front_user_id = get_current_front_user_id();
		$account_detail = '';
		if($front_user_id > 0){
			$account_detail = DB::table('users')->where('ID', $front_user_id)->first();
		}
		return view('frontend.partner-account',['account_detail'=>$account_detail]);
	}
	function partner_save_account(Request $request){
		$front_user_id = get_current_front_user_id();
		
		$full_name = trim($request->input('company_name'));
        //$sur_name = trim($request->input('sur_name'));
        $mobile_number = trim($request->input('contact_number'));
        $address = trim($request->input('address'));
        $representative_name = trim($request->input('representative_name'));
        $token_address = trim($request->input('token_address'));
        //$second_auth = trim($request->input('second_auth'));
        $etc_percentage = trim($request->input('etc_percentage'));
        $high_percentage = trim($request->input('high_percentage'));
		
		$this->validate($request,[
            'company_name' => 'required',
			'contact_number'=>'numeric',
			'etc_percentage'=>'numeric',
			'high_percentage'=>'numeric',
			'token_address'=>'alpha_dash'
            ],[
            'company_name.required' => 'Please enter company name !',
            'contact_number.numeric' => 'Please enter proper contact number !',
            'etc_percentage.numeric' => 'Please enter proper ETC percentage !',
            'high_percentage.numeric' => 'Please enter proper HIL percentage !',
            'token_address.alpha_dash' => 'Please enter proper token address !'
        ]);
		
		
		
		
		if( ((float)$etc_percentage + (float)$high_percentage) != 100){
			return back()->with('error','Total Percentage of ETC and HIL token should 100!');
		}
		
		$update_arr['full_name'] = $full_name;
		//$update_arr['last_name'] = $sur_name;
		$update_arr['phone_no'] = $mobile_number;
		$update_arr['user_address'] = $address;
		$update_arr['representative_name'] = $representative_name;
		$update_arr['wallet_address'] = $token_address;
		$update_arr['etc_percentage'] = $etc_percentage;
		$update_arr['high_percentage'] = $high_percentage;
		if(!empty($second_auth) &&  $second_auth==1){
			$update_arr['is_second_auth'] = '1';
		}else{
			$update_arr['is_second_auth'] = '0';
		}
		
		$update = DB::table('users')
                  ->where('ID','=',$front_user_id)
                  ->update($update_arr);

        if($update == 1)
        {
            return back()->with('message','Account information updated successfully !');
        }
        else
        {
            return back()->with('error','Account information are same, nothing updated !');
        }
	}
	function save_account(Request $request){
		
		$front_user_id = get_current_front_user_id();
		
		//$full_name = trim($request->input('full_name'));
		$first_name = trim($request->input('first_name'));
		$last_name = trim($request->input('last_name'));
        //$sur_name = trim($request->input('sur_name'));
        $mobile_number = trim($request->input('mobile_number'));
        $date_of_birth = trim($request->input('date_of_birth'));
        $nationality = trim($request->input('Nationality'));
        $token_address = trim($request->input('token_address'));
        $second_auth = trim($request->input('second_auth'));
		
		if($token_address !=""){
			
			$this->validate($request,[
				'first_name' => 'required',
				'last_name' => 'required',
				'token_address'=>'alpha_dash'
				],[
				'first_name.required' => 'Please enter first name !',
				'last_name.required' => 'Please enter last name !',
				'token_address.alpha_dash' => 'Please enter proper token address !'
			]);
		}else{
			
			$this->validate($request,[
				'first_name' => 'required',
				'last_name' => 'required'
				],[
				'first_name.required' => 'Please enter first name !',
				'last_name.required' => 'Please enter last name !'
			]);
		}
		if($mobile_number !=""){
			
			$this->validate($request,[
				'first_name' => 'required',
				'last_name' => 'required',
				'mobile_number' => 'digits_between:8,13'
				],[
				'first_name.required' => 'Please enter first name !',
				'last_name.required' => 'Please enter last name !',
				'mobile_number.digits_between' => 'Mobile number should be 8-13 digits!'
			]);
		}else{
			
			$this->validate($request,[
				'first_name' => 'required',
				'last_name' => 'required'
				],[
				'first_name.required' => 'Please enter first name !',
				'last_name.required' => 'Please enter last name !'
			]);
		}
		
		
		$full_name = $first_name.' '.$last_name;
		$update_arr['full_name'] = $full_name;
		$update_arr['first_name'] = $first_name;
		$update_arr['last_name'] = $last_name;
		//$update_arr['last_name'] = $sur_name;
		$update_arr['phone_no'] = $mobile_number;
		$update_arr['date_of_birth'] = $date_of_birth;
		$update_arr['country'] = $nationality;
		$update_arr['wallet_address'] = $token_address;
		if(!empty($second_auth) &&  $second_auth==1){
			$update_arr['is_second_auth'] = '1';
		}else{
			$update_arr['is_second_auth'] = '0';
		}
		
		$update = DB::table('users')
                  ->where('ID','=',$front_user_id)
                  ->update($update_arr);

        if($update == 1)
        {
            return back()->with('message','Account information updated successfully !');
        }
        else
        {
            return back()->with('error','Account information are same, nothing updated !');
        }
	}
	
	function resend_email(Request $request){
		
		$front_user_id = get_current_front_user_id();
		$user_token = strtoupper(uniqid('HIL',true));
		
		$update_arr['user_token'] = $user_token;
		$update_arr['is_activated'] = 0;
		
		$update = DB::table('users')
                  ->where('ID','=',$front_user_id)
                  ->update($update_arr);
				  
		$users = DB::table('users')->where(array('ID' => $front_user_id))->first();
		
		$mail_content = get_email_template_body('email-verification');
		$mail_subject = get_email_template_subject('email-verification');
		$data = array('name'=>$users->first_name,'email'=>$users->email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$user_token);
		
		$res = Mail::send('mail.temp-verification', $data, function ($message) use ($data) {
			
			
			$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
		});
		
		
		return back()->with('message','Verification mail sent again !');
	}
	
	function referrals(Request $request){
		$front_user_id = get_current_front_user_id();
		$referral = DB::table('referral as r')
					->where('r.parent_user_id','=',$front_user_id)
					->join('users as u','u.ID','=','r.child_user_id')
					->select('u.ID','u.created_date','u.email')
					->orderBy('r.created_date','DESC')
					->paginate(3);
		$referral_all = DB::table('referral as r')
					->where('r.parent_user_id','=',$front_user_id)
					->join('users as u','u.ID','=','r.child_user_id')
					->select('u.ID','u.created_date','u.email')
					->orderBy('r.created_date','DESC')
					->get();
		return view('frontend.referrals',['referrals'=>$referral,'referral_all'=>$referral_all]);
	}
	function partner_referrals(Request $request){
		$front_user_id = get_current_front_user_id();
		$referral = DB::table('referral as r')
					->where('r.parent_user_id','=',$front_user_id)
					->join('users as u','u.ID','=','r.child_user_id')
					->select('u.ID','u.created_date','u.email')
					->orderBy('r.created_date','DESC')
					->paginate(3);
		$referral_all = DB::table('referral as r')
					->where('r.parent_user_id','=',$front_user_id)
					->join('users as u','u.ID','=','r.child_user_id')
					->select('u.ID','u.created_date','u.email')
					->orderBy('r.created_date','DESC')
					->get();
		return view('frontend.partner-referrals',['referrals'=>$referral,'referral_all'=>$referral_all]);
	}
	function kyc_applicatyion(Request $request){
		$front_user_id = get_current_front_user_id();
		if(is_kyc_varified()){
		return redirect()->route('kyc');
		}
		if(is_kyc_processing()){
		return redirect()->route('kyc');	
		}
		$udetail = get_user_detail_by_id($front_user_id);
		//$kyc = DB::table('kyc')->where(array('user_id' => $front_user_id,'latest_one' => '1'))->where('status','!=','2')->first();
		$kyc = DB::table('kyc')->where(array('user_id' => $front_user_id,'latest_one' => '1'))->first();
		return view('frontend.kyc-application',['kyc'=>$kyc,'udetail'=>$udetail]);
	}
	
	function save_kyc(Request $request){
		
		$document_id_passport = trim($request->input('document_id_passport'));
		$document_id_national_card_2 = trim($request->input('document_id_national-card_2'));
		$document_id_national_card_1 = trim($request->input('document_id_national-card_1'));
		$document_id_driver_licence = trim($request->input('document_id_driver-licence'));
		$document_type = trim($request->input('document_type'));

		$validate_rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|digits_between:8,13',
            'date_of_birth' => 'required',
            'Nationality' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'document_type' => 'required',
            'email_address' => 'required|email',
			'aggrement' => 'required'
            );
		$validate_msg = array(
            'first_name.required' => 'Please enter first name !',
            'last_name.required' => 'Please enter last name !',
            'phone_number.required' => 'Please enter phone number !',
			'phone_number.digits_between' => 'Phone number should be 8-13 digits!',
            'date_of_birth.required' => 'Please enter date of birth !',
            'Nationality.required' => 'Please choose nationality !',
            'address_line_1.required' => 'Please enter address !',
            'city.required' => 'Please enter city of residence !',
            'zip.required' => 'Please enter zip code !',
            'document_type.required' => 'Please choose document type !',
            'email_address.required' => 'Please enter email !',
            'email_address.email' => 'Please enter valid email !',
            'aggrement.required' => 'Please check aggrement !',
        );
		if($document_type=='passport'){
			$validate_rule['document_id_passport'] = 'required|integer|min:1';
			$validate_msg['document_id_passport.required'] = 'Please upload passport copy !';
			$validate_msg['document_id_passport.integer'] = 'Please upload passport copy !';
			$validate_msg['document_id_passport.min'] = 'Please upload passport copy !';
		}
		if($document_type=='driver-licence'){
			$validate_rule['document_id_driver-licence'] = 'required|integer|min:1';
			$validate_msg['document_id_driver-licence.required'] = 'Please upload driving licence copy !';
			$validate_msg['document_id_driver-licence.integer'] = 'Please upload driving licence copy !';
			$validate_msg['document_id_driver-licence.min'] = 'Please upload driving licence copy !';
		}
		if($document_type=='national-card'){
			$validate_rule['document_id_national-card_1'] = 'required|integer|min:1';
			$validate_rule['document_id_national-card_2'] = 'required|integer|min:1';
			
			$validate_msg['document_id_national-card_1.required'] = 'Please upload national id front side copy !';
			$validate_msg['document_id_national-card_1.integer'] = 'Please upload national id front side copy !';
			$validate_msg['document_id_national-card_1.min'] = 'Please upload national id front side copy !';
			
			$validate_msg['document_id_national-card_2.required'] = 'Please upload national id back side copy !';
			$validate_msg['document_id_national-card_2.integer'] = 'Please upload national id back side copy !';
			$validate_msg['document_id_national-card_2.min'] = 'Please upload national id back side copy !';
		}
		$this->validate($request,$validate_rule,$validate_msg);
		
		$front_user_id = get_current_front_user_id();
		
		$first_name = trim($request->input('first_name'));
		$last_name = trim($request->input('last_name'));
		$email_address = trim($request->input('email_address'));
		$phone_number = trim($request->input('phone_number'));
		$date_of_birth = trim($request->input('date_of_birth'));
		$nationality = trim($request->input('Nationality'));
		$address_line_1 = trim($request->input('address_line_1'));
		$address_line_2 = trim($request->input('address_line_2'));
		$city = trim($request->input('city'));
		$zip = trim($request->input('zip'));
		$telegram_uname = trim($request->input('telegram_uname'));
		$kyc_id = trim($request->input('kyc_id'));
		$document_type = trim($request->input('document_type'));
		
		$document_id_passport = trim($request->input('document_id_passport'));
		$document_id_driver_licence = trim($request->input('document_id_driver-licence'));
		$document_id_national_card_1 = trim($request->input('document_id_national-card_1'));
		$document_id_national_card_2 = trim($request->input('document_id_national-card_2'));
		
		$data['first_name'] = $first_name;
		$data['last_name'] = $last_name;
		$data['email'] = $email_address;
		$data['phone_number'] = $phone_number;
		$data['date_of_birth'] = $date_of_birth;
		$data['nationality'] = $nationality;
		$data['address1'] = $address_line_1;
		$data['address2'] = $address_line_2;
		$data['city'] = $city;
		$data['zipcode'] = $zip;
		$data['telegram_username'] = $telegram_uname;
		$data['document_type'] = $document_type;
		if($document_type=='passport'){
			if($document_id_passport > 0){
				$data['document_upload_id'] = $document_id_passport;
			}
		}
		if($document_type=='driver-licence'){
			if($document_id_driver_licence > 0){
				$data['document_upload_id'] = $document_id_driver_licence;
			}
		}
		if($document_type=='national-card'){
			if($document_id_national_card_1 > 0){
				$data['document_upload_id'] = $document_id_national_card_1;
			}
			if($document_id_national_card_2 > 0){
				$data['document_upload_id_2'] = $document_id_national_card_2;
			}
		}
		
		if($kyc_id > 0){
			// update
			$update = DB::table('kyc')->where('ID','=',$kyc_id)->update($data);
			return back()->with('message','AML/KYC resubmitted successfully !');
		}else{
			// insert
			DB::table('kyc')->where('user_id', $front_user_id)->update(['latest_one' => '0']);
			$data['user_id'] = $front_user_id;
			$data['latest_one'] = '1';
			$kyc_id = DB::table('kyc')->insertGetId($data);
			return back()->with('message','AML/KYC submitted successfully !');
		}
		
	}
	
	function kyc_status(Request $request){
		return view('frontend.kyc-status');
	}
	function submit_contribution(Request $request){
		$this->validate($request,[
            'email_address' => 'required|email',
            'currency' => 'required',
			'transfer_proof' => 'required|unique:contribution,transfer_proof',
            'contribution_amount' => 'required|numeric|min:0.0000001',
			'aggrement' => 'required'
            ],[
				'email_address.required' => 'Please enter email!',
				'email_address.email' => 'Please enter a valid email address!',
				'currency.required' => 'Please enter currency !',
				'transfer_proof.required' => 'Please submit a valid transfer proof !',
				'transfer_proof.unique' => 'The entered TxHash is already submitted, please check and enter again. Thank You!',
				'contribution_amount.required' => 'Please enter contribution amount !',
				'aggrement.required' => 'Please check the box!'
			]
		);
		
		$front_user_id = get_current_front_user_id();
		$email_address = trim($request->input('email_address'));
		$currency = trim($request->input('currency'));
		$contribution_amount = trim($request->input('contribution_amount'));
		$transfer_proof = trim($request->input('transfer_proof'));
		
		$base_amount = '0';
		
		if($currency=='eth'){
			
			$price_table_ETH = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD");
			$price_table_json_ETH = json_decode($price_table_ETH, true);
		
			if(!empty($price_table_json_ETH)){
				$base_amount = ($price_table_json_ETH['USD']*$contribution_amount)/get_settings('token_value');
			}else{
				$base_amount = $contribution_amount;
			}
		}
		
		if($currency=='btc'){
			
			
			$price_table_BTC = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD");
			$price_table_json_BTC = json_decode($price_table_BTC, true);
			if(!empty($price_table_json_BTC)){
				$base_amount = ($price_table_json_BTC['USD']*$contribution_amount)/get_settings('token_value');
			}else{
				$base_amount = $contribution_amount;
			}
		}
		
		if($currency=='usdt'){
			
			$price_table_USDT = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=USDT&tsyms=USD");
			$price_table_json_USDT = json_decode($price_table_USDT, true);
			if(!empty($price_table_json_USDT)){
				$base_amount = ($price_table_json_USDT['USD']*$contribution_amount)/get_settings('token_value');
			}else{
				$base_amount = $contribution_amount;
			}
		}
		
		if($currency=='bnb'){
			
			
			$price_table_BNB = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=BNB&tsyms=USD");
			$price_table_json_BNB = json_decode($price_table_BNB, true);
			if(!empty($price_table_json_BNB)){
				$base_amount = ($price_table_json_BNB['USD']*$contribution_amount)/get_settings('token_value');
			}else{
				$base_amount = $contribution_amount;
			}
		}
		
		if($currency=='ada'){
			
			$price_table_ADA = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=ADA&tsyms=USD");
			$price_table_json_ADA = json_decode($price_table_ADA, true);
			if(!empty($price_table_json_ADA)){
				$base_amount = ($price_table_json_ADA['USD']*$contribution_amount)/get_settings('token_value');
			}else{
				$base_amount = $contribution_amount;
			}
		}
		
		if($currency=='sol'){			

			$price_table_SOL = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=SOL&tsyms=USD");
			$price_table_json_SOL = json_decode($price_table_SOL, true);

			if(!empty($price_table_json_SOL)){
				$base_amount = ($price_table_json_SOL['USD']*$contribution_amount)/get_settings('token_value');
			}else{
				$base_amount = $contribution_amount;
			}
		}
		
		
		$bonus_percentage = get_settings('bonus_percentage');
		
		$bonus_amount = 0;

        if($bonus_percentage > 0){
            $bonus_amount = (float)($base_amount*($bonus_percentage/100));
        }
		
		$data['email'] = $email_address;
		$data['currency'] = $currency;
		$data['amount'] = $contribution_amount;
		$data['transfer_proof'] = $transfer_proof;
		$data['base_currency'] = 'HIL';
		$data['base_amount'] = $base_amount;
		$data['bonus_percentage'] = $bonus_percentage;
		$data['bonus_amount'] = $bonus_amount;
		$data['submitted_by'] = $front_user_id;
		$data['status'] = '0';
		$con_id = DB::table('contribution')->insertGetId($data);
			
		return back()->with('message','Purchase Information submitted successfully !');
	}
	
	function page(Request $request)
    {
		$base_url = url('/');
		$current_url = $request->url();
		$slug = ltrim(str_replace($base_url,'',$current_url),'/');
		$page = DB::table('cms_pages')->where('slug', $slug)->first();
		if(isset($page)){
			$view_name = 'frontend.page-templates.page-'.$page->ID;
			if(View::exists($view_name))
			{
				return view($view_name,['page'=>$page]);
			}else{
				return view('frontend.page',['page'=>$page]);
			}
		}else{
			return view('404');
		}
	}
	
    function stories(Request $request)
    {
       $query = DB::table('success_stories');
       $query = $query->where('status','1');
       $results = $query->paginate(12);
       return view('frontend.stories',['results'=>$results]);
    }

    function stories_detail(Request $request)
    {
        $slug = $request->slug;
        $story = DB::table('success_stories')->where('status', '1')->where('slug',$slug)->first();
        if(isset($story) && !empty($story) ){
        return view('frontend.stories-detail',['story'=>$story]);
        }else{
            return view('404');
        }
    }

    function activities(Request $request)
    {
         $query = DB::table('activity_plan');
         $query = $query->where('status','1');
         $results = $query->paginate(12);
        return view('frontend.activities',['results'=>$results]);
    }

    function activities_detail(Request $request)
    {
        $slug = $request->slug;
        $activity = DB::table('activity_plan')->where('status', '1')->where('slug',$slug)->first();
        if(isset($activity) && !empty($activity)){
        return view('frontend.activities-detail',['activity'=>$activity]);
        }else{
            return view('404');
        }
    }

	function search(Request $request)
	{

        $search_string = ((isset($_GET['s']) && !empty($_GET['s'])) ? $_GET['s'] : '');
        $results_per_page = 12;
        $current_page = ((isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1);
        $offset = (($current_page > 1) ? ($current_page-1)*$results_per_page : 0);

        $query = "SELECT * FROM (
                    (SELECT e.ID, e.title, e.description, e.start_date as date, 'event' as type, e.status as status, e.slug, e.is_edc_id FROM events as e )
                    UNION
                    (SELECT n.ID, n.title, n.description, n.publish_date as date, 'news' as type, n.status as status, n.slug, n.is_edc_id FROM news as n )
                    UNION
                    (SELECT ss.ID, ss.title, ss.description, ss.publish_date as date, 'success_stories' as type, ss.status as status, ss.slug, ss.is_edc_id FROM success_stories as ss )
                    UNION
                    (SELECT ap.ID, ap.title, ap.description, ap.from_date as date, 'activity_plan' as type, ap.status as status, ap.slug, ap.is_edc_id FROM activity_plan as ap )
                    UNION
                    (SELECT m.ID, concat(m.salutation,' ',m.first_name,' ',m.last_name) as title, m.description, m.created_date as date, 'mentors' as type, m.status as status, concat(lower(m.first_name),'-',lower(m.last_name),'-',m.ID) as slug, 0 as is_edc_id FROM mentors as m )
                    ) results WHERE status=1 AND (title LIKE '%$search_string%' OR description LIKE '%$search_string%') ORDER BY title,'$search_string' ASC";

        $query_page = "SELECT * FROM (
                    (SELECT e.ID, e.title, e.description, e.start_date as date, 'event' as type, e.status as status, e.slug, e.is_edc_id FROM events as e )
                    UNION
                    (SELECT n.ID, n.title, n.description, n.publish_date as date, 'news' as type, n.status as status, n.slug, n.is_edc_id FROM news as n )
                    UNION
                    (SELECT ss.ID, ss.title, ss.description, ss.publish_date as date, 'start_up_stories' as type, ss.status as status, ss.slug, ss.is_edc_id FROM success_stories as ss )
                    UNION
                    (SELECT ap.ID, ap.title, ap.description, ap.from_date as date, 'activity_plan' as type, ap.status as status, ap.slug, ap.is_edc_id FROM activity_plan as ap )
                    UNION
                    (SELECT m.ID, concat(m.salutation,' ',m.first_name,' ',m.last_name) as title, m.description, m.created_date as date, 'mentors' as type, m.status as status, concat(lower(m.first_name),'-',lower(m.last_name),'-',m.ID) as slug, 0 as is_edc_id FROM mentors as m )
                    ) results WHERE status=1 AND (title LIKE '%$search_string%' OR description LIKE '%$search_string%') ORDER BY title,'$search_string' ASC LIMIT $offset,$results_per_page";


		$results = DB::select(DB::raw($query));
        $results_page = DB::select(DB::raw($query_page));
        $options['path'] = 'search';

        $pagination = new Paginator($results, count($results), $results_per_page,$current_page,$options);

        return view('frontend.search',['results'=>$results_page,'pagination'=>$pagination]);
	}

    function news_events(Request $request){

        $results_per_page = 12;
        $current_page = ((isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1);
        $offset = (($current_page > 1) ? ($current_page-1)*$results_per_page : 0);

        $query = "SELECT * FROM (
                        (SELECT e.ID, e.title, e.description, e.start_date as date, 'event' as type, e.status as status, e.slug, e.is_edc_id FROM events as e )
                        UNION
                        (SELECT n.ID, n.title, n.description, n.publish_date as date, 'news' as type, n.status as status, n.slug, n.is_edc_id FROM news as n )
                        ) results WHERE status=1 ORDER BY date DESC";

        $query_page = "SELECT * FROM (
                        (SELECT e.ID, e.title, e.description, e.start_date as date, 'event' as type, e.status as status, e.slug, e.is_edc_id FROM events as e )
                        UNION
                        (SELECT n.ID, n.title, n.description, n.publish_date as date, 'news' as type, n.status as status, n.slug, n.is_edc_id FROM news as n )
                        ) results WHERE status=1 ORDER BY title DESC LIMIT $offset,$results_per_page";

        $results = DB::select(DB::raw($query));
        $results_page = DB::select(DB::raw($query_page));
        $options['path'] = 'news-events';
        $pagination = new Paginator($results, count($results), $results_per_page,$current_page,$options);

        return view('frontend.news-events',['results'=>$results_page,'pagination'=>$pagination]);
    }

    //copy above
    function all_events(Request $request){

        $results_per_page = 12;
        $current_page = ((isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1);
        $offset = (($current_page > 1) ? ($current_page-1)*$results_per_page : 0);

        $query = "SELECT * FROM (
                        (SELECT e.ID, e.title, e.description, e.start_date as date, 'event' as type, e.status as status, e.slug, e.is_edc_id FROM events as e )
                        UNION
                        (SELECT n.ID, n.title, n.description, n.publish_date as date, 'news' as type, n.status as status, n.slug, n.is_edc_id FROM news as n )
                        ) results WHERE status=1 ORDER BY date DESC";

        $query_page = "SELECT * FROM (
                        (SELECT e.ID, e.title, e.description, e.start_date as date, 'event' as type, e.status as status, e.slug, e.is_edc_id FROM events as e )
                        UNION
                        (SELECT n.ID, n.title, n.description, n.publish_date as date, 'news' as type, n.status as status, n.slug, n.is_edc_id FROM news as n )
                        ) results WHERE status=1 ORDER BY title DESC LIMIT $offset,$results_per_page";

        $results = DB::select(DB::raw($query));
        $results_page = DB::select(DB::raw($query_page));
        $options['path'] = 'news-events';
        $pagination = new Paginator($results, count($results), $results_per_page,$current_page,$options);

        return view('frontend.all-events',['results'=>$results_page,'pagination'=>$pagination]);

    }

    function news(Request $request){

        $query = DB::table('news');
        $query = $query->where('status','1');
        $results = $query->paginate(12);

        return view('frontend.news',['results'=>$results]);
    }
    function news_detail(Request $request){
        $slug = $request->slug;
        $news = DB::table('news')->where('status', '1')->where('slug',$slug)->first();
        if(isset($news) && !empty($news)){
        return view('frontend.news-detail',['news'=>$news]);
        }else{
            return view('404');
        }
    }
    function events(Request $request){

         $query = DB::table('events');
         $query = $query->where('status','1');
         $results = $query->paginate(12);
        return view('frontend.events',['results'=>$results]);
    }
    function events_detail(Request $request){
        $slug = $request->slug;
        $event = DB::table('events')->where('status', '1')->where('slug',$slug)->first();
        $event_photo = array();
        if(isset($event)){
        $event_photo = DB::table('event_photo')->where('status', '1')->where('event_id',$event->ID)->get();
        }
        if(isset($event) && !empty($event)){
        return view('frontend.events-detail',['event'=>$event,'event_photo'=>$event_photo]);
        }else{
            return view('404');
        }
    }

	function edc(Request $request){

		$edcs = DB::table('users')->where('status', '1')->where('role_id','2')->get();
		return view('frontend.edc',['edcs'=>$edcs]);
	}

	function each_edc(Request $request){
        $slug = $request->slug;
        $edc = DB::table('users')->where('status', '1')->where('user_slug',$slug)->first();

        if(isset($edc) && !empty($edc)){
                $query_con = DB::table('contact');
                $query_con = $query_con->where(function($query_con) use ($edc) {
                    $query_con->where('author_id', $edc->ID);
                    $query_con->orWhere('is_edc_id',$edc->ID);
                });
                $query_con = $query_con->where('status','1');
                $contacts = $query_con->get();


                $todays_date = date('Y-m-d');

                $query = DB::table('events');
                $query = $query->where(function($query) use ($edc) {
                    $query->where('author_id', $edc->ID);
                    $query->orWhere('is_edc_id',$edc->ID);
                });
                $query = $query->where('status','1');
                
                /*
                $query = $query->where(function($query) use ($todays_date) {
                    $query->where('start_date','>=' ,$todays_date);
                    $query->orWhere('end_date','>=' ,$todays_date);
                });
                */

                $events = $query->orderBy('start_date', 'DESC')->get();


                $success_stories_query = DB::table('success_stories');
                $success_stories_query = $success_stories_query->where(function($success_stories_query) use ($edc) {
                    $success_stories_query->where('author_id', $edc->ID);
                    $success_stories_query->orWhere('is_edc_id',$edc->ID);
                });
                $success_stories_query = $success_stories_query->where('status','1');
                $success_stories = $success_stories_query->get();

                $activity_query = DB::table('activity_plan');
                $activity_query = $activity_query->where(function($activity_query) use ($edc) {
                    $activity_query->where('author_id', $edc->ID);
                    $activity_query->orWhere('is_edc_id',$edc->ID);
                });
                $activity_query = $activity_query->where('status','1');
                $activities = $activity_query->get();

                $allNews = DB::table('news')
                         ->where('status','=','1')
                         ->where('is_edc_id','=',$edc->ID)
                         ->orderBy('publish_date','DESC')
                         ->get();



    		return view('frontend.each-edc',['edc'=>$edc,'contacts'=>$contacts,'events'=>$events,'success_stories'=>$success_stories,'activities'=>$activities,'allNews'=>$allNews]);
        }else{
        return view('404');
        }
	}
	function save_subscriber(Request $request){
        
		/*$validator = Validator::make($request->all(),[
            'youremail' => 'required|email',
        ],[
            'youremail.required' => 'Please enter email-id.',
            'youremail.email' => 'Please enter valid email-id.'
        ]);

        if ($validator->fails()) {
            
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);
        }
		*/
		$email = trim($request->input('youremail'));
		
		if($email !=''){
			//$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  echo json_encode(array ('result' => "error", 'message' => "You have enter an invalid email!") );
			  exit;
			}
		}else{
			
			echo json_encode(array ('result' => "error", 'message' => "Please enter email-id.") );
			exit;
			
		}
		
		$insert_date = date('Y-m-d');
		 
		$subscriber = DB::table('subscribers')->where('email',$email)->first();
		if(isset($subscriber) && !empty($subscriber)){
			$msg_success = __t("Already subscribed with this email !");
			$response = array ('result' => "error", 'message' => $msg_success);
            return response()->json($response);
		}
		

        $sql_qry = DB::table('subscribers')->insert(['email'=>$email]);

		$mail_content = get_email_template_body('ACW-subscription');
		$mail_subject = get_email_template_subject('ACW-subscription');
		$data = array('email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
		
		Mail::send('mail.subscribe', $data, function ($message) use ($data) {
			
			$message->to($data['email'], $data['email'])->subject($data['mail_subject']);
		});

        if($sql_qry > 0){
			$msg_success = __t("<strong>Thank you</strong> for subscribing to our updates.");
			$response = array ('result' => "success", 'message' => $msg_success);
            return response()->json($response);
        }else{
            return response()->json(array ('result' => "error", 'message' => __t("error occure, please try again !") ) );
		}
	}
	
	function add_kyc_document(Request $request){
		$return_upload_id = 0;
		$author_id = Session::get('frontend_userid');
		$return_array['status'] = 'error';
		if($request->hasFile('file'))
        {
            $image = $request->file('file');
            $upload_id = do_upload($image,'kyc',$author_id);
            if($upload_id > 0)
            {
                $return_upload_id = $upload_id;   
				$return_array['status'] = 'success';
            }
            
        }
		
		$return_array['upload_id'] = $return_upload_id;
		$return_array['document_type'] = $request->input('document_type');
		$return_array['document_order'] = $request->input('document_order');
		echo json_encode($return_array);
	}
    function save_contact_us(Request $request){
		
		//print_r($_POST); die;

       /* $validator = Validator::make($request->all(),[
            
            'contact-name' => 'required',
            'contact-email' => 'required|email'
        ],[
        
            'contact-name.required' => 'Please enter your name.',
            'contact-email.required' => 'Please enter email-id.',
            'contact-email.email' => 'Please enter valid email-id.'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $name = trim($request->input('contact-name'));
        $email = trim($request->input('contact-email'));
		*/
		
		$name = trim($request->input('contact-name'));
        $email = trim($request->input('contact-email'));
		//echo $name; die;
		//$name = test_input($_POST["name"]);
		if($name !=''){
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			  echo json_encode(array ('result' => "error", 'message' => "Full name only letters and white space allowed") );
			  exit;
			}
		}else{
			
			echo json_encode(array ('result' => "error", 'message' => "Please enter your name.") );
			exit;
			
		}
		
		if($email !=''){
			//$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  echo json_encode(array ('result' => "error", 'message' => "You have enter an invalid email!") );
			  exit;
			}
		}else{
			
			echo json_encode(array ('result' => "error", 'message' => "Please enter email-id.") );
			exit;
			
		}
		
		
        $msg = trim($request->input('contact-message'));
        //$contact_type = trim($request->input('contact-type'));
        $contact_type = 1;
        $insert_date = date('Y-m-d');

        $sql_qry = DB::table('contact')
                 ->insert(['name'=>$name,'email'=>$email,'special_note'=>$msg,'contact_type'=>$contact_type]);


        //$data = array('name'=>$name,'email'=>$email,'msg'=>$msg,'contact_type'=>$contact_type);
		
		$mail_content = get_email_template_body('highbank-contact-us');
		$mail_subject = get_email_template_subject('highbank-contact-us');
		$data = array('name'=>$name,'email'=>$email,'msg'=>$msg,'contact_type'=>$contact_type,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
		

        Mail::send('mail.temp1', $data, function ($message) use ($data) {
            

            $message->to($data['email'], $data['name'])->subject($data['mail_subject']);
        });
		
		//$contact_email = get_settings('contact_email');
		$contact_email = 'info@ACW.net';
		
		
		if(!empty($contact_email)){
			
			Mail::send('mail.temp-admin', $data, function ($message) use ($contact_email) {
				

				$message->to($contact_email, 'HIL Admin')->subject('HIL - Contact Request');
			});
		}

        if($sql_qry > 0){
			$msg_success = __t("Thank you for your enquiry we will get back to you as soon as possible.");
            //return back()->with('status_msg','Thanks for contact us.');
			$response = array ('result' => "success", 'message' => $msg_success);
            return response()->json($response);
        }else{

        
        //var_dump($ret);
        //die;
        /*
        
        */

        //return false;
            return response()->json(array ('result' => "error", 'message' => __t("error occure, please try again !")));
		}
    }

    function edc_registration(Request $request)
    {
        $role_id = '2';
        $full_name = trim($request->input('nm'));
        $email = trim($request->input('em'));
        $password = Hash::make(trim($request->input('pwd')));
        $edc_slug = is_unique_user_slug(trim(str_slug($full_name)));
        $is_activated = '0';
        $created_date = date('Y-m-d');
        
        if(is_email_id_exist($email) == false){
            $reg = DB::table('users')
                 ->insert(['role_id'=>$role_id,'full_name'=>$full_name,'email'=>$email,'password'=>$password,'user_slug'=>$edc_slug,'is_activated'=>$is_activated,'created_date'=>$created_date]);
            
            if($reg){
                echo "1";
            } else {
                echo "-1";
            }
        
        } else {
            echo "0";
        }
        
    }

    function front_login(Request $request){

        $email = trim($request->input('email'));
        $password = trim($request->input('password'));
        $users = DB::table('users')->where('email','=',$email)->first();
        if(!empty($users) && count($users) > 0){
            $pwd = $users->password;
            $ckPWD = Hash::check($password, $pwd);
            if($ckPWD){
                Session::put('username', $users->email);
                Session::put('userid', $users->ID);
                Session::put('is_admin_logged_in', 'yes');
                echo "1";
            } else {
                echo "-1";
            }
        } else {
            echo "0";
        }
    }
	
	
	function user_contribution(){
		
		
		$front_user_id = get_current_front_user_id();
							
		$data['curr_urt'] = DB::table('contribution')
					->where('submitted_by','=',$front_user_id)
					->orderBy('created_date','DESC')
					->paginate(10);

		return view('frontend.utransaction',$data);
	}
	
	
	function subs_transaction(){
		$author_id = get_current_front_user_id();
		
		$data['sub_tran'] = DB::table('membership_transactions')->where('user_id','=',$author_id)->paginate(10);

		return view('frontend.utransaction_report',$data);
	}
	
	
	
    function change_password(Request $request)
    {
        $this->validate($request,[
            
            'cpwd' => 'required',        
            'npwd' => 'required|min:6|confirmed',
            'npwd_confirmation' => 'required|min:6',
        ],[
        
            'cpwd.required' => 'Please enter current password.',
            'npwd.required'=>'Please enter Password',
            'npwd.min'=>'Password minimum length 6',
            'npwd_confirmation.required'=>'Please enter Confirm Password',
        ]);

        $cpwd = trim($request->input('cpwd'));
        $npwd = Hash::make(trim($request->input('npwd')));
        $npwd_confirmation = trim($request->input('npwd_confirmation'));

		$front_user_id = get_current_front_user_id();

        $sql = DB::table('users')
               ->where('ID','=',$front_user_id)
               ->select('password')->first();

        if(!empty($sql) && Hash::check($cpwd, $sql->password))
        {
            $up = DB::table('users')
                  ->where('ID','=',$front_user_id)
                  ->update(['password'=>$npwd]);

            if($up > 0)
            {
                return back()->with('message','New Password Updated Successfully.');
            }
            else
            {
                return back()->with('error','Password Not Changed.');       
            }
        }
        else
        {
            return back()->with('error','Current Password Not Match.');
        }
    }
	
	
	
}
