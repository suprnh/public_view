<?php

namespace App\Http\Controllers\edc;

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
use App\Activity;
use App\ExpCat;
use App\Mentor;
use App\Centers;
use Mail;

class ArindamEdc extends BaseController
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
        $Event->is_edc_id = $author_id;

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
			'slug.unique' => 'url path already exist!',
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

        if(!empty($del_img) && count($del_img) > 0){
            foreach ($del_img as $dimg) {
                un_assign_image_id($dimg);
                $delete = DB::table('event_photo')->where('image_id','=',$dimg)->where('event_id','=',$event_id)->delete();
            }
        }
    	
    	$update = DB::table('events')
    			  ->where('ID','=',$event_id)
    			  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'start_date'=>$start_date,'end_date'=>$end_date,'author_id'=>$author_id,'updated_date'=>$updated_date,'status'=>$status]);

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
			
			'name' => 'required|regex:/^[a-z A-Z]+$/',
			'email' => 'required|email|unique:contact,email',
			'phone' => 'required|digits:10|unique:contact,phone',
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
		$Contact->status = trim($request->input('status'));
		$Contact->special_note = trim(ucfirst($request->input('special_note')));
		$Contact->author_id = Session::get('userid');
		$Contact->created_date = date('Y-m-d');
    	$Contact->updated_date = date('Y-m-d');
        $Contact->is_edc_id = Session::get('userid');

    	if($Contact->save())
    	{
    		return back()->with('contact_success','Contact Added Successfully.');
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
			
			'name' => 'required|regex:/^[a-z A-Z]+$/',
			'email' => 'required|email|unique:contact,email,'.$contact_id,
			'phone' => 'required|digits:10,'.$contact_id,
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
		$status = trim($request->input('status'));
		$special_note = trim(ucfirst($request->input('special_note')));
		$author_id = Session::get('userid');
    	$updated_date = date('Y-m-d');

    	$update = DB::table('contact')
    			  ->where('ID','=',$contact_id)
    			  ->update(['name'=>$name,'email'=>$email,'phone'=>$phone,'status'=>$status,'special_note'=>$special_note,'author_id'=>$author_id,'updated_date'=>$updated_date]);

    	if($update == 1)
    	{
    		return back()->with('contact_success','Contact Updated Successfully.');
    	}
    	else
    	{
    		return back();
    	}
    }

    function save_activity(Request $request)
    {
        $CreateAfterDate = date('Y-m-d',strtotime($request->input('start_date') . ' -1 day '));
        $afterDate = date('d-m-Y', strtotime($CreateAfterDate));
        //echo$afterDate; die;

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
    	$slug = is_unique_activity_plan_slug(trim($request->input('title')));
    	$description = trim($request->input('description'));
    	$from_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
    	$to_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
    	$status = $request->input('status');
    	$author_id = Session::get('userid');
    	$created_date = date('Y-m-d');
    	$updated_date = date('Y-m-d');

    	$Activity = new Activity;
        $Activity->title = $title;
    	$Activity->slug = $slug;
    	$Activity->description = $description;
    	$Activity->from_date = $from_date;
    	$Activity->to_date = $to_date;
    	$Activity->status = $status;
    	$Activity->author_id = $author_id;
    	$Activity->created_date = $created_date;
    	$Activity->updated_date = $updated_date;
        $Activity->is_edc_id = $author_id;

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
        //echo$afterDate; die;

        $this->validate($request,[
            
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date_format:d-m-Y|after:'.$afterDate,
            'slug' => "required|unique:activity_plan,slug,$activity_id",
        ],[
        
            'title.required' => 'Please enter Activity name.',
            'description.required' => 'Please enter Activity description.',
            'start_date.required' => 'Please enter Activity start date.',
            'end_date.required' => 'Please enter Activity end date.',
            'slug.required' => 'Please enter url path',
            'slug.unique' => 'Url path already exist!',
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
				  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'from_date'=>$from_date,'to_date'=>$to_date,'author_id'=>$author_id,'updated_date'=>$updated_date,'status'=>$status,'image_id'=>$image_id]);

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
            
            'category_name' => 'required|unique:expertise_category,category_name',
        ],[
        
            'category_name.required' => 'Please enter category name.',
        ]);

        $ExpCat = new ExpCat;
        $ExpCat->category_name = trim(ucfirst($request->input('category_name')));
        $ExpCat->category_slug = str_slug($request->input('category_name'),'-');
        $ExpCat->parent_id = trim($request->input('parent_id')) == '' ? 0 : trim($request->input('parent_id'));
        $ExpCat->author_id = Session::get('userid');
        $ExpCat->status = '0';
        $ExpCat->created_date = date('Y-m-d');
        $ExpCat->updated_date = date('Y-m-d');

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
        $cat_id = trim($request->input('cat_id'));

        $this->validate($request,[
            
            'category_name' => 'required|unique:expertise_category,category_name,'.$cat_id,
        ],[
        
            'category_name.required' => 'Please enter category name.',
        ]);

        $category_name = trim(ucfirst($request->input('category_name')));
        $category_slug = str_slug($request->input('category_name'),'-');
        $parent_id = trim($request->input('parent_id')) == '' ? 0 : trim($request->input('parent_id'));
        $author_id = Session::get('userid');
        $status = '0';
        $updated_date = date('Y-m-d');
        
        $update = DB::table('expertise_category')
                  ->where('ID','=',$cat_id)
                  ->update(['category_name'=>$category_name,'category_slug'=>$category_slug,'parent_id'=>$parent_id,'author_id'=>$author_id,'status'=>$status,'updated_date'=>$updated_date]);

        if($update == 1)
        {
            return redirect()->route('edc-manage-expertise-category')->with('success','Expertise category Updated Successfully.');
        }
        else
        {
            return back();
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
        $Mentor->salutation = trim($request->input('salutation'));
        $Mentor->designation = trim($request->input('designation'));
        $Mentor->author_id = Session::get('userid');
        $Mentor->created_date = date('Y-m-d');
        $Mentor->updated_date = date('Y-m-d');
        $Mentor->phone_no = serialize($request->input('phone_no'));
        $catArr = $request->input('category_id');
        $Mentor->is_edc_id = Session::get('userid');
        
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
                  ->update(['first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'phone_no'=>$phone_no,'author_id'=>$author_id,'status'=>$status,'updated_date'=>$updated_date,'description'=>$description,'image_id'=>$image_id,'salutation'=>$salutation,'designation'=>$designation]);


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
        $logo_id = trim($request->input('saved_logo_id'));
        $banner_id = trim($request->input('saved_banner_id'));

        $edc_name = trim($request->input('edc_name'));
        $edc_description = trim($request->input('edc_description'));
        $edc_email = trim($request->input('edc_email'));
        $edc_phone = trim($request->input('edc_phone'));
        $edc_address = trim($request->input('edc_address'));
        $edc_website = trim($request->input('edc_website'));
        $saved_banner_id = trim($request->input('saved_banner_id'));
        $saved_logo_id = trim($request->input('saved_logo_id'));
        $saved_list_image_id = trim($request->input('saved_list_image_id'));
        $remove_logo = trim($request->input('remove_logo'));
        $remove_banner = trim($request->input('remove_banner'));
        $remove_list_image = trim($request->input('remove_list_image'));

        $fb_link = trim($request->input('fb_link'));
        $twitter_link = trim($request->input('twitter_link'));
        $gplus_link = trim($request->input('gplus_link'));

        $social_link['fb_link'] = $fb_link;
        $social_link['twitter_link'] = $twitter_link;
        $social_link['gplus_link'] = $gplus_link;

        $this->validate($request,[
            'edc_name' => 'required',
            'edc_description' => 'required',
            'edc_email' => "required|email|unique:users,email,$id",
        ],[
        
             'edc_name.required' => 'Please enter EDC name !',
             'edc_description.required' => 'Please enter EDC description!',
             'edc_email.required' => 'Please enter EDC email !',
             'edc_email.email' => 'Please enter Valid Email !',
             'edc_email.unique' => "Email Id: $edc_email already Exist, Please Try with another !"
        ]);

        $update_array['email'] = $edc_email;
        $update_array['full_name'] = $edc_name;
        $update_array['user_bio'] = $edc_description;
        $update_array['phone_no'] = $edc_phone;
        $update_array['user_address'] = $edc_address;
        $update_array['website'] = $edc_website;
        $update_array['social_links'] = serialize($social_link);

        $user_id = $id;

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

    function event_calender()
    {
        $events = DB::table('events')
                ->where('author_id','=',Session::get('userid'))
                ->where('status','=','1')
                ->orderBy('ID','DESC')
                ->take(10)->get();
                
        return view('edc.event-calendar',['cal_data'=>$events]);
    }

    function quick_add_event(Request $request)
    {
        $title = trim($request->input('title'));
        $start_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
        $end_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
        $event_color = trim($request->input('event_color'));

        $Event = new Event;
        $Event->title = $title;
        $Event->description = "";
        $Event->start_date = $start_date;
        $Event->end_date = $end_date;
        $Event->status = "1";
        $Event->event_color = $event_color;
        $Event->author_id = Session::get('userid');
        $Event->created_date = date('Y-m-d');
        $Event->updated_date = date('Y-m-d');
        $Event->is_edc_id = Session::get('userid');

        if($Event->save())
        {
            return back()->with('event_success','New event created successfully, thankyou.');
        }

        return back();
    }

    function quick_update_event(Request $request)
    {
        $title = trim($request->input('title'));
        $start_date = date('Y-m-d', strtotime(trim($request->input('start_date'))));
        $end_date = date('Y-m-d', strtotime(trim($request->input('end_date'))));
        $event_color = trim($request->input('event_color'));
        $event_id = trim($request->input('ev_id'));

        $update = DB::table('events')
                ->where('author_id','=',Session::get('userid'))
                ->where('ID','=',$event_id)
                ->update(['title'=>$title,'start_date'=>$start_date,'end_date'=>$end_date,'event_color'=>$event_color]);

        if($update > 0)
        {
            return back()->with('event_success','Event updated successfully, thankyou.');
        }

        return back();
    }

    function ajx_event_modify(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->input('start')));
        $end_date = date('Y-m-d', strtotime($request->input('end')));
        $ID = $request->input('id');

        DB::table('events')
        ->where('author_id','=',Session::get('userid'))
        ->where('ID','=',$ID)
        ->update(['start_date'=>$start_date,'end_date'=>$end_date]);
    }

    function save_branch(Request $request)
    {
        $this->validate($request,[
            'center_name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ],[
            'center_name.required' => 'Please enter center name !',
            'description.required' => 'Please enter description !',
            'address.required' => 'Please enter address !',
        ]);

        $Centers = new Centers();
        $Centers->name = trim($request->input('center_name'));
        $Centers->description = trim($request->input('description'));
        $Centers->status = trim($request->input('status'));
        $Centers->address = trim($request->input('address'));
        $Centers->author_id = Session::get('userid');
        $Centers->parent_id = Session::get('userid');
        $Centers->created_date = date('Y-m-d');
        $Centers->updated_date = date('Y-m-d');
        $Centers->image_id = '0';
        $Centers->is_edc_id = Session::get('userid');

        if ($request->hasFile('center_img')) {
            $center_image = $request->file('center_img');
            $upload_id = do_upload($center_image,'center',Session::get('userid'));
            $Centers->image_id = $upload_id;
        }

        if($Centers->save())
        {
            $center_id = $Centers->id;
            return redirect()->route('edc-add-branch',$center_id)->with('success','Your branch created successfully.');
        }
        else
        {
            return back()->with('error','Something went wrong. Branch not created.');
        }


    }

    function update_branch(Request $request)
    {
        $this->validate($request,[
            'center_name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ],[
            'center_name.required' => 'Please enter center name !',
            'description.required' => 'Please enter description !',
            'address.required' => 'Please enter address !',
        ]);

        $name = trim($request->input('center_name'));
        $description = trim($request->input('description'));
        $status = trim($request->input('status'));
        $address = trim($request->input('address'));
        $updated_date = date('Y-m-d');
        $image_id = trim($request->input('prev_img_id'));
        $center_id = trim($request->input('center_id'));
        $del_img = trim($request->input('del_img'));

        if($del_img == 'yes' && $image_id > 0){
            un_assign_image_id($image_id);
            $image_id = 0;
        }

        if($request->hasFile('center_img')) {
            $center_image = $request->file('center_img');
            $upload_id = do_upload($center_image,'center',Session::get('userid'));
            $image_id = $upload_id;
        }

        $update = DB::table('centers')
                ->where('ID','=',$center_id)
                ->update(['name'=>$name,'description'=>$description,'address'=>$address,'image_id'=>$image_id,'status'=>$status,'updated_date'=>$updated_date]);

        if($update > 0)
        {
            return back()->with('success','Branch updated successfully.');
        }

        return back();

    }


    function ajax_status_update(Request $request)
    {
        $table_name = trim($request->input('tab_name'));
        $ID = trim($request->input('ID'));
        $status = trim($request->input('status'));
		if($table_name=='kyc'){
			$res_before_update = DB::table('kyc')->where(array('ID' => $ID))->first();
			$previous_status = $res_before_update->status;
			$full_name = $res_before_update->first_name.' '.$res_before_update->last_name;
			$first_name = $res_before_update->first_name;
			$email = $res_before_update->email;
			if($previous_status!=$status){
				if($status==2){ // rejected mail
					
					$mail_content = get_email_template_body('kyc-rejected');					
					$mail_subject = get_email_template_subject('kyc-rejected');
					$data = array('name'=>$first_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
					
					/* $res = Mail::send('mail.temp-kyc-rejected', $data, function ($message) use ($data) {
						//$message->from('support@highbank.io', 'Highbank');
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					}); */
				}
				if($status==3){ // information missing mail
					$mail_content = get_email_template_body('kyc-information-missing');
					$mail_subject = get_email_template_subject('kyc-information-missing');
					$data = array('name'=>$first_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
					
					/* $res = Mail::send('mail.temp-kyc-missing', $data, function ($message) use ($data) {
						//$message->from('support@highbank.io', 'Highbank');
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					}); */
				}
				if($status==4){ // verified mail
					$mail_content = get_email_template_body('kyc-verified');
					$mail_subject = get_email_template_subject('kyc-verified');
					$data = array('name'=>$first_name,'email'=>$email,'mail_subject'=>$mail_subject,'mail_content'=>$mail_content);
					
					/* $res = Mail::send('mail.temp-kyc-verified', $data, function ($message) use ($data) {
						//$message->from('support@highbank.io', 'Highbank');
						$message->to($data['email'], $data['name'])->subject($data['mail_subject']);
					}); */
					
					$res = DB::table('users')
						 ->where('ID','=',$res_before_update->user_id)
						 ->update(['country'=>$res_before_update->nationality, 'date_of_birth'=>$res_before_update->date_of_birth]);
				}
			}
		}
        $res = DB::table($table_name)
             ->where('ID','=',$ID)
             ->update(['status'=>$status]);
		if($table_name=='translation'){
			DB::table($table_name)
             ->where('parent','=',$ID)
             ->update(['status'=>$status]);
		}
		
        if($res > 0){
            return "OK";
        }
    }
	
	function ajax_done_update(Request $request)
    {
        $table_name = trim($request->input('tab_name'));
        $ID = trim($request->input('ID'));
        $status = trim($request->input('status'));
        $res = DB::table($table_name)
             ->where('ID','=',$ID)
             ->update(['is_done'=>$status]);
        if($res > 0){
			session()->flash('msg', 'status updated !');
            return "OK";
        }
    }
	
	function ajax_order_update(Request $request)
    {
        $table_name = trim($request->input('tab_name'));
        $ID = trim($request->input('ID'));
        $val = trim($request->input('val'));
        $res = DB::table($table_name)
             ->where('ID','=',$ID)
             ->update(['order'=>$val]);
        if($res > 0){
			session()->flash('msg', 'Order updated successfully !');
            return "OK";
        }
    }

    function ajax_isfront_update(Request $request)
    {
		
        $table_name = trim($request->input('tab_name'));
        $ID = trim($request->input('ID'));
        $ID_type = trim($request->input('ID_type'));
        $is_show_front = trim($request->input('is_show_front'));
		if($ID_type=='is_front'){
			if($table_name=='whitepaper'){
				 
				$lang = get_admin_language();
				$res = DB::table($table_name)
				 ->where('ID','=',$ID)
				 ->update(['is_show_front'=>$is_show_front]);
				 
				DB::table($table_name)
				 ->where('is_show_front','=','1')->where('ID','!=',$ID)->where('lang','=',$lang)
				 ->update(['is_show_front'=>'0']);
				 
			}else{
			$res = DB::table($table_name)
				 ->where('ID','=',$ID)
				 ->update(['is_show_front'=>$is_show_front]);	
			}
		}else{
		 $res = DB::table($table_name)
             ->where('ID','=',$ID)
             ->update(['is_activated'=>$is_show_front]);
		}
        if($res > 0){
            return "OK";
        }
    }
	
	function set_lng(Request $request){
		$language_code = trim($request->input('language_code'));
		if(!empty($language_code)){
			Session::put('language_code', $language_code);
		}
	}
}