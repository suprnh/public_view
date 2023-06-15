<?php
use Illuminate\Support\Str;


if (!function_exists('human_file_size')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function human_file_size($bytes, $decimals = 2)
    {
        $sz = 'BKMGTPE';
        $factor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $sz[$factor];
 
    }
}

if (!function_exists('do_upload')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function do_upload($request_obj,$parent_table,$parent_id=0)
    {
        $resource_id = 0;

        $file = $request_obj->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        $fname = is_duplicate_file_name(Str::slug($filename).'.'.$request_obj->getClientOriginalExtension());
        $type = $request_obj->getMimeType();

        $this_month = date('m');
        $this_year = date('Y');
        $destination_folder = 'uploads/'.$this_year.'/'.$this_month;
        $destinationPath = public_path('/'.$destination_folder);
        $author_id = get_current_user_id();

        makedirs($destinationPath);

        $request_obj->move($destinationPath, $fname);
        
        $insert_id = DB::table('upload_master')->insertGetId(
                ['name' => $fname,'url'=>$destination_folder,'type'=>$type,'status'=>'1','author_id'=>$author_id,'parent_id'=>$parent_id,'parent_table'=>$parent_table]
        );
        if($insert_id > 0){
        return $insert_id;
        }else{
        return $resource_id;    
        }
        
    }
}

if (!function_exists('do_upload_with_file_n_path')) {
    
    function do_upload_with_file_n_path($request_obj,$parent_table,$parent_id=0){
		
        $resource_id = 0;

        $fname = $request_obj->getClientOriginalName();
        
        $type = $request_obj->getMimeType();

        $destinationPath = './';
        $author_id = get_current_user_id();

        $request_obj->move($destinationPath, $fname);
        
        $insert_id = DB::table('upload_master')->insertGetId(
                ['name' => $fname,'type'=>$type,'status'=>'1','author_id'=>$author_id,'parent_id'=>$parent_id,'parent_table'=>$parent_table]
        );
        if($insert_id > 0){
        return $insert_id;
        }else{
        return $resource_id;    
        }
        
    }
}



if (!function_exists('is_email_id_esist_edit')) {
    function is_email_id_esist_edit($email,$id){
        $users = DB::table('users')->where('email',trim($email))->where('ID','<>',$id)->first();
        if(isset($users)){
            return $users->ID;
        }else{
            return false;
        }
    }
}

if (!function_exists('get_user_detail_by_id')) {
    function get_user_detail_by_id($id){
        $users = DB::table('users')->where('ID',$id)->first();
        if(isset($users)){
            return $users;
        }else{
            return false;
        }
    }
}


if(!function_exists('what_my_role')){
    function what_my_role($user_id){
        $users = DB::table('users')->where(array('ID' => $user_id))->first();
        if(isset($users)){
            if($users->role_id==1){
                return 'admin';
            }
            if($users->role_id==2){
                return 'user';
            }
            if($users->role_id==3){
                return 'web_manager';
            }
			if($users->role_id==4){
                return 'partner';
            }
			if($users->role_id==5){
                return 'user_admin';
            }
			if($users->role_id==6){
                return 'social_admin';
            }
			if($users->role_id==7){
                return 'view_admin';
            }
        }
    }
}

if(!function_exists('what_my_role_logged_in')){
    function what_my_role_logged_in(){
		$user_id = get_current_front_user_id();
        $users = DB::table('users')->where(array('ID' => $user_id))->first();
        if(isset($users)){
            if($users->role_id==1){
                return 'admin';
            }
            if($users->role_id==2){
                return 'user';
            }
            if($users->role_id==3){
                return 'web_manager';
            }
			if($users->role_id==4){
                return 'partner';
            }
        }
		return false;
    }
}

if (!function_exists('un_assign_image_id')) {
    function un_assign_image_id($image_id){
        DB::table('upload_master')->where('ID', $image_id)->update(array('parent_table'=>'unassigned','parent_id'=>'0'));
    }
}
if (!function_exists('get_recource_url')) {
    function get_recource_url($recource_id) {
        $upload_master = DB::table('upload_master')->where(array('ID' => $recource_id))->first();
        if(isset($upload_master)){
			
			if($upload_master->url !=""){
				return url('/public/'.$upload_master->url.'/'.$upload_master->name);
			}else{
				return url('/'.$upload_master->name);
			}
            
        }else{
            return false;
        }
    }
}

if (!function_exists('makedirs')) {
    function makedirs($dirpath, $mode=0777) {
        return is_dir($dirpath) || mkdir($dirpath, $mode, true);
    }
}

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        return true;
    }
}

if (!function_exists('selected')) {
    function selected($option_val,$get_val) {
        if($option_val==$get_val){
            echo 'selected="selected"';
        }
    }
}

if (!function_exists('get_current_user_id')) {
    function get_current_user_id() {
        $userid = Session::get('userid');
        $ck = Session::get('is_admin_logged_in');
        if($ck == "yes" && $userid > 0){
            return $userid;
        }else{
            return 0;
        }
    }
}

if (!function_exists('get_current_ref_id')) {
    function get_current_ref_id() {
        $userid = Session::get('frontend_userid');
        $ck = Session::get('is_frontend_user_logged_in');
        if($ck == "yes" && $userid > 0){
			if($userid > 0){
			$account_detail = DB::table('users')->where('ID', $userid)->first();
			}
			if(isset($account_detail->referral_code) & !empty($account_detail->referral_code)){
				return strtoupper($account_detail->referral_code);
			}else{
				return false;
			}
        }else{
            return false;
        }
    }
}

if (!function_exists('total_referral')) {
    function total_referral($user_id) {
		$referral = DB::table('referral as r')
					->where('r.parent_user_id','=',$user_id)
					->join('users as u','u.ID','=','r.child_user_id')
					->select('u.ID')
					->orderBy('r.created_date','DESC')
					->count();
					
		if(isset($referral)){
		return $referral;
		}else{
		return 0;
		}
	}
}

if (!function_exists('if_has_parent_user')) {
    function if_has_parent_user($user_id) {
		$referral = DB::table('referral as r')
					->where('r.child_user_id','=',$user_id)
					/*->where('r.status','=','1')*/
					->join('users as u','u.ID','=','r.parent_user_id')
					->first();
					
		if(isset($referral)){
		return $referral->parent_user_id;
		}else{
		return 0;
		}
	}
}

if (!function_exists('get_current_front_user_id')) {
    function get_current_front_user_id() {
        $userid = Session::get('frontend_userid');
        $ck = Session::get('is_frontend_user_logged_in');
        if($ck == "yes" && $userid > 0){
            return $userid;
        }else{
            return 0;
        }
    }
}

