<?php



/*

|--------------------------------------------------------------------------

| Application Routes

|--------------------------------------------------------------------------

|

| Here is where you can register all of the routes for an application.

| It's a breeze. Simply tell Laravel the URIs it should respond to

| and give it the controller to call when that URI is requested.

|

*/









/* ADMIN AREA */

Route::group(['middleware' => 'IfLoggedIn'], function(){

    Route::group(['middleware' => 'IsAdmin'], function(){



        Route::get('iamadmin/dashboard','admin\Webadmin@dashboard')->name('admin-dashboard');



        Route::get('iamadmin/dashboard/add-user','admin\Webadmin@add_edc')->name('add-edc');

        Route::post('iamadmin/dashboard/add-user','admin\Webadmin@add_edc')->name('add-edc-post');

        Route::get('iamadmin/dashboard/edit-user/{id}','admin\Webadmin@edit_edc')->name('edit-edc');

        Route::get('iamadmin/dashboard/edit-user',function(){

            return redirect(route('all-edcs'));

        });

        Route::post('iamadmin/dashboard/edit-user','admin\Webadmin@edit_edc_post')->name('edit-edc-post');





        Route::get('iamadmin/dashboard/delete-user/{id}','admin\Webadmin@delete_edc')->name('delete-edc-post');



        Route::get('iamadmin/dashboard/users','admin\Webadmin@all_edc')->name('all-edcs');

        /* export users data */

        Route::post('iamadmin/dashboard/export-users-data','admin\Webadmin@export_users_data')->name('export-users-data');



        Route::get('iamadmin/dashboard/users/{id}','admin\Webadmin@all_referrals')->name('all-referrals');

        Route::get('iamadmin/logout','admin\Webadmin@logout')->name('admin-logout');



        /* export affiliate partner data */

        Route::post('iamadmin/dashboard/export-affiliate-partner-data','admin\Webadmin@export_affiliate_partner_data')->name('export-affiliate-partner-data');



        /*Affiliate Partners */

        Route::get('iamadmin/dashboard/add-affiliate-partner/{ID?}',function($ID = null){

            $affiliate_partner = DB::table('users')->where('ID','=',$ID)->first();

            return view('admin.add-affiliate-partner',['affiliate_partner'=>$affiliate_partner]);

        })->name('add-affiliate-partner');



        Route::get('iamadmin/dashboard/all-affiliate-partner',function(){

            $query = DB::table('users');

            $query = $query->where('role_id','=','4');

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                    $query->orWhere('phone_no','like','%'.$_GET['s'].'%');

                    $query->orWhere('full_name','like','%'.$_GET['s'].'%');

                });

            }



            if(isset($_GET['sort_by']) && !empty($_GET['sort_by']) && isset($_GET['sort_order']) && !empty($_GET['sort_order'])){

                $field = $_GET['sort_by'];

                $sort_order = $_GET['sort_order'];

                $query->orderBy($field,$sort_order);

            }



            $all_affiliate_partner_data = $query->paginate(10);

            return view('admin.all-affiliate-partner',['all_affiliate_partner'=>$all_affiliate_partner_data]);

        })->name('all-affiliate-partner');



        Route::get('iamadmin/dashboard/delete-affiliate-partner/{ID?}',function($ID = null){

			

            $users = DB::table('users')->where(array('ID' => $ID))->first();

            $del = DB::table('users')->where('ID','=',$ID)->delete();



            $data = array('name'=>$users->full_name,'email'=>$users->email);

            $res = Mail::send('mail.temp-del-notify', $data, function ($message) use ($data) {

                $message->from('support@highbank.io', 'Highbank');

                $message->to($data['email'], $data['name'])->subject('Account Deleted - Highbank');

            });

            return Redirect::route('all-affiliate-partner')->with('msg','Partner Deleted Successfully');

            return back()->with('msg','Partner Deleted Successfully');

        })->name('delete-affiliate-partner');



        Route::post('iamadmin/dashboard/save-affiliate-partner','admin\Webadmin@save_affiliate_partner')->name('save-affiliate-partner');

        Route::post('iamadmin/dashboard/update-affiliate-partner','admin\Webadmin@update_affiliate_partner')->name('update-affiliate-partner');

        /*End Affiliate Partners */



		



        /*Contact */

        Route::get('iamadmin/dashboard/add-contact/{ID?}',function($ID = null){

            $contact = DB::table('contact')->where('ID','=',$ID)->first();

            return view('admin.add-contact',['contact'=>$contact]);

        })->name('add-contact');



        Route::get('iamadmin/dashboard/all-contacts',function(){

            $query = DB::table('contact');

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                    $query->orWhere('phone','like','%'.$_GET['s'].'%');

                    $query->orWhere('name','like','%'.$_GET['s'].'%');

                });

            }



            $all_contacts_data = $query->orderBy('ID','desc')->paginate(10);

            return view('admin.all-contacts',['all_contacts'=>$all_contacts_data]);

        })->name('all-contacts');

		

        Route::get('iamadmin/dashboard/delete-contact/{ID?}',function($ID = null){

            $del = DB::table('contact')->where('ID','=',$ID)->delete();

            return back()->with('msg','Contact Deleted Successfully');

        })->name('delete-contact');



        Route::post('iamadmin/dashboard/save-contact','admin\Arindam@save_contact')->name('save-contact');

        Route::post('iamadmin/dashboard/update-contact','admin\Arindam@update_contact')->name('update-contact');

        /*End Contact */

		

		/* Plans */

		  Route::get('iamadmin/dashboard/add-plan/{id?}',function($ID = null){

            $plan = DB::table('membership_plans')->where('id','=',$ID)->first();

            return view('admin.add-plan',['plan'=>$plan]);

        })->name('add-plan');



		

		 Route::get('iamadmin/dashboard/all-plan',function(){

            $query = DB::table('membership_plans');

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                    $query->orWhere('phone','like','%'.$_GET['s'].'%');

                    $query->orWhere('name','like','%'.$_GET['s'].'%');

                });

            }



            $all_plans_data = $query->orderBy('ID','desc')->paginate(10);

            return view('admin.all-plans',['all_plans'=>$all_plans_data]);

        })->name('all-plans');

		

		Route::post('iamadmin/dashboard/save-plan','admin\Arindam@save_plan')->name('save-plan');

        Route::post('iamadmin/dashboard/update-plan','admin\Arindam@update_plan')->name('update-plan');



		/* End Plans*/

		

		



        /*translation */

        Route::get('iamadmin/dashboard/add-translation/{ID?}',function($ID = null){

            $translation = DB::table('translation')->where('ID','=',$ID)->first();

            return view('admin.add-translation',['translation'=>$translation]);

        })->name('add-translation');



        Route::get('iamadmin/dashboard/all-translation','admin\Webadmin@all_translation')->name('all-translation');



        Route::get('iamadmin/dashboard/delete-translation/{ID?}',function($ID = null){

            $del = DB::table('translation')->where('parent','=',$ID)->delete();

            $del = DB::table('translation')->where('ID','=',$ID)->delete();

            return back()->with('msg','Translation Deleted Successfully');

        })->name('delete-translation');



        Route::post('iamadmin/dashboard/save-translation','admin\Webadmin@save_translation')->name('save-translation');

        Route::post('iamadmin/dashboard/update-translation','admin\Webadmin@update_translation')->name('update-translation');

        /*End translation */

		

	    /*	Transaction   */

			





        /*language */

        Route::get('iamadmin/dashboard/add-language/{ID?}',function($ID = null){

            $language = DB::table('language')->where('ID','=',$ID)->first();

            return view('admin.add-language',['language'=>$language]);

        })->name('add-language');



        Route::get('iamadmin/dashboard/all-language',function(){

            $query = DB::table('language');

            /*

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                    $query->orWhere('phone','like','%'.$_GET['s'].'%');

                    $query->orWhere('name','like','%'.$_GET['s'].'%');

                });

            }

            */



            $all_language_data = $query->orderBy('ID','desc')->paginate(10);

            return view('admin.all-language',['all_language'=>$all_language_data]);

        })->name('all-language');



        Route::get('iamadmin/dashboard/delete-language/{ID?}',function($ID = null){

            $del = DB::table('language')->where('ID','=',$ID)->delete();

            return back()->with('msg','Language Deleted Successfully');

        })->name('delete-language');



        Route::post('iamadmin/dashboard/save-language','admin\Webadmin@save_language')->name('save-language');

        Route::post('iamadmin/dashboard/update-language','admin\Webadmin@update_language')->name('update-language');

        /*End language */





        /*Email Template */

        Route::get('iamadmin/dashboard/add-email-template/{ID?}',function($ID = null){

            $email_template = DB::table('email_template')->where('ID','=',$ID)->first();

            return view('admin.add-email-template',['email_template'=>$email_template]);

        })->name('add-email-template');



        Route::get('iamadmin/dashboard/all-email-template',function(){

            $query = DB::table('email_template');

            /*

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                    $query->orWhere('phone','like','%'.$_GET['s'].'%');

                    $query->orWhere('name','like','%'.$_GET['s'].'%');

                });

            }

            */



            $all_email_template_data = $query->orderBy('ID','desc')->paginate(10);

            return view('admin.all-email-template',['all_email_template'=>$all_email_template_data]);

        })->name('all-email-template');



        Route::get('iamadmin/dashboard/delete-email-template/{ID?}',function($ID = null){

            $del = DB::table('email_template')->where('ID','=',$ID)->delete();

            return back()->with('msg','Email Template Deleted Successfully');

        })->name('delete-email-template');



        Route::post('iamadmin/dashboard/save-email-template','admin\Webadmin@save_email_template')->name('save-email-template');

        Route::post('iamadmin/dashboard/update-email-template','admin\Webadmin@update_email_template')->name('update-email-template');

        /*End Email Template */



        /*Bonus */

        Route::get('iamadmin/dashboard/add-bonus/{ID?}',function($ID = null){

            $bonus = DB::table('bonus_master')->where('ID','=',$ID)->first();

            return view('admin.add-bonus',['bonus'=>$bonus]);

        })->name('add-bonus');



        Route::get('iamadmin/dashboard/all-bonus',function(){

            $query = DB::table('bonus_master');

            /*

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                    $query->orWhere('phone','like','%'.$_GET['s'].'%');

                    $query->orWhere('name','like','%'.$_GET['s'].'%');

                });

            }*/



            $all_bonus_data = $query->orderBy('priority','desc')->paginate(10);

            return view('admin.all-bonus',['all_bonus'=>$all_bonus_data]);

        })->name('all-bonus');



        Route::get('iamadmin/dashboard/delete-bonus/{ID?}',function($ID = null){

            $del = DB::table('bonus_master')->where('ID','=',$ID)->delete();

            return back()->with('msg','Bonus Deleted Successfully');

        })->name('delete-bonus');



        Route::post('iamadmin/dashboard/save-bonus','admin\Arindam@save_bonus')->name('save-bonus');

        Route::post('iamadmin/dashboard/update-bonus','admin\Arindam@update_bonus')->name('update-bonus');

        /*End Bonus */



        /*Subscribers */

        Route::get('iamadmin/dashboard/all-subscribers',function(){

            $query = DB::table('subscribers');

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != ""){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                });

            }



            $all_subscribers_data = $query->orderBy('ID','desc')->paginate(10);

            return view('admin.all-subscribers',['all_subscribers'=>$all_subscribers_data]);

        })->name('all-subscribers');

        Route::get('iamadmin/dashboard/add-subscriber/{ID?}',function($ID = null){

            $subscriber = DB::table('subscribers')->where('ID','=',$ID)->first();

            return view('admin.add-subscriber',['subscriber'=>$subscriber]);

        })->name('add-subscriber');



        Route::get('iamadmin/dashboard/delete-subscriber/{ID?}',function($ID = null){

            $del = DB::table('subscribers')->where('ID','=',$ID)->delete();

            return back()->with('msg','Subscriber Deleted Successfully!');

        })->name('delete-subscriber');



        Route::post('iamadmin/dashboard/save-subscriber','admin\Webadmin@save_subscriber')->name('save-subscriber');

        Route::post('iamadmin/dashboard/update-subscriber','admin\Webadmin@update_subscriber')->name('update-subscriber');

        /*End Subscribers */



        /* export contribution data */

        Route::post('iamadmin/dashboard/export-contribution-data','admin\Webadmin@export_contribution_data')->name('export-contribution-data');

        /*contribution */

        Route::get('iamadmin/dashboard/add-contribution/{ID?}',function($ID = null){

            $contribution = DB::table('contribution')->where('ID','=',$ID)->first();

            $users = DB::table('users')->get();

            return view('admin.add-contribution',['contribution'=>$contribution,'users'=>$users]);

        })->name('add-contribution');



        Route::get('iamadmin/dashboard/all-contributions',function(){

            $query = DB::table('contribution');

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['currency']) && $_GET['currency'] != ""){

                $query = $query->where('currency','=',$_GET['currency']);

            }

            if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){



                $query = $query->where(function($query){

                    $query->where('email','like','%'.$_GET['s'].'%');

                });

            }



            if(isset($_GET['sort_by']) && !empty($_GET['sort_by']) && isset($_GET['sort_order']) && !empty($_GET['sort_order'])){

                $field = $_GET['sort_by'];

                $sort_order = $_GET['sort_order'];

                $query->orderBy($field,$sort_order);

            }else{

				$query->orderBy('created_date','desc');

			}



            $all_contributions_data = $query->paginate(10);

            return view('admin.all-contributions',['all_contributions'=>$all_contributions_data]);

        })->name('all-contributions');



        Route::get('iamadmin/dashboard/delete-contribution/{ID?}',function($ID = null){

            $del_transaction = DB::table('transaction')->where('parent_id','=',$ID)->delete();

            $del = DB::table('contribution')->where('ID','=',$ID)->delete();

            return back()->with('msg','Contribution Deleted Successfully!');

        })->name('delete-contribution');



        Route::post('iamadmin/dashboard/save-contribution','admin\Webadmin@save_contribution')->name('save-contribution');

        Route::post('iamadmin/dashboard/update-contribution','admin\Webadmin@update_contribution')->name('update-contribution');

        /*End contribution */









        /*upload Master*/

        Route::get('iamadmin/dashboard/all-assets',function(){

            $query = DB::table('upload_master');



            if(isset($_GET['s']) && !empty($_GET['s'])){

                $s = $_GET['s'];

                $query = $query->Where('name','like','%'.$s.'%');

            }

            $all_assets_data = $query->orderBy('ID','desc')->get();

            return view('admin.all-assets',['all_assets'=>$all_assets_data]);

        })->name('all-assets');



        Route::get('iamadmin/dashboard/all-uploads',function(){

            $query = DB::table('upload_master');



            if(isset($_GET['s']) && !empty($_GET['s'])){

                $s = $_GET['s'];

                $query = $query->Where('name','like','%'.$s.'%');

            }

            $all_uploads_data = $query->orderBy('ID','desc')->paginate(27);

            return view('admin.all-uploads',['all_uploads'=>$all_uploads_data]);

        })->name('all-uploads');



        Route::get('iamadmin/dashboard/delete-upload/{ID?}','admin\Webadmin@delete_upload')->name('delete-upload');



        /*End upload Master*/



        /*pages */

        Route::get('iamadmin/dashboard/add-page/{ID?}',function($ID = null){

            $page = DB::table('cms_pages')->where('ID','=',$ID)->first();

            return view('admin.add-page',['page'=>$page]);

        })->name('add-page');



        Route::get('iamadmin/dashboard/all-pages',function(){

            $query = DB::table('cms_pages');

            if(isset($_GET['status']) && $_GET['status'] >=0 ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && !empty($_GET['s'])){

                $s = $_GET['s'];

                $query = $query->orWhere('title','like','%'.$s.'%')->orWhere('description','like','%'.$s.'%');

            }

            //$all_news_data = DB::table('news')->orderBy('ID','desc')->paginate(15);

            $all_pages_data = $query->orderBy('ID','desc')->paginate(15);

            return view('admin.all-pages',['all_pages'=>$all_pages_data]);

        })->name('all-pages');



        Route::get('iamadmin/dashboard/delete-page/{ID?}',function($ID = null){

            $del = DB::table('cms_pages')->where('ID','=',$ID)->delete();

            return back()->with('msg','Page Deleted Successfully !');

        })->name('delete-page');



        Route::post('iamadmin/dashboard/save-page','admin\Webadmin@save_page')->name('save-page');

        Route::post('iamadmin/dashboard/update-page','admin\Webadmin@update_page')->name('update-page');

        /*End pages */







        /*KYC */

        Route::get('iamadmin/dashboard/add-kyc-application/{ID?}',function($ID = null){

            $kyc = DB::table('kyc')->where('ID','=',$ID)->first();

            $users = DB::table('users')->where('role_id',2)->get();

            //$users = DB::table('users')->pluck('ID', 'email', 'first_name', 'last_name', 'country', 'date_of_birth', 'phone_no')->get();

            return view('admin.add-kyc-application',['kyc'=>$kyc,'users'=>$users]);

        })->name('add-kyc-application');



        Route::get('iamadmin/dashboard/all-kyc-applications',function(){

            $query = DB::table('kyc');

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }else if(isset($_GET['s']) && $_GET['s'] != "" && !empty($_GET['s'])){

                $query = $query->where('first_name','like','%'.trim(urldecode($_GET['s'])).'%');

                $query = $query->orWhere('last_name','like','%'.trim(urldecode($_GET['s'])).'%');

                $query = $query->orWhere('email','like','%'.trim(urldecode($_GET['s'])).'%');

                $query = $query->orWhere('first_name','like','%'.trim(urldecode($_GET['s'])));

                $query = $query->orWhere('last_name','like',trim(urldecode($_GET['s'])).'%');

                $query = $query->orWhere(DB::raw("CONCAT(`first_name`,' ',`last_name`)"), 'like', '%'.trim(urldecode($_GET['s'])).'%');

            }

            /*else{

                $query = $query->where('latest_one','=',1);

            }*/

            $all_kyc_data = $query->orderBy('ID','desc')->paginate(10);

            return view('admin.all-kyc-applications',['all_kyc'=>$all_kyc_data]);

        })->name('all-kyc-applications');



        Route::get('iamadmin/dashboard/delete-kyc-application/{ID?}',function($ID = null){

            $del = DB::table('kyc')->where('ID','=',$ID)->delete();

            return back()->with('msg','Application Deleted Successfully');

        })->name('delete-kyc-application');



        Route::post('iamadmin/dashboard/save-kyc-application','admin\Arindam@save_kyc')->name('save-kyc-application');

        Route::post('iamadmin/dashboard/update-kyc-application','admin\Arindam@update_kyc')->name('update-kyc-application');

        /*End KYC */



        /*people */

        Route::get('iamadmin/dashboard/add-people/{ID?}',function($ID = null){

            $people = DB::table('people')->where('ID','=',$ID)->first();

            $people_category = DB::table('people_category')->where('status','=','1')->get();

            return view('admin.add-people',['people'=>$people,'people_category'=>$people_category]);

        })->name('add-people');



        Route::get('iamadmin/dashboard/all-people',function(){

            $query = DB::table('people');

            $lang = get_admin_language();

            $query = $query->where('lang',$lang);

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != ""){

                $query = $query->where('full_name','like','%'.urldecode(trim($_GET['s'])).'%');

                $query = $query->orWhere('description','like','%'.urldecode(trim($_GET['s'])).'%');

            }

            $all_people_data = $query->orderBy('order','asc')->paginate(10);

            return view('admin.all-people',['all_people'=>$all_people_data]);

        })->name('all-people');



        Route::get('iamadmin/dashboard/delete-people/{ID?}',function($ID = null){

            $del = DB::table('people')->where('ID','=',$ID)->delete();

            return back()->with('msg','People Deleted Successfully !');

        })->name('delete-people');



        Route::post('iamadmin/dashboard/save-people','admin\Arindam@save_people')->name('save-people');

        Route::post('iamadmin/dashboard/update-people','admin\Arindam@update_people')->name('update-people');

        /*End people */



        /*people_category */

        Route::get('iamadmin/dashboard/add-people-category/{ID?}',function($ID = null){

            $people_cat = DB::table('people_category')->where('ID','=',$ID)->first();

            return view('admin.add-people-category',['people_cat'=>$people_cat]);

        })->name('add-people-category');



        Route::get('iamadmin/dashboard/all-people-category',function(){

            $query = DB::table('people_category');



            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['s']) && $_GET['s'] != ""){

                $query = $query->where('name','like','%'.$_GET['s'].'%');

            }

            $all_people_cat_data = $query->orderBy('order','asc')->paginate(10);

            return view('admin.all-people-category',['all_people_cat'=>$all_people_cat_data]);

        })->name('all-people-category');



        Route::get('iamadmin/dashboard/delete-people-category/{ID?}',function($ID = null){

            $del = DB::table('people_category')->where('ID','=',$ID)->delete();

            return back()->with('msg','Category Deleted Successfully !');

        })->name('delete-people-category');



        Route::post('iamadmin/dashboard/save-people-cat','admin\Arindam@save_people_cat')->name('save-people-category');

        Route::post('iamadmin/dashboard/update-people-cat','admin\Arindam@update_people_cat')->name('update-people-category');

        /*End people_category */



        /*whitepaper */

        Route::get('iamadmin/dashboard/add-whitepaper/{ID?}',function($ID = null){

            $whitepaper = DB::table('whitepaper')->where('ID','=',$ID)->first();

            return view('admin.add-whitepaper',['whitepaper'=>$whitepaper]);

        })->name('add-whitepaper');



        Route::get('iamadmin/dashboard/all-whitepaper',function(){

            $query = DB::table('whitepaper');



            $lang = get_admin_language();

            $query = $query->where('lang',$lang);



            if(isset($_GET['status']) && $_GET['status'] !="" ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && $_GET['s'] !=""){

                $s = $_GET['s'];

                $query = $query->Where('title','like','%'.$s.'%')->orWhere('description','like','%'.$s.'%');

            }



            $all_whitepaper_data = $query->orderBy('ID','desc')->paginate(15);

            return view('admin.all-whitepaper',['all_whitepaper'=>$all_whitepaper_data]);

        })->name('all-whitepaper');



        Route::get('iamadmin/dashboard/delete-whitepaper/{ID?}',function($ID = null){

            $del = DB::table('whitepaper')->where('ID','=',$ID)->delete();

            return back()->with('msg','whitepaper Deleted Successfully');

        })->name('delete-whitepaper');



        Route::post('iamadmin/dashboard/save-whitepaper','admin\Webadmin@save_whitepaper')->name('save-whitepaper');

        Route::post('iamadmin/dashboard/update-whitepaper','admin\Webadmin@update_whitepaper')->name('update-whitepaper');

        /*End whitepaper */



        /*video */

        Route::get('iamadmin/dashboard/add-video/{ID?}',function($ID = null){

            $video = DB::table('videos')->where('ID','=',$ID)->first();

            return view('admin.add-video',['video'=>$video]);

        })->name('add-video');



        Route::get('iamadmin/dashboard/all-video',function(){

            $query = DB::table('videos');



            //$lang = get_admin_language();

            //$query = $query->where('lang',$lang);



            if(isset($_GET['status']) && $_GET['status'] !="" ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && !empty($_GET['s'])){

                $s = $_GET['s'];

                $query = $query->Where('title','like','%'.$s.'%')->orWhere('description','like','%'.$s.'%');

            }



            $all_video_data = $query->orderBy('ID','desc')->paginate(15);

            return view('admin.all-video',['all_video'=>$all_video_data]);

        })->name('all-video');



        Route::get('iamadmin/dashboard/delete-video/{ID?}',function($ID = null){

            $del = DB::table('videos')->where('ID','=',$ID)->delete();

            return back()->with('msg','Video Deleted Successfully');

        })->name('delete-video');



        Route::post('iamadmin/dashboard/save-video','admin\Webadmin@save_video')->name('save-video');

        Route::post('iamadmin/dashboard/update-video','admin\Webadmin@update_video')->name('update-video');



        /* Landing page video */

        Route::get('iamadmin/dashboard/landing-page-video',function(){

            return view('admin.landing-page-video');

        })->name('landing-page-video');



        Route::post('iamadmin/dashboard/save-landing-page-video','admin\Webadmin@save_landing_page_video')->name('save-landing-page-video');

        /*End of Landing page video */

        /*End video */



        /*roadmap */

        Route::get('iamadmin/dashboard/add-roadmap/{ID?}',function($ID = null){

            $roadmap = DB::table('roadmap')->where('ID','=',$ID)->first();

            return view('admin.add-roadmap',['roadmap'=>$roadmap]);

        })->name('add-roadmap');



        Route::get('iamadmin/dashboard/all-roadmap',function(){

            $query = DB::table('roadmap');



            $lang = get_admin_language();

            $query = $query->where('lang',$lang);



            if(isset($_GET['status']) && $_GET['status'] !=0 ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && $_GET['s'] !=""){

                $s = $_GET['s'];

                $query = $query->Where('title','like','%'.$s.'%')->orWhere('description','like','%'.$s.'%');

            }



            $all_roadmap_data = $query->orderBy('order','asc')->paginate(15);

            return view('admin.all-roadmap',['all_roadmap'=>$all_roadmap_data]);

        })->name('all-roadmap');



        Route::get('iamadmin/dashboard/delete-roadmap/{ID?}',function($ID = null){

            $del = DB::table('roadmap')->where('ID','=',$ID)->delete();

            return back()->with('msg','Roadmap Deleted Successfully');

        })->name('delete-roadmap');



        Route::post('iamadmin/dashboard/save-roadmap','admin\Webadmin@save_roadmap')->name('save-roadmap');

        Route::post('iamadmin/dashboard/update-roadmap','admin\Webadmin@update_roadmap')->name('update-roadmap');

        /*End roadmap */



        /*token */



        /*All Token */





        Route::get('iamadmin/dashboard/add-token/{ID?}',function($ID = null){

            $token = DB::table('token_info')->where('ID','=',$ID)->first();

            return view('admin.add-token',['token'=>$token]);

        })->name('add-token');





        Route::get('iamadmin/dashboard/all-token',function(){

            $query = DB::table('token_info');



            $lang = get_admin_language();

            $query = $query->where('lang',$lang);



            if(isset($_GET['status']) && $_GET['status'] >=0 ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && !empty($_GET['s'])){

                $s = $_GET['s'];

                $query = $query->Where('title','like','%'.$s.'%')->orWhere('description','like','%'.$s.'%');

            }



            $all_token_data = $query->orderBy('order','asc')->paginate(15);

            return view('admin.all-token',['all_token'=>$all_token_data]);

        })->name('all-token');



        Route::get('iamadmin/dashboard/delete-token/{ID?}',function($ID = null){

            $del = DB::table('token_info')->where('ID','=',$ID)->delete();

            return back()->with('msg','Token Deleted Successfully');

        })->name('delete-token');



        Route::post('iamadmin/dashboard/save-token','admin\Webadmin@save_token')->name('save-token');

        Route::post('iamadmin/dashboard/update-token','admin\Webadmin@update_token')->name('update-token');



        /*End of All */



        /*Token Platform & Distribution */

        Route::get('iamadmin/dashboard/platform-distribution',function(){

            return view('admin.platform-distribution');

        })->name('platform-distribution');



        Route::post('iamadmin/dashboard/save-platform-distribution','admin\Webadmin@save_platform_distribution')->name('save-platform-distribution');

        /*End of Token Platform & Distribution */

        /*ICO Phases */



        Route::get('iamadmin/dashboard/ico-phase',function(){

            return view('admin.ico-phase');

        })->name('ico-phase');



        Route::post('iamadmin/dashboard/save-ico-phase','admin\Webadmin@save_ico_phase')->name('save-ico-phase');



        /*End of ICO Phases */



        /*General Token Info by Sakil*/

        Route::get('iamadmin/dashboard/general-token-info',function(){

            return view('admin.general-token-info');

        })->name('general-token-info');



        Route::post('iamadmin/dashboard/save-general-token-info','admin\Webadmin@save_general_token_info')->name('save-general-token-info');

        /*End General Token Info*/



        /*End token info */



        /*partner */

        Route::get('iamadmin/dashboard/add-partner/{ID?}',function($ID = null){

            $partner = DB::table('partners')->where('ID','=',$ID)->first();

            return view('admin.add-partner',['partner'=>$partner]);

        })->name('add-partner');



        Route::get('iamadmin/dashboard/all-partner',function(){

            $query = DB::table('partners');



            $lang = get_admin_language();

            $query = $query->where('lang',$lang);



            if(isset($_GET['status']) && $_GET['status'] !="" ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && $_GET['s'] !="" ){

                $s = $_GET['s'];

                $query = $query->orWhere('name','like','%'.$s.'%');

            }



            $all_partner_data = $query->orderBy('order','asc')->paginate(15);

            return view('admin.all-partner',['all_partner'=>$all_partner_data]);

        })->name('all-partner');



        Route::get('iamadmin/dashboard/delete-partner/{ID?}',function($ID = null){

            $del = DB::table('partners')->where('ID','=',$ID)->delete();

            return back()->with('msg','Partner Deleted Successfully');

        })->name('delete-partner');



        Route::post('iamadmin/dashboard/save-partner','admin\Webadmin@save_partner')->name('save-partner');

        Route::post('iamadmin/dashboard/update-partner','admin\Webadmin@update_partner')->name('update-partner');

        /*End partner */

		



        /* ICO Listing */

        Route::get('iamadmin/dashboard/add-ico-listing/{ID?}',function($ID = null){

            $ico_listing = DB::table('ico_listing')->where('ID','=',$ID)->first();

            return view('admin.add-ico-listing',['ico_listing'=>$ico_listing]);

        })->name('add-ico-listing');



        Route::get('iamadmin/dashboard/all-ico-listing',function(){

            $query = DB::table('ico_listing');



            if(isset($_GET['status']) && $_GET['status'] !="" ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && $_GET['s'] !="" ){

                $s = $_GET['s'];

                $query = $query->orWhere('name','like','%'.$s.'%');

            }



            $all_ico_listing_data = $query->orderBy('order','asc')->paginate(15);

            return view('admin.all-ico-listing',['all_ico_listing'=>$all_ico_listing_data]);

        })->name('all-ico-listing');



        Route::get('iamadmin/dashboard/delete-ico-listing/{ID?}',function($ID = null){

            $del = DB::table('ico_listing')->where('ID','=',$ID)->delete();

            return back()->with('msg','ICO Listing Deleted Successfully');

        })->name('delete-ico-listing');



        Route::post('iamadmin/dashboard/save-ico-listing','admin\Webadmin@save_ico_listing')->name('save-ico-listing');

        Route::post('iamadmin/dashboard/update-ico-listing','admin\Webadmin@update_ico_listing')->name('update-ico-listing');

		

        /*ICO Listing */



		/* Airdrop Listing */

        Route::get('iamadmin/dashboard/add-airdrop-listing/{ID?}',function($ID = null){

            $airdrop_listing = DB::table('airdrop_listing')->where('ID','=',$ID)->first();

            return view('admin.add-airdrop-listing',['airdrop_listing'=>$airdrop_listing]);

        })->name('add-airdrop-listing');



        Route::get('iamadmin/dashboard/all-airdrop-listing',function(){

            $query = DB::table('airdrop_listing');



            if(isset($_GET['status']) && $_GET['status'] !="" ){

                $status = $_GET['status'];

                $query = $query->where('status',$status);

            }

            if(isset($_GET['s']) && $_GET['s'] !="" ){

                $s = $_GET['s'];

                $query = $query->orWhere('name','like','%'.$s.'%');

            }



            $all_airdrop_listing_data = $query->orderBy('order','asc')->paginate(15);

            return view('admin.all-airdrop-listing',['all_airdrop_listing'=>$all_airdrop_listing_data]);

        })->name('all-airdrop-listing');



        Route::get('iamadmin/dashboard/delete-airdrop-listing/{ID?}',function($ID = null){

            $del = DB::table('airdrop_listing')->where('ID','=',$ID)->delete();

            return back()->with('msg','Airdrop Listing Deleted Successfully');

        })->name('delete-airdrop-listing');



        Route::post('iamadmin/dashboard/save-airdrop-listing','admin\Webadmin@save_airdrop_listing')->name('save-airdrop-listing');

        Route::post('iamadmin/dashboard/update-airdrop-listing','admin\Webadmin@update_airdrop_listing')->name('update-airdrop-listing');

		

        /*Airdrop Listing */





        /*Profile Edit*/

        Route::get('iamadmin/dashboard/edit-profile',function(){

            $udata = DB::table('users')->where('ID','=',Session::get('userid'))->first();

            return view('admin.edit-profile',['udata'=>$udata]);

        })->name('edit-profile');



        Route::post('iamadmin/dashboard/save-edit-profile','admin\Arindam@save_edit_profile')->name('save-edt-profile');

        /*End Profile Edit*/



        /* Documents */

        Route::get('iamadmin/dashboard/all-docs',function(){

            $query = DB::table('documents');



            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['name']) && $_GET['name'] != "" && !empty($_GET['name'])){

                $query = $query->where('name','like','%'.$_GET['name'].'%');

            }

            //$all_docs_data = $query->orderBy('order','asc')->paginate(10);

            $all_docs_data = $query->orderBy('order','asc')->paginate(10);

            return view('admin.documents.all-documents',['all_docs'=>$all_docs_data]);

        })->name('all-docs');



        Route::get('iamadmin/dashboard/add-doc/{ID?}',function($ID = null){

            $doc = DB::table('documents')->where('id','=',$ID)->first();

            return view('admin.documents.add-document',['doc'=>$doc]);

        })->name('add-doc');



        Route::get('iamadmin/dashboard/delete-doc/{ID?}',function($ID = null){

            $del_doc = \App\Document::find($ID);

            // delete old images

            delete_upload($del_doc->upload_master_id);

            $del = $del_doc->delete();

            return back()->with('msg','Document Deleted Successfully !');

        })->name('delete-doc');



        Route::post('iamadmin/dashboard/save-doc','admin\Webadmin@save_doc')->name('save-doc');

        Route::post('iamadmin/dashboard/update-doc','admin\Webadmin@update_doc')->name('update-doc');

        /*End Documents*/



        /*General Settings*/

        Route::get('iamadmin/dashboard/general-settings',function(){

            return view('admin.general-settings');

        })->name('general-settings');



        Route::post('iamadmin/dashboard/save-general-settings','admin\Webadmin@save_general_settings')->name('save-general-settings');

        /*End General Settings*/

		

		/*Social Media Links*/

        Route::get('iamadmin/dashboard/social-media-links',function(){

            return view('admin.social-media-links');

        })->name('social-media-links');



        Route::post('iamadmin/dashboard/save-social-media-links','admin\Webadmin@save_social_media_links')->name('save-social-media-links');

        /*End Social Media Links*/



        /*Change Password*/

        Route::get('iamadmin/dashboard/change-password',function(){

            return view('admin.change-password');

        })->name('change-password');



        Route::post('iamadmin/dashboard/save-password','admin\Arindam@change_password')->name('save-cng-pwd');

        /*End Change Password*/



        /*Banner Settings*/

        Route::get('iamadmin/dashboard/add-banner/{ID?}',function($ID = null){

            $banners = DB::table('banner')->get();

            $oneBanner = array();

            if($ID != null && $ID != "")

            {

                $oneBanner = DB::table('banner')->where('ID','=',$ID)->first();

            }

            return view('admin.banner-management',['banners'=>$banners,'oneBanner'=>$oneBanner]);

        })->name('banner-management');



        Route::get('iamadmin/dashboard/delete-banner/{ID?}',function($ID){

            DB::table('banner')->where('ID','=',$ID)->delete();

            return back()->with('error','Banner Deleted Successfully.');

        })->name('del-banner');



        Route::post('iamadmin/dashboard/upload-banner','admin\Arindam@upload_banner')->name('upload-banner');

        Route::post('iamadmin/dashboard/update-banner','admin\Arindam@update_banner')->name('update-banner');

        /*End Banner Settings*/





        /*bulk delete*/

        Route::post('iamadmin/dashboard/bulk-delete','admin\Webadmin@bulk_delete')->name('bulk-delete');

        /*bulk delete*/



        /*Faqs */

        Route::get('iamadmin/dashboard/add-faq/{ID?}',function($ID = null){

            $faq = DB::table('faqs')->where('id','=',$ID)->first();

            return view('admin.faqs.add-faq',['faq'=>$faq]);

        })->name('add-faq');



        Route::get('iamadmin/dashboard/all-faqs',function(){

            $query = DB::table('faqs');

            $lang = get_admin_language();

            if(isset($_GET['status']) && $_GET['status'] != ""){

                $query = $query->where('status','=',$_GET['status']);

            }

            if(isset($_GET['question']) && $_GET['question'] != ""){

                $query = $query->where('question','like','%'.urldecode(trim($_GET['question'])).'%');

            }

            $all_faqs_data = $query->orderBy('order','asc')->paginate(10);

            return view('admin.faqs.all-faqs',['all_faqs'=>$all_faqs_data]);

        })->name('all-faqs');



        Route::get('iamadmin/dashboard/delete-faq/{ID?}',function($ID = null){

            $del = DB::table('faqs')->where('id','=',$ID)->delete();

            return back()->with('msg','Faq Deleted Successfully !');

        })->name('delete-faq');



        Route::post('iamadmin/dashboard/save-faq','admin\Arindam@save_faq')->name('save-faq');

        Route::post('iamadmin/dashboard/update-faq','admin\Arindam@update_faq')->name('update-faq');

        /*End people */





    }); //IsAdmin middleware end

















    Route::group(['middleware' => 'IsEdc'], function(){











    }); //IsEdc middleware end







}); // IfLogin middleware end













