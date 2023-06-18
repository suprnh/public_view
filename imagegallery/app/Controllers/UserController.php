<?php

namespace App\Controllers;

use App\Filters;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ImageModel;




class UserController extends BaseController
{
    public function index()
    {
        /* if(Auth::check()){
            return view('frontend.dashboard');  
        } */
        

        return view('frontend/login');
    }

    public function login(){
        
        $userModel = new UserModel();
        $session = session();
        
        $data = $this->request->getVar();

        $email = $data['email'];
        $password = $data['password'];
        //$password_has = password_hash($password,PASSWORD_BCRYPT);

        $user_details = $userModel->where(["email"=>$email])->first();


        if(!empty($user_details) && password_verify($password, $user_details['password'])) {
            
            $ses_data = [
                'id' => $user_details['id'],
                'name' => $user_details['first_name'].''.$user_details['last_name'],
                'email' => $user_details['email'],
                'isLoggedIn' => true
            ];

            $session->set($ses_data);
            return redirect()->to('user/profile');
        } else {
            $session->setFlashdata('msg', 'Check your email & password is correct');
            return redirect()->to('/signin');
        }
       
    }
    
    public function user_profile($cat=""){
       
        $ImageModel = new ImageModel();
        $categoryModel = new CategoryModel();
        $data[]=[];
        if($cat){   
            $data = $ImageModel->where('category_id',$cat)->findAll();
            print json_encode($data); 
        }else{
            $data['images'] = $ImageModel->findAll();
            return view('frontend/dashboard',$data); 
        }      
    }

    public function userLogout(){
        $session = session();
        $session->destroy();
       // print_r($session->get("userdata"));
       return redirect()->to('/');
    }

    public function all_Image_category(){
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('frontend/all_image_category',$data);
    }

    public function image_category_add($id=""){
        $categoryModel = new CategoryModel();
        $data = $this->request->getVar();
            $form_data = [
                "name" => $data['categoryName'],
                "description" => $data['description']
            ];
        if($id){
            $session = session();
            if($categoryModel->where(["id" => $id])->set($form_data)->update()){
                $session->setFlashdata("success","Update Success");
                return redirect()->to('user/allcat');  
            }else{
                $session->setFlashdata("error","Faield Update");
                return redirect()->back(); 
            }
        }
        else{
            $session = session();
            if($categoryModel->insert($form_data)){
                $session->setFlashdata("success","New category added");
                return redirect()->to('user/imagecat');  
            }else{
                $session->setFlashdata("error","Faield to save category");
            }
        } 

    }

    public function delete_image_category($id){
        if($id){
            $session = session();
            $categoryModel = new CategoryModel();
            if($categoryModel->where(["id" => $id])->delete()){
                $session->setFlashdata("success","Category delete successfull");
                return redirect()->to('user/allcat');  
            }else{
                $session->setFlashdata("error","Delete faield");
                return redirect()->back(); 
            }
        }
    }

   /*  public function update_image_category($id){
        $categoryModel = new CategoryModel();
        $data = $this->request->getVar();

        $form_data = [
            "name" => $data['categoryName'],
            "description" => $data['description']
        ];
        
        $session = session();
        if($categoryModel->where(["id" => $id])->set($form_data)->update()){
            $session->setFlashdata("success","New category added");
           
        }else{
            $session->setFlashdata("error","Faield to save category");
        }
    }
     */

    public function show_image_cat($id=""){
        $data['imagecat']=[];
        if($id){
            $categoryModel = new CategoryModel();
            $data['imagecat'] = $categoryModel->where(["id" => $id])->first();
                
            return view('frontend/add_imageCat',$data); 
        }
        return view('frontend/add_imageCat',$data);       
    }

    public function upload_image(){
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
    
        return view('frontend/add_image',$data);   
    }

    public function store_image(){
        $category = $this->request->getVar('category'); 
        $file = $this->request->getFile("image_file");
            $rules = [
                "image_file" => "uploaded[image_file]|is_image[image_file]|max_size[image_file,1024]", 
            ];
            $messages = [
                "image_file" =>[
                    "max_size" => "Image is too larger",
                    "is_image" => "This is not a valid file Image file only acceptable"
                ]
            ];

            if(!$this->validate($rules,$messages)){
               $error_msg =$this->validator->getErrors();
               $session = session();
               $session->setFlashdata("error",$error_msg);
              return redirect()->to("user/add");
            }else{
                $file_name = $file->getName();
                $folder_path = FCPATH . 'public/uploads/';
                $full_path_with_file = $folder_path.$file_name;
                
                if (!file_exists($full_path_with_file)) {
                     
                        if($file->move($folder_path ,$file_name)){
                            $ImageModel = new ImageModel();

                            $store = [
                                'category_id' => $category,
                                'name' => $file_name,
                            ];


                        }
                        if($ImageModel->insert($store)){
                            $session = session();
                           $session->setFlashdata("success","Image upload success!");
                        }   
                }else{
                    echo "file already exists"; die;
                }
            }

            return redirect()->to('user/add');

    }



}