if (!function_exists('is_mail_confirmed')) {
    function is_mail_confirmed() {
		$front_user_id = get_current_front_user_id();
		$account_detail = '';
		if($front_user_id > 0){
			$account_detail = DB::table('users')->where('ID', $front_user_id)->first();
		}
        if($account_detail->user_token!='activated' && !empty($account_detail->user_token) && $account_detail->is_activated==0){
            return false;
        }else{
            return true;
        }
    }
}


if (!function_exists('is_duplicate_file_name')) {
    function is_duplicate_file_name($file_name){
        $files = DB::table('upload_master')->where(array('name' => trim($file_name)))->first();
        if(isset($files)){
            $filename = pathinfo($file_name, PATHINFO_FILENAME);
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = $filename.'-1.'.$extension;
            return is_duplicate_file_name($new_file_name);
        }else{
            return $file_name;
        }
    }
}

if (!function_exists('is_email_id_exist')) {
    function is_email_id_exist($email){
        $users = DB::table('users')->where(array('email' => trim($email)))->first();
        if(isset($users)){
            return $users->ID;
        }else{
            return false;
        }
    }
}

if(!function_exists('exp_cat_name')) {
    function exp_cat_name($cat_id) {
        $cname = "";
        $sql = DB::table('expertise_category')->where('ID','=',$cat_id)->select('category_name')->first();
        if(!empty($sql)) {
            $cname = $sql->category_name;
        } else {
            $cname = "";
        }

        return $cname;
    }
}

if(!function_exists('update_settings')) {
    function update_settings($setting_slug,$setting_name='',$setting_value='') {
        $setting_ID = 0;
        if(!empty($setting_slug)){
            if(empty($setting_name)){
                $setting_name = ucfirst($setting_slug);
            }
            if(is_array($setting_value)){
                $setting_value = serialize($setting_value);
            }

            $author_id = get_current_user_id();

            $sql = DB::table('settings')->where('setting_slug','=',$setting_slug)->select('ID')->first();
            if(!empty($sql)){
                $setting_ID = $sql->ID;
                $update = DB::table('settings')
                      ->where('ID','=',$setting_ID)
                      ->update(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);

            } else {
                $setting_ID = DB::table('settings')->insertGetId(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);
            }
        }
        return $setting_ID;
    }
}

if(!function_exists('update_token_info')) {
    function update_token_info($setting_slug,$setting_name='',$setting_value='') {
        $setting_ID = 0;
        if(!empty($setting_slug)){
            if(empty($setting_name)){
                $setting_name = ucfirst($setting_slug);
            }
            if(is_array($setting_value)){
                $setting_value = serialize($setting_value);
            }

            $author_id = get_current_user_id();

            $sql = DB::table('token_info_general')->where('setting_slug','=',$setting_slug)->select('ID')->first();
            if(!empty($sql)){
                $setting_ID = $sql->ID;
                $update = DB::table('token_info_general')
                      ->where('ID','=',$setting_ID)
                      ->update(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);

            } else {
                $setting_ID = DB::table('token_info_general')->insertGetId(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);
            }
        }
        return $setting_ID;
    }
}

if(!function_exists('update_ico_phase')) {
    function update_ico_phase($setting_slug,$setting_name='',$setting_value='') {
        $setting_ID = 0;
        if(!empty($setting_slug)){
            if(empty($setting_name)){
                $setting_name = ucfirst($setting_slug);
            }
            if(is_array($setting_value)){
                $setting_value = serialize($setting_value);
            }

            $author_id = get_current_user_id();

            $sql = DB::table('token_ico_phase')->where('setting_slug','=',$setting_slug)->select('ID')->first();
            if(!empty($sql)){
                $setting_ID = $sql->ID;
                $update = DB::table('token_ico_phase')
                      ->where('ID','=',$setting_ID)
                      ->update(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);

            } else {
                $setting_ID = DB::table('token_ico_phase')->insertGetId(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);
            }
        }
        return $setting_ID;
    }
}

if(!function_exists('update_platform_distribution')) {
    function update_platform_distribution($setting_slug,$setting_name='',$setting_value='') {
        $setting_ID = 0;
        if(!empty($setting_slug)){
            if(empty($setting_name)){
                $setting_name = ucfirst($setting_slug);
            }
            if(is_array($setting_value)){
                $setting_value = serialize($setting_value);
            }

            $author_id = get_current_user_id();

            $sql = DB::table('token_platform_distribution')->where('setting_slug','=',$setting_slug)->select('ID')->first();
            if(!empty($sql)){
                $setting_ID = $sql->ID;
                $update = DB::table('token_platform_distribution')
                      ->where('ID','=',$setting_ID)
                      ->update(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);

            } else {
                $setting_ID = DB::table('token_platform_distribution')->insertGetId(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);
            }
        }
        return $setting_ID;
    }
}

if(!function_exists('update_landing_page_video')) {
    function update_landing_page_video($setting_slug,$setting_name='',$setting_value='') {
        $setting_ID = 0;
        if(!empty($setting_slug)){
            if(empty($setting_name)){
                $setting_name = ucfirst($setting_slug);
            }
            if(is_array($setting_value)){
                $setting_value = serialize($setting_value);
            }

            $author_id = get_current_user_id();

            $sql = DB::table('videos_landing_page')->where('setting_slug','=',$setting_slug)->select('ID')->first();
            if(!empty($sql)){
                $setting_ID = $sql->ID;
                $update = DB::table('videos_landing_page')
                      ->where('ID','=',$setting_ID)
                      ->update(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);

            } else {
                $setting_ID = DB::table('videos_landing_page')->insertGetId(['setting_name'=>$setting_name,'setting_slug'=>$setting_slug,'setting_value'=>$setting_value,'author_id'=>$author_id]);
            }
        }
        return $setting_ID;
    }
}

if(!function_exists('get_settings')) {
    function get_settings($settings_slug=false){
        if(!empty($settings_slug)){
            $sql = DB::table('settings')->where('setting_slug','=',$settings_slug)->select('setting_value')->first();
            if(!empty($sql)) {
                $setting_value = $sql->setting_value;
                if(is_serialized($setting_value)){
                   return unserialize($setting_value);
                }else{
                   return $setting_value;
                }
            }
        }else{
            $return_arr = array();
            $sql = DB::table('settings')->get();
            if(!empty($sql) && count($sql) > 0){
                foreach($sql as $sq){
                    $return_arr[$sq->setting_slug] = $sq->setting_value;
                }
            }
            return $return_arr;
        }
    }
}