Route::group(['middleware' => 'IfNotLoggedIn'], function(){

    //Route::post('admin','admin\Webadmin@login')->name('admin-login-post');



    Route::post('admin-submit', array('as'=>'admin-login-post', 'uses'=>'admin\Webadmin@login'));

    Route::get('iamadmin', array('as'=>'admin-login', 'uses'=>'admin\Webadmin@login'));



    //Route::get('admin','admin\Webadmin@login')->name('admin-login');

    //Route::get('admin/login','admin\Webadmin@login')->name('admin-login');

});











Route::get('no-page-404',function(){

    return view('404');

})->name('404');



Route::post('ajax-status-change','edc\ArindamEdc@ajax_status_update')->name('ajx-status-change');

Route::post('ajax-done-change','edc\ArindamEdc@ajax_done_update')->name('ajx-done-change');

Route::post('ajax-isfront-change','edc\ArindamEdc@ajax_isfront_update')->name('ajx-isfront-change');

Route::post('ajax-order-change','edc\ArindamEdc@ajax_order_update')->name('ajx-order-change');

Route::post('set-language','edc\ArindamEdc@set_lng')->name('set-language');













/******************* FRONT END ************************/

Route::get('/',function(){

        set_front_language();

        $lang = get_front_language();

		

        $ico_listing = DB::table('ico_listing')

            ->where('status','=','1')

            //->where('image_id','>','0')

            ->orderBy('order','asc')

            ->select('*')

            ->get();

			

        $airdrop_listing = DB::table('airdrop_listing')

            ->where('status','=','1')

            //->where('image_id','>','0')

            ->orderBy('order','asc')

            ->select('*')

            ->get();

			

		$partners = DB::table('partners')

            ->where('status','=','1')

            ->where('image_id','>','0')

            ->orderBy('order','asc')

            ->select('*')

            ->get();



        $team = DB::table('people')

            ->where('status','=','1')

            ->where('category_id','=','1')

            ->orderBy('order','asc')

            ->select('*')

            ->get();



        $advisor = DB::table('people')

            ->where('status','=','1')

            ->where('category_id','=','2')

            ->orderBy('order','asc')

            ->select('*')

            ->get();



        $roadmap = DB::table('roadmap')

            ->where('status','=','1')

            ->orderBy('order','asc')

            ->select('*')

            ->get();



        $whitepaper = DB::table('whitepaper')

            ->where('status','=','1')

            ->where('is_show_front','=','1')

            ->where('image_id','>','0')

            ->orderBy('ID','desc')

            ->first();



        $k_videos = DB::table('videos')

            ->where('status','=','1')

            ->where('video_language','=','2')

            ->orderBy('ID','desc')

            ->get();

        $e_videos = DB::table('videos')

            ->where('status','=','1')

            ->where('video_language','=','1')

            ->orderBy('ID','desc')

            ->get();



        $token_info = DB::table('token_info')

            ->where('status','=','1')

            ->orderBy('order','asc')

            ->take(4)

            ->get();



        $faqs = DB::table('faqs')

            ->where('status','=','1')

            ->orderBy('order','asc')

            ->get();



        $documents = DB::table('documents')

            ->where('status','=','1')

            ->orderBy('order','asc')

            ->get();



        $top_documents = DB::table('documents')

            ->where('status','=','1')->where('is_show_front','=','1')

            ->get();

		

		

		

		// $jsonurl = "https://highbankblog.weprovidewebsite.com/API/LatestBlogs.php";

		// $json = file_get_contents($jsonurl);

		// $blogs = json_decode($json);

        // 

		//$blogs = response()->json($bitcoin);

		/*$blogs = DB::table('highbank_blog.wp_users')

            ->where('user_status','=','0')

            ->get(); */



        /*

        $mobile_roadmap = $roadmap;

        if(isset($roadmap) && count($roadmap) > 0)

        {

            $roadmap = rearrange_roadmap($roadmap);

        }

        */



        return view('frontend.high',['ico_listing'=>$ico_listing,'airdrop_listing'=>$airdrop_listing,'partners'=>$partners,'team'=>$team,'advisor'=>$advisor,'roadmap'=>$roadmap,'whitepaper'=>$whitepaper,'token_info'=>$token_info,'e_videos'=>$e_videos,'k_videos'=>$k_videos,'faqs'=>$faqs,'documents'=>$documents,'top_documents'=>$top_documents]);

        //, 'blogs'=>$blogs

    })->name('high');

	

