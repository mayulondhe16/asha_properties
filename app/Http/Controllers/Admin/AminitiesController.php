<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Amenities;
use  App\Models\AmenityImages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Session;

class AminitiesController extends Controller
{
    public function __construct(Amenities $Amenities)
    {
        $data               = [];
        $this->title        = "Amenities";
        $this->url_slug     = "amenities";
        $this->folder_path  = "admin/amenities/";
    }
    public function index(Request $request)
    {
        $Amenities = Amenities::get();

        $data['data']      = $Amenities;
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
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $Amenities = new Amenities();
        $AmenityImages = new AmenityImages();
        $arr_data               = [];
        
        $Amenities->name =  $request->name;
        $Amenities->description =  $request->description;
        $Amenitiestatus = $Amenities->save();

        $images = $request->file('images');
        $temp = [];
        if ($images) {
            foreach ($images as $image)
            {
                $AmenityImages = new AmenityImages();

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i_ = 0; $i_ < 20; $i_++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $imageName = $image->getClientOriginalName();
                $ext = $image->getClientOriginalExtension();
                $random_file_name                  = $randomString.'.'.$ext;
                $latest_image                      = '/amenity_images/'.$random_file_name;
                $filename                          = basename($imageName,'.'.$ext);
                $newFileName                       = $filename.time().".".$ext; 
               
                
                if(Storage::put('all_project_data'.$latest_image, File::get($image)))
                {
                    array_push($temp, $random_file_name);
                    $AmenityImages->amenity_id = $Amenities->id;
                    $AmenityImages->image = $latest_image;
                    $Amenitiesaved = $AmenityImages->save();
                }
             
            }
        }


        if (!empty($Amenitiesaved))
        {
            Session::flash('success', 'Success! Record added successfully.');
            return \Redirect::to('manage_amenities');
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
        $data1     = Amenities::find($id);
        $data['city'] = City::orderBy('city_name','desc')->groupBy('city_name')->get();
        $data['shop_images'] = AmenityImages::where('shop_id',$id)->get();
        $data['data']      = $data1;
        $data['page_name'] = "Edit";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $Amenities = Amenities::find($id);
        $AmenityImages = new AmenityImages();
        $arr_data               = [];
        $Amenities->name =  $request->name;
      
        $Amenities->description =  $request->description;
        $Amenitiestatus = $Amenities->update();
     
        if (!empty($Amenitiestatus))
        {
            Session::flash('success', 'Success! Record updated successfully.');
            return \Redirect::to('manage_amenities');
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
        $certificate = Amenities::find($id);
        $certificate->delete();
        $img = AmenityImages::find($id);
        $img->delete();
        return \Redirect::to('manage_amenities');
    }

    public function delete_amenity_image($id)
    {
        $img = AmenityImages::find($id);
        $img->delete();
        return \Redirect::to('manage_amenities');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $arr_data = [];
        $data1     = Amenities::find($id);
        $data['shop_images'] = AmenityImages::where('amenity_id',$id)->get();
        $data['data']      = $data1;
        $data['page_name'] = "View";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'view',$data);
    }

   
}