if(!function_exists('get_token_info')) {
    function get_token_info($settings_slug=false){
        if(!empty($settings_slug)){
            $sql = DB::table('token_info_general')->where('setting_slug','=',$settings_slug)->select('setting_value')->first();
            if(!empty($sql)) {
                $setting_value = $sql->setting_value;
                if(is_serialized($setting_value)){
                   return unserialize($setting_value);
                }else{
                   return $setting_value;
                }
            }
        }else{
            $return_arr = array();
            $sql = DB::table('token_info_general')->get();
            if(!empty($sql) && count($sql) > 0){
                foreach($sql as $sq){
                    $return_arr[$sq->setting_slug] = $sq->setting_value;
                }
            }
            return $return_arr;
        }
    }
}

if(!function_exists('get_ico_phase')) {
    function get_ico_phase($settings_slug=false){
        if(!empty($settings_slug)){
            $sql = DB::table('token_ico_phase')->where('setting_slug','=',$settings_slug)->select('setting_value')->first();
            if(!empty($sql)) {
                $setting_value = $sql->setting_value;
                if(is_serialized($setting_value)){
                   return unserialize($setting_value);
                }else{
                   return $setting_value;
                }
            }
        }else{
            $return_arr = array();
            $sql = DB::table('token_ico_phase')->get();
            if(!empty($sql) && count($sql) > 0){
                foreach($sql as $sq){
                    $return_arr[$sq->setting_slug] = $sq->setting_value;
                }
            }
            return $return_arr;
        }
    }
}

if(!function_exists('get_platform_distribution')) {
    function get_platform_distribution($settings_slug=false){
        if(!empty($settings_slug)){
            $sql = DB::table('token_platform_distribution')->where('setting_slug','=',$settings_slug)->select('setting_value')->first();
            if(!empty($sql)) {
                $setting_value = $sql->setting_value;
                if(is_serialized($setting_value)){
                   return unserialize($setting_value);
                }else{
                   return $setting_value;
                }
            }
        }else{
            $return_arr = array();
            $sql = DB::table('token_platform_distribution')->get();
            if(!empty($sql) && count($sql) > 0){
                foreach($sql as $sq){
                    $return_arr[$sq->setting_slug] = $sq->setting_value;
                }
            }
            return $return_arr;
        }
    }
}

if(!function_exists('get_landing_page_video')) {
    function get_landing_page_video($settings_slug=false){
        if(!empty($settings_slug)){
            $sql = DB::table('videos_landing_page')->where('setting_slug','=',$settings_slug)->select('setting_value')->first();
            if(!empty($sql)) {
                $setting_value = $sql->setting_value;
                if(is_serialized($setting_value)){
                   return unserialize($setting_value);
                }else{
                   return $setting_value;
                }
            }
        }else{
            $return_arr = array();
            $sql = DB::table('videos_landing_page')->get();
            if(!empty($sql) && count($sql) > 0){
                foreach($sql as $sq){
                    $return_arr[$sq->setting_slug] = $sq->setting_value;
                }
            }
            return $return_arr;
        }
    }
}

if(!function_exists('is_serialized')) {
    function is_serialized( $data ) {
    // if it isn't a string, it isn't serialized
    if ( !is_string( $data ) )
        return false;
    $data = trim( $data );
    if ( 'N;' == $data )
        return true;
    if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
        return false;
    switch ( $badions[1] ) {
        case 'a' :
        case 'O' :
        case 's' :
            if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                return true;
            break;
        case 'b' :
        case 'i' :
        case 'd' :
            if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                return true;
            break;
    }
    return false;
}
}

if(!function_exists('get_edc_name_by_id')) {
    function get_edc_name_by_id($edc_id) {
        $cname = "";
        $sql = DB::table('users')->where('ID','=',$edc_id)->select('full_name')->first();
        if(!empty($sql)) {
            $setting_ID = $sql->full_name;
        } else {
            $setting_ID = '';
        }

        return $setting_ID;
    }
}

if(!function_exists('get_parent_uid_by_id')) {
    function get_parent_uid_by_id($user_id) {
        
        $sql = DB::table('referral')->where('child_user_id','=',$user_id)->select('parent_user_id')->first();
        if(!empty($sql)) {
            $parent_ID = $sql->parent_user_id;
        } else {
            $parent_ID = 0;
        }

        return $parent_ID;
    }
}

if (!function_exists('in_arrayi')) {
 
    /**
     * Checks if a value exists in an array in a case-insensitive manner
     *
     * @param mixed $needle
     * The searched value
     *
     * @param $haystack
     * The array
     *
     * @param bool $strict [optional]
     * If set to true type of needle will also be matched
     *
     * @return bool true if needle is found in the array,
     * false otherwise
     */
    function in_arrayi($needle, $haystack, $strict = false)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack), $strict);
    }
}

if (!function_exists('is_url_exist')) {
    function is_url_exist($url){
        $ch = curl_init($url);    
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($code == 200){
           $status = true;
        }else{
          $status = false;
        }
        curl_close($ch);
       return $status;
    }
}

if (!function_exists('is_unique_page_slug')) {
    function is_unique_page_slug($title){
        $slug = str_slug($title);
        $page = DB::table('cms_pages')->where(array('slug' => trim($slug)))->first();
        if(isset($page)){
            return is_unique_page_slug($page->slug);
        }else{
            return $slug;
        }
    }
}

if (!function_exists('is_unique_news_slug')) {
    function is_unique_news_slug($title){
        $slug = str_slug($title);
        $page = DB::table('news')->where(array('slug' => trim($slug)))->first();
        if(isset($page)){
            return is_unique_news_slug($page->slug);
        }else{
            return $slug;
        }
    }
}


if (!function_exists('is_unique_email_template_slug')) {
    function is_unique_email_template_slug($title){
        $slug = str_slug($title);
        $page = DB::table('email_template')->where(array('slug' => trim($slug)))->first();
        if(isset($page)){
            return is_unique_email_template_slug($page->slug.'-copy');
        }else{
            return $slug;
        }
    }
}


if (!function_exists('get_email_template_body')) {
    function get_email_template_body($identifier){
        $template = DB::table('email_template')->where(array('slug' => trim($identifier),'status'=>'1'))->first();
        if(isset($template)){
            return $template->description;
        }else{
            return false;
        }
    }
}

if (!function_exists('get_email_template_subject')) {
    function get_email_template_subject($identifier){
        $template = DB::table('email_template')->where(array('slug' => trim($identifier),'status'=>'1'))->first();
        if(isset($template)){
            return $template->title;
        }else{
            return false;
        }
    }
}


if (!function_exists('is_unique_success_stories_slug')) {
    function is_unique_success_stories_slug($title){
        $slug = str_slug($title);
        $page = DB::table('success_stories')->where(array('slug' => trim($slug)))->first();
        if(isset($page)){
            return is_unique_success_stories_slug($page->slug);
        }else{
            return $slug;
        }
    }
}

