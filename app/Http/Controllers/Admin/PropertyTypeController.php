<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\PropertyType;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Session;
use Config;

class PropertyTypeController extends Controller
{
    public function __construct(PropertyType $PropertyType)
    {
        $data               = [];
        $this->title        = "Property Type";
        $this->url_slug     = "property_type";
        $this->folder_path  = "admin/propertyType/";
    }
    public function index(Request $request)
    {
        $PropertyType = PropertyType::orderBy('id','DESC')->get();

        $data['data']      = $PropertyType;
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
            'image' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $propertyType = new PropertyType();
        $propertyType->title = $request->title;
        $propertyType->description = $request->description;
        $propertyType->total_area = $request->total_area;
        $propertyType->plot_area = $request->plot_area;
        $propertyType->location = $request->location;
        $status = $propertyType->save();
        $last_id = $propertyType->id;
        $path = Config::get('DocumentConstant.PROPERTY_TYPE_ADD');

        if ($request->hasFile('image')) {

            if ($propertyType->image) {
                $delete_file_eng= storage_path(Config::get('DocumentConstant.PROPERTY_TYPE_DELETE') . $propertyType->image);
                if(file_exists($delete_file_eng)){
                    unlink($delete_file_eng);
                }

            }

            $fileName = $last_id.".". $request->image->extension();
            uploadImage($request, 'image', $path, $fileName);
           
            $brand = PropertyType::find($last_id);
            $brand->image = $fileName;
            $brand->save();
        }
        if (!empty($status))
        {
            Session::flash('success', 'Success! Record added successfully.');
            return \Redirect::to('manage_property_type');
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
        $data1     = PropertyType::find($id);
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
        $PropertyType = PropertyType::find($id);
        $path = Config::get('DocumentConstant.PROPERTY_TYPE_ADD');
        if ($request->hasFile('image'))
        {
            if ($PropertyType->image)
            {
                $delete_file_eng= storage_path(Config::get('DocumentConstant.PROPERTY_TYPE_DELETE') . $PropertyType->image);
                if(file_exists($delete_file_eng))
                {
                    unlink($delete_file_eng);
                }

            }

            $fileName = $id.".". $request->image->extension();
            uploadImage($request, 'image', $path, $fileName);
            $PropertyType->image = $fileName;

        }
        $PropertyType->title = $title;
        $PropertyType->description = $description;
        $PropertyType->total_area = $request->total_area;
        $PropertyType->plot_area = $request->plot_area;
        $PropertyType->location = $request->location;
        $status = $PropertyType->save();        
        if (!empty($status))
        {
            Session::flash('success', 'Success! Record updated successfully.');
            return \Redirect::to('manage_property_type');
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
        $certificate = PropertyType::find($id);
        $certificate->delete();
        Session::flash('success', 'Success! Record deleted successfully.');
        return \Redirect::to('manage_property_type');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $arr_data = [];
        $data1     = PropertyType::find($id);
        $data['data']      = $data1;
        $data['page_name'] = "View";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'view',$data);
    }

   
}