Route::get('/demo', function () {



    set_front_language();

    $lang = get_front_language();

    $partners = DB::table('partners')

        ->where('status','=','1')

        ->where('image_id','>','0')

        ->where('lang','=',$lang)

        /*->orderBy('ID','DESC')*/

        ->orderBy('order','asc')

        ->select('*')

        ->take(10)

        ->get();



    $team = DB::table('people')

        ->where('status','=','1')

        ->where('category_id','=','1')

        ->where('lang','=',$lang)

        /*->orderBy('ID','DESC')*/

        ->orderBy('order','asc')

        ->select('*')

        /*->take(4)*/

        ->get();



    $advisor = DB::table('people')

        ->where('status','=','1')

        ->where('category_id','=','2')

        ->where('lang','=',$lang)

        /*->orderBy('ID','DESC')*/

        ->orderBy('order','asc')

        ->select('*')

        /*->take(3)*/

        ->get();



    $roadmap = DB::table('roadmap')

        ->where('status','=','1')

        ->where('lang','=',$lang)

        ->orderBy('order','asc')

        ->select('*')

        ->get();



    $whitepaper = DB::table('whitepaper')

        ->where('status','=','1')

        ->where('is_show_front','=','1')

        ->where('lang','=',$lang)

        ->where('image_id','>','0')

        ->orderBy('ID','desc')

        ->first();



    $k_videos = DB::table('videos')

        ->where('status','=','1')

        ->where('video_language','=','2')

        ->orderBy('ID','desc')

        ->get();

    $e_videos = DB::table('videos')

        ->where('status','=','1')

        ->where('video_language','=','1')

        ->orderBy('ID','desc')

        ->get();



    $token_info = DB::table('token_info')

        ->where('status','=','1')

        ->where('lang','=',$lang)

        ->orderBy('order','asc')

        ->take(4)

        ->get();



    /*

    $mobile_roadmap = $roadmap;

    if(isset($roadmap) && count($roadmap) > 0)

    {

        $roadmap = rearrange_roadmap($roadmap);

    }

    */



    return view('frontend.home',['partners'=>$partners,'team'=>$team,'advisor'=>$advisor,'roadmap'=>$roadmap,'whitepaper'=>$whitepaper,'token_info'=>$token_info,'e_videos'=>$e_videos,'k_videos'=>$k_videos]);

})->name('home');