if (!function_exists('is_unique_activity_plan_slug')) {
    function is_unique_activity_plan_slug($title){
        $slug = str_slug($title);
        $page = DB::table('activity_plan')->where(array('slug' => trim($slug)))->first();
        if(isset($page)){
            return is_unique_activity_plan_slug($page->slug);
        }else{
            return $slug;
        }
    }
}

if (!function_exists('is_unique_event_slug')) {
    function is_unique_event_slug($title){
        $slug = str_slug($title);
        $page = DB::table('events')->where(array('slug' => trim($slug)))->first();
        if(isset($page)){
            return is_unique_event_slug($page->slug);
        }else{
            return $slug;
        }
    }
}

if (!function_exists('is_unique_user_slug')) {
    function is_unique_user_slug($title){
        $slug = str_slug($title);
        $page = DB::table('users')->where(array('user_slug' => trim($slug)))->first();
        if(isset($page)){
            $slg = $page->slug.'-1';
            return is_unique_page_slug($slg);
        }else{
            return $slug;
        }
    }
}

if (!function_exists('page_url')) {
    function page_url($slug){
		return url($slug);
	}
}

if(!function_exists('image_size')){
    function image_size($path)
    {
        $bytes = sprintf('%u', filesize($path));

        if ($bytes > 0)
        {
            $unit = intval(log($bytes, 1024));
            $units = array('B', 'KB', 'MB', 'GB');

            if (array_key_exists($unit, $units) === true)
            {
                return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
            }
        }

        return $bytes;
    }
}

if (!function_exists('delete_upload')) {
    
    function delete_upload($image_id)
    {
       $upload = DB::table('upload_master')->where(array('ID' => $image_id))->first();
        if(isset($upload)){
            $image_path = public_path('/'.$upload->url.'/'.$upload->name);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        DB::table('upload_master')->where('ID','=',$image_id)->delete();
        }
    }
}

if (!function_exists('get_site_title')) {
    
    function get_site_title($title=false)
    {
        $site_name = get_settings('site_title');
        if(!empty($title)){
            echo $title.' | '.$site_name;
        }else{
            echo $site_name;
        }
    }
}

if (!function_exists('get_edc_logo')) {
    
    function get_edc_logo($edc_id=0)
    {
        $users = DB::table('users')->where(array('ID' => $edc_id))->first();
        if(isset($users)){
            $logo_id = $users->logo_id;
            return get_recource_url($logo_id);
        }
        return false;
    }
}

if (!function_exists('get_category_name_by_id')) {
    
    function get_category_name_by_id($category_id)
    {
		$people_category = DB::table('people_category')->where(array('ID' => $category_id))->first();
        if(isset($people_category)){
            return $people_category->name;
        }
        return '';
	}
}

if (!function_exists('P2P_value_from_eth')) {
    function P2P_value_from_eth($eth_value)
    {
		$settings = get_settings('eth_to_p2p');
		$return_value = $eth_value*$settings;
		$final_return = (float)$return_value;
		return round($final_return,2);
	}
}

if (!function_exists('P2P_value_from_btc')) {
    function P2P_value_from_btc($btc_value)
    {
		$settings = get_settings('btc_to_p2p');
		$return_value = $btc_value*$settings;
		$final_return = (float)$return_value;
		return round($final_return,2);
	}
}

if (!function_exists('P2P_value_from_ltc')) {
    function P2P_value_from_ltc($ltc_value)
    {
		$settings = get_settings('ltc_to_p2p');
		$return_value = $ltc_value*$settings;
		$final_return = (float)$return_value;
		return round($final_return,2);
	}
}

