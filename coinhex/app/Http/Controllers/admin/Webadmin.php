<?php

namespace App\Http\Controllers\admin;

use App\Document;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Hash;
use Session;
use Form;
use App\Achievements;
use App\SuccessStories;
use App\News;
use App\EmailTemplate;
use App\Whitepaper;
use App\Videos;
use App\Roadmap;
use App\TokenInfo;
use App\Partners;
use App\ICOListing;
use App\AirdropListing;
use App\Centers;
use App\Subscribers;
use App\CmsPages;
use App\Contribution;
use App\Kyc;
use App\Translation;
use App\Language;
use Mail;

class Webadmin extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function __construct()
    {
		set_front_language();
	}
    function login(Request $request){
    	$auth = false;
    	if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['actioned']) && $_POST['actioned']=='admin_login'){
    	$username = trim($request->input('username'));
    	$password = trim($request->input('password'));
    	if(empty($username) || empty($password)){
    		return Redirect::route('admin-login')->with('errmsg', 'Invalid Username Password!');
    	}
    	if(filter_var($username, FILTER_VALIDATE_EMAIL)===false){
    		return Redirect::route('admin-login')->with('errmsg', 'Invalid Username Password!');
    	}else{
    		$users = DB::table('users')->where(array('email' => trim($username), 'status' => '1'))->first();
    	}
    	if(!empty($users) && Hash::check($password, $users->password)) {
          $auth=true;
        }else{
          return Redirect::route('admin-login')->with('errmsg', 'Invalid Username Password!');
        }
        if($auth==true){
          if (isset($users)) {
                
                if(what_my_role($users->ID)=='admin'){
					Session::put('username', $users->email);
					Session::put('userid', $users->ID);
					Session::put('is_admin_logged_in', 'yes');
                    return Redirect::route('admin-dashboard')->with('message', 'Welcome ');
                }else if(what_my_role($users->ID)=='user'){
					Session::put('frontend_username', $users->email);
					Session::put('frontend_userid', $users->ID);
					Session::put('is_frontend_user_logged_in', 'yes');
                    //return Redirect::route('edc-dashboard')->with('message', 'Welcome ');
					return Redirect::route('dashboard')->with('message', 'Welcome to dashboard !');
                }else if(what_my_role($users->ID)=='web_manager'){
					Session::put('username', $users->email);
					Session::put('userid', $users->ID);
					Session::put('is_admin_logged_in', 'yes');
                    return Redirect::route('webman-dashboard')->with('message', 'Welcome ');
                }else if(what_my_role($users->ID) == 'user_admin' || what_my_role($users->ID) == 'view_admin' || what_my_role($users->ID) == 'social_admin'){
						
						$userRole = what_my_role($users->ID);
						
						Session::put('username', $users->email);
						Session::put('userid', $users->ID);
						Session::put('is_admin_logged_in', 'yes');
						Session::put('userRole', $userRole);
						return Redirect::route('admin-dashboard')->with('message', 'Welcome ');
                }
          }
        }
    	}
    	return view('admin.login');
    }

    function dashboard(){
        $recent_activity = DB::table('activity_plan')->where('status','=','1')->orderBy('from_date','asc')->take(5)->get();
        $recent_story = DB::table('success_stories')->where('status','=','1')->orderBy('ID','DESC')->take(5)->get();
        $recent_event = DB::table('events')->where('status','=','1')->orderBy('start_date','ASC')->take(5)->get();
        $top_mentor = DB::table('mentors')->where('status','=','1')->orderBy('ID','DESC')->take(5)->get();
    	return view('admin.dashboard',['recent_activity'=>$recent_activity,'recent_story'=>$recent_story,'recent_event'=>$recent_event,'top_mentor'=>$top_mentor]);
    }

    function add_edc(Request $request){
        
        if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['actioned']) && $_POST['actioned']=='add_user'){

            $logo_id = 0;
            $banner_id = 0;

            $first_name = trim($request->input('first_name'));
            $last_name = trim($request->input('last_name'));
            $full_name = $first_name.' '.$last_name;
            //$surname = trim($request->input('surname'));
            $user_email = trim($request->input('user_email'));
            $user_password = trim($request->input('user_password'));
            $user_phone = trim($request->input('user_phone'));
            $user_dob = trim($request->input('user_dob'));
            $country = trim($request->input('country'));
            $status = trim($request->input('status'));
            $wallet_type = trim($request->input('wallet_type'));
            $wallet_address = trim($request->input('wallet_address'));
			$my_referral_code = strtoupper(uniqid('EVI',false));
			$parent = trim($request->input('parent'));

            //$password = Hash::make($user_password);

            $this->validate($request,[
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'user_email' => "required|email|unique:users,email"
            ],[
            
             'first_name.required' => 'Please enter first name !',
             'last_name.required' => 'Please enter last name !',
             'user_email.required' => 'Please enter user email !',
             'user_email.email' => 'Please enter Valid Email !',
             'user_email.unique' => 'Email Id already Exist, Please Try with another !'
            ]);


            

            if(!is_email_id_exist($user_email)){
            $user_email =  $user_email;  
            }else{
            return Redirect::route('add-edc')->with('errmsg', 'Email ID Exist, Please try another !');
            }

			$user_token = strtoupper(uniqid('EVI',true));
			$my_referral_code = strtoupper(uniqid('EVI',false));
		 
            $user_id = DB::table('users')->insertGetId(
                ['email'=>$user_email,
				'role_id'=>'2',
				'full_name'=>$full_name,
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'user_token'=>$user_token,
				'referral_code'=>$my_referral_code,
				'status'=>$status,
				'phone_no'=>$user_phone,
				'country'=>$country,
				'date_of_birth'=>$user_dob,
				'country'=>$country,
				'referral_code'=>$my_referral_code,
				'is_activated'=>'0',
				'wallet_type'=>$wallet_type,
				'wallet_address'=>$wallet_address]
            );

			/*
            if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_id = do_upload($logo,'users',$user_id);
            }else{
            $logo_id = 0;
            }

            if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_id = do_upload($banner_image,'users',$user_id);
            }else{
            $banner_id = 0;
            }

            if ($request->hasFile('listing_image')) {
            $listing_image = $request->file('listing_image');
            $list_image_id = do_upload($listing_image,'users',$user_id);
            }else{
            $list_image_id = 0;
            }
			

            DB::table('users')->where('ID', $user_id)->update(array('logo_id'=>$logo_id,'banner_id'=>$banner_id,'list_image_id'=>$list_image_id));
			*/
			
				if($user_id > 0 && $parent > 0){
					$user_detail = DB::table('referral')->where('parent_user_id',$parent)->where('child_user_id',$user_id)->first();
					if(isset($user_detail) && !empty($user_detail->ID) && $user_detail->ID > 0){
						
					}else{
						$ref_auto_id = DB::table('referral')->insertGetId(['parent_user_id'=>$parent,'child_user_id'=>$user_id]);
					}
				}
				//$data = array('name'=>$full_name,'email'=>$user_email,'token'=>$user_token);
				
				$mail_content = get_email_template_body('email-verification');
				$mail_subject = get_email_template_subject('email-verification');
				$data = array('name'=>$first_name,'email'=>$user_email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$user_token);
				
				$res = Mail::send('mail.temp-verification', $data, function ($message) use ($data) {
					
					
					$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
				});
				
            return Redirect::route('edit-edc',$user_id)->with('success', 'User created successfully!');
            }
			$users = DB::table('users')->get();
            return view('admin.add-edc',['users'=>$users]);
    }

	function all_translation(){
			$results_per_page = 10;
			$current_page = ((isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1);
			$offset = (($current_page > 1) ? ($current_page-1)*$results_per_page : 0);
		
			$query = DB::table('translation');
			$query1 = DB::table('translation');
			if(isset($_GET['language']) && $_GET['language'] != "" && !empty($_GET['language'])){
				$query = $query->where('language_code',$_GET['language']);
				$query1 = $query1->where('language_code',$_GET['language']);
			}
			if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){
				$query = $query->where('text','like','%'.trim(urldecode($_GET['s'])).'%');
				$query1 = $query1->where('text','like','%'.trim(urldecode($_GET['s'])).'%');
			}
			if(empty($_GET['s']) && empty($_GET['language'])){
				$query = $query->where('language_code','en_GB');
				$query1 = $query1->where('language_code','en_GB');
			}
			$all_translation_data = $query->orderBy('ID','desc')->skip($offset)->take($results_per_page)->get();
			$all_translation = $query1->orderBy('ID','desc')->get();
			
			$options['path'] = 'all-translation';
			
			$pagination = new Paginator($all_translation, count($all_translation), $results_per_page,$current_page,$options);
			
			return view('admin.all-translation',['all_translation'=>$all_translation_data,'pagination'=>$pagination]);
	}
	
    function edit_edc($id){
            $user_detail = DB::table('users')->where('ID',$id)->get();
			$users = DB::table('users')->get();
            return view('admin.edit-edc',array('user_detail'=>$user_detail[0],'users'=>$users));
    }

    function edit_edc_post(Request $request){
            $id = trim($request->input('id'));

            if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['actioned']) && $_POST['actioned']=='edit_user'){
            $logo_id = 0;
            $banner_id = 0;
            $list_image_id = 0;

            $last_name = trim($request->input('last_name'));
            $first_name = trim($request->input('first_name'));
            $full_name = $first_name.' '.$last_name;
            //$surname = trim($request->input('surname'));
            $user_slug = trim($request->input('user_slug'));
            $user_email = trim($request->input('user_email'));
            //$user_password = trim($request->input('user_password'));
            $user_phone = trim($request->input('user_phone'));
            $user_dob = trim($request->input('user_dob'));
            $country = trim($request->input('country'));
            $status = trim($request->input('status'));
            $wallet_type = trim($request->input('wallet_type'));
            $wallet_address = trim($request->input('wallet_address'));
            //$is_second_auth = trim($request->input('is_second_auth'));
            $parent = trim($request->input('parent'));

            $this->validate($request,[
            
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'user_email' => "required|email|unique:users,email,$id",
            ],[
            
             'first_name.required' => 'Please enter first name !',
             'last_name.required' => 'Please enter last name !',
             'user_email.required' => 'Please enter User email !',
             'user_email.email' => 'Please enter Valid Email !',
             'user_email.unique' => "Email Id: $user_email already Exist, Please Try with another !",
             'user_slug.unique' => "Provided slug already Exist, Please Try with another !"
            ]);
			$udetail = get_user_detail_by_id($id);
			if($user_email!=$udetail->email){
				$user_token = strtoupper(uniqid('EVI',true));
				
				//$data = array('name'=>$full_name,'email'=>$user_email,'token'=>$user_token,'old_email'=>$udetail->email,'new_email'=>$user_email);
				
				
				$mail_content = get_email_template_body('email-change-request');
				$mail_subject = get_email_template_subject('email-change-request');
				
				$data = array('name'=>$first_name,'email'=>$user_email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$user_token,'old_email'=>$udetail->email,'new_email'=>$user_email);
				
				$res = Mail::send('mail.temp-verification-change', $data, function ($message) use ($data) {
					
					
					$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
				});
				$update_array['email_change_request'] = $user_email;
				$update_array['user_token'] = $user_token;
			}
            
            $update_array['last_name'] = $last_name;
            $update_array['first_name'] = $first_name;
            $update_array['full_name'] = $full_name;
            //$update_array['last_name'] = $surname;
            $update_array['user_slug'] = $user_slug;
            $update_array['phone_no'] = $user_phone;
            $update_array['date_of_birth'] = $user_dob;
            $update_array['status'] = $status;
            $update_array['country'] = $country;
            $update_array['wallet_type'] = $wallet_type;
            $update_array['wallet_address'] = $wallet_address;
            //$update_array['is_second_auth'] = $is_second_auth;


            /*if(!empty($user_password)){
               $password = Hash::make($user_password);
               $update_array['password'] = $password;
            }*/

            $user_id = $id;
           
            DB::table('users')->where('ID', $user_id)->update($update_array);

			if($parent > 0){
				$user_detail = DB::table('referral')->where('parent_user_id',$parent)->where('child_user_id',$user_id)->first();
				if(isset($user_detail) && !empty($user_detail->ID) && $user_detail->ID > 0){
						
				}else{
					DB::table('referral')->where('child_user_id','=',$user_id)->delete();
					$ref_auto_id = DB::table('referral')->insertGetId(['parent_user_id'=>$parent,'child_user_id'=>$user_id]);
				}
			}else{
				DB::table('referral')->where('child_user_id','=',$user_id)->delete();
			}
			
			/*
            if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_id = do_upload($logo,'users',$user_id);

                DB::table('users')->where('ID', $user_id)->update(array('logo_id'=>$logo_id));
                if($saved_logo_id > 0){
                    un_assign_image_id($saved_logo_id);
                }

            }else{
            $logo_id = 0;
            }

            if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_id = do_upload($banner_image,'users',$user_id);

                DB::table('users')->where('ID', $user_id)->update(array('banner_id'=>$banner_id));
                if($saved_banner_id > 0){
                    un_assign_image_id($saved_banner_id);
                }

            }else{
            $banner_id = 0;
            }

            if($remove_logo=='yes' && $saved_logo_id > 0){
                    DB::table('users')->where('ID', $user_id)->update(array('logo_id'=>'0'));
                    un_assign_image_id($saved_logo_id);
            }

            if($remove_banner=='yes' && $saved_banner_id > 0){
                    DB::table('users')->where('ID', $user_id)->update(array('banner_id'=>'0'));
                    un_assign_image_id($saved_banner_id);
            }

            if($request->hasFile('listing_image')) {
            $listing_image = $request->file('listing_image');
            $list_image_id = do_upload($listing_image,'users',$user_id);
                DB::table('users')->where('ID', $user_id)->update(array('list_image_id'=>$list_image_id));
                if($saved_list_image_id > 0){
                    un_assign_image_id($saved_list_image_id);
                }
            }else{
                $list_image_id = 0;
            }

            if($remove_list_image=='yes' && $saved_list_image_id > 0){
                DB::table('users')->where('ID', $user_id)->update(array('list_image_id'=>'0'));
                un_assign_image_id($saved_list_image_id);
            }
			*/

            }
            return Redirect::route('edit-edc',$id)->with('success','User Successfully Updated !');
    }

    function delete_edc($id){
		$users = DB::table('users')->where(array('ID' => $id))->first();
        $del = DB::table('users')->where('ID','=',$id)->delete();
		
		$mail_content = get_email_template_body('account-deleted');
		$mail_subject = get_email_template_subject('account-deleted');
		
		$data = array('name'=>$users->first_name,'email'=>$users->email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
		
		//$data = array('name'=>$users->full_name,'email'=>$users->email);
		$res = Mail::send('mail.temp-del-notify', $data, function ($message) use ($data) {
			
			$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
		});
        return Redirect::route('all-edcs')->with('success','User Successfully Deleted !');
    }

    function all_edc(Request $request){
            $query = DB::table('users');
            $query = $query->where('role_id','=','2');
            if(isset($_GET['status']) && $_GET['status'] != "" ){
            $status = $_GET['status'];
            $query = $query->where('status',$status);   
            }
           if(isset($_GET['s']) && !empty($_GET['s'])){
            $s = $_GET['s'];
				$query = $query->where(function($query){
					$query->where('full_name','like','%'.urldecode(trim($_GET['s'])).'%');
					$query->orWhere('email','like','%'.urldecode(trim($_GET['s'])).'%');
				});
            }
			if(isset($_GET['sort_by']) && !empty($_GET['sort_by']) && isset($_GET['sort_order']) && !empty($_GET['sort_order'])){
				$field = $_GET['sort_by'];
				$sort_order = $_GET['sort_order'];
				$query->orderBy($field,$sort_order);
			}else{
				$query->orderBy('created_date','desc');
			}
            $users = $query->paginate(10);

            return view('admin.all-edc',array('users'=>$users));
    }
	
	function save_affiliate_partner(Request $request){
		$email = trim($request->input('email'));
		$company_name = trim($request->input('company_name'));
		$contact_number = trim($request->input('contact_number'));
		$representative_name = trim($request->input('representative_name'));
		$address = trim($request->input('address'));
		$is_second_auth = trim($request->input('is_second_auth'));
		$is_activated = trim($request->input('is_activated'));
		$wallet_address = trim($request->input('wallet_address'));
		$etc_percentage = trim($request->input('etc_percentage'));
		$high_percentage = trim($request->input('high_percentage'));
		$high_token_amount = trim($request->input('high_token_amount'));
		$eth_token_amount = trim($request->input('eth_token_amount'));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
		
        $this->validate($request,[
			'company_name'=>'required',
			'representative_name'=>'required|alpha_spaces',
			'address' => 'required',
			'contact_number'=>'required|numeric',
            'email' => "required|email|unique:users,email",
			'etc_percentage'=>'numeric',
			'high_percentage'=>'numeric',
			'high_token_amount'=>'numeric',
			'eth_token_amount'=>'numeric',
			'wallet_address'=>'alpha_dash'
        ],[
			'company_name.required' => 'Please provide company name',
			'representative_name.required' => 'Please provide representative name',
			'contact_number.required' => 'Please provide contact number',
            'email.required' => 'Please provide email !',
            'email.email' => 'Please provide valid email !',
            'email.unique' => 'Email id : '.$email.' already exist !',
			'etc_percentage.numeric' => 'Please enter proper ETC percentage !',
            'high_percentage.numeric' => 'Please enter proper EVI percentage !',
            'eth_token_amount.numeric' => 'Please enter proper token amount !',
            'high_token_amount.numeric' => 'Please enter proper token amount !',
            'wallet_address.alpha_dash' => 'Please enter proper token address !'
        ]);
		$user_token = strtoupper(uniqid('EVI',true));
		$my_referral_code = strtoupper(uniqid('EVI',false));
			
		$insert_array = array();
		$insert_array['email'] = $email;
		$insert_array['role_id'] = '4';
        $insert_array['full_name'] = $company_name;
        $insert_array['phone_no'] = $contact_number;
        $insert_array['status'] = $status;
        $insert_array['representative_name'] = $representative_name;
        $insert_array['is_activated'] = $is_activated;
        $insert_array['wallet_address'] = $wallet_address;
        $insert_array['etc_percentage'] = $etc_percentage;
        $insert_array['high_percentage'] = $high_percentage;
        $insert_array['eth_token_amount'] = $eth_token_amount;
        $insert_array['high_token_amount'] = $high_token_amount;
        $insert_array['is_second_auth'] = $is_second_auth;
        $insert_array['user_token'] = $user_token;
        $insert_array['referral_code'] = $my_referral_code;
		$insert_array['user_address'] = $address;

			
        $user_id = DB::table('users')->insertGetId($insert_array);

        if($user_id > 0)
        {
				//$data = array('name'=>$company_name,'email'=>$email,'token'=>$user_token);
				
				$mail_content = get_email_template_body('email-verification');
				$mail_subject = get_email_template_subject('email-verification');
				$data = array('name'=>$company_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$user_token);
				
				$res = Mail::send('mail.temp-verification', $data, function ($message) use ($data) {
					
					
					$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
				});
				
				
			return Redirect::route('add-affiliate-partner',$user_id)->with('af_partner_success', 'Partner Created Successfully !');
        }
        else
        {
            return back()->with('af_partner_error','Partner Not Saved');
        }
	}
	function update_affiliate_partner(Request $request){
		$email = trim($request->input('email'));
		$company_name = trim($request->input('company_name'));
		$contact_number = trim($request->input('contact_number'));
		$representative_name = trim($request->input('representative_name'));
		$address = trim($request->input('address'));
		$is_second_auth = trim($request->input('is_second_auth'));
		$is_activated = trim($request->input('is_activated'));
		$wallet_address = trim($request->input('wallet_address'));
		$etc_percentage = trim($request->input('etc_percentage'));
		$high_percentage = trim($request->input('high_percentage'));
		$high_token_amount = trim($request->input('high_token_amount'));
		$eth_token_amount = trim($request->input('eth_token_amount'));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $user_id = trim($request->input('user_id'));

        $this->validate($request,[
			'company_name'=>'required',
			'representative_name'=>'required|alpha_spaces',
            'address' => 'required',
			'contact_number'=>'required|numeric',
            'email' => "required|email|unique:users,email,$user_id",
			'etc_percentage'=>'numeric',
			'high_percentage'=>'numeric',
			'high_token_amount'=>'numeric',
			'eth_token_amount'=>'numeric',
			'wallet_address'=>'alpha_dash'
        ],[
			'company_name.required' => 'Please provide company name',
			'representative_name.required' => 'Please provide representative name',
			'contact_number.required' => 'Please provide contact number',
            'email.required' => 'Please provide email !',
            'email.email' => 'Please provide valid email !',
            'email.unique' => 'Email id : '.$email.' already exist !',
			'etc_percentage.numeric' => 'Please enter proper ETC percentage !',
            'high_percentage.numeric' => 'Please enter proper EVI percentage !',
			'eth_token_amount.numeric' => 'Please enter proper token amount !',
            'high_token_amount.numeric' => 'Please enter proper token amount !',
            'wallet_address.alpha_dash' => 'Please enter proper token address !'
        ]);
		$update_array = array();
		
		$udetail = get_user_detail_by_id($user_id);
			if($email!=$udetail->email){
				$user_token = strtoupper(uniqid('EVI',true));
				
				//$data = array('name'=>$company_name,'email'=>$email,'token'=>$user_token,'old_email'=>$udetail->email,'new_email'=>$email);
				
				$mail_content = get_email_template_body('email-change-request');
				$mail_subject = get_email_template_subject('email-change-request');
				
				$data = array('name'=>$company_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content,'token'=>$user_token,'old_email'=>$udetail->email,'new_email'=>$email);
				
				
				$res = Mail::send('mail.temp-verification-change', $data, function ($message) use ($data) {
					
					
					$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
				});
				$update_array['email_change_request'] = $email;
				$update_array['user_token'] = $user_token;
			}
			
		$update_array['email'] = $email;
        $update_array['full_name'] = $company_name;
        $update_array['phone_no'] = $contact_number;
        $update_array['status'] = $status;
        $update_array['representative_name'] = $representative_name;
        $update_array['is_activated'] = $is_activated;
        $update_array['wallet_address'] = $wallet_address;
        $update_array['etc_percentage'] = $etc_percentage;
        $update_array['high_percentage'] = $high_percentage;
        $update_array['high_token_amount'] = $high_token_amount;
        $update_array['eth_token_amount'] = $eth_token_amount;
        $update_array['is_second_auth'] = $is_second_auth;
        $update_array['user_address'] = $address;
			
        $update = DB::table('users')
                  ->where('ID','=',$user_id)
                  ->update($update_array);

        if($update == 1)
        {
            return back()->with('af_partner_success','Partner Updated Successfully !');
        }
        else
        {
            return back()->with('af_partner_error','Partner Not Updated');
        }
	}
	
	function save_contribution(Request $request){
		
		$this->validate($request,[
            'email' => 'required|email',
            'amount' => 'required|numeric|min:0.0000001',
            /*'bonus_percentage' => 'required|numeric|min:0.00000000',*/
            'submitted_by' => 'required|numeric|min:1',
            'currency' => 'required',
        ],[
            'email.required' => 'Please provide email !',
            'email.email' => 'Please provide valid email !',
			'amount.required' => 'Please enter contribution amount !',
            'amount.numeric' => 'Please enter numeric value !',
            'amount.min' => 'Please enter positive non zero number !',
			'bonus_percentage.required' => 'Please enter bonus percentage !',
            'bonus_percentage.numeric' => 'Please enter numeric value !',
            'bonus_percentage.min' => 'Please enter positive non zero number !',
			'submitted_by.required' => 'Please choose user !',
            'submitted_by.numeric' => 'Please choose user !',
            'submitted_by.min' => 'Please choose user !',
			'currency.required' => 'Please choose currency !',
        ]);

		$contribution_amount = trim($request->input('amount'));
		$currency = trim($request->input('currency'));
		
		
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
		
        $Contribution = new Contribution;
        $Contribution->email = trim($request->input('email'));
        $Contribution->status = trim($request->input('status'));
        $Contribution->amount = trim($request->input('amount'));
        $Contribution->currency = $currency;
        $Contribution->transfer_proof = trim($request->input('transfer_proof'));
        $Contribution->base_amount = $base_amount;
        $Contribution->bonus_percentage = $bonus_percentage;
        $Contribution->bonus_amount = $bonus_amount;
        $Contribution->submitted_by = trim($request->input('submitted_by'));
        $Contribution->status_msg = trim($request->input('status_msg'));
        $Contribution->base_currency = 'EVI';
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        if($Contribution->save())
        {
            //return back()->with('news_success','News Added Successfully !');
            $lastInsertedId = $Contribution->id;
            return Redirect::route('add-contribution',$lastInsertedId)->with('contribution_success','Contribution Added Successfully !');
        }
        else
        {
            return back()->with('contribution_error','Contribution Not Saved');
        }
	}
	
	function update_contribution(Request $request){
		$this->validate($request,[
            'email' => 'required|email',
            /* 'amount' => 'required|numeric|min:0.0000001', */
            /*'bonus_percentage' => 'required|numeric|min:0.00000000',*/
			'submitted_by' => 'required|numeric|min:1',
			/* 'currency' => 'required', */
        ],[
            'email.required' => 'Please provide email !',
            'email.email' => 'Please provide valid email !',
			/* 'amount.required' => 'Please enter contribution amount !',
            'amount.numeric' => 'Please enter numeric value !',
            'amount.min' => 'Please enter positive non zero number !', */
			'bonus_percentage.required' => 'Please enter bonus percentage !',
            'bonus_percentage.numeric' => 'Please enter numeric value !',
            'bonus_percentage.min' => 'Please enter positive number !',
			'submitted_by.required' => 'Please choose user !',
            'submitted_by.numeric' => 'Please choose user !',
            'submitted_by.min' => 'Please choose user !',
			/* 'currency.required' => 'Please choose currency !', */
        ]);
		
		$email = trim($request->input('email'));
        $status = trim($request->input('status'));
        /* $amount = trim($request->input('amount'));
        $currency = trim($request->input('currency')); */
        $transfer_proof = trim($request->input('transfer_proof'));
        /*$base_amount = trim($request->input('base_amount'));*/
        /*$bonus_percentage = trim($request->input('bonus_percentage'));*/
        /*$bonus_amount = trim($request->input('bonus_amount'));*/
        $status_msg = trim($request->input('status_msg'));
        $submitted_by = trim($request->input('submitted_by'));
		
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $contribution_id = trim($request->input('contribution_id'));
	    $amount = get_user_amount_by_id($contribution_id);
		$currency = get_user_currency_by_id($contribution_id);
	

		$update_arr['email'] = $email;
		$update_arr['status'] = $status;
		$update_arr['amount'] = $amount;
		$update_arr['currency'] = $currency;
		$update_arr['base_currency'] = 'EVI';
		$update_arr['transfer_proof'] = $transfer_proof;
		$base_amount = '0';
		
		$contribution_amount = $amount;
		
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
		
		$update_arr['base_amount'] = $base_amount;
		$update_arr['bonus_percentage'] = $bonus_percentage;
		$update_arr['bonus_amount'] = $bonus_amount;
		$update_arr['status_msg'] = $status_msg;
		$update_arr['updated_date'] = $updated_date;
		$update_arr['approved_by'] = $author_id;
		$update_arr['submitted_by'] = $submitted_by;
		
        $update = DB::table('contribution')
                  ->where('ID','=',$contribution_id)
                  ->update($update_arr);

        if($update == 1)
        {
			DB::table('transaction')->where('parent_id', '=', $contribution_id)->where('parent_type', '=', 'contribution')->delete();
			DB::table('transaction')->where('parent_id', '=', $contribution_id)->where('parent_type', '=', 'ref_commission')->delete();
			
			if($status == 3){
		
				$total_amount = (float)$base_amount+(float)$bonus_amount;
				
				
				
				$transaction_data = array();
				$transaction_data['type'] = '1';
				$transaction_data['parent_type'] = 'contribution';
				$transaction_data['parent_id'] = $contribution_id;
				$transaction_data['amount'] = $total_amount;
				$transaction_data['status'] = '1';
				/* $transaction_data['exchange_rate'] = $exchange_rate; 
				$transaction_data['exchange_currency'] = $currency;*/
				$transaction_data['transaction_for'] = $submitted_by;
				$transaction_id = DB::table('transaction')->insertGetId($transaction_data);
					
				if($transaction_id > 0){
					
					
					  $parent_id = if_has_parent_user($submitted_by);
				     
					  $refferal_pers = get_settings('referral_commission_percentage');
					  
					    if($parent_id > 0 ){
							
							$bnus_amount = round($base_amount*$refferal_pers/100);
							
						
							
							$transaction_data_comm = array();
							$transaction_data_comm['type'] = '1';
							$transaction_data_comm['parent_type'] = 'ref_commission';
							$transaction_data_comm['parent_id'] = $contribution_id;
							$transaction_data_comm['amount'] = $bnus_amount;
							$transaction_data_comm['status'] = '1';
							
							$transaction_data_comm['transaction_for'] = $parent_id;
							$transaction_id = DB::table('transaction')->insertGetId($transaction_data_comm);
						}
					
					
					$get_user_info = get_user_info($submitted_by);
						
					if(!empty($get_user_info)){
						
						$high_token_amount = $get_user_info->high_token_amount;
						
						if($high_token_amount !=""){
							$total_amount = (float)$high_token_amount + (float)$total_amount;
						}
						
						$update_user_data['high_token_amount'] = $total_amount;
						
						$update2 = DB::table('users')
								  ->where('ID','=',$submitted_by)
								  ->update($update_user_data);
						if($update2 == 1){
							return back()->with('contribution_success','Contribution Updated Successfully ! Transaction and Total EVI Token also updated');
						}
							
					}else{
						return back()->with('contribution_success','Contribution Updated Successfully ! Transaction also updated');
					}
				}
					
				
			}else{
			//DB::table('transaction')->where('parent_id', '=', $contribution_id)->where('parent_type', '=', 'contribution')->delete();
			//DB::table('transaction')->where('parent_id', '=', $contribution_id)->where('parent_type', '=', 'ref_commission')->delete();
			}				
				 
            return back()->with('contribution_success','Contribution Updated Successfully !');
        }
        else
        {
            return back()->with('contribution_error','Contribution Not Updated');
        }
	}

    function export_contribution_data(Request $request){
        $query = DB::table('contribution')->orderBy('ID','desc')->get();
        if(count($query) > 0){
            $sl = 0;
            foreach($query as $export_data){
                $sl++;
                $full_name ='';
                $udetail = get_user_detail_by_id($export_data->submitted_by);
                if(isset($udetail) && !empty($udetail)){
                    $full_name = $udetail->full_name;
                }

                // referral commision
                $ref_commision= 0;
                if($export_data->submitted_by > 0 && $export_data->status==3 ){
                    $parent_id = if_has_parent_user($export_data->submitted_by);
                    if($parent_id > 0){
                        $ref_amt = total_referral_bycontribution($export_data->ID);
                        if($ref_amt > 0){
                            $ref_commision =  _tr('Ref Commission') .': '. number_format($ref_amt,2,'.',',');
                        }
                    }
                }
                // status
                $status = get_status_lable($export_data->status);
                    if($ref_commision > 0) {
                        $status = $status.' '.$ref_commision;
                    }
                // amount
                // bonus amount
                $bonus_amount = 0;
                $base_amount = (float)$export_data->base_amount;
                $bonus_amount = (float)$export_data->bonus_amount;
                $total = $base_amount+$bonus_amount;
                $total_high_amount = number_format($total,2,'.',',');
				
				$get_user_wallet_by_email = get_user_wallet_by_email($export_data->email);

                $data[]=[
						'SL'=>$sl,
						'Date'=>date('Y-M-d',strtotime($export_data->created_date)),
						'Email'=>$export_data->email,
						'Currency'=>strtoupper($export_data->currency),
						'Amount'=>number_format($export_data->amount,2,'.',','),
						'Status'=>$status,
						'EVI Qty'=>$base_amount,
						'Bonus'=>number_format($export_data->bonus_amount,2,'.',','),
						'Total EVI Qty'=>$total_high_amount,
						'Referral'=>get_ref_commission($export_data->ID),
						'Wallet' => $get_user_wallet_by_email,
                    ];
            }
        }
        export_data_xls($data);
    }


    function export_users_data(Request $request){
        $query = DB::table('users');
        $query = $query->where('role_id','=','2')->orderBy('ID','desc')->get();

        if(count($query) > 0){
            $sl = 0;
            foreach($query as $export_data){
                $sl++;
                if($export_data->status == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Inactive';
                }
                if($export_data->status == 1) {
                    $verified = 'Yes';
                } else {
                    $verified = 'No';
                }
                $data[]=[
                    'SL'=>$sl,
                    'User Name'=>$export_data->full_name,
                    'User Email'=>$export_data->email.' '.$export_data->phone_no,
                    'Referral User'=>total_referral($export_data->ID).'user(s)'.'  '.route('all-referrals',$export_data->ID),
                    'Token Amount'=>get_p2p_by_user_id($export_data->ID).'EVI',
                    'Registered On'=>$export_data->created_date,
                    'Status'=>$status,
                    'Verified'=>$verified,
                ];
            }
        }
        export_data_xls($data);
    }
    function export_affiliate_partner_data(Request $request){
        $query = DB::table('users')->where('role_id','=','4')->orderBy('ID','desc')->get();

        if(count($query) > 0){
            $sl = 0;
            foreach($query as $export_data){
                $sl++;
                if($export_data->status == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Inactive';
                }
                if($export_data->status == 1) {
                    $verified = 'Yes';
                } else {
                    $verified = 'No';
                }
                $data[]=[
                    'SL'=>$sl,
                    'Company Name'=>$export_data->full_name,
                    'Email'=>$export_data->email.' '.$export_data->phone_no,
                    'Referral user'=>total_referral($export_data->ID).'user(s)'.'  '.route('all-referrals',$export_data->ID),
                    'Token Amount'=>get_p2p_by_user_id($export_data->ID).'EVI',
                    'Registered On'=>$export_data->created_date,
                    'Status'=>$status,
                    'Verified'=>$verified,
                ];
            }
        }
        export_data_xls($data);
    }
	
	function all_referrals(Request $request){
		$id = $request->id;
		
		$query = DB::table('users as u');
		$query = $query->where('u.role_id','=','2');
		
		/*filter*/
		if(isset($_GET['status']) && $_GET['status'] >=0 ){
		$status = $_GET['status'];
		$query = $query->where('u.status',$status);   
		}
		if(isset($_GET['s']) && !empty($_GET['s'])){
		$s = $_GET['s'];
		$query = $query->where('u.full_name','like','%'.$s.'%');
		}
		/*filter*/
		$query = $query->where('r.parent_user_id','=',$id);
		$query = $query->join('referral as r','u.ID','=','r.child_user_id');
		$query = $query->select('u.ID','u.created_date','u.email','u.full_name','u.status','u.is_activated','u.phone_no','u.updated_date');
						
		$users = $query->paginate(10);
		
		$parent_detail = get_user_detail_by_id($id);
        return view('admin.all-referrals',array('users'=>$users,'id'=>$id,'parent_detail'=>$parent_detail));
	}

    function save_subscriber(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:subscribers',
        ],[
            'email.required' => 'Please provide email !',
            'email.email' => 'Please provide valid email !',
            'email.unique' => 'Email id already exist!',
        ]);

        $Subscribers = new Subscribers;
        $Subscribers->email = trim($request->input('email'));
        $Subscribers->status = trim($request->input('status'));
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        if($Subscribers->save())
        {
            //return back()->with('news_success','News Added Successfully !');
            $lastInsertedId = $Subscribers->id;
            return Redirect::route('add-subscriber',$lastInsertedId)->with('subscriber_success','Subscriber Added Successfully !');
        }
        else
        {
            return back()->with('subscriber_error','Subscriber Not Saved');
        }
    }

    function update_subscriber(Request $request)
    {
        $email = trim($request->input('email'));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $subscriber_id = trim($request->input('subscriber_id'));

        $this->validate($request,[
            'email' => "required|email|unique:subscribers,email,$subscriber_id",
        ],[
            'email.required' => 'Please provide email !',
            'email.email' => 'Please provide valid email !',
            'email.unique' => 'Email id : '.$email.' already exist !',
        ]);

        $update = DB::table('subscribers')
                  ->where('ID','=',$subscriber_id)
                  ->update(['email'=>$email,'status'=>$status,'updated_date'=>$updated_date]);

        if($update == 1)
        {
            return back()->with('subscriber_success','Subscriber Updated Successfully !');
        }
        else
        {
            return back()->with('subscriber_error','Subscriber Not Updated');
        }
    }

    function save_center(Request $request)
    {
        $this->validate($request,[
            'edc_name' => 'required',
            'center_name' => 'required',
            'description' => 'required',
        ],[
            'edc_name.required' => 'Please choose EDC name !',
            'center_name.required' => 'Please enter center name !',
            'description.required' => 'Please enter description !',
        ]);

        $Centers = new Centers;
        $Centers->name = trim($request->input('center_name'));
        $Centers->parent_id = trim($request->input('edc_name'));
        $Centers->description = trim($request->input('description'));
        $Centers->address = trim($request->input('address'));
        $Centers->status = trim($request->input('status'));
        $Centers->author_id = Session::get('userid');
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        $author_id = Session::get('userid');
        if($request->hasFile('center_img'))
        {
            $image = $request->file('center_img');
            $upload_id = do_upload($image,'centers',$author_id);
            if($upload_id > 0)
            {
                $Centers->image_id = $upload_id;   
            }
            
        }

        if($Centers->save())
        {
            //return back()->with('news_success','News Added Successfully !');
            $lastInsertedId = $Centers->id;
            return Redirect::route('add-center',$lastInsertedId)->with('center_success','Center Added Successfully !');
        }
        else
        {
            return back()->with('center_error','Center Not Saved');
        }
    }

    function update_center(Request $request)
    {
        $this->validate($request,[
            'edc_name' => 'required',
            'center_name' => 'required',
            'description' => 'required',
        ],[
            'edc_name.required' => 'Please choose EDC name !',
            'center_name.required' => 'Please enter center name !',
            'description.required' => 'Please enter description !',
        ]);

        $center_name = trim($request->input('center_name'));
        $edc_name = trim($request->input('edc_name'));
        $description = trim($request->input('description'));
        $address = trim($request->input('address'));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $center_id = trim($request->input('center_id'));

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('center_img'))
        {
            $image = $request->file('center_img');
            $upload_id = do_upload($image,'news',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id;
            }
            
        }

        $update = DB::table('centers')
                  ->where('ID','=',$center_id)
                  ->update(['name'=>$center_name,'parent_id'=>$edc_name,'description'=>$description,'address'=>$address,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id]);

        if($update == 1)
        {
            return back()->with('center_success','Center Updated Successfully !');
        }
        else
        {
            return back()->with('center_error','Center Not Updated');
        }
    }
	
	function save_translation(Request $request)
    {
		$langs = get_langs();
		$validate_arr = array();
		$validate_msg = array();
		if(isset($langs) && count($langs) >0){
			foreach($langs as $lng){
				$validate_arr['text_'.$lng->language_code] = 'required';
				$validate_msg['text_'.$lng->language_code.'.required'] = 'Please enter text !';
			}
		}
		
        $this->validate($request,$validate_arr,$validate_msg);
		
		$status = trim($request->input('status'));
		$translaton_parent_id = 0;
		if(isset($langs) && count($langs) >0){
			foreach($langs as $lng){
				$name = 'text_'.$lng->language_code;
				$text = trim($request->input($name ));
				$translation_data = array();
				$translation_data['text'] = $text;
				$translation_data['status'] = $status;
				$translation_data['parent'] = $translaton_parent_id;
				$translation_data['language_code'] = $lng->language_code;
				$insert_id = DB::table('translation')->insertGetId($translation_data);
				if($translaton_parent_id == 0){
					$translaton_parent_id = $insert_id;
				}
			}
		}
			
        $author_id = Session::get('userid');
        if($translaton_parent_id > 0)
        {
            return Redirect::route('add-translation',$translaton_parent_id)->with('translation_success','Translation Added Successfully !');
        }
        else
        {
            return back()->with('translation_error','Translation Not Saved !');
        }
    }

    function update_translation(Request $request)
    {
        $langs = get_langs();
		$validate_arr = array();
		$validate_msg = array();
		if(isset($langs) && count($langs) >0){
			foreach($langs as $lng){
				$validate_arr['text_'.$lng->language_code] = 'required';
				$validate_msg['text_'.$lng->language_code.'.required'] = 'Please enter text !';
			}
		}
		
		
        $this->validate($request,$validate_arr,$validate_msg);

		$status = trim($request->input('status'));
		$translation_id = trim($request->input('translation_id'));
		$author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
		
		$text = trim($request->input('text_en_GB'));
		$update = DB::table('translation')->where('ID','=',$translation_id)->update(['text'=>$text]);
				  
		$children = get_child_translation($translation_id);
		if(isset($children) && count($children) > 0){
			foreach($children as $child){
				$id = $child->ID;
				$text_name = 'text_'.$child->language_code;
				$text = trim($request->input($text_name));
				DB::table('translation')->where('ID','=',$id)->update(['text'=>$text]);
			}
		}

        /*if($update == 1)
        {*/
            return back()->with('translation_success','Translation Updated Successfully !');
        /*}
        else
        {
            return back()->with('translation_error','Translation Not Updated');
        }*/
    }
	
	
	function save_email_template(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Please enter subject !',
            'description.required' => 'Please enter body !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $EmailTemplate = new EmailTemplate;
        $EmailTemplate->title = trim($request->input('title'));
        $EmailTemplate->slug = is_unique_email_template_slug($request->input('title'));
        $EmailTemplate->description = trim($request->input('description'));
        //$EmailTemplate->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $EmailTemplate->publish_date = date('Y-m-d');
        $EmailTemplate->status = trim($request->input('status'));
        $EmailTemplate->author_id = Session::get('userid');
        $EmailTemplate->created_date = date('Y-m-d');
        $EmailTemplate->updated_date = date('Y-m-d');

        $author_id = Session::get('userid');
        if($request->hasFile('email_template_img'))
        {
            $image = $request->file('email_template_img');
            $upload_id = do_upload($image,'email_template',$author_id);
            if($upload_id > 0)
            {
                $EmailTemplate->image_id = $upload_id;   
            }
            
        }

        if($EmailTemplate->save())
        {
            //return back()->with('news_success','News Added Successfully !');
            $lastInsertedId = $EmailTemplate->id;
            return Redirect::route('add-email-template',$lastInsertedId)->with('email_template_success','Email Template Added Successfully !');
        }
        else
        {
            return back()->with('email_template_error','Email Template Not Saved');
        }
    }

    function update_email_template(Request $request)
    {
        $email_template_id = trim($request->input('email_template_id'));
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'slug' => "required|unique:email_template,slug,$email_template_id",
        ],[
            'title.required' => 'Please enter subject !',
            'description.required' => 'Please enter body !',
            'publish_date.required' => 'Please enter publish date !',
            'slug.required' => 'Please enter identifier !',
            'slug.unique' => "Provided identifier already Exist, Please Try with another !",
        ]);

        $title = trim($request->input('title'));
        $slug = trim($request->input('slug'));
        $description = trim($request->input('description'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $email_template_id = trim($request->input('email_template_id'));


        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('email_template_img'))
        {
            $image = $request->file('email_template_img');
            $upload_id = do_upload($image,'email_template',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }

        $update = DB::table('email_template')
                  ->where('ID','=',$email_template_id)
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id]);

        if($update == 1)
        {
            return back()->with('email_template_success','Email Template Updated Successfully.');
        }
        else
        {
            return back()->with('email_template_error','Email Template Not Updated');
        }
    }
	
	
    function save_news(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $News = new News;
        $News->title = trim($request->input('title'));
        $News->slug = is_unique_news_slug($request->input('title'));
        $News->description = trim($request->input('description'));
        $News->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $News->status = trim($request->input('status'));
        $News->author_id = Session::get('userid');
        $News->created_date = date('Y-m-d');
        $News->updated_date = date('Y-m-d');
        $News->is_edc_id = $request->input('is_edc_id');
        $News->is_show_front = $request->input('is_show_front');

        $author_id = Session::get('userid');
        if($request->hasFile('news_img'))
        {
            $image = $request->file('news_img');
            $upload_id = do_upload($image,'news',$author_id);
            if($upload_id > 0)
            {
                $News->image_id = $upload_id;   
            }
            
        }

        if($News->save())
        {
            //return back()->with('news_success','News Added Successfully !');
            $lastInsertedId = $News->id;
            return Redirect::route('add-news',$lastInsertedId)->with('news_success','News Added Successfully !');
        }
        else
        {
            return back()->with('news_error','News Not Saved');
        }
    }

	function update_language(Request $request)
    {
        $language_id = trim($request->input('language_id'));

        $this->validate($request,[
			'language' => 'required',
			'language_code' => 'required',
			'writing_system' => 'required'
		],[
			'language.required' => 'Please enter language !',
			'language_code.required' => 'Please enter language code !',
			'writing_system.required' => 'Please enter writing system !'
		]);
		

       $language = trim($request->input('language'));
       $language_code = trim($request->input('language_code'));
	   $writing_system = trim($request->input('writing_system'));
	   $is_default = trim($request->input('is_default'));
       $status = trim($request->input('status'));
       $del_flag_img = trim($request->input('del_flag_img'));
      


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
		
		if($is_default==1){
			Language::where('is_default', '1')->update(array('is_default'=>'0'));
		}
		
		$update_arr['language'] = $language;
		$update_arr['language_code'] = $language_code;
		$update_arr['writing_system'] = $writing_system;
		$update_arr['writing_system'] = $writing_system;
    	$update_arr['status'] = $status;
    	$update_arr['is_default'] = $is_default;
		
		
		if($del_flag_img == 'yes')
        {
			$image_id = trim($request->input('prev_flag_image_id'));
            $update = un_assign_image_id($image_id);
            $image_id = 0;
			$update_arr['flag_id'] = $image_id;
        }

    	if($request->hasFile('flag_img'))
		{
			$image = $request->file('flag_img');
			$upload_id = do_upload($image,'language',$author_id);
			if($upload_id > 0)
			{
				$image_id = $upload_id;
				$update_arr['flag_id'] = $image_id;
			}
			
		}

    	if(Language::where('ID', $language_id)->update($update_arr))
    	{
    		
    		return back()->with('language_success','Language Updated Successfully.');
    	}
    	else
    	{
    		return back()->with('language_error','Language Not Updated !');
    	}
    }
	
    function update_news(Request $request)
    {
        $news_id = trim($request->input('news_id'));
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
            'slug' => "required|unique:news,slug,$news_id",
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
            'slug.required' => 'Please enter url path !',
            'slug.unique' => "Provided slug already Exist, Please Try with another !",
        ]);

        $title = trim($request->input('title'));
        $slug = trim($request->input('slug'));
        $description = trim($request->input('description'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $news_id = trim($request->input('news_id'));
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('news_img'))
        {
            $image = $request->file('news_img');
            $upload_id = do_upload($image,'news',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }

        $update = DB::table('news')
                  ->where('ID','=',$news_id)
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id,'is_edc_id'=>$is_edc_id,'is_show_front'=>$is_show_front]);

        if($update == 1)
        {
            return back()->with('news_success','News Updated Successfully.');
        }
        else
        {
            return back()->with('news_error','News Not Updated');
        }
    }

	function save_video(Request $request)
    {
         $this->validate($request,[
            'title' => 'required',
            'video_link' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'video_link.required' => 'Please enter youtube video link !',
        ]);

		$lang = get_admin_language();
		
        $Videos = new Videos;
        $Videos->title = trim($request->input('title'));
        $Videos->slug = is_unique_news_slug($request->input('title'));
        $Videos->description = trim($request->input('description'));
        /*$Videos->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));*/
        $Videos->status = trim($request->input('status'));
        $Videos->author_id = Session::get('userid');
        $Videos->created_date = date('Y-m-d');
        $Videos->updated_date = date('Y-m-d');
        $Videos->is_show_front = $request->input('is_show_front');
        $Videos->video_link = $request->input('video_link');
        //$Videos->video_language = $request->input('show_on_homepage');
        //$Videos->lang = $lang;

        $author_id = Session::get('userid');
        if($request->hasFile('whitepaper_img'))
        {
            $image = $request->file('whitepaper_img');
            $upload_id = do_upload($image,'video',$author_id);
            if($upload_id > 0)
            {
                $Videos->image_id = $upload_id;   
            }
            
        }

        if($Videos->save())
        {
            $lastInsertedId = $Videos->id;
            return Redirect::route('add-video',$lastInsertedId)->with('video_success','Video Added Successfully !');
        }
        else
        {
            return back()->with('video_error','Video Not Saved');
        }
    }

    function update_video(Request $request)
    {
        $video_id = trim($request->input('video_id'));
        $this->validate($request,[
            'title' => 'required',
            'video_link' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'video_link.required' => 'Please enter youtube video link !',
        ]);

        $title = trim($request->input('title'));
        /*$slug = trim($request->input('slug'));*/
        $description = trim($request->input('description'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $video_id = trim($request->input('video_id'));
        $is_show_front = $request->input('is_show_front');
        //$video_language = $request->input('video_language');
        $video_link = $request->input('video_link');

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('whitepaper_img'))
        {
            $image = $request->file('whitepaper_img');
            $upload_id = do_upload($image,'whitepaper',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }
		/*
		if($is_show_front==1){
		DB::table('videos')
				 ->where('is_show_front','=','1')->where('ID','!=',$video_id)
				 ->update(['is_show_front'=>'0']);
		}
		*/
		
		$lang = get_admin_language();
		
        $update = DB::table('videos')
                  ->where('ID','=',$video_id)
                  ->update(['title'=>$title,'description'=>$description,'status'=>$status,'updated_date'=>$updated_date,'is_show_front'=>$is_show_front,'video_link'=>$video_link]);
		
		
        if($update == 1)
        {
            return back()->with('video_success','Video Updated Successfully.');
        }
        else
        {
            return back()->with('video_error','Video Not Updated');
        }
    }
	
	function save_whitepaper(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

		$lang = get_admin_language();
		
        $Whitepaper = new Whitepaper;
        $Whitepaper->title = trim($request->input('title'));
        $Whitepaper->slug = is_unique_news_slug($request->input('title'));
        $Whitepaper->description = trim($request->input('description'));
        $Whitepaper->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $Whitepaper->status = trim($request->input('status'));
        $Whitepaper->author_id = Session::get('userid');
        $Whitepaper->created_date = date('Y-m-d');
        $Whitepaper->updated_date = date('Y-m-d');
        $Whitepaper->is_show_front = $request->input('is_show_front');
        $Whitepaper->lang = $lang;

        $author_id = Session::get('userid');
        if($request->hasFile('whitepaper_img'))
        {
            $image = $request->file('whitepaper_img');
            $upload_id = do_upload($image,'whitepaper',$author_id);
            if($upload_id > 0)
            {
                $Whitepaper->image_id = $upload_id;   
            }
            
        }

        if($Whitepaper->save())
        {
            $lastInsertedId = $Whitepaper->id;
            return Redirect::route('add-whitepaper',$lastInsertedId)->with('whitepaper_success','Whitepaper Added Successfully !');
        }
        else
        {
            return back()->with('whitepaper_error','Whitepaper Not Saved');
        }
    }

    function update_whitepaper(Request $request)
    {
        $whitepaper_id = trim($request->input('whitepaper_id'));
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $title = trim($request->input('title'));
        $slug = trim($request->input('slug'));
        $description = trim($request->input('description'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $whitepaper_id = trim($request->input('whitepaper_id'));
        $is_show_front = $request->input('is_show_front');

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('whitepaper_img'))
        {
            $image = $request->file('whitepaper_img');
            $upload_id = do_upload($image,'whitepaper',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }
		if($is_show_front==1){
		DB::table('whitepaper')
				 ->where('is_show_front','=','1')->where('ID','!=',$whitepaper_id)
				 ->update(['is_show_front'=>'0']);
		}
		
		$lang = get_admin_language();
		
        $update = DB::table('whitepaper')
                  ->where('ID','=',$whitepaper_id)
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id,'is_show_front'=>$is_show_front]);
		
		
        if($update == 1)
        {
            return back()->with('whitepaper_success','Whitepaper Updated Successfully.');
        }
        else
        {
            return back()->with('whitepaper_error','whitepaper Not Updated');
        }
    }
	
	
	
	function save_roadmap(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

		$lang = get_admin_language();
		
        $Roadmap = new Roadmap;
        $Roadmap->title = trim($request->input('title'));
        $Roadmap->slug = is_unique_news_slug($request->input('title'));
        $Roadmap->description = trim($request->input('description'));
        $Roadmap->publish_date = trim($request->input('publish_date'));
        $Roadmap->status = trim($request->input('status'));
        $Roadmap->is_done = trim($request->input('is_done'));
        $Roadmap->order = trim($request->input('order'));
        $Roadmap->author_id = Session::get('userid');
        $Roadmap->created_date = date('Y-m-d');
        $Roadmap->updated_date = date('Y-m-d');
        $Roadmap->lang = $lang;

        $author_id = Session::get('userid');
        if($request->hasFile('roadmap_img'))
        {
            $image = $request->file('roadmap_img');
            $upload_id = do_upload($image,'roadmap',$author_id);
            if($upload_id > 0)
            {
                $Roadmap->image_id = $upload_id;   
            }
            
        }

        if($Roadmap->save())
        {
            $lastInsertedId = $Roadmap->id;
            return Redirect::route('add-roadmap',$lastInsertedId)->with('roadmap_success','Roadmap Added Successfully !');
        }
        else
        {
            return back()->with('roadmap_error','Roadmap Not Saved');
        }
    }

    function update_roadmap(Request $request)
    {
        $roadmap_id = trim($request->input('roadmap_id'));
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $title = trim($request->input('title'));
        $slug = trim($request->input('slug'));
        $description = trim($request->input('description'));
        $publish_date = trim($request->input('publish_date'));
        $status = trim($request->input('status'));
		$is_done = trim($request->input('is_done'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $roadmap_id = trim($request->input('roadmap_id'));
        $order = $request->input('order');
		
		$lang = get_admin_language();

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('roadmap_img'))
        {
            $image = $request->file('roadmap_img');
            $upload_id = do_upload($image,'roadmap',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }
		
		
        $update = DB::table('roadmap')
                  ->where('ID','=',$roadmap_id)
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'is_done'=>$is_done,'author_id'=>$author_id,'updated_date'=>$updated_date,'order'=>$order]);
		
		
        if($update == 1)
        {
            return back()->with('roadmap_success','Roadmap Updated Successfully.');
        }
        else
        {
            return back()->with('roadmap_error','Roadmap Not Updated');
        }
    }
	
	
	function save_token(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
        ],[
            'title.required' => 'Please enter title !',
        ]);

		$lang = get_admin_language();
		
        $TokenInfo = new TokenInfo;
        $TokenInfo->title = trim($request->input('title'));
        $TokenInfo->slug = is_unique_news_slug($request->input('title'));
        $TokenInfo->subtitle = trim($request->input('subtitle'));

        /*$TokenInfo->offer_name = trim($request->input('offer_name'));
        $TokenInfo->bonus_percentage = trim($request->input('bonus_percentage'));
        $TokenInfo->publish_date = trim($request->input('publish_date')); */
		
        $TokenInfo->status = trim($request->input('status'));
        $TokenInfo->order = trim($request->input('order'));
        $TokenInfo->author_id = Session::get('userid');
        $TokenInfo->created_date = date('Y-m-d');
        $TokenInfo->updated_date = date('Y-m-d');
        $TokenInfo->lang = $lang;

        $author_id = Session::get('userid');
        if($request->hasFile('token_info'))
        {
            $image = $request->file('token_info');
            $upload_id = do_upload($image,'whitepaper',$author_id);
            if($upload_id > 0)
            {
                $TokenInfo->image_id = $upload_id;   
            }
            
        }

        if($TokenInfo->save())
        {
            $lastInsertedId = $TokenInfo->id;
            return Redirect::route('add-token',$lastInsertedId)->with('token_success','Token info Added Successfully !');
        }
        else
        {
            return back()->with('token_error','Token info Not Saved');
        }
    }

    function update_token(Request $request)
    {
        $token_id = trim($request->input('token_id'));
        $this->validate($request,[
            'title' => 'required',
        ],[
            'title.required' => 'Please enter title !',
        ]);

        $title = trim($request->input('title'));

        $subtitle = trim($request->input('subtitle'));
		
        /*$offer_name = trim($request->input('offer_name'));
        $bonus_percentage = trim($request->input('bonus_percentage'));
        $publish_date = trim($request->input('publish_date'));
		*/
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $token_id = trim($request->input('token_id'));
        $order = $request->input('order');

		$lang = get_admin_language();
		
        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('token_img'))
        {
            $image = $request->file('token_img');
            $upload_id = do_upload($image,'token_info',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id;
            }
            
        }
		
		
        $update = DB::table('token_info')
                  ->where('ID','=',$token_id)
                  ->update(['title'=>$title,'subtitle'=>$subtitle,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'order'=>$order]);
		
		
        if($update == 1)
        {
            return back()->with('token_success','Token Info Updated Successfully.');
        }
        else
        {
            return back()->with('token_error','Token Info Not Updated');
        }
    }
	
	
	function save_partner(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|alpha_spaces',
        ],[
            'name.required' => 'Please enter name !'
        ]);

        $Partners = new Partners;
        $Partners->name = trim($request->input('name'));
        $Partners->link = trim($request->input('link'));
        $Partners->status = trim($request->input('status'));
        $Partners->order = trim($request->input('order'));
		$lang = get_admin_language();
		$Partners->lang = $lang;

        $author_id = Session::get('userid');
        if($request->hasFile('partner_img'))
        {
            $image = $request->file('partner_img');
            $upload_id = do_upload($image,'partner',$author_id);
            if($upload_id > 0)
            {
                $Partners->image_id = $upload_id;   
            }
            
        }

        if($Partners->save())
        {
            $lastInsertedId = $Partners->id;
            return Redirect::route('add-partner',$lastInsertedId)->with('partner_success','Partner Added Successfully !');
        }
        else
        {
            return back()->with('partner_error','Partner Not Saved');
        }
    }

    function update_partner(Request $request)
    {
        $partner_id = trim($request->input('partner_id'));
        $this->validate($request,[
            'name' => 'required|alpha_spaces',
        ],[
            'name.required' => 'Please enter title !'
        ]);

        $name = trim($request->input('name'));
   
		$lang = get_admin_language();
        $status = trim($request->input('status'));
        $link = trim($request->input('link'));
        $order = trim($request->input('order'));
        $author_id = Session::get('userid');
       

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('partner_img'))
        {
            $image = $request->file('partner_img');
            $upload_id = do_upload($image,'partner',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }
		
		
        $update = DB::table('partners')
                  ->where('ID','=',$partner_id)
                  ->update(['name'=>$name,'status'=>$status,'image_id'=>$image_id,'link'=>$link,'order'=>$order]);
		
		
        if($update == 1)
        {
            return back()->with('partner_success','Partner Updated Successfully.');
        }
        else
        {
            return back()->with('partner_error','Partner Not Updated');
        }
    }
	
	
	function save_ico_listing(Request $request){
		
        $this->validate($request,[
            'name' => 'required|alpha_spaces',
            'ico_type' => 'required'
        ],[
            'name.required' => 'Please enter name !',
            'ico_type.required' => 'Please choose ICO type !'
        ]);

        $ICOListing = new ICOListing;
        $ICOListing->name = trim($request->input('name'));
        $ICOListing->link = trim($request->input('link'));
        $ICOListing->other_text = trim($request->input('other_text'));
        $ICOListing->status = trim($request->input('status'));
        $ICOListing->order = trim($request->input('order'));
		
		$last_choosen_item = trim($request->input('last_choosen_item'));
		
		if($last_choosen_item == 'image'){
			
			$author_id = Session::get('userid');
			if($request->hasFile('ico_listing_img')){
				
				$image = $request->file('ico_listing_img');
				$upload_id = do_upload($image,'ico_listing',$author_id);
				if($upload_id > 0)
				{
					$ICOListing->image_id = $upload_id;   
				}
				
			}
		}else{
			$ICOListing->image_id = 0;
		}
        
		

        if($ICOListing->save()){
			
            $lastInsertedId = $ICOListing->id;
            return Redirect::route('add-ico-listing',$lastInsertedId)->with('ico_listing_success','ICO Added Successfully !');
        }
        else{
			
			return back()->with('ico_listing_error','ICO Not Saved');
        }
    }

    function update_ico_listing(Request $request){
		
        $ico_listing_id = trim($request->input('ico_listing_id'));
		
        $this->validate($request,[
            'name' => 'required|alpha_spaces',
            'ico_type' => 'required'
        ],[
            'name.required' => 'Please enter name !',
            'ico_type.required' => 'Please choose ICO type !'
        ]);

        $name = trim($request->input('name'));
   
		$lang = get_admin_language();
        $status = trim($request->input('status'));
        $link = trim($request->input('link'));
        $other_text = trim($request->input('other_text'));
        $order = trim($request->input('order'));
        $author_id = Session::get('userid');
       
	   
		$last_choosen_item = trim($request->input('last_choosen_item'));
		
		if($last_choosen_item == 'image'){
			//echo "<br>img"; exit;
			$image_id = trim($request->input('prev_img_id'));
			
			if($request->hasFile('ico_listing_img'))
			{
				$image = $request->file('ico_listing_img');
				$upload_id = do_upload($image,'ico_listing',$author_id);
				if($upload_id > 0)
				{
					$image_id = $upload_id; 
				}
				
			}
			
			$other_text = "";
			
		}else{
			//echo "<br>wdht"; exit;
			$image_id = 0;
		}
		
		

        $update = DB::table('ico_listing')
                  ->where('ID','=',$ico_listing_id)
                  ->update(['name'=>$name,'status'=>$status,'image_id'=>$image_id,'link'=>$link,'other_text'=>$other_text,'order'=>$order]);
		
		
        if($update == 1)
        {
            return back()->with('ico_listing_success','ICO Updated Successfully.');
        }
        else
        {
            return back()->with('ico_listing_error','ICO Not Updated');
        }
    }
	
	
	function save_airdrop_listing(Request $request){
		
        $this->validate($request,[
            'name' => 'required',
            'airdrop_type' => 'required'
        ],[
            'name.required' => 'Please enter name !',
            'airdrop_type.required' => 'Please choose Airdrop type !'
        ]);

        $AirdropListing = new AirdropListing;
        $AirdropListing->name = trim($request->input('name'));
        $AirdropListing->link = trim($request->input('link'));
        $AirdropListing->other_text = trim($request->input('other_text'));
        $AirdropListing->status = trim($request->input('status'));
        $AirdropListing->order = trim($request->input('order'));
		
		$last_choosen_item = trim($request->input('last_choosen_item'));
		
		if($last_choosen_item == 'image'){
			
			$author_id = Session::get('userid');
			if($request->hasFile('airdrop_listing_img')){
				
				$image = $request->file('airdrop_listing_img');
				$upload_id = do_upload($image,'airdrop_listing',$author_id);
				if($upload_id > 0)
				{
					$AirdropListing->image_id = $upload_id;   
				}
				
			}
		}else{
			$AirdropListing->image_id = 0;
		}

        if($AirdropListing->save()){
			
            $lastInsertedId = $AirdropListing->id;
            return Redirect::route('add-airdrop-listing',$lastInsertedId)->with('airdrop_listing_success','Airdrop Added Successfully !');
        }
        else{
			
			return back()->with('airdrop_listing_error','Airdrop Not Saved');
        }
    }

    function update_airdrop_listing(Request $request){
		
        $airdrop_listing_id = trim($request->input('airdrop_listing_id'));
        $this->validate($request,[
            'name' => 'required',
            'airdrop_type' => 'required'
        ],[
            'name.required' => 'Please enter title !',
            'airdrop_type.required' => 'Please choose Airdrop type !'
        ]);

        $name = trim($request->input('name'));
   
		$lang = get_admin_language();
        $status = trim($request->input('status'));
        $link = trim($request->input('link'));
        $other_text = trim($request->input('other_text'));
        $order = trim($request->input('order'));
        $author_id = Session::get('userid');
       
	   
		$last_choosen_item = trim($request->input('last_choosen_item'));
		
		if($last_choosen_item == 'image'){
			//echo "<br>img"; exit;
			$image_id = trim($request->input('prev_img_id'));
			
			if($request->hasFile('airdrop_listing_img'))
			{
				$image = $request->file('airdrop_listing_img');
				$upload_id = do_upload($image,'airdrop_listing',$author_id);
				if($upload_id > 0)
				{
					$image_id = $upload_id; 
				}
				
			}
			
			$other_text = "";
			
		}else{
			//echo "<br>wdht"; exit;
			$image_id = 0;
		}		
		
        $update = DB::table('airdrop_listing')
                  ->where('ID','=',$airdrop_listing_id)
                  ->update(['name'=>$name,'status'=>$status,'image_id'=>$image_id,'link'=>$link,'other_text'=>$other_text,'order'=>$order]);
		
		
        if($update == 1)
        {
            return back()->with('airdrop_listing_success','Airdrop Updated Successfully.');
        }
        else
        {
            return back()->with('airdrop_listing_error','Airdrop Not Updated');
        }
    }


    function save_achievements(Request $request)
    {
         $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $Achievements = new Achievements;
        $Achievements->title = trim($request->input('title'));
        $Achievements->description = trim($request->input('description'));
        $Achievements->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $Achievements->status = trim($request->input('status'));
        $Achievements->author_id = Session::get('userid');
        $Achievements->created_date = date('Y-m-d');
        $Achievements->updated_date = date('Y-m-d');
        $Achievements->is_edc_id = $request->input('is_edc_id');
        $Achievements->is_show_front = $request->input('is_show_front');

        $author_id = Session::get('userid');
        if($request->hasFile('achievement_img'))
        {
            $image = $request->file('achievement_img');
            $upload_id = do_upload($image,'achievements',$author_id);
            if($upload_id > 0)
            {
                $Achievements->image_id = $upload_id;   
            }
            
        }

        if($Achievements->save())
        {
            //return back()->with('achievements_success','Achievement Added Successfully !');
            $lastInsertedId = $Achievements->id;
            return Redirect::route('add-achievements',$lastInsertedId)->with('achievements_success','Achievement Added Successfully !');
        }
        else
        {
            return back()->with('achievements_error','Achievement Not Saved');
        }
    }

    function update_achievements(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $title = trim($request->input('title'));
        $description = trim($request->input('description'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $achievement_id = trim($request->input('achievement_id'));

        $image_id = trim($request->input('prev_img_id'));

        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

        if($request->hasFile('achievement_img'))
        {
            $image = $request->file('achievement_img');
            $upload_id = do_upload($image,'achievements',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }

        $update = DB::table('achievements')
                  ->where('ID','=',$achievement_id)
                  ->update(['title'=>$title,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id,'is_edc_id'=>$is_edc_id,'is_show_front'=>$is_show_front]);

        if($update == 1)
        {
            return back()->with('achievements_success','Achievement Updated Successfully !');
        }
        else
        {
            return back()->with('achievements_error','Achievement Not Updated');
        }
    }




    function save_page(Request $request)
    {
         $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $CmsPages = new CmsPages;
        $CmsPages->title = trim($request->input('title'));
        $CmsPages->description = trim($request->input('description'));
        $CmsPages->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $CmsPages->status = trim($request->input('status'));
        $CmsPages->slug = is_unique_page_slug($request->input('title'));
        $CmsPages->author_id = Session::get('userid');
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        $author_id = Session::get('userid');
        if($request->hasFile('page_img'))
        {
            $image = $request->file('page_img');
            $upload_id = do_upload($image,'cms_pages',$author_id);
            if($upload_id > 0)
            {
                $CmsPages->image_id = $upload_id;   
            }
            
        }

        if($CmsPages->save())
        {
            //return back()->with('achievements_success','Achievement Added Successfully !');
            $lastInsertedId = $CmsPages->id;
            return Redirect::route('add-page',$lastInsertedId)->with('page_success','Page Added Successfully !');
        }
        else
        {
            return back()->with('page_error','Page Not Saved');
        }
    }

    function update_page(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
        ]);

        $title = trim($request->input('title'));
        $description = trim($request->input('description'));
        $slug = trim($request->input('slug'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $page_id = trim($request->input('page_id'));

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('page_img'))
        {
            $image = $request->file('page_img');
            $upload_id = do_upload($image,'cms_pages',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }

        $update = DB::table('cms_pages')
                  ->where('ID','=',$page_id)
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id]);

        if($update == 1)
        {
            return back()->with('page_success','Page Updated Successfully !');
        }
        else
        {
            return back()->with('page_error','Page Not Updated');
        }
    }


    function save_success_stories(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
            'alumni_name' => 'required',
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
            'alumni_name.required' => 'Please enter alumni name !',
        ]);

        $SuccessStories = new SuccessStories;
        $SuccessStories->title = trim($request->input('title'));
        $SuccessStories->slug = is_unique_success_stories_slug(trim($request->input('title')));
        $SuccessStories->description = trim($request->input('description'));
        $SuccessStories->publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $SuccessStories->status = trim($request->input('status'));
        $SuccessStories->author_id = Session::get('userid');
        $SuccessStories->alumni_name = trim($request->input('alumni_name'));
        $SuccessStories->alumni_designation = trim($request->input('alumni_designation'));
        $SuccessStories->created_date = date('Y-m-d');
        $SuccessStories->updated_date = date('Y-m-d');
        $SuccessStories->is_edc_id = $request->input('is_edc_id');
        $SuccessStories->is_show_front = $request->input('is_show_front');

        $author_id = Session::get('userid');
        if($request->hasFile('success_stories_img'))
        {
            $image = $request->file('success_stories_img');
            $upload_id = do_upload($image,'success_stories',$author_id);
            if($upload_id > 0)
            {
                $SuccessStories->image_id = $upload_id;   
            }
            
        }

        if($SuccessStories->save())
        {
            //return back()->with('success_stories_success','Success Story Added Successfully !');
            $lastInsertedId = $SuccessStories->id;
            return Redirect::route('add-success-stories',$lastInsertedId)->with('success_stories_success','Success Story Added Successfully !');
        }
        else
        {
            return back()->with('success_stories_error','Success Story Not Saved');
        }
    }

    function update_success_stories(Request $request)
    {
        $success_story_id = trim($request->input('success_story_id'));
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
            'alumni_name' => 'required',
            'slug' => "required|unique:success_stories,slug,$success_story_id",
        ],[
            'title.required' => 'Please enter title !',
            'description.required' => 'Please enter description !',
            'publish_date.required' => 'Please enter publish date !',
            'alumni_name.required' => 'Please enter alumni name !',
            'slug.required' => 'Please enter url path !',
            'slug.unique' => 'The Path you entered already exist !',
        ]);

        $title = trim($request->input('title'));
        $slug = trim($request->input('slug'));
        $description = trim($request->input('description'));
        $publish_date = date('Y-m-d',strtotime($request->input('publish_date')));
        $status = trim($request->input('status'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d H:i:s');
        $success_story_id = trim($request->input('success_story_id'));
        $alumni_name = trim($request->input('alumni_name'));
        $alumni_designation = trim($request->input('alumni_designation'));
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

        $image_id = trim($request->input('prev_img_id'));

        if($request->hasFile('success_stories_img'))
        {
            $image = $request->file('success_stories_img');
            $upload_id = do_upload($image,'success_stories',$author_id);
            if($upload_id > 0)
            {
                $image_id = $upload_id; 
            }
            
        }

        $update = DB::table('success_stories')
                  ->where('ID','=',$success_story_id)
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id,'alumni_name'=>$alumni_name,'alumni_designation'=>$alumni_designation,'is_edc_id'=>$is_edc_id,'is_show_front'=>$is_show_front]);

        if($update == 1)
        {
            return back()->with('success_stories_success','Success Story Updated Successfully !');
        }
        else
        {
            return back()->with('success_stories_error','Success Story Not Updated');
        }
    }

    function save_general_settings(Request $request){
        $this->validate($request,[
            'site_title' => 'required',
        ],[
            'site_title.required' => 'Please enter site title !',
        ]);

        $site_title = trim($request->input('site_title'));
        update_settings('site_title','Site Title',$site_title);
		
		$admin_title = trim($request->input('admin_title'));
        update_settings('admin_title','Admin Title',$admin_title);
		
		$admin_email = trim($request->input('admin_email'));
        update_settings('admin_email','Admin Email',$admin_email);

        $header_code = trim($request->input('header_code'));
        update_settings('header_code','Header Code',$header_code);

        $footer_code = trim($request->input('footer_code'));
        update_settings('footer_code','Footer Code',$footer_code);

        $copyright_text = trim($request->input('copyright_text'));
        update_settings('copyright_text','Copyright Text',$copyright_text);
		
		if($request->hasFile('whitepaper'))
        {
            $image = $request->file('whitepaper');
			
			$upload_id = do_upload_with_file_n_path($image,'whitepaper','0');
			
			if($upload_id > 0){
				$whitepaper_id = $upload_id;
                update_settings('whitepaper_id','White Paper',$whitepaper_id);
			}
        }

        $remove_logo = trim($request->input('remove_logo'));
        if($remove_logo=='yes'){
        update_settings('site_logo_id','Site Logo','0');
        }

        if($request->hasFile('site_logo'))
        {
            $image = $request->file('site_logo');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $image_id = $upload_id;
                update_settings('site_logo_id','Site Logo',$image_id);

            }
            
        }

        $remove_privacy_policy = trim($request->input('remove_privacy_policy'));
        if($remove_privacy_policy=='yes'){
        update_settings('privacy_policy','Privacy Policy','0');
        }
		
		
		if($request->hasFile('privacy_policy'))
        {
            $image = $request->file('privacy_policy');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $image_id = $upload_id;
                update_settings('privacy_policy','Privacy Policy',$image_id);

            }
            
        }
		
		 $remove_terms_conditions = trim($request->input('remove_terms_conditions'));
        if($remove_terms_conditions=='yes'){
        update_settings('terms_conditions','Terms & Conditions','0');
        }
		
		
		if($request->hasFile('terms_conditions'))
        {
            $image = $request->file('terms_conditions');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $image_id = $upload_id;
                update_settings('terms_conditions','Terms & Conditions',$image_id);

            }
            
        }
		
		 $remove_onepager = trim($request->input('remove_onepager'));
        if($remove_onepager=='yes'){
        update_settings('onepager','One Pager','0');
        }
		
		
		if($request->hasFile('onepager'))
        {
            $image = $request->file('onepager');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $image_id = $upload_id;
                update_settings('onepager','One Pager',$image_id);

            }
            
        }
		

        $remove_alt_logo = trim($request->input('remove_alt_logo'));
        if($remove_alt_logo=='yes'){
        update_settings('alt_site_logo_id','Site Logo','0');
        }
		

        if($request->hasFile('alt_site_logo'))
        {
            $image = $request->file('alt_site_logo');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $alt_image_id = $upload_id;
                update_settings('alt_site_logo_id','Site Logo',$alt_image_id);

            }
            
        }
		
		
		
        $remove_privacy_policy = trim($request->input('remove_privacy_policy'));
        if($remove_privacy_policy=='yes'){
			update_settings('privacy_policy','Privacy Policy','0');
        }
		
		
		if($request->hasFile('privacy_policy_file'))
        {
            $image = $request->file('privacy_policy_file');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $image_id = $upload_id;
                update_settings('privacy_policy','Privacy Policy',$image_id);

            }
            
        }
		
		 $remove_terms_conditions = trim($request->input('remove_terms_conditions'));
        if($remove_terms_conditions=='yes'){
			update_settings('terms_conditions','Terms & Conditions','0');
        }
		
		
		if($request->hasFile('terms_conditions_file'))
        {
            $image = $request->file('terms_conditions_file');
            $upload_id = do_upload($image,'settings','0');
            if($upload_id > 0)
            {
                $image_id = $upload_id;
                update_settings('terms_conditions','Terms & Conditions',$image_id);

            }
            
        }

        $home_title = trim($request->input('home_title'));
        update_settings('home_title','Home Page Welcome Title',$home_title);

        $home_desc = trim($request->input('home_desc'));
        update_settings('home_desc','Home Page Welcome Description',$home_desc);

        $more_link = trim($request->input('more_link'));
        update_settings('more_link','Home Page Read More Link',$more_link);
		
		$home_youtube_link = trim($request->input('home_youtube_link'));
        update_settings('home_youtube_link','Home Youtube Link',$home_youtube_link);
		
		/* $eth_to_p2p = trim($request->input('eth_to_p2p'));
        update_settings('eth_to_p2p','ETH convertion rate to P2P',$eth_to_p2p);
		
		$btc_to_p2p = trim($request->input('btc_to_p2p'));
        update_settings('btc_to_p2p','BTC convertion rate to P2P',$btc_to_p2p);
		
		$ltc_to_p2p = trim($request->input('ltc_to_p2p'));
        update_settings('ltc_to_p2p','LTC convertion rate to P2P',$ltc_to_p2p); */
		
		$token_value = trim($request->input('token_value'));
        update_settings('token_value','Token Value',$token_value);
		
		$clock_title = trim($request->input('clock_title'));
        update_settings('clock_title','Clock Title',$clock_title);
		
		$clock_sub_title = trim($request->input('clock_sub_title'));
        update_settings('clock_sub_title','Clock Sub Title',$clock_sub_title);
		
		$clock_countdown_time = trim($request->input('clock_countdown_time'));
        update_settings('clock_countdown_time','Clock Countdown Date',$clock_countdown_time);
		
		$percentage = trim($request->input('percentage'));
        update_settings('percentage','percentage',$percentage);
		
		$softcap = trim($request->input('softcap'));
        update_settings('softcap','softcap',$softcap);
		
		$hardcap = trim($request->input('hardcap'));
        update_settings('hardcap','hardcap',$hardcap);
		
		$admin_wallet_address = trim($request->input('admin_wallet_address'));
        update_settings('admin_wallet_address','Admin wallet address',$admin_wallet_address);
		
		$admin_wallet_address_ltc = trim($request->input('admin_wallet_address_ltc'));
        update_settings('admin_wallet_address_ltc','Admin wallet address USDT',$admin_wallet_address_ltc);
		
		$admin_wallet_address_btc = trim($request->input('admin_wallet_address_btc'));
        update_settings('admin_wallet_address_btc','Admin wallet address BTC',$admin_wallet_address_btc);
		
		$admin_wallet_address_bnb = trim($request->input('admin_wallet_address_bnb'));
        update_settings('admin_wallet_address_bnb','Admin wallet address BNB',$admin_wallet_address_bnb);
		
		$admin_wallet_address_ada = trim($request->input('admin_wallet_address_ada'));
        update_settings('admin_wallet_address_ada','Admin wallet address ADA',$admin_wallet_address_ada);
		
		$admin_wallet_address_sol = trim($request->input('admin_wallet_address_sol'));
        update_settings('admin_wallet_address_sol','Admin wallet address SOL',$admin_wallet_address_sol);
		
		$bonus_percentage = trim($request->input('bonus_percentage'));
        update_settings('bonus_percentage','Bonus Percentage',$bonus_percentage);
		
		$referral_commission_percentage = trim($request->input('referral_commission_percentage'));
        update_settings('referral_commission_percentage','Referral Commission Percentage',$referral_commission_percentage);
		
		$contact_email = trim($request->input('contact_email'));
        update_settings('contact_email','Contact Email',$contact_email);
		
		$contact_email_technical = trim($request->input('contact_email_technical'));
        update_settings('contact_email_technical','Contact Email (Technical)',$contact_email_technical);
		
		$contact_email_promotion = trim($request->input('contact_email_promotion'));
        update_settings('contact_email_promotion','Contact Email ( Partnership / Promotion)',$contact_email_promotion);
		
		
		
        return back()->with('success','Settings Updated Successfully !');

    }

    function save_social_media_links(Request $request){
        
        $fb_link = trim($request->input('fb_link'));
        update_settings('fb_link','Facebook Link',$fb_link);

        $twitter_link = trim($request->input('twitter_link'));
        update_settings('twitter_link','Twitter Link',$twitter_link);

        $gplus_link = trim($request->input('gplus_link'));
        update_settings('gplus_link','Goole Plus link',$gplus_link);

        $instagram_link = trim($request->input('instagram_link'));
        update_settings('instagram_link','Instagram Link',$instagram_link);

        $pinterest_link = trim($request->input('pinterest_link'));
        update_settings('pinterest_link','Instagram Link',$pinterest_link);

        $youtube_link = trim($request->input('youtube_link'));
        update_settings('youtube_link','Youtube Link',$youtube_link);
		
		$telegram_link = trim($request->input('telegram_link'));
        update_settings('telegram_link','Telegram Link',$telegram_link);
		
		$reddit_link = trim($request->input('reddit_link'));
        update_settings('reddit_link','Reddit link',$reddit_link);
		
		$github_link = trim($request->input('github_link'));
        update_settings('github_link','Github link',$github_link);
		
		$bitcointalk_link = trim($request->input('bitcointalk_link'));
        update_settings('bitcointalk_link','Bitcointalk Link',$bitcointalk_link);
		
		$medium_link = trim($request->input('medium_link'));
        update_settings('medium_link','Medium Link',$medium_link);
		
		$linkedin_link = trim($request->input('linkedin_link'));
        update_settings('linkedin_link','Linkedin Link',$linkedin_link);
		
        return back()->with('success','Settings Updated Successfully !');
    }
	

    function save_general_token_info(Request $request){
        
        $token_name = trim($request->input('token_name'));
        update_token_info('token_name','Token Name',$token_name);
		
        $contract_address = trim($request->input('contract_address'));
        update_token_info('contract_address','Contract Address',$contract_address);
		
        $token_explorer = trim($request->input('token_explorer'));
        update_token_info('token_explorer','Token Explorer',$token_explorer);
		
        $purchase_methods_accepted = trim($request->input('purchase_methods_accepted'));
        update_token_info('purchase_methods_accepted','Purchase Methods Accepted',$purchase_methods_accepted);
		
		$percentage = trim($request->input('percentage'));
		update_token_info('percentage','Percentage',$percentage);
		
        $hard_cap = trim($request->input('hard_cap'));
        update_token_info('hard_cap','Hard Cap',$hard_cap);
		
        $soft_cap = trim($request->input('soft_cap'));
        update_token_info('soft_cap','Soft Cap',$soft_cap);
		
        $cost_ubex_token = trim($request->input('cost_ubex_token'));
        update_token_info('cost_ubex_token','Cost of 1 UBEX Token',$cost_ubex_token);
		
        $total_supply_tokens = trim($request->input('total_supply_tokens'));
        update_token_info('total_supply_tokens','Total Supply of Tokens',$total_supply_tokens);
		
        $new_token_commissions = trim($request->input('new_token_commissions'));
        update_token_info('new_token_commissions','New Token Commissions',$new_token_commissions);
		
        $key_your_customer_kyc = trim($request->input('key_your_customer_kyc'));
        update_token_info('key_your_customer_kyc','Key Your Customer (KYC)',$key_your_customer_kyc);
		
        $min_purchase_cap = trim($request->input('min_purchase_cap'));
        update_token_info('min_purchase_cap','Min Purchase Cap',$min_purchase_cap);
		
        $max_purchase_cap = trim($request->input('max_purchase_cap'));
        update_token_info('max_purchase_cap','Max Purchase Cap',$max_purchase_cap);
		
        $whitelist = trim($request->input('whitelist'));
        update_token_info('whitelist','Whitelist',$whitelist);
		
        return back()->with('success','Info Updated Successfully !');

    }
	

    function save_ico_phase(Request $request){
        
        $pre_sale = trim($request->input('pre_sale'));
        update_ico_phase('pre_sale','Pre Sale',$pre_sale);
		
		$ico_phase_1 = trim($request->input('ico_phase_1'));
        update_ico_phase('ico_phase_1','ICO Phase I',$ico_phase_1);
		
		$ico_phase_2 = trim($request->input('ico_phase_2'));
        update_ico_phase('ico_phase_2','ICO Phase II',$ico_phase_2);
		
		$ico_phase_3 = trim($request->input('ico_phase_3'));
        update_ico_phase('ico_phase_3','ICO Phase III',$ico_phase_3);
		
		$ico_phase_4 = trim($request->input('ico_phase_4'));
        update_ico_phase('ico_phase_4','ICO Phase IV',$ico_phase_4);
		
        return back()->with('success','Data Updated Successfully !');

    }

    function save_platform_distribution(Request $request){
        
        $tokens_offered = trim($request->input('tokens_offered'));
        update_platform_distribution('tokens_offered','Tokens Offered',$tokens_offered);
		
		$blockchain_platform = trim($request->input('blockchain_platform'));
        update_platform_distribution('blockchain_platform','Blockchain Platform',$blockchain_platform);
		
		$ethereum_mainnet = trim($request->input('ethereum_mainnet'));
        update_platform_distribution('ethereum_mainnet','Ethereum Mainnet',$ethereum_mainnet);
		
		$distrbution_tokens = trim($request->input('distrbution_tokens'));
        update_platform_distribution('distrbution_tokens','Distrbution of Tokens',$distrbution_tokens);
		
		
        return back()->with('success','Data Updated Successfully !');

    }

    function save_landing_page_video(Request $request){
        
        $video_1 = trim($request->input('video_1'));
        update_landing_page_video('video_1','Video 1',$video_1);
		
		$video_2 = trim($request->input('video_2'));
        update_landing_page_video('video_2','Video 2',$video_2);
		
		$video_3 = trim($request->input('video_3'));
        update_landing_page_video('video_3','Video 3',$video_3);
		
		
        return back()->with('success','Video Updated Successfully !');

    }

    function delete_upload(Request $request){
        $image_id = $request->ID;
        if($image_id > 0){
            delete_upload($image_id);
        }
        return back()->with('msg','Uploaded asset deleted successfully !');
    }

    function logout(){
        Session::flush();
        return redirect()->route('admin-login')->with('errmsg','Logged out Successfully!');
    }
	function userlogout(){
		$current_language = get_front_language();
		Session::flush();
        return redirect()->route('login')->with('msg','Logged out Successfully!');
	}
	
	function bulk_delete(Request $request){
		$table_name = $request->input('table');
		$grid_name = $request->input('grid_name');
		$ids = $request->input('ids');
		if(!empty($table_name) && !empty($ids) && is_array($ids) && count($ids) > 0){
			$total_count = count($ids);
			if(count($ids) > 0){
				foreach($ids as $id){
					if($table_name=='contribution'){
					DB::table('transaction')->where('parent_id','=',$id)->delete();
					}
					if($table_name=='translation'){
					DB::table('translation')->where('parent','=',$id)->delete();	
					}
					if($table_name=='users'){
						$users = DB::table('users')->where(array('ID' => $id))->first();
						
						$mail_content = get_email_template_body('account-deleted');
						$mail_subject = get_email_template_subject('account-deleted');
						
						$data = array('name'=>$users->first_name,'email'=>$users->email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
						
						//$data = array('name'=>$users->full_name,'email'=>$users->email);
						$res = Mail::send('mail.temp-del-notify', $data, function ($message) use ($data) {
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
						});
					}
					DB::table($table_name)->where('ID','=',$id)->delete();
				}
			}
			$msg = $total_count.' '._tr($grid_name.'(s) ')._tr('deleted successfully !');
			return back()->with('msg',$msg);
		}else{
			return back()->with('msg',"No item selected !");
		}
		
	}

    function save_doc(Request $request){
		
        $this->validate($request,[
            'name' => 'required',
			'document' => 'required|mimes:pdf,doc,docx,ppt'
        ],[
            'name.required' => 'Please enter document name.',
            'document.required' => 'Please upload a file and File should be PDF, DOC, DOCX or PPT.'
        ]);

        $doc = new Document;

        $doc_name = trim($request->input('name'));
        $status = trim($request->input('status'));
        $is_show_front = trim($request->input('is_show_front'));
        $order = trim($request->input('order'));
        $sameLink = trim($request->input('oexf'));
		
        if($request->hasFile('document'))
        {
            $image = $request->file('document');
			
			if($sameLink == 1){
				
				$upload_id = do_upload_with_file_n_path($image,'documents','0');
				
				if($upload_id > 0){
					$image_id = $upload_id;
					$doc->upload_master_id = $image_id;
				}
			}else{
				$upload_id = do_upload($image,'documents','0');
				if($upload_id > 0){
					$image_id = $upload_id;
					$doc->upload_master_id = $image_id;
				}
			}

        }

        $author_id = Session::get('userid');
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        $doc->name = $doc_name;
        $doc->status = $status;
        $doc->is_show_front = $is_show_front;
        $doc->order = $order;
		
		/*if($is_show_front==1){
			DB::table('documents')
				 ->where('is_show_front','=','1')
				 ->update(['is_show_front'=>'0']);
		} */


        if($doc->save())
        {

            return back()->with('success','Document Created Successfully.');
        }
        else
        {
            return back()->with('error','Document Not Created.');
        }
    }

    function update_doc(Request $request)
    {
        $doc_id = trim($request->input('doc_id'));
		
		if($request->hasFile('document')){

			$this->validate($request,[
				'name' => 'required',
				'document' => 'required|mimes:pdf,doc,docx,ppt,pptx'
			],[
				'name.required' => 'Please enter document name.',
				'document.required' => 'Please upload a file and File should be PDF, DOC, DOCX or PPT.'
			]);
		}else{
			$this->validate($request,[
				'name' => 'required'
			],[
				'name.required' => 'Please enter document name.'
			]);
		}
        $doc = Document::find($doc_id);
		$doc_name = trim($request->input('name'));
        $status = trim($request->input('status'));
        $is_show_front = trim($request->input('is_show_front'));
        $order = trim($request->input('order'));

        $author_id = Session::get('userid');
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        $update_arr['name'] = $doc_name;
        $update_arr['status'] = $status;
		$update_arr['is_show_front'] = $is_show_front;
        $update_arr['order'] = $order;
		
		$sameLink = trim($request->input('oexf'));
		
        if($request->hasFile('document'))
        {
            $image = $request->file('document');
			
			if($sameLink == 1){
				
				$upload_id = do_upload_with_file_n_path($image,'documents','0');
				
				if($upload_id > 0){
					$image_id = $upload_id;
					$doc->upload_master_id = $image_id;
				}
			}else{
				$upload_id = do_upload($image,'documents','0');
				if($upload_id > 0){
					$image_id = $upload_id;
					$doc->upload_master_id = $image_id;
				}
			}

        }

        if($doc->update($update_arr))
        {
			/*if($is_show_front==1){
				DB::table('documents')
					 ->where('is_show_front','=','1')->where('id','!=',$doc_id)
					 ->update(['is_show_front'=>'0']);
			} */
			
            return back()->with('success','Document Updated Successfully.');
        }
        else
        {
            return back()->with('error','Document Not Updated!');
        }
    }
}