Route::group(['middleware' => 'IfNotLoggedInFront'], function(){

    

    Route::get('login',function(){

        return view('frontend.login');

    })->name('login');



    Route::get('recovery',function(){

        return view('frontend.recovery');

    })->name('recovery');

	

	



    Route::get('signup',function(){

		

		$plan=DB::table('membership_plans')

        ->where('status','=','1')

        ->orderBy('id','asc')

        ->select('*')

        ->get();

		

        return view('frontend.sign-up',['plans'=>$plan]);

    })->name('signup');



    Route::get('partner/signup',function(){

        return view('frontend.partner-sign-up');

    })->name('partner-signup');



    Route::post('partner-signup','frontend\Index@partner_signup')->name('partner-post-signup');

    Route::post('signup','frontend\Index@signup')->name('post-signup');

    Route::post('login','frontend\Index@login')->name('post-login');

    Route::post('submit-otp','frontend\Index@submit_otp')->name('post-otp');



    Route::post('recovery','frontend\Index@sendrecovery')->name('post-recovery');



    Route::get('resetpassword','frontend\Index@resetpassword')->name('resetpassword');



    Route::get('resendotp','frontend\Index@resendotp')->name('resendotp');

    Route::post('resetpassword','frontend\Index@save_resetpassword')->name('resetpassword-post');



});