if (!function_exists('get_country_lable')) {
    function get_country_lable($country_id='')
    {
		
	$country = array(
    'AF'=>'AFGHANISTAN',
    'AL'=>'ALBANIA',
    'DZ'=>'ALGERIA',
    'AS'=>'AMERICAN SAMOA',
    'AD'=>'ANDORRA',
    'AO'=>'ANGOLA',
    'AI'=>'ANGUILLA',
    'AQ'=>'ANTARCTICA',
    'AG'=>'ANTIGUA AND BARBUDA',
    'AR'=>'ARGENTINA',
    'AM'=>'ARMENIA',
    'AW'=>'ARUBA',
    'AU'=>'AUSTRALIA',
    'AT'=>'AUSTRIA',
    'AZ'=>'AZERBAIJAN',
    'BS'=>'BAHAMAS',
    'BH'=>'BAHRAIN',
    'BD'=>'BANGLADESH',
    'BB'=>'BARBADOS',
    'BY'=>'BELARUS',
    'BE'=>'BELGIUM',
    'BZ'=>'BELIZE',
    'BJ'=>'BENIN',
    'BM'=>'BERMUDA',
    'BT'=>'BHUTAN',
    'BO'=>'BOLIVIA',
    'BA'=>'BOSNIA AND HERZEGOVINA',
    'BW'=>'BOTSWANA',
    'BV'=>'BOUVET ISLAND',
    'BR'=>'BRAZIL',
    'IO'=>'BRITISH INDIAN OCEAN TERRITORY',
    'BN'=>'BRUNEI DARUSSALAM',
    'BG'=>'BULGARIA',
    'BF'=>'BURKINA FASO',
    'BI'=>'BURUNDI',
    'KH'=>'CAMBODIA',
    'CM'=>'CAMEROON',
    'CA'=>'CANADA',
    'CV'=>'CAPE VERDE',
    'KY'=>'CAYMAN ISLANDS',
    'CF'=>'CENTRAL AFRICAN REPUBLIC',
    'TD'=>'CHAD',
    'CL'=>'CHILE',
    'CN'=>'CHINA',
    'CX'=>'CHRISTMAS ISLAND',
    'CC'=>'COCOS (KEELING) ISLANDS',
    'CO'=>'COLOMBIA',
    'KM'=>'COMOROS',
    'CG'=>'CONGO',
    'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
    'CK'=>'COOK ISLANDS',
    'CR'=>'COSTA RICA',
    'CI'=>'COTE D IVOIRE',
    'HR'=>'CROATIA',
    'CU'=>'CUBA',
    'CY'=>'CYPRUS',
    'CZ'=>'CZECH REPUBLIC',
    'DK'=>'DENMARK',
    'DJ'=>'DJIBOUTI',
    'DM'=>'DOMINICA',
    'DO'=>'DOMINICAN REPUBLIC',
    'TP'=>'EAST TIMOR',
    'EC'=>'ECUADOR',
    'EG'=>'EGYPT',
    'SV'=>'EL SALVADOR',
    'GQ'=>'EQUATORIAL GUINEA',
    'ER'=>'ERITREA',
    'EE'=>'ESTONIA',
    'ET'=>'ETHIOPIA',
    'FK'=>'FALKLAND ISLANDS (MALVINAS)',
    'FO'=>'FAROE ISLANDS',
    'FJ'=>'FIJI',
    'FI'=>'FINLAND',
    'FR'=>'FRANCE',
    'GF'=>'FRENCH GUIANA',
    'PF'=>'FRENCH POLYNESIA',
    'TF'=>'FRENCH SOUTHERN TERRITORIES',
    'GA'=>'GABON',
    'GM'=>'GAMBIA',
    'GE'=>'GEORGIA',
    'DE'=>'GERMANY',
    'GH'=>'GHANA',
    'GI'=>'GIBRALTAR',
    'GR'=>'GREECE',
    'GL'=>'GREENLAND',
    'GD'=>'GRENADA',
    'GP'=>'GUADELOUPE',
    'GU'=>'GUAM',
    'GT'=>'GUATEMALA',
    'GN'=>'GUINEA',
    'GW'=>'GUINEA-BISSAU',
    'GY'=>'GUYANA',
    'HT'=>'HAITI',
    'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS',
    'VA'=>'HOLY SEE (VATICAN CITY STATE)',
    'HN'=>'HONDURAS',
    'HK'=>'HONG KONG',
    'HU'=>'HUNGARY',
    'IS'=>'ICELAND',
    'IN'=>'INDIA',
    'ID'=>'INDONESIA',
    'IR'=>'IRAN, ISLAMIC REPUBLIC OF',
    'IQ'=>'IRAQ',
    'IE'=>'IRELAND',
    'IL'=>'ISRAEL',
    'IT'=>'ITALY',
    'JM'=>'JAMAICA',
    'JP'=>'JAPAN',
    'JO'=>'JORDAN',
    'KZ'=>'KAZAKSTAN',
    'KE'=>'KENYA',
    'KI'=>'KIRIBATI',
    'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
    'KR'=>'KOREA REPUBLIC OF',
    'KW'=>'KUWAIT',
    'KG'=>'KYRGYZSTAN',
    'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC',
    'LV'=>'LATVIA',
    'LB'=>'LEBANON',
    'LS'=>'LESOTHO',
    'LR'=>'LIBERIA',
    'LY'=>'LIBYAN ARAB JAMAHIRIYA',
    'LI'=>'LIECHTENSTEIN',
    'LT'=>'LITHUANIA',
    'LU'=>'LUXEMBOURG',
    'MO'=>'MACAU',
    'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
    'MG'=>'MADAGASCAR',
    'MW'=>'MALAWI',
    'MY'=>'MALAYSIA',
    'MV'=>'MALDIVES',
    'ML'=>'MALI',
    'MT'=>'MALTA',
    'MH'=>'MARSHALL ISLANDS',
    'MQ'=>'MARTINIQUE',
    'MR'=>'MAURITANIA',
    'MU'=>'MAURITIUS',
    'YT'=>'MAYOTTE',
    'MX'=>'MEXICO',
    'FM'=>'MICRONESIA, FEDERATED STATES OF',
    'MD'=>'MOLDOVA, REPUBLIC OF',
    'MC'=>'MONACO',
    'MN'=>'MONGOLIA',
    'MS'=>'MONTSERRAT',
    'MA'=>'MOROCCO',
    'MZ'=>'MOZAMBIQUE',
    'MM'=>'MYANMAR',
    'NA'=>'NAMIBIA',
    'NR'=>'NAURU',
    'NP'=>'NEPAL',
    'NL'=>'NETHERLANDS',
    'AN'=>'NETHERLANDS ANTILLES',
    'NC'=>'NEW CALEDONIA',
    'NZ'=>'NEW ZEALAND',
    'NI'=>'NICARAGUA',
    'NE'=>'NIGER',
    'NG'=>'NIGERIA',
    'NU'=>'NIUE',
    'NF'=>'NORFOLK ISLAND',
    'MP'=>'NORTHERN MARIANA ISLANDS',
    'NO'=>'NORWAY',
    'OM'=>'OMAN',
    'PK'=>'PAKISTAN',
    'PW'=>'PALAU',
    'PS'=>'PALESTINIAN TERRITORY, OCCUPIED',
    'PA'=>'PANAMA',
    'PG'=>'PAPUA NEW GUINEA',
    'PY'=>'PARAGUAY',
    'PE'=>'PERU',
    'PH'=>'PHILIPPINES',
    'PN'=>'PITCAIRN',
    'PL'=>'POLAND',
    'PT'=>'PORTUGAL',
    'PR'=>'PUERTO RICO',
    'QA'=>'QATAR',
    'RE'=>'REUNION',
    'RO'=>'ROMANIA',
    'RU'=>'RUSSIAN FEDERATION',
    'RW'=>'RWANDA',
    'SH'=>'SAINT HELENA',
    'KN'=>'SAINT KITTS AND NEVIS',
    'LC'=>'SAINT LUCIA',
    'PM'=>'SAINT PIERRE AND MIQUELON',
    'VC'=>'SAINT VINCENT AND THE GRENADINES',
    'WS'=>'SAMOA',
    'SM'=>'SAN MARINO',
    'ST'=>'SAO TOME AND PRINCIPE',
    'SA'=>'SAUDI ARABIA',
    'SN'=>'SENEGAL',
    'SC'=>'SEYCHELLES',
    'SL'=>'SIERRA LEONE',
    'SG'=>'SINGAPORE',
    'SK'=>'SLOVAKIA',
    'SI'=>'SLOVENIA',
    'SB'=>'SOLOMON ISLANDS',
    'SO'=>'SOMALIA',
    'ZA'=>'SOUTH AFRICA',
    'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
    'ES'=>'SPAIN',
    'LK'=>'SRI LANKA',
    'SD'=>'SUDAN',
    'SR'=>'SURINAME',
    'SJ'=>'SVALBARD AND JAN MAYEN',
    'SZ'=>'SWAZILAND',
    'SE'=>'SWEDEN',
    'CH'=>'SWITZERLAND',
    'SY'=>'SYRIAN ARAB REPUBLIC',
    'TW'=>'TAIWAN, PROVINCE OF CHINA',
    'TJ'=>'TAJIKISTAN',
    'TZ'=>'TANZANIA, UNITED REPUBLIC OF',
    'TH'=>'THAILAND',
    'TG'=>'TOGO',
    'TK'=>'TOKELAU',
    'TO'=>'TONGA',
    'TT'=>'TRINIDAD AND TOBAGO',
    'TN'=>'TUNISIA',
    'TR'=>'TURKEY',
    'TM'=>'TURKMENISTAN',
    'TC'=>'TURKS AND CAICOS ISLANDS',
    'TV'=>'TUVALU',
    'UG'=>'UGANDA',
    'UA'=>'UKRAINE',
    'AE'=>'UNITED ARAB EMIRATES',
    'GB'=>'UNITED KINGDOM',
    'US'=>'UNITED STATES',
    'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS',
    'UY'=>'URUGUAY',
    'UZ'=>'UZBEKISTAN',
    'VU'=>'VANUATU',
    'VE'=>'VENEZUELA',
    'VN'=>'VIET NAM',
    'VG'=>'VIRGIN ISLANDS, BRITISH',
    'VI'=>'VIRGIN ISLANDS, U.S.',
    'WF'=>'WALLIS AND FUTUNA',
    'EH'=>'WESTERN SAHARA',
    'YE'=>'YEMEN',
    'YU'=>'YUGOSLAVIA',
    'ZM'=>'ZAMBIA',
    'ZW'=>'ZIMBABWE',
	);
	
	//$country = array_map('strtolower', $country);
	
	if(!empty($country_id)){
		if(array_key_exists($country_id, $country)){
		$country_name = $country[$country_id];
		return ucwords($country_name);
		}else{
		return ucwords($country_id);
		}
	}else{
		return $country;
	}
	}
}

