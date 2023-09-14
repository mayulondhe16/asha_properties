<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Session;
use Config;

class ReviewController extends Controller
{
    public function __construct(Review $Review)
    {
        $data               = [];
        $this->title        = "Review";
        $this->url_slug     = "review";
        $this->folder_path  = "admin/review/";
    }
    public function index(Request $request)
    {
        $Review = Review::orderBy('id','DESC')->get();

        $data['data']      = $Review;
        $data['page_name'] = "Manage";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'index',$data);
    }
    public function add()
    {
        $data['page_name'] = "Add";
        $data['title']     = $this->title;
        $data['url_slug']  = $this->url_slug;
        return view($this->folder_path.'add',$data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'image' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $propertyType = new Review();
        $propertyType->title = $request->title;
        $propertyType->description = $request->description;
        $propertyType->reviewer_name = $request->reviewer_name;
        $status = $propertyType->save();
        $last_id = $propertyType->id;
        // $path = Config::get('DocumentConstant.REVIEW_ADD');

        // if ($request->hasFile('image')) {

        //     if ($propertyType->image) {
        //         $delete_file_eng= storage_path(Config::get('DocumentConstant.REVIEW_DELETE') . $propertyType->image);
        //         if(file_exists($delete_file_eng)){
        //             unlink($delete_file_eng);
        //         }

        //     }

        //     $fileName = $last_id.".". $request->image->extension();
        //     uploadImage($request, 'image', $path, $fileName);
           
        //     $brand = Review::find($last_id);
        //     $brand->image = $fileName;
        //     $brand->save();
        // }
        if (!empty($status))
        {
            Session::flash('success', 'Success! Record added successfully.');
            return \Redirect::to('manage_review');
        }
        else
        {
            Session::flash('error', "Error! Oop's something went wrong.");
            return \Redirect::back();
        }
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $arr_data = [];
        $data1     = Review::find($id);
        $data['data']      = $data1;
        $data['page_name'] = "Edit";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'edit',$data);
    }

    public function update(Request $request, $id)
    {
        $title = $request->title;
        $description = $request->description;
       
        $arr_data               = [];
        $Review = Review::find($id);
        $path = Config::get('DocumentConstant.REVIEW_ADD');
        // if ($request->hasFile('image'))
        // {
        //     if ($Review->image)
        //     {
        //         $delete_file_eng= storage_path(Config::get('DocumentConstant.REVIEW_DELETE') . $Review->image);
        //         if(file_exists($delete_file_eng))
        //         {
        //             unlink($delete_file_eng);
        //         }

        //     }
        //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //     $randomString = '';
        
        //     for ($i = 0; $i < 10; $i++) {
        //         $index = rand(0, strlen($characters) - 1);
        //         $randomString .= $characters[$index];
        //     }
        //     $fileName = $randomString.".". $request->image->extension();
        //     uploadImage($request, 'image', $path, $fileName);
        //     $Review->image = $fileName;

        // }
        $Review->title = $title;
        $Review->description = $description;
        $Review->reviewer_name = $request->reviewer_name;
        $status = $Review->save();        
        if (!empty($status))
        {
            Session::flash('success', 'Success! Record updated successfully.');
            return \Redirect::to('manage_review');
        }
        else
        {
            Session::flash('error', "Error! Oop's something went wrong.");
            return \Redirect::back();
        }
    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $all_data=[];
        $certificate = Review::find($id);
        $certificate->delete();
        Session::flash('success', 'Success! Record deleted successfully.');
        return \Redirect::to('manage_review');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $arr_data = [];
        $data1     = Review::find($id);
        $data['data']      = $data1;
        $data['page_name'] = "View";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'view',$data);
    }

   
}