Route::group(['middleware' => 'IfLoggedInFront'], function(){



    Route::get('dashboard',function(){

        set_front_language();

        $lang = get_front_language();

        $token_info = DB::table('token_info')

            ->where('status','=','1')

            ->where('lang','=',$lang)

            ->orderBy('order','asc')

            ->take(4)

            ->get();

        $front_user_id = get_current_front_user_id();

        $account_detail = '';

        if($front_user_id > 0){

            $account_detail = DB::table('users')->where('ID', $front_user_id)->first();

           

				

        }

        return view('frontend.dashboard',['token_info'=>$token_info,'user_detail'=>$account_detail]);

    })->name('dashboard');


	/*Change Password*/
	
	Route::post('save-password','frontend\Index@change_password')->name('user_save-cng-pwd');
	
	/*End Change Password*/	


    Route::get('account','frontend\Index@account')->name('account');

    Route::get('partner-account','frontend\Index@partner_account')->name('partner-account');



    Route::post('account','frontend\Index@save_account')->name('account-post');

    Route::post('partner-account','frontend\Index@partner_save_account')->name('partner-account-post');



    Route::post('resend-email','frontend\Index@resend_email')->name('resend-email');

    Route::post('iamadmin/dashboard/update-logo','frontend\Index@update_logo')->name('update-logo');



    Route::get('kyc',function(){

        $front_user_id = get_current_front_user_id();

        $kyc = DB::table('kyc')->where(array('user_id' => $front_user_id,'latest_one' => '1'))->first();

        return view('frontend.kyc',['kyc'=>$kyc]);

    })->name('kyc');



    Route::get('token',function(){

        return view('frontend.token');

    })->name('token');



    Route::get('faq',function(){

        return view('frontend.faq');

    })->name('faq');



    Route::get('policy',function(){

        return view('frontend.policy');

    })->name('policy');



    Route::get('how-to',function(){

        return view('frontend.how-to');

    })->name('how-to');



    Route::get('contribution',function(){

        return view('frontend.contribution');

    })->name('contribution');



    Route::get('referrals','frontend\Index@referrals')->name('referrals');

    Route::get('partner-referrals','frontend\Index@partner_referrals')->name('partner-referrals');





    Route::get('kyc/application','frontend\Index@kyc_applicatyion')->name('kyc-application');

    Route::post('kyc/application','frontend\Index@save_kyc')->name('post-kyc');



    Route::get('kyc/status','frontend\Index@kyc_status')->name('kyc-status');





    Route::post('contribution/submit','frontend\Index@submit_contribution')->name('post-contribution');

	Route::get('transaction-history','frontend\Index@user_contribution')->name('ur-transaction');



    /*Subscribtion Transaction*/

	Route::get('dashboard/subscription-trans','frontend\Index@subs_transaction')->name('sub-transaction');

		

		

    /*End Subscribtion Transaction*/	

});