if (!function_exists('get_document_lable')) {
    function get_document_lable($doc_id)
    {
		$doc['passport'] = 'Passport';
		$doc['national-card'] = 'National Card';
		$doc['driver-licence'] = 'Driver’s License';
		return $doc[$doc_id];
	}
}

if (!function_exists('get_status_lable')) {
    function get_status_lable($status_id)
    {
		$status[0] = 'Pending';
		$status[1] = 'Processing';
		$status[2] = 'Rejected';
		$status[3] = 'Accepted';
		return $status[$status_id];
	}
}

if (!function_exists('referral_commission_amount')) {
    function referral_commission_amount($amount)
    {
		//$settings = (float)get_settings('referral_commission_percentage');
		$settings = (float)get_bonus_percentage($amount);
		if($settings > 0){
			$return_amount = (float)($amount*($settings/100));
		}else{
			$return_amount = 0;
		}
		return $return_amount;
	}
}

if (!function_exists('get_p2p_by_user_id')) {
    function get_p2p_by_user_id($user_id){
		
		$transaction = DB::table("transaction")
	    ->select(DB::raw("SUM(`amount`) as total_token"))
	    ->where("transaction_for","=",$user_id)
	    ->first();
		if(isset($transaction) & !empty($transaction)){
			return number_format($transaction->total_token,2,'.',',');
		}
		return number_format('00000',2,'.',',');
	}
}

if (!function_exists('if_exist_total_token')) {
    function if_exist_total_token($user_id){
		
		$total_token_data = array();
		
		$total_token = DB::table("total_token")
	    ->where("partner_id","=",$user_id)
	    ->first();
		if(isset($total_token) & !empty($total_token)){
			$total_token_data = $total_token;
			return $total_token_data;
		}else{
			return $total_token_data;
		}
	}
}

if (!function_exists('get_user_info')) {
    function get_user_info($user_id){
		
		$users_data = DB::table("users")
	    ->where(array('ID' => $user_id,'role_id'=>'4'))
	    ->first();
		
		if(isset($users_data) & !empty($users_data)){
			return $users_data;
		}else{
			return array();
		}
	}
}


if (!function_exists('get_total_ref_commission_by_user_id')) {
    function get_total_ref_commission_by_user_id($user_id)
    {
		$sql = "SELECT SUM(t.amount) as total FROM `contribution` as `c` inner join `transaction` as `t` on `c`.`ID` = `t`.`parent_id` WHERE c.status = '3' AND t.parent_type='ref_commission' AND c.submitted_by=$user_id";
		$results = DB::select($sql);
		if(isset($results[0]) & !empty($results[0])){
			return number_format($results[0]->total,2,'.',',');
		}
		return number_format('00000',2,'.',',');
	}
}

if (!function_exists('rearrange_roadmap')) {
	function rearrange_roadmap($input_arr){
		$result_arr = array();
		$cnt = 0;
		$col_arr = array_chunk($input_arr,4);
		if(isset($col_arr) && count($col_arr) > 0){
			foreach($col_arr as $col){
				$each_arr = array();
				$each_arr = $col;
				
				if($cnt%2==0){
					//ksort($each_arr,SORT_NUMERIC);
				}else{
					//krsort($each_arr,SORT_NUMERIC);				
					$each_arr = array_reverse($each_arr);	
				}
				
				foreach($each_arr as $arr){
						$result_arr[] = $arr;
				}
				$cnt++;
			}
		}else{
			$result_arr = $input_arr;
		}
		return $result_arr;
	}
}
if (!function_exists('is_kyc_varified')) {
	function is_kyc_varified(){
		$user_id = get_current_front_user_id();
		if($user_id > 0){
			$kyc = DB::table('kyc')->where(array('user_id' => $user_id,'latest_one'=>'1'))->first();
			if(isset($kyc) && !empty($kyc) && $kyc->status==4){
				return true;
			}
		}
		return false;
	}
}

if (!function_exists('current_kyc_status')) {
	function current_kyc_status(){
		$user_id = get_current_front_user_id();
		if($user_id > 0){
			$kyc = DB::table('kyc')->where(array('user_id' => $user_id,'latest_one'=>'1'))->first();
			if(isset($kyc) && !empty($kyc)){
				return $kyc->status;
			}
		}
		return -1;
	}
}

if (!function_exists('get_bonus_percentage')) {
	function get_bonus_percentage($amount='0.00'){
		//$query = "SELECT `bonus_amount` FROM `bonus_master` WHERE (($amount >= CAST(`lower_range` AS DOUBLE) AND  $amount <= CAST(`higher_range` AS DOUBLE)) AND `no_higher` = '0') OR (($amount >= CAST(`lower_range` AS DOUBLE)) AND `no_higher` = '1')  AND `status` = '1'";
		$query = "SELECT `bonus_amount` FROM `bonus_master` WHERE (($amount >= `lower_range` AND  $amount <= `higher_range` ) AND `no_higher` = '0') OR (($amount >= `lower_range`) AND `no_higher` = '1')  AND `status` = '1'";
		$bonus_amount = DB::select($query);
		if(isset($bonus_amount) && !empty($bonus_amount) && !empty($bonus_amount[0]->bonus_amount)){
			return $bonus_amount[0]->bonus_amount;
		}else{
			return 0.00;
		}
	}
}

