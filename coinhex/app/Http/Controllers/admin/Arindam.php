<?php

namespace App\Http\Controllers\admin;

use App\Faq;
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
use App\Event;
use App\Contact;
use App\Bonus;
use App\Activity;
use App\ExpCat;
use App\Mentor;
use App\Banner;
use App\Kyc;
use App\People;
use App\PeopleCategory;
use Mail;

class Arindam extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function save_event(Request $request)
    {

        $CreateAfterDate = date('Y-m-d',strtotime($request->input('start_date') . ' -1 day '));
        $afterDate = date('d-m-Y', strtotime($CreateAfterDate));

    	$this->validate($request,[
			
			'title' => 'required',
			'description' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|date_format:d-m-Y|after:'.$afterDate,
		],[
		
			'title.required' => 'Please enter event name.',
			'description.required' => 'Please enter event description.',
			'start_date.required' => 'Please enter event start date.',
			'end_date.required' => 'Please enter event end date.',
		]);

    	$title = trim($request->input('title'));
    	$description = trim($request->input('description'));
    	$start_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
    	$end_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
    	$status = $request->input('status');
    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

    	$Event = new Event;
    	$Event->title = $title;
        $Event->slug = is_unique_news_slug($request->input('title'));
    	$Event->description = $description;
    	$Event->start_date = $start_date;
    	$Event->end_date = $end_date;
    	$Event->status = $status;
    	$Event->author_id = $author_id;
    	$Event->created_date = $created_date;
    	$Event->updated_date = $updated_date;
        $Event->is_edc_id = $is_edc_id;
        $Event->is_show_front = $is_show_front;

    	if($Event->save())
    	{
    		if($request->hasFile('event_img'))
    		{
    			$eventID = $Event->id;
    			$imageArr = $request->file('event_img');
    			if(!empty($imageArr) && count($imageArr) != 0)
    			{
    				for($i=0; $i<count($imageArr); $i++)
    				{
    					//echo $image = $imageArr[$i]->getClientOriginalName()."<br/>";
    					$upload_id = do_upload($imageArr[$i],'events',$author_id);
    					if($upload_id > 0)
    					{
    						$values = array('event_id'=>$eventID, 'image_id'=>$upload_id);
    						DB::table('event_photo')->insert($values);
    					}
    				}
    			}
    			
    		}
    		return back()->with('event_success','Event Created Successfully.');
    	}
    	else
    	{
    		return back()->with('event_error','Event Not Created.');
    	}
    }


    function update_event(Request $request)
    {
        $del_img = array();

        $CreateAfterDate = date('Y-m-d',strtotime($request->input('start_date') . ' -1 day '));
        $afterDate = date('d-m-Y', strtotime($CreateAfterDate));
        $event_id = trim($request->input('event_id'));

    	$this->validate($request,[
			
			'title' => 'required',
			'description' => 'required',
			'start_date' => 'required|date',
            'slug' => "required|unique:events,slug,$event_id",
			'end_date' => 'required|date_format:d-m-Y|after:'.$afterDate,
		],[
		
			'title.required' => 'Please enter event name.',
			'description.required' => 'Please enter event description.',
			'start_date.required' => 'Please enter event start date.',
            'end_date.required' => 'Please enter event end date.',
            'slug.required' => 'Please enter url path.',
			'slug.unique' => 'Url path already exist!',
		]);

        $title = trim($request->input('title'));
    	$slug = trim($request->input('slug'));
    	$description = trim($request->input('description'));
    	$start_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
    	$end_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
    	$status = $request->input('status');
    	$author_id = Session::get('userid');
    	$updated_date = date('Y-m-d');
    	$event_id = trim($request->input('event_id'));
        $del_img = $request->input('del_img');
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

        if(!empty($del_img) && count($del_img) > 0){
            foreach ($del_img as $dimg) {
                un_assign_image_id($dimg);
                $delete = DB::table('event_photo')->where('image_id','=',$dimg)->where('event_id','=',$event_id)->delete();
            }
        }
    	
    	$update = DB::table('events')
    			  ->where('ID','=',$event_id)
    			  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'start_date'=>$start_date,'end_date'=>$end_date,'author_id'=>$author_id,'updated_date'=>$updated_date,'status'=>$status,'is_edc_id'=>$is_edc_id,'is_show_front'=>$is_show_front]);

    	if($request->hasFile('event_img'))
		{
			$imageArr = $request->file('event_img');
			if(!empty($imageArr) && count($imageArr) != 0)
			{
				for($i=0; $i<count($imageArr); $i++)
				{
					//echo $image = $imageArr[$i]->getClientOriginalName()."<br/>";
					$upload_id = do_upload($imageArr[$i],'events',$author_id);
					if($upload_id > 0)
					{
						$values = array('event_id'=>$event_id, 'image_id'=>$upload_id);
						$update = DB::table('event_photo')->insert($values);
					}
				}
			}
			
		}

    	if(($update > 0) || ($delete > 0))
    	{
    		
    		return back()->with('event_success','Event Updated Successfully.');
    	}
    	else
    	{
    		return back();
    	}
    }


    function save_contact(Request $request)
    {
    	$this->validate($request,[
			
			'name' => 'required|alpha_spaces',
			'email' => 'required|email',
			'phone' => 'required|digits:10',
		],[
		
			'name.required' => 'Please enter name.',
			'email.required' => 'Please enter email-id.',
			'email.email' => 'Please enter valid email-id.',
			'phone.required' => 'Please enter contact number.',
			'phone.digits' => 'Please enter 10 digits contact number.',
		]);

		$Contact = new Contact;
		$Contact->name = trim(ucfirst($request->input('name')));
		$Contact->email = trim($request->input('email'));
		$Contact->phone = trim($request->input('phone'));
		$Contact->status = 1;
		$Contact->special_note = trim(ucfirst($request->input('special_note')));
		//$Contact->contact_type = trim(ucfirst($request->input('contact_type')));
		$Contact->author_id = Session::get('userid');
		$Contact->created_date = date('Y-m-d');
    	$Contact->updated_date = date('Y-m-d');
       

    	if($Contact->save())
    	{
			$lastInsertedId = $Contact->id;
            return Redirect::route('add-contact',$lastInsertedId)->with('contact_success','Contact Added Successfully !');
    	}
    	else
    	{
    		return back()->with('contact_error','Contact Not Saved');
    	}
    }

    function update_contact(Request $request)
    {
        $contact_id = trim($request->input('contact_id'));

    	$this->validate($request,[
			
			'name' => 'required|alpha_spaces',
			'email' => 'required|email',
			'phone' => 'required|digits:10',
		],[
		
			'name.required' => 'Please enter name.',
			'email.required' => 'Please enter email-id.',
			'email.email' => 'Please enter valid email-id.',
			'phone.required' => 'Please enter contact number.',
			'phone.digits' => 'Please enter 10 digits contact number.',
		]);

		$name = trim(ucfirst($request->input('name')));
		$email = trim($request->input('email'));
		$phone = trim($request->input('phone'));
		//$contact_type = trim($request->input('contact_type'));
		$status = 1;
		$special_note = trim(ucfirst($request->input('special_note')));
    	$updated_date = date('Y-m-d');

    	$update = DB::table('contact')
    			  ->where('ID','=',$contact_id)
    			  ->update(['name'=>$name,'email'=>$email,'phone'=>$phone,'status'=>$status,'special_note'=>$special_note,'updated_date'=>$updated_date]);

    	if($update == 1)
    	{
    		return back()->with('contact_success','Contact Updated Successfully.');
    	}
    	else
    	{
    		return back();
    	}
    }
	
	 function save_plan(Request $request)
    {
    	$this->validate($request,[
			
			'name' => 'required|alpha_spaces',
			'amount' => 'required|amount',
		],[
		
			'name.required' => 'Please enter name.',
			'amount.required' => 'Please enter plan.',
			
		]);

		$plan = new plan;
		$plan->name = trim(ucfirst($request->input('name')));
		$plan->email = trim($request->input('amount'));
		$plan->author_id = Session::get('userid');
		
       

    	if($plan->save())
    	{
			$lastInsertedId = $plan->id;
            return Redirect::route('add-plan',$lastInsertedId)->with('paln_success','Plan Added Successfully !');
    	}
    	else
    	{
    		return back()->with('plan_error','Plan Not Saved');
    	}
    }

    function update_plan(Request $request)
    {
        $plan_id = trim($request->input('plan_id'));

    	$this->validate($request,[
			
			'name' => 'required|alpha_spaces',
			'amount' => 'required|email',
			],[
		
			'name.required' => 'Please enter name.',
			'amount.required' => 'Please enter amount.',
			
		]);

		$name = trim(ucfirst($request->input('name')));
		$email = trim($request->input('amount'));
		
		//$contact_type = trim($request->input('contact_type'));
		$status = 1;
		
    	$update = DB::table('membership_plans')
    			  ->where('ID','=',$contact_id)
    			  ->update(['name'=>$name,'email'=>$email,'phone'=>$phone,'status'=>$status,'special_note'=>$special_note,'updated_date'=>$updated_date]);

    	if($update == 1)
    	{
    		return back()->with('contact_success','Contact Updated Successfully.');
    	}
    	else
    	{
    		return back();
    	}
    }
	
	
	
	
	
	function save_bonus(Request $request)
    {
		$no_higher = trim(ucfirst($request->input('no_higher')));
		
		$validate_array = array('bonus_type' => 'required',
			'bonus_amount' => 'required',
			'lower_range' => 'required',
			'higher_range' => 'required',
			'priority' => 'required');
		$validate_msg_array = array('bonus_type.required' => 'Please select bonus type !',
			'bonus_amount.required' => 'Please enter bonus amount !',
			'lower_range.required' => 'Please enter lower range !',
			'higher_range.required' => 'Please enter higher range !',
			'priority.required' => 'Please enter priority value !');
			
		if($no_higher==1){
			unset($validate_array['higher_range']);
			unset($validate_array['higher_range.required']);
		}
		
    	$this->validate($request,$validate_array,$validate_msg_array);

		$Bonus = new Bonus;
		$Bonus->bonus_type = trim(ucfirst($request->input('bonus_type')));
		$Bonus->bonus_amount = trim($request->input('bonus_amount'));
		$Bonus->lower_range = trim($request->input('lower_range'));
		$Bonus->higher_range = trim($request->input('higher_range'));
		$Bonus->status = trim($request->input('status'));
		$Bonus->priority = trim($request->input('priority'));
		$Bonus->created_date = date('Y-m-d');
    	$Bonus->updated_date = date('Y-m-d');
		if($no_higher==1){
			$Bonus->no_higher = 1;
		}
       

    	if($Bonus->save())
    	{
			$lastInsertedId = $Bonus->id;
            return Redirect::route('add-bonus',$lastInsertedId)->with('bonus_success','Bonus Added Successfully !');
    	}
    	else
    	{
    		return back()->with('bonus_error','Bonus Not Saved');
    	}
    }

    function update_bonus(Request $request)
    {
        $bonus_id = trim($request->input('bonus_id'));
		$no_higher = trim(ucfirst($request->input('no_higher')));
		
    	$validate_array = array('bonus_type' => 'required',
			'bonus_amount' => 'required',
			'lower_range' => 'required',
			'higher_range' => 'required',
			'priority' => 'required');
		$validate_msg_array = array('bonus_type.required' => 'Please select bonus type !',
			'bonus_amount.required' => 'Please enter bonus amount !',
			'lower_range.required' => 'Please enter lower range !',
			'higher_range.required' => 'Please enter higher range !',
			'priority.required' => 'Please enter priority value !');
			
		if($no_higher==1){
			unset($validate_array['higher_range']);
			unset($validate_array['higher_range.required']);
		}
		
    	$this->validate($request,$validate_array,$validate_msg_array);

		$bonus_type = trim(ucfirst($request->input('bonus_type')));
		$bonus_amount = trim($request->input('bonus_amount'));
		$lower_range = trim($request->input('lower_range'));
		$higher_range = trim($request->input('higher_range'));
		$status = trim($request->input('status'));
		$priority = trim($request->input('priority'));
    	$updated_date = date('Y-m-d');
		
		$update_arr = array();
		$update_arr['bonus_type'] = $bonus_type;
		$update_arr['bonus_amount'] = $bonus_amount;
		$update_arr['lower_range'] = $lower_range;
		$update_arr['higher_range'] = $higher_range;
		$update_arr['status'] = $status;
		$update_arr['priority'] = $priority;
		$update_arr['updated_date'] = $updated_date;
		if($no_higher==1){
			$update_arr['no_higher'] = 1;
		}else{
			$update_arr['no_higher'] = 0;
		}
		
    	$update = DB::table('bonus_master')->where('ID','=',$bonus_id)->update($update_arr);

    	if($update == 1)
    	{
    		return back()->with('bonus_success','Bonus Updated Successfully.');
    	}
    	else
    	{
    		return back();
    	}
    }
	
	
	function save_kyc(Request $request)
    {
    	$this->validate($request,[
			'user_id' => 'required',
			'first_name' => 'required|alpha_spaces',
			'last_name' => 'required|alpha_spaces',
			'address1' => 'required',
			'city' => 'required',
			'zipcode' => 'required',
			'document_type' => 'required',
			'email' => 'required|email'
		],[
			'user_id.required' => 'Please select any user.',
			'first_name.required' => 'Please enter first name.',
			'last_name.required' => 'Please enter last name.',
			'address1.required' => 'Please enter address.',
			'city.required' => 'Please enter city.',
			'zipcode.required' => 'Please enter zipcode.',
			'document_type.required' => 'Please enter document type.',
			'email.required' => 'Please enter email address.',
			'email.email' => 'Please enter proper email address.'
		]);

    	$first_name = trim($request->input('first_name'));
    	$last_name = trim($request->input('last_name'));
    	$email = trim($request->input('email'));
    	$phone_number = trim($request->input('phone_number'));
    	$date_of_birth = trim($request->input('date_of_birth'));
    	$nationality = trim($request->input('nationality'));
    	$address1 = trim($request->input('address1'));
    	$address2 = trim($request->input('address2'));
    	$city = trim($request->input('city'));
    	$zipcode = trim($request->input('zipcode'));
    	$telegram_username = trim($request->input('telegram_username'));
    	$document_type = trim($request->input('document_type'));
    	//$wallet_type = trim($request->input('wallet_type'));
    	//$wallet_address = trim($request->input('wallet_address'));
    	$status = trim($request->input('status'));
    	$rejection_cause = trim($request->input('rejection_cause'));
		
    	$user_id = trim($request->input('user_id'));


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
		
		DB::table('kyc')->where('user_id', $user_id)->update(['latest_one' => '0']);
		
    	$Kyc = new Kyc;
    	$Kyc->user_id = $user_id;
    	$Kyc->first_name = $first_name;
    	$Kyc->last_name = $last_name;
    	$Kyc->email = $email;
    	$Kyc->phone_number = $phone_number;
    	$Kyc->date_of_birth = $date_of_birth;
    	$Kyc->nationality = $nationality;
    	$Kyc->address1 = $address1;
    	$Kyc->address2 = $address2;
    	$Kyc->city = $city;
    	$Kyc->zipcode = $zipcode;
    	$Kyc->telegram_username = $telegram_username;
    	$Kyc->document_type = $document_type;
    	//$Kyc->wallet_type = $wallet_type;
    	//$Kyc->wallet_address = $wallet_address;
    	$Kyc->status = $status;
    	$Kyc->rejection_cause = $rejection_cause;
    	$Kyc->latest_one = 1;

    	if($request->hasFile('kyc_img'))
		{
			$image = $request->file('kyc_img');
			$upload_id = do_upload($image,'kyc',$author_id);
			if($upload_id > 0)
			{
				$Kyc->document_upload_id = $upload_id;	
			}
			
		}
		
		if($request->hasFile('kyc_img_2'))
		{
			$image = $request->file('kyc_img_2');
			$upload_id = do_upload($image,'kyc',$author_id);
			if($upload_id > 0)
			{
				$Kyc->document_upload_id_2 = $upload_id;	
			}
			
		}

    	if($Kyc->save())
    	{
    		$lastInsertedId = $Kyc->id;
            return Redirect::route('add-kyc-application',$lastInsertedId)->with('kyc_success','Application Created Successfully !');
			
    		//return back()->with('kyc_success','Application Created Successfully.');
    	}
    	else
    	{
    		return back()->with('kyc_error','Application Not Created.');
    	}
    }


    function update_kyc(Request $request)
    {
        $kyc_id = trim($request->input('kyc_id'));

        $this->validate($request,[
			'first_name' => 'required|alpha_spaces',
			'last_name' => 'required|alpha_spaces',
			'address1' => 'required',
			'city' => 'required',
			'zipcode' => 'required',
			'email' => 'required|email'
		],[
			'first_name.required' => 'Please enter first name.',
			'last_name.required' => 'Please enter last name.',
			'address1.required' => 'Please enter address.',
			'city.required' => 'Please enter city.',
			'zipcode.required' => 'Please enter zipcode.',
			'email.required' => 'Please enter email address.',
			'email.email' => 'Please enter proper email address.'
		]);
		
		
		
		
        $first_name = trim($request->input('first_name'));
    	$last_name = trim($request->input('last_name'));
    	$email = trim($request->input('email'));
    	$phone_number = trim($request->input('phone_number'));
    	$date_of_birth = trim($request->input('date_of_birth'));
    	$nationality = trim($request->input('nationality'));
    	$address1 = trim($request->input('address1'));
    	$address2 = trim($request->input('address2'));
    	$city = trim($request->input('city'));
    	$zipcode = trim($request->input('zipcode'));
    	$telegram_username = trim($request->input('telegram_username'));
    	$document_type = trim($request->input('document_type'));
    	//$wallet_type = trim($request->input('wallet_type'));
    	//$wallet_address = trim($request->input('wallet_address'));
    	$status = trim($request->input('status'));
    	$rejection_cause = trim($request->input('rejection_cause'));


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
		
    	$image_id = trim($request->input('prev_document_upload_id'));
    	$image_id_2 = trim($request->input('prev_document_upload_id_2'));
        $del_img = $request->input('del_img');
        $del_img_2 = $request->input('del_img_2');
       

		
		$update_arr['first_name'] = $first_name;
    	$update_arr['last_name'] = $last_name;
    	$update_arr['email'] = $email;
    	$update_arr['phone_number'] = $phone_number;
    	$update_arr['date_of_birth'] = $date_of_birth;
    	$update_arr['nationality'] = $nationality;
    	$update_arr['address1'] = $address1;
    	$update_arr['address2'] = $address2;
    	$update_arr['city'] = $city;
    	$update_arr['zipcode'] = $zipcode;
    	$update_arr['telegram_username'] = $telegram_username;
    	$update_arr['document_type'] = $document_type;
    	//$update_arr['wallet_type'] = $wallet_type;
    	//$update_arr['wallet_address'] = $wallet_address;
    	$update_arr['status'] = $status;
    	$update_arr['rejection_cause'] = $rejection_cause;
		
		$full_name = $first_name.' '.$last_name;
		if($del_img == 'yes')
        {
            $update = un_assign_image_id($image_id);
            $image_id = 0;
			$update_arr['document_upload_id'] = $image_id;
        }

    	if($request->hasFile('kyc_img'))
		{
			$image = $request->file('kyc_img');
			$upload_id = do_upload($image,'kyc',$author_id);
			if($upload_id > 0)
			{
				$image_id = $upload_id;
				$update_arr['document_upload_id'] = $image_id;
			}
			
		}
		
		if($del_img_2 == 'yes')
        {
            $update = un_assign_image_id($image_id_2);
            $image_id_2 = 0;
			$update_arr['document_upload_id_2'] = $image_id_2;
        }

    	if($request->hasFile('kyc_img_2'))
		{
			$image_2 = $request->file('kyc_img_2');
			$upload_id_2 = do_upload($image_2,'kyc',$author_id);
			if($upload_id_2 > 0)
			{
				$image_id_2 = $upload_id_2;
				$update_arr['document_upload_id_2'] = $image_id_2;
			}
			
		}
		$res_before_update = DB::table('kyc')->where(array('ID' => $kyc_id))->first();
		$previous_status = $res_before_update->status;
    	if(Kyc::where('ID', $kyc_id)->update($update_arr))
    	{
			if($previous_status!=$status){
				if($status==2){ // rejected mail
					//$data = array('name'=>$full_name,'email'=>$email);
					
					$mail_content = get_email_template_body('kyc-rejected');					
					$mail_subject = get_email_template_subject('kyc-rejected');
					$data = array('name'=>$first_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
					
					/* $res = Mail::send('mail.temp-kyc-rejected', $data, function ($message) use ($data) {
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					}); */
				}
				if($status==3){ // information missing mail
					//$data = array('name'=>$full_name,'email'=>$email);
					$mail_content = get_email_template_body('kyc-information-missing');
					$mail_subject = get_email_template_subject('kyc-information-missing');
					$data = array('name'=>$first_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
					
					/* $res = Mail::send('mail.temp-kyc-missing', $data, function ($message) use ($data) {
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					}); */
				}
				if($status==4){ // verified mail
					
					$mail_content = get_email_template_body('kyc-verified');
					$mail_subject = get_email_template_subject('kyc-verified');
					$data = array('name'=>$first_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
					
					//$data = array('name'=>$full_name,'email'=>$email);
					/* $res = Mail::send('mail.temp-kyc-verified', $data, function ($message) use ($data) {
						
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					}); */
					
					$res = DB::table('users')
						 ->where('ID','=',$res_before_update->user_id)
						 ->update(['country'=>$res_before_update->nationality, 'date_of_birth'=>$res_before_update->date_of_birth]);
				}
			}
    		return back()->with('kyc_success','Application Updated Successfully.');
    	}
    	else
    	{
    		//return back()->with('kyc_error','Application Not Updated !');
			return back()->with('kyc_success','Application Updated Successfully.');
    	}
    }
	
	function save_people_cat(Request $request)
    {
    	$this->validate($request,[
			'cat_name' => 'required'
		],[
			'cat_name.required' => 'Please enter First name.'
		]);

    	$parent_category = trim($request->input('parent_category'));
    	$cat_name = trim($request->input('cat_name'));
    	$status = trim($request->input('status'));


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');


    	$PeopleCategory = new PeopleCategory;
    	$PeopleCategory->name = $cat_name;
    	$PeopleCategory->status = $status;
    	

    	if($PeopleCategory->save())
    	{
    		
    		return back()->with('cat_success','Category Created Successfully.');
    	}
    	else
    	{
    		return back()->with('cat_error','Category Not Created.');
    	}
    }


    function update_people_cat(Request $request)
    {
        $cat_id = trim($request->input('cat_id'));

        $this->validate($request,[
			'cat_name' => 'required',
		],[
			'cat_name.required' => 'Please enter First name.'
		]);
		

        $cat_name = trim($request->input('cat_name'));
    	$status = trim($request->input('status'));


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
		

		
		$update_arr['name'] = $cat_name;
    	$update_arr['status'] = $status;
		
		

    	if(PeopleCategory::where('ID', $cat_id)->update($update_arr))
    	{
    		
    		return back()->with('cat_success','Category Updated Successfully.');
    	}
    	else
    	{
    		return back()->with('cat_error','Category Not Updated !');
    	}
    }
	
	function save_people(Request $request)
    {
    	$this->validate($request,[
			'full_name' => 'required|alpha_spaces',
			'designation' => 'required'
		],[
			'full_name.required' => 'Please enter name !',
			'designation.required' => 'Please enter designation !'
		]);

		$lang = get_admin_language();
		
    	$full_name = trim($request->input('full_name'));
    	$description = trim($request->input('description'));
    	$designation = trim($request->input('designation'));
    	$category = trim($request->input('category'));
    	$status = trim($request->input('status'));
    	$link = trim($request->input('link'));
    	$order = trim($request->input('order'));
		


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');


    	$People = new People;
    	$People->full_name = $full_name;
    	$People->description = $description;
    	$People->designation = $designation;
    	$People->category_id = $category;
    	$People->status = $status;
    	$People->link = $link;
		$People->order = $order;
		$People->lang = $lang;
    	
		if($request->hasFile('people_img'))
		{
			$image = $request->file('people_img');
			$upload_id = do_upload($image,'people',$author_id);
			if($upload_id > 0)
			{
				$People->image_id = $upload_id;	
			}
			
		}
		

    	if($People->save())
    	{
    		
    		return back()->with('people_success','People Created Successfully.');
    	}
    	else
    	{
    		return back()->with('people_error','Category Not Created.');
    	}
    }


    function update_people(Request $request)
    {
        $people_id = trim($request->input('people_id'));

        $this->validate($request,[
			'full_name' => 'required|alpha_spaces',
			'designation' => 'required',
		],[
			'full_name.required' => 'Please enter name !',
			'designation.required' => 'Please enter designation !'
		]);
		

	   $lang = get_admin_language();
       $full_name = trim($request->input('full_name'));
       $description = trim($request->input('description'));
	   $designation = trim($request->input('designation'));
	   $category = trim($request->input('category'));
       $status = trim($request->input('status'));
       $del_img = trim($request->input('del_img'));
       $link = trim($request->input('link'));
       $order = trim($request->input('order'));


    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
		

		
		$update_arr['full_name'] = $full_name;
		$update_arr['description'] = $description;
		$update_arr['designation'] = $designation;
		$update_arr['category_id'] = $category;
    	$update_arr['status'] = $status;
    	$update_arr['link'] = $link;
    	$update_arr['order'] = $order;
		
		
		if($del_img == 'yes')
        {
			$image_id = trim($request->input('prev_image_id'));
            $update = un_assign_image_id($image_id);
            $image_id = 0;
			$update_arr['image_id'] = $image_id;
        }

    	if($request->hasFile('people_img'))
		{
			$image = $request->file('people_img');
			$upload_id = do_upload($image,'people',$author_id);
			if($upload_id > 0)
			{
				$image_id = $upload_id;
				$update_arr['image_id'] = $image_id;
			}
			
		}

    	if(People::where('ID', $people_id)->update($update_arr))
    	{
    		
    		return back()->with('people_success','People Updated Successfully.');
    	}
    	else
    	{
    		return back()->with('people_error','People Not Updated !');
    	}
    }
	
	
    function save_activity(Request $request)
    {
        $CreateAfterDate = date('Y-m-d',strtotime($request->input('start_date') . ' -1 day '));
        $afterDate = date('d-m-Y', strtotime($CreateAfterDate));

    	$this->validate($request,[
			
			'title' => 'required',
			'description' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|date_format:d-m-Y|after:'.$afterDate,
		],[
		
			'title.required' => 'Please enter Activity name.',
			'description.required' => 'Please enter Activity description.',
			'start_date.required' => 'Please enter Activity start date.',
			'end_date.required' => 'Please enter Activity end date.',
		]);

    	$title = trim($request->input('title'));

    	$description = trim($request->input('description'));
    	$from_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
    	$to_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
    	$status = $request->input('status');
    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

    	$Activity = new Activity;
    	$Activity->title = $title;
        $Activity->slug = is_unique_activity_plan_slug(trim($request->input('title')));
    	$Activity->description = $description;
    	$Activity->from_date = $from_date;
    	$Activity->to_date = $to_date;
    	$Activity->status = $status;
    	$Activity->author_id = $author_id;
    	$Activity->created_date = $created_date;
    	$Activity->updated_date = $updated_date;
        $Activity->is_edc_id = $is_edc_id;
        $Activity->is_show_front = $is_show_front;

    	if($request->hasFile('activity_img'))
		{
			$image = $request->file('activity_img');
			$upload_id = do_upload($image,'activity_plan',$author_id);
			if($upload_id > 0)
			{
				$Activity->image_id = $upload_id;	
			}
			
		}

    	if($Activity->save())
    	{
    		
    		return back()->with('activity_success','Activity Created Successfully.');
    	}
    	else
    	{
    		return back()->with('activity_error','Activity Not Created.');
    	}
    }


    function update_activity(Request $request)
    {

    	$CreateAfterDate = date('Y-m-d',strtotime($request->input('start_date') . ' -1 day '));
        $afterDate = date('d-m-Y', strtotime($CreateAfterDate));
        $activity_id = trim($request->input('activity_id'));

        $this->validate($request,[
            
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'slug' => "required|unique:activity_plan,slug,$activity_id",
            'end_date' => 'required|date_format:d-m-Y|after:'.$afterDate,
        ],[
        
            'title.required' => 'Please enter Activity name.',
            'description.required' => 'Please enter Activity description.',
            'start_date.required' => 'Please enter Activity start date.',
            'end_date.required' => 'Please enter Activity end date.',
            'slug.required' => 'Please enter URL path.',
            'slug.unique' => 'The Path you provided already exist!',
        ]);

        $title = trim($request->input('title'));
    	$slug = trim($request->input('slug'));
    	$description = trim($request->input('description'));
    	$from_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
    	$to_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
    	$status = $request->input('status');
    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');
    	$activity_id = trim($request->input('activity_id'));
    	$image_id = trim($request->input('prev_img_id'));
        $del_img = $request->input('del_img');
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

        if($del_img == 'yes')
        {
            $update = un_assign_image_id($image_id);
            $image_id = 0;
        }

    	if($request->hasFile('activity_img'))
		{
			$image = $request->file('activity_img');
			$upload_id = do_upload($image,'activity_plan',$author_id);
			if($upload_id > 0)
			{
				$image_id = $upload_id;	
			}
			
		}

		$update = DB::table('activity_plan')
				  ->where('ID','=',$activity_id)
				  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'from_date'=>$from_date,'to_date'=>$to_date,'author_id'=>$author_id,'updated_date'=>$updated_date,'status'=>$status,'image_id'=>$image_id,'is_edc_id'=>$is_edc_id,'is_show_front'=>$is_show_front]);

    	if($update > 0)
    	{
    		
    		return back()->with('activity_success','Activity Updated Successfully.');
    	}
    	else
    	{
    		return back();
    	}
    }


    function add_exp_cat(Request $request)
    {
       $this->validate($request,[
            
            'category_name' => 'required|unique:expertise_category,category_name,'.$request->input('category_name'),
        ],[
        
            'category_name.required' => 'Please enter category name.',
        ]);

        $ExpCat = new ExpCat;
        $ExpCat->category_name = trim(ucfirst($request->input('category_name')));
        $ExpCat->category_slug = str_slug($request->input('category_name'),'-');
        $ExpCat->parent_id = trim($request->input('parent_id')) == '' ? 0 : trim($request->input('parent_id'));
        $ExpCat->author_id = Session::get('userid');
        $ExpCat->status = '1';
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        if($ExpCat->save())
        {
            return back()->with('success','Expertise category Added Successfully.');
        }
        else
        {
            return back()->with('error','Category Not Created.');
        }
    }

    function upd_exp_cat(Request $request)
    {
        $this->validate($request,[
            
            'category_name' => 'required',
        ],[
        
            'category_name.required' => 'Please enter category name.',
        ]);

        $category_name = trim(ucfirst($request->input('category_name')));
        $category_slug = str_slug($request->input('category_name'),'-');
        $parent_id = trim($request->input('parent_id')) == '' ? 0 : trim($request->input('parent_id'));
        $author_id = Session::get('userid');
        $status = '1';
        $updated_date = date('Y-m-d');
        $cat_id = trim($request->input('cat_id'));

        $update = DB::table('expertise_category')
                  ->where('ID','=',$cat_id)
                  ->update(['category_name'=>$category_name,'category_slug'=>$category_slug,'parent_id'=>$parent_id,'author_id'=>$author_id,'status'=>$status,'updated_date'=>$updated_date]);

        if($update == 1)
        {
            return redirect()->route('manage-expertise-category')->with('success','Expertise category Updated Successfully.');
        }
        else
        {
            return back()->with('error','Category Not Updated.');
        }
    }

    function save_mentor(Request $request)
    {
        $this->validate($request,[
            
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'salutation' => 'required',
            'email' => 'required|email|unique:mentors,email',
        ],[
        
            'first_name.required' => 'Please enter first name.',
            'last_name.required' => 'Please enter last name.',
            'salutation.required' => 'Please enter salutation.',
            'email.required' => 'Please enter email-id.',
        ]);

        $Mentor = new Mentor;
        $Mentor->first_name = trim(ucfirst($request->input('first_name')));
        $Mentor->last_name = trim(ucfirst($request->input('last_name')));
        $Mentor->email = trim($request->input('email'));
        $Mentor->status = trim($request->input('status'));
        $Mentor->description = trim($request->input('description'));
        $Mentor->author_id = Session::get('userid');
        $Mentor->salutation = trim($request->input('salutation'));
        $Mentor->designation = trim($request->input('designation'));
        $Mentor->created_date = date('Y-m-d');
        $Mentor->updated_date = date('Y-m-d');
        $Mentor->phone_no = serialize($request->input('phone_no'));
        $catArr = $request->input('category_id');
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');
        $Mentor->is_edc_id = $is_edc_id;
        $Mentor->is_show_front = $is_show_front;
        
        if($request->hasFile('mentor_img'))
        {
            $image = $request->file('mentor_img');
            $upload_id = do_upload($image,'mentors',Session::get('userid'));
            if($upload_id > 0)
            {
                $Mentor->image_id = $upload_id;   
            }
            
        }

        if($Mentor->save())
        {
            $menID = $Mentor->id;
            if(!empty($catArr) && count($catArr) > 0)
            {
                foreach($catArr as $cid)
                {
                    $v = array('mentor_id'=>$menID, 'category_id'=>$cid, 'status'=>'1');
                    DB::table('mentor_expertise_map')->insert($v);
                }
            }

            return back()->with('success','Mentor Added Successfully.');
        }
        else
        {
            return back()->with('error','Mentor Not Created.');
        }
    }

    function update_mentor(Request $request)
    {

        $mentor_id = trim($request->input('mentor_id'));

        $this->validate($request,[
            
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'salutation' => 'required',
            'email' => 'required|email|unique:mentors,email,'.$mentor_id,
        ],[
        
            'first_name.required' => 'Please enter first name.',
            'last_name.required' => 'Please enter last name.',
            'salutation.required' => 'Please enter salutation.',
            'email.required' => 'Please enter email-id.',
        ]);

        $first_name = trim(ucfirst($request->input('first_name')));
        $last_name = trim(ucfirst($request->input('last_name')));
        $email = trim($request->input('email'));
        $status = trim($request->input('status'));
        $description = trim($request->input('description'));
        $salutation = trim($request->input('salutation'));
        $designation = trim($request->input('designation'));
        $author_id = Session::get('userid');
        $updated_date = date('Y-m-d');
        $phone_no = serialize($request->input('phone_no'));
        $catArr = $request->input('category_id');
        $image_id = trim($request->input('prev_img_id'));
        $del_img = $request->input('del_img');
        $is_edc_id = $request->input('is_edc_id');
        $is_show_front = $request->input('is_show_front');

        if($del_img == 'yes')
        {
            $delete = un_assign_image_id($image_id);
            $image_id = 0;
        }

        if($request->hasFile('mentor_img'))
        {
            $image = $request->file('mentor_img');
            $update = $upload_id = do_upload($image,'mentors',Session::get('userid'));
            if($upload_id > 0)
            {
                $image_id = $upload_id;   
            }
            
        }

        $update = DB::table('mentors')
                  ->where('ID','=',$mentor_id)
                  ->update(['first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'phone_no'=>$phone_no,'author_id'=>$author_id,'status'=>$status,'updated_date'=>$updated_date,'description'=>$description,'image_id'=>$image_id,'salutation'=>$salutation,'designation'=>$designation,'is_edc_id'=>$is_edc_id,'is_show_front'=>$is_show_front]);


        $delete = DB::table('mentor_expertise_map')->where('mentor_id','=',$mentor_id)->delete();
        
        if(!empty($catArr) && count($catArr) > 0)
        {
            foreach($catArr as $cid)
            {
                $v = array('mentor_id'=>$mentor_id, 'category_id'=>$cid, 'status'=>'1');
                $update1 = DB::table('mentor_expertise_map')->insert($v);
            }
        }

        if($update > 0 || (isset($delete) && $delete > 0) || (isset($update1) && $update1 > 0))
        {
            return back()->with('success','Mentor Updated Successfully.');
        }
        else
        {
            return back();   
        }
    }

    function save_edit_profile(Request $request)
    {
        $id = trim($request->input('rowID'));
        
        $edc_name = trim($request->input('edc_name'));

        $edc_email = trim($request->input('edc_email'));
        

        $this->validate($request,[
            'edc_name' => 'required',
            'edc_email' => "required|email|unique:users,email,$id",
        ],[
        
             'edc_name.required' => 'Please enter EDC name !',
             'edc_email.required' => 'Please enter EDC email !',
             'edc_email.email' => 'Please enter Valid Email !',
             'edc_email.unique' => "Email Id: $edc_email already Exist, Please Try with another !"
        ]);

        $update_array['email'] = $edc_email;
        $update_array['full_name'] = $edc_name;

        $user_id = $id;
		
		/*
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_id = do_upload($logo,'users',$user_id);
            $update_array['logo_id'] = $logo_id;
            if($saved_logo_id > 0){
                un_assign_image_id($saved_logo_id);
            }
        }

        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_id = do_upload($banner_image,'users',$user_id);
            $update_array['banner_id'] = $banner_id;
            if($saved_banner_id > 0){
                un_assign_image_id($saved_banner_id);
            }
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
            $update_array['list_image_id'] = $list_image_id;
            if($saved_list_image_id > 0){
                un_assign_image_id($saved_list_image_id);
            }
        }

        if($remove_list_image=='yes' && $saved_list_image_id > 0){
            DB::table('users')->where('ID', $user_id)->update(array('list_image_id'=>'0'));
            un_assign_image_id($saved_list_image_id);
        }

		*/
           
        $up = DB::table('users')->where('ID', $user_id)->update($update_array);
		

        if($up > 0)
        {
            return back()->with('success','Your Profile Saved Successfully, Thankyou.');
        }
        else
        {
            return back();
        }
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

        $sql = DB::table('users')
               ->where('ID','=',Session::get('userid'))
               ->select('password')->first();

        if(!empty($sql) && Hash::check($cpwd, $sql->password))
        {
            $up = DB::table('users')
                  ->where('ID','=',Session::get('userid'))
                  ->update(['password'=>$npwd]);

            if($up > 0)
            {
                return back()->with('success','New Password Updated Successfully.');
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


    function upload_banner(Request $request)
    {
        $this->validate($request,[
            
            'banner_img' => 'required|image|mimes:jpeg,jpg,png|dimensions:min_width=1920,min_height=850'        
        ],[
        
            'banner_img.required' => 'Please select banner image',
            'banner_img.dimensions' => 'Banner dimensions should be (1920 x 851)'
        ]);

        $Banner = new Banner;

        if($request->hasFile('banner_img'))
        {
            $image = $request->file('banner_img');
            $upload_id = do_upload($image,'banner',Session::get('userid'));
            if($upload_id > 0)
            {
                $Banner->image_id = $upload_id;   
            }

            $Banner->title = trim($request->input('banner_title'));
            $Banner->status = $request->input('status');
            $Banner->author_id = Session::get('userid');
            $Banner->created_date = date('Y-m-d');
            $Banner->updated_date = date('Y-m-d');

            if($Banner->save())
            {
                return back()->with('success','Banner Uploaded Successfully.');
            }
            
        }

        return back();
    }


    function update_banner(Request $request)
    {
        $this->validate($request,[
            
            'banner_img' => 'image|mimes:jpeg,jpg,png|dimensions:min_width=1920,min_height=850'        
        ],[
        
            'banner_img.dimensions' => 'Banner dimensions should be (1920 x 851)'
        ]);

        $ID = $request->input('banner_id');
        $image_id = $request->input('prev_image_id');
        
        $title = trim($request->input('banner_title'));
        $status = $request->input('status');
        $updated_date = date('Y-m-d');

        if($request->hasFile('banner_img'))
        {
            $image = $request->file('banner_img');
            $upload_id = do_upload($image,'banner',Session::get('userid'));
            $image_id = $upload_id;
        }

        $update = DB::table('banner')
                ->where('ID','=',$ID)
                ->update(['title'=>$title,'image_id'=>$image_id,'status'=>$status,'updated_date'=>$updated_date]);

        if($update > 0)
        {
            return back()->with('success','Banner Image Updated Successfully.');            
        }

        return back();
    }


    function save_webman(Request $request){

        $this->validate($request,[
            
            'full_name' => 'required|regex:/^[a-z A-Z]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone_no' => 'digits:10|unique:users,phone_no',
        
        ],[
        
            'full_name.required' => 'Please enter name.',
            'email.required' => 'Please enter email-id.',
            'email.email' => 'Please enter valid email-id.',
            'password.required' => 'please enter password.',
            'phone_no.digits' => 'Please enter 10 digits contact number.'
            
        ]);

        $full_name = trim($request->input('full_name'));
        $email = trim($request->input('email'));
        $password = Hash::make(trim($request->input('password')));
        $user_address = trim($request->input('user_address'));
        $phone_no = trim($request->input('phone_no'));
        $status = trim($request->input('status'));
        $role_id = '3';
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');

        $ins = DB::table('users')
             ->insertGetId(['full_name'=>$full_name,'email'=>$email,'phone_no'=>$phone_no,'password'=>$password,'user_address'=>$user_address,'status'=>$status,'role_id'=>$role_id,'created_date'=>$created_date,'updated_date'=>$updated_date]);

        

        if($ins > 0){
            return redirect()->route('add-webman', $ins)->with('success','New Web manager created successfully.');
        }

        return back()->with('error','Something went wrong!!!');
    }


    function update_webman(Request $request){

        $webman_id = trim($request->input('webman_id'));

        $this->validate($request,[
            
            'full_name' => 'required|regex:/^[a-z A-Z]+$/',
            'email' => 'required|email|unique:users,email,'.$webman_id,
            'phone_no' => 'digits:10|unique:users,phone_no,'.$webman_id,
        
        ],[
        
            'full_name.required' => 'Please enter name.',
            'email.required' => 'Please enter email-id.',
            'email.email' => 'Please enter valid email-id.',
            'phone_no.digits' => 'Please enter 10 digits contact number.'
            
        ]);

        $full_name = trim($request->input('full_name'));
        $email = trim($request->input('email'));
        //$password = trim($request->input('password'));
        $user_address = trim($request->input('user_address'));
        $phone_no = trim($request->input('phone_no'));
        $status = trim($request->input('status'));
        $updated_date = date('Y-m-d');

        $ups = DB::table('users')
             ->where('ID','=',$webman_id)
             ->update(['full_name'=>$full_name,'email'=>$email,'phone_no'=>$phone_no,'user_address'=>$user_address,'status'=>$status,'updated_date'=>$updated_date]);

        

        if($ups > 0){
            return redirect()->route('add-webman', $webman_id)->with('success','Web manager updated successfully.');
        }

        return back();
    }

    function edc_approve(Request $request){
        $ID = trim($request->input('ID'));
        $r = DB::table('users')
           ->where('ID','=',$ID)
           ->where('role_id','=','2')
           ->update(['is_activated'=>'1']);
        echo $r;
    }

    function save_faq(Request $request)
    {
        $this->validate($request,[
            'question' => 'required',
            'answer' => 'required'
        ],[
            'question.required' => 'Please enter question !',
            'answer.required' => 'Please enter answer!'
        ]);

        $question = trim($request->input('question'));
        $answer = trim($request->input('answer'));
        $status = trim($request->input('status'));
        $order = trim($request->input('order'));

        //$author_id = Session::get('userid');
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');


        $faq = new Faq;
        $faq->question = $question;
        $faq->answer = $answer;
        $faq->status = $status;
        $faq->order = $order;

        if($faq->save())
        {
            return back()->with('success','Faq Created Successfully.');
        }
        else
        {
            return back()->with('error','Faq Not Created.');
        }
    }


    function update_faq(Request $request)
    {
        $faq_id = trim($request->input('faq_id'));

        $this->validate($request,[
            'question' => 'required',
            'answer' => 'required'
        ],[
            'question.required' => 'Please enter question !',
            'answer.required' => 'Please enter answer!'
        ]);


        $question = trim($request->input('question'));
        $answer = trim($request->input('answer'));
        $status = trim($request->input('status'));
        $order = trim($request->input('order'));


        //$author_id = Session::get('userid');
        $created_date = date('Y-m-d');
        $updated_date = date('Y-m-d');



        $update_arr['question'] = $question;
        $update_arr['answer'] = $answer;
        $update_arr['status'] = $status;
        $update_arr['order'] = $order;

        if(Faq::where('id', $faq_id)->update($update_arr))
        {

            return back()->with('success','Faq Updated Successfully.');
        }
        else
        {
            return back()->with('error','Faq Not Updated !');
        }
    }


}