Route::get('verify','frontend\Index@verifyemail')->name('verify');



Route::get('logout','admin\Webadmin@userlogout')->name('logout');



/* Frontend Dynamic Page Creation */

$pages = DB::table('cms_pages')->where('status', '1')->get();

if(isset($pages) && count($pages) > 0){

    foreach($pages as $page){

        $slg = $page->slug;

        $slug = '/'.$page->slug;

        Route::get($slug, 'frontend\Index@page')->name($slg);

    }

}

/* ----------- END --------------- */



Route::get('/search', 'frontend\Index@search')->name('search');

Route::get('/edc/{slug}', 'frontend\Index@each_edc')->name('each-edc');

Route::get('/edc', 'frontend\Index@edc')->name('front-edc');



/* EDCS */

/*

Route::get('edc', function(){

	return view('frontend.edc');

})->name('front-edc');

*/





/* MENTORS */

Route::get('mentors', function(){



    $allExpertise = DB::table('expertise_category')

        ->where('status','=','1')

        ->orderBy('category_name','ASC')

        ->get();



    $allPartners = DB::table('partners')

        ->where('status','=','1')

        ->orderBy('ID','DESC')

        ->get();



    $query = DB::table('mentors as m')

        ->where('m.status','=','1')

        ->where('m.is_show_front','=','1')

        ->orderBy('m.ID','DESC');



    if(isset($_GET['src_txt']) && $_GET['src_txt'] != ""){

        $query = $query->where(function($query){

            $query = $query->where('m.first_name','like','%'.$_GET['src_txt'].'%');

            $query = $query->orWhere('m.last_name','like','%'.$_GET['src_txt'].'%');

            $query = $query->orWhere('m.email','like','%'.$_GET['src_txt'].'%');

            $query = $query->orWhere('m.designation','like','%'.$_GET['src_txt'].'%');

            $query = $query->orWhere('m.salutation','like','%'.$_GET['src_txt'].'%');

        });

    }



    if(isset($_GET['exp_cat']) && $_GET['exp_cat'] != "" && $_GET['exp_cat'] != "ALL"){

        $query->join('mentor_expertise_map as me','m.ID','=','me.mentor_id');

        $query->where('me.category_id','=',$_GET['exp_cat']);

        $query->select('m.*');

    }



    $query = $query->paginate(8);



    if(!empty($query) && count($query) > 0)

    {

        foreach($query as $men){

            $men->expertise = DB::table('mentor_expertise_map as mem')

                ->where('mem.mentor_id','=',$men->ID)

                ->join('expertise_category as ec','ec.ID','=','mem.category_id')

                ->select('ec.ID','ec.category_name')

                ->orderBy('ec.category_name')

                ->get();

        }

    }



    $allMentors = $query;



    return view('frontend.mentors',['allExpertise'=>$allExpertise,'allMentors'=>$allMentors,'allPartners'=>$allPartners]);

})->name('front-mentors');