if (!function_exists('get_langs')) {
	function get_langs(){
		$language = DB::table('language')->where(array('status' => '1'))->orderBy('order','asc')->get();
		return $language;
	}
}

if (!function_exists('set_admin_language')){
	function set_admin_language(){
		$language_code = Session::get('language_code');
		if(empty($language_code)){
			$is_default = DB::table('language')->where(array('is_default' => '1','status'=>'1'))->first();
			if(isset($is_default)){
				Session::put('language_code', $is_default->language_code);
			}
		}
	}
}
if (!function_exists('get_admin_language')) {
	function get_admin_language(){
		$language_code = Session::get('language_code');
		if(!empty($language_code)){
			return $language_code;
		}
		$is_default = DB::table('language')->where(array('is_default' => '1','status'=>'1'))->first();
		if(isset($is_default)){
			return $is_default->language_code;
		}else{
			return false;
		}
	}
}

/*
if (!function_exists('save_translation')) {
	function save_translation($text,$language_code){
		
		$translation['otp'] = $generated_otp;
		$otp_data['status'] = '1';
		$otp_data['user_id'] = $users->ID;
		$otp_data['duration'] = '180';
		$otp_id = DB::table('otp')->insertGetId($otp_data);
		
	}
}
*/
if (!function_exists('get_child_translation')) {
	function get_child_translation($parent_id){
		$translation = DB::table('translation')->where(array('parent' => $parent_id))->where('language_code','!=','en_GB')->get();
		if(isset($translation) && !empty($translation)){
		return $translation;
		}
		return false;
	}
}

if (!function_exists('get_translation')) {
	function get_translation($parent_id,$language_code){
		$translation = DB::table('translation')->where(array('parent' => $parent_id,'language_code'=>$language_code))->first();
		if(isset($translation) && !empty($translation)){
		return $translation->text;
		}
		return '';
	}
}

if (!function_exists('_tr')) {
	function _tr($text){
		$language_code = get_admin_language();
		if($language_code!='en_GB'){
		$parent = DB::table('translation')->where(array('text' => trim($text)))->first();
			if(isset($parent)){
			$translation = DB::table('translation')->where(array('parent' => $parent->ID,'language_code'=>$language_code))->first();
				if(isset($translation) && !empty($translation)){
				return $translation->text;
				}
			}
		}
		return $text;
	}
}

if (!function_exists('set_front_language')){
	function set_front_language(){
		if(isset($_GET['lang']) && !empty($_GET['lang'])){
			$lang_code = $_GET['lang'];
			$lang = DB::table('language')->where(array('language_code' => $lang_code,'status'=>'1'))->first();
			if(isset($lang)){
			Session::put('front_language_code', $lang_code);
			}
		}else{
			$language_code = Session::get('front_language_code');
			if(empty($language_code)){
				$is_default = DB::table('language')->where(array('is_default' => '1','status'=>'1'))->first();
				if(isset($is_default)){
					Session::put('front_language_code', $is_default->language_code);
				}
			}
		}
	}
}

if (!function_exists('get_front_language')) {
	function get_front_language(){
		$language_code = Session::get('front_language_code');
		if(!empty($language_code)){
			return $language_code;
		}
		$is_default = DB::table('language')->where(array('is_default' => '1','status'=>'1'))->first();
		if(isset($is_default)){
			return $is_default->language_code;
		}else{
			return false;
		}
	}
}

if (!function_exists('__t')) {
	function __t($text){
		$language_code = get_front_language();
		if($language_code!='en_GB'){
		$parent = DB::table('translation')->where(array('text' => trim($text)))->first();
			if(isset($parent)){
			$translation = DB::table('translation')->where(array('parent' => $parent->ID,'language_code'=>$language_code))->first();
				if(isset($translation) && !empty($translation)){
				return $translation->text;
				}
			}
		}
		return $text;
	}
}

if (!function_exists('total_referral_bycontribution')) {
    function total_referral_bycontribution($contribution_id) {
		$transaction = DB::table('transaction as t')
					->where('t.parent_id','=',$contribution_id)
					->where('t.parent_type','=','ref_commission')
					->where('t.type','=','5')
					->where('t.status','=','1')
					->first();
					
		if(isset($transaction) && !empty($transaction) && !empty($transaction->amount) ){
		return $transaction->amount;
		}else{
		return 0;
		}
	}
}

if (!function_exists('is_kyc_processing')) {
	function is_kyc_processing(){
		$user_id = get_current_front_user_id();
		if($user_id > 0){
			$kyc = DB::table('kyc')->where(array('user_id' => $user_id,'latest_one'=>'1'))->first();
			if(isset($kyc) && !empty($kyc) && $kyc->status==1){
				return true;
			}
		}
		return false;
	}
}

if(!function_exists('language_switcher_html')){
	function language_switcher_html(){
		$language = DB::table('language')->where(array('status' => '1'))->orderBy('order','asc')->get();
		if(isset($language) && count($language) > 0){ /* ?>
		<div class="translatorr-inner text-right">
		<?php
			foreach($language as $lang){
				$code = $lang->language_code;
				?>
				<a href="<?php echo url()->current().'?lang='.$code?>" title="<?php echo __t($lang->language); ?>"><img src="<?php echo get_recource_url($lang->flag_id); ?>" alt="<?php echo  __t($lang->language); ?>"></a>
				<?php
			}
		?>
		 </div>
		 <?php
		 */
		}
	}
}

