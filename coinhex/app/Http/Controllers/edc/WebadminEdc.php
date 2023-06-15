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
use App\Achievements;
use App\SuccessStories;
use App\News;
use App\Centers;

class WebadminEdc extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    function dashboard(){
        $recent_activity = DB::table('activity_plan')->where('status','=','1')->orderBy('from_date','asc')->take(5)->get();
        $recent_story = DB::table('success_stories')->where('status','=','1')->orderBy('ID','DESC')->take(5)->get();
        $recent_event = DB::table('events')->where('status','=','1')->orderBy('start_date','ASC')->take(5)->get();
        $top_mentor = DB::table('mentors')->where('status','=','1')->orderBy('ID','DESC')->take(5)->get();
    	return view('admin.dashboard',['recent_activity'=>$recent_activity,'recent_story'=>$recent_story,'recent_event'=>$recent_event,'top_mentor'=>$top_mentor]);
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
        $News->is_edc_id = Session::get('userid');

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
            return Redirect::route('edc-add-news',$lastInsertedId)->with('news_success','News Added Successfully !');
        }
        else
        {
            return back()->with('news_error','News Not Saved');
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

        $image_id = trim($request->input('prev_img_id'));

        $del_img = $request->input('del_img');

        if($del_img == 'yes')
        {
            $update = un_assign_image_id($image_id);
            $image_id = 0;
        }

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
                  ->update(['title'=>$title,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id]);

        if($update == 1)
        {
            return back()->with('news_success','News Updated Successfully.');
        }
        else
        {
            return back()->with('news_error','News Not Updated');
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
        $Achievements->is_edc_id = Session::get('userid');

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
            return Redirect::route('edc-add-achievements',$lastInsertedId)->with('achievements_success','Achievement Added Successfully !');
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

        $del_img = $request->input('del_img');

        if($del_img == 'yes')
        {
            $update = un_assign_image_id($image_id);
            $image_id = 0;
        }

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
                  ->update(['title'=>$title,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id]);

        if($update == 1)
        {
            return back()->with('achievements_success','Achievement Updated Successfully !');
        }
        else
        {
            return back()->with('achievements_error','Achievement Not Updated');
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
        $SuccessStories->is_edc_id = Session::get('userid');

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
            return Redirect::route('edc-add-success-stories',$lastInsertedId)->with('success_stories_success','Success Story Added Successfully !');
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


        $image_id = trim($request->input('prev_img_id'));

        $del_img = $request->input('del_img');

        if($del_img == 'yes')
        {
            $update = un_assign_image_id($image_id);
            $image_id = 0;
        }

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
                  ->update(['title'=>$title,'slug'=>$slug,'description'=>$description,'publish_date'=>$publish_date,'status'=>$status,'author_id'=>$author_id,'updated_date'=>$updated_date,'image_id'=>$image_id,'alumni_name'=>$alumni_name,'alumni_designation'=>$alumni_designation]);

        if($update == 1)
        {
            return back()->with('success_stories_success','Success Story Updated Successfully !');
        }
        else
        {
            return back()->with('success_stories_error','Success Story Not Updated');
        }

    }


    function logout(){
        Session::flush();
        return redirect()->route('admin-login')->with('errmsg','Logged out Successfully!');
    }

    
}