Route::get('/news-events', 'frontend\Index@news_events')->name('news-events');

Route::get('/news', 'frontend\Index@news')->name('news');

Route::get('/news/{slug}', 'frontend\Index@news_detail')->name('news-detail');

Route::get('/events', 'frontend\Index@events')->name('events');

Route::get('/events/{slug}', 'frontend\Index@events_detail')->name('events-detail');



Route::get('/stories', 'frontend\Index@stories')->name('stories');

Route::get('/stories/{slug}', 'frontend\Index@stories_detail')->name('stories-detail');



Route::get('/activities', 'frontend\Index@activities')->name('activities');

Route::get('/activities/{slug}', 'frontend\Index@activities_detail')->name('activities-detail');



Route::get('mentor-details/{mentor?}',function($mentor = null){

    if($mentor != null && $mentor != ""){

        $ID = "";

        $MenArr = array();

        $ExpData = array();

        $arrx = explode('-',$mentor);

        if(!empty($arrx)){

            $ID = end($arrx);

        }

        if($ID != ""){



            $MenArr = DB::table('mentors')

                ->where('ID','=',$ID)

                ->first();



            $ExpData = DB::table('mentor_expertise_map')

                ->where('mentor_expertise_map.mentor_id','=',$ID)

                ->join('expertise_category','expertise_category.ID','=','mentor_expertise_map.category_id')

                ->select('expertise_category.ID','expertise_category.category_name')

                ->orderBy('expertise_category.category_name')

                ->get();

        }

        if(isset($MenArr) && !empty($MenArr)){

            return view('frontend.mentors-details',['MenArr'=>$MenArr,'ExpData'=>$ExpData]);

        } else {

            return view('404');

        }

    } else {

        return redirect()->route('front-mentors');

    }

})->name('front-mentor-details');