if (!function_exists('korean_translate')) {
	function korean_translate($id){
			$parent = DB::table('translation')->where(array('ID' => trim($id)))->first();
			if(isset($parent) && $parent->parent == 0){
			$translation = DB::table('translation')->where(array('parent' => $parent->ID))->first();
				if(isset($translation) && !empty($translation)){
				return $translation->text;
				}
			}else if(isset($parent) && $parent->parent > 0){
				return $parent->text;
			}
		return '';
	}
}
if (!function_exists('english_translation')) {
	function english_translation($id){
		$parent = DB::table('translation')->where(array('ID' => trim($id)))->first();
			if(isset($parent) && $parent->parent==0){
				return $parent->text;
			}else if(isset($parent) && $parent->parent > 0){
				$translation = DB::table('translation')->where(array('ID' => $parent->parent))->first();
				if(isset($translation) && !empty($translation)){
				return $translation->text;
				}
			}
		return '';
	}
}
if (!function_exists('tid')) {
	function tid($id){
		$parent = DB::table('translation')->where(array('ID' => trim($id)))->first();
		if(isset($parent) && $parent->parent==0){
			return $parent->ID;
		}else if(isset($parent) && $parent->parent > 0){
				$translation = DB::table('translation')->where(array('ID' => $parent->parent))->first();
				if(isset($translation) && !empty($translation)){
				return $translation->ID;
				}
		}
		return '';
	}
}
if (!function_exists('sort_html')) {
	function sort_html($field){
		$url = url()->current();
		parse_str($_SERVER['QUERY_STRING'], $query_arr);
		$query_arr['sort_by'] = $field;
		$query_arr['sort_order'] = 'desc';
		$new_string = http_build_query($query_arr);
		$new_url = $url.'?'.$new_string;
		$active_desc = '';
		if(isset($_GET['sort_by']) && $_GET['sort_by']==$field && isset($_GET['sort_order']) && $_GET['sort_order']=='desc'){
		$active_desc = 'active';	
		}
		?>
		<a href="<?php echo $new_url; ?>" class="sort-down <?php echo $active_desc; ?>"><i class="fa fa-chevron-down"></i></a>
		<?php
		$query_arr['sort_order'] = 'asc';
		$new_string = http_build_query($query_arr);
		$new_url = $url.'?'.$new_string;
		$active_asc = '';
		if(isset($_GET['sort_by']) && $_GET['sort_by']==$field && isset($_GET['sort_order']) && $_GET['sort_order']=='asc'){
		$active_asc = 'active';	
		}
		?>
		<a href="<?php echo $new_url; ?>" class="sort-up <?php echo $active_asc; ?>"><i class="fa fa-chevron-up"></i></a>
		<?php
	}
}

if (!function_exists('export_data_xls')) {
    function export_data_xls($data){

        // filename for download
        $filename = "contribution_data_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data as $row) {
            if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
    }
}
if (!function_exists('cleanData')) {
    function cleanData(&$str){
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

if (!function_exists('get_user_currency_by_id')) {
    function get_user_currency_by_id($id){
        $currency = DB::table('contribution')->where('ID',$id)->first();
        if(isset($currency)){
            return $currency ->currency;
        }else{
            return false;
        }
    }
}

if (!function_exists('get_user_amount_by_id')) {
    function get_user_amount_by_id($id){
        $amount = DB::table('contribution')->where('ID',$id)->first();
        if(isset($amount)){
            return $amount ->amount;
        }else{
            return false;
        }
    }
}

if (!function_exists('total_contribution_usdt')) {
    function total_contribution_usdt($id=""){
        $amount = DB::table('contribution')
		->select(DB::raw("SUM(`amount`) as all_usdt_amount"))
		->where('currency','=','usdt')->where('status','=','3')->first();
       if(isset($amount) & !empty($amount)){
			return number_format($amount->all_usdt_amount,2,'.',',');
		}
		return number_format('00000',2,'.',',');
        
    }
}

if (!function_exists('total_contribution_btc')) {
    function total_contribution_btc($id=""){
        $amount = DB::table('contribution')
		->select(DB::raw("SUM(`amount`) as all_btc_amount"))
		->where('currency','=','btc')->where('status','=','3')->first();
       if(isset($amount) & !empty($amount)){
			return number_format($amount->all_btc_amount,6,'.',',');
		}
		return number_format('00000',2,'.',',');
        
    }
}

if (!function_exists('total_contribution_eth')) {
    function total_contribution_eth($id=""){
        $amount = DB::table('contribution')
					->select(DB::raw("SUM(`amount`) as all_eth_amount"))
					->where('currency','=','eth')
					->where('status','=','3')
					->first();
		
       if(isset($amount) & !empty($amount)){
			return number_format($amount->all_eth_amount,6,'.',',');
		}
		return number_format('00000',2,'.',',');
        
    }
}


if (!function_exists('all_verified_user')) {
    function all_verified_user($id=""){
        $users = DB::table('users')
		->where(array('role_id'=>'2', 'is_activated'=>'1', 'status'=>'1' ))->get();
		$all_users = count($users);
       if(isset($all_users) & !empty($all_users)){
			return $all_users;
		}
		
        return '';
    }
}

if (!function_exists('all_acw_token')) {
    function all_acw_token($id=""){
        $amount = DB::table('contribution')
		->select(DB::raw("SUM(`base_amount`) as all_acw_amount"))
		->where('status', 3)->first();
       if(isset($amount) & !empty($amount)){
			return number_format($amount->all_acw_amount,2,'.',',');
		}
		return number_format('00000',2,'.',',');
        
    }
}

if (!function_exists('all_bonus')) {
    function all_bonus(){
        $amount = DB::table('contribution')
		->select(DB::raw("SUM(`bonus_amount`) as all_bonus_amount"))
		->where('status', 3)->first();
       if(isset($amount) & !empty($amount)){
			return number_format($amount->all_bonus_amount,2,'.',',');
		}
		return number_format('00000',2,'.',',');
        
    }
}

if (!function_exists('get_ref_commission')) {
    function get_ref_commission($id){
		$reff_bonus=0;
		$amount = DB::table('transaction')
		->where(array('parent_type'=>'ref_commission','parent_id'=>$id))->first();
       if(!empty($amount)){
			$reff_bonus = $amount->amount;
		}
		return $reff_bonus;
        
    }
}


if (!function_exists('get_user_wallet_by_email')) {
    function get_user_wallet_by_email($email){
		$wallet='';
		$wallet_data = DB::table('users')
		->where(array('email'=>$email))->first();
       if(!empty($wallet_data)){
			$wallet = $wallet_data->wallet_address;
		}
		return $wallet;
        
    }
}

if (!function_exists('subscriber_plan_details')) {
    function subscriber_plan_details($id){
		$plan='';
		$subscriber_plan = DB::table('user_subscription_plan')->where('user_id', $id)->first();
	
		if(!empty($subscriber_plan)){
			$plan = $subscriber_plan;
		
		}
		return $plan;
        
    }
}

if (!function_exists('plan_details')) {
    function plan_details($id){
		
		$membership_plans_data = DB::table('membership_plans')->where('id', $id)->first();

		return $membership_plans_data;
    }
}

if (!function_exists('is_paid_subscription')) {
    function is_paid_subscription($user_id){
		
		$membership_transactions = DB::table('membership_transactions')->where('user_id', $user_id)->first();

		return $membership_transactions;
    }
}

if (!function_exists('str_slug')) {
	function str_slug($title, $separator = '-', $language = 'en')
	{
		//$title = static::ascii($title, $language);
		// Convert all dashes/underscores into separator
		$flip = $separator == '-' ? '_' : '-';
		$title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);
		// Replace @ with the word 'at'
		$title = str_replace('@', $separator.'at'.$separator, $title);
		// Remove all characters that are not the separator, letters, numbers, or whitespace.

		// With lower case: $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));
		$title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', $title);

		// Replace all separator characters and whitespace by a single separator
		$title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);
		return trim($title, $separator);
	}
}