/* CONTACT US */

Route::get('contact-us/',function(){

    return view('frontend.contact-us');

})->name('contact-us');



Route::post('save-contact-us','frontend\Index@save_contact_us')->name('save-contact-us');

Route::post('save-subscriber','frontend\Index@save_subscriber')->name('save-subscriber');

Route::post('add-kyc-document','frontend\Index@add_kyc_document')->name('add-kyc-document');







/* Newsletter */

Route::post('/saveNewsletter','frontend\Index@save_newsletter')->name('save-newsletter');



/* Ajax EDC Reg */

Route::post('/edc-registration','frontend\Index@edc_registration')->name('front_edc_reg');

/* Front Login */

Route::get('front-user-login', function(){

        return view('frontend.login');

    })->name('front-usr-login');

Route::post('/login-box','frontend\Index@front_login')->name('front-login');





Route::get('meta',function(){

    return view('frontend.meta');

})->name('meta');



Route::get('home2',function(){

    return view('frontend.home-matrix');

})->name('home2');



Route::get('resource',function(){

    $rArr = DB::table('resource')

        ->where('status','=','1')

        ->orderBy('ID','DESC')

        ->get();



    return view('frontend.resource',['rArr'=>$rArr]);

})->name('resource');



Route::get('/all-events', 'frontend\Index@all_events')->name('all-fevents');





/*Stripe Payment*/

Route::post('/paystripe','frontend\PaymentController@paystripe');

Route::post('/subscriber_plan','frontend\PaymentController@subscriber_plan');

/*End of Stripe Payment*/



/* ------------------------------ END FRONT AREA ------------------------- */

/* ------------------------------ Social Login ------------------------- */

Route::get('/social-login/redirect/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');

Route::get('/social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

/* ------------------------------ END Social Login ------------------------- */