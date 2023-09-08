<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Projects;
use  App\Models\ProjectImages;
use  App\Models\Amenities;
use  App\Models\AmenityImages;
use  App\Models\Features;
use  App\Models\FeatureImages;
use  App\Models\LayoutImages;
use  App\Models\SubLayoutImages;
use Illuminate\Support\Str;



use Validator;
use Session;
use Config;

class ProjectsController extends Controller
{
    public function __construct(Projects $Projects)
    {
        $data               = [];
        $this->title        = "Project";
        $this->url_slug     = "projects";
        $this->folder_path  = "admin/project/";
    }
    public function index(Request $request)
    {
        $Project = Projects::orderBy('id','DESC')->get();

        $data['data']      = $Project;
        $data['page_name'] = "Manage";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'index',$data);
    }

    public function manage_layouts(Request $request)
    {
        $layouts = LayoutImages::orderBy('id','DESC')->get();

        $data['data']      = $layouts;
        $data['page_name'] = "Manage";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = 'Layouts';
        return view($this->folder_path.'layouts_list',$data);
    }

    public function add()
    {
        $data['page_name'] = "Add";
        $data['title']     = $this->title;
        $data['url_slug']  = $this->url_slug;
        return view($this->folder_path.'add',$data);
    }

    public function add_sublayouts($id)
    {
       
        $data1     = LayoutImages::find($id);
        $data['data']      = $data1;
        $data['page_name'] = "Add";
        $data['title']     = "Sub Layouts";
        $data['url_slug']  = $this->url_slug;
        return view($this->folder_path.'add_sublayouts',$data);
    }
    public function store_sublayouts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sublayout_images' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $images = $request->file('sublayout_images');
        // dd($images);
        
        $existingRecord = subLayoutimages::orderBy('id','DESC')->first();
        $recordId = $existingRecord ? $existingRecord->id + 1 : 1;
      
        // if($images){
        //     foreach ($images as $image)
        //     {
        //         $subLayoutimages =  new SubLayoutImages();

        //         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //         $charactersLength = strlen($characters);
        //         $randomString = '';
        //         for ($i_ = 0; $i_ < 20; $i_++) {
        //             $randomString .= $characters[rand(0, $charactersLength - 1)];
        //         }

        //         $imageName = $image->getClientOriginalName();
        //         $ext = $image->getClientOriginalExtension();
        //         $random_file_name                  = $randomString.'.'.$ext;
        //         $latest_image                      = '/sublayout_images/'.$random_file_name;
        //         $filename                          = basename($imageName,'.'.$ext);
        //         $newFileName                       = $filename.time().".".$ext; 
               
                
        //         if(Storage::put('all_project_data'.$latest_image, File::get($image)))
        //         {
        //             $subLayoutimages->project_id = $request->input('project_id');
        //             $subLayoutimages->layout_id = $request->input('layout_id');
        //             $subLayoutimages->images = $latest_image;
        //             $projectstatus = $subLayoutimages->save();
        //         }
             
        //     }
        //     Session::flash('success', 'Success! Record added successfully.');
        //     return \Redirect::to('manage_layouts');
        // }

            if($images)
            {
                foreach ($images as $key=> $image)
                {
                    $subLayoutimages =  new subLayoutimages();
                    $path = Config::get('DocumentConstant.SUB_LAYOUT_ADD');
                    $fileName = $recordId."_".$key.".". $image->extension();
                    uploadMultiImage($image, 'image', $path, $fileName);
                    $subLayoutimages->project_id = $request->input('project_id');
                    $subLayoutimages->layout_id = $request->input('layout_id');
                    $subLayoutimages->images = $fileName;
                    $projectstatus = $subLayoutimages->save();
                
                }
                
            }
            if($projectstatus){
                Session::flash('success', 'Success! Record added successfully.');
                return \Redirect::to('manage_layouts');
            }
            else
            {
                Session::flash('error', "Error! Oop's something went wrong.");
                return \Redirect::back();
            }


    }
    public function store(Request $request)
    {  
        $temp=[];
        $new_arr = [];
        $images = $request->file('images');
        $layout_images = $request->file('layout_images');
        $main_layout_image = $request->file('main_layout_image');
        $amenity_collection =  collect($request->all())->reject(function($item, $key){
            if (strpos($key,'amenityimage_') !== false) {
                return false;
            } else {
                return true;
            }
        })->toArray();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'area' => 'required',
            'amenityname' => 'required',
            'images' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $project = new Projects();
        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
        $project->area = $request->area;
        $project->plot_area = $request->plot_area;
        $project->available_plot = $request->available_plot;
        $project->map_link = $request->map_link;
      
        $status = $project->save();
        $last_id = $project->id;
        if (!empty($status))
        {
            $temp = [];
            $amenities = $request->input('amenityname');
            if(count($amenities))
            {
                foreach($amenities as $key=>$value)
                {
                    // dd($key);
                    $aminity = new Amenities();
                    $aminity->project_id = $project->id;
                    $aminity->aminity = $value;
                    $aminity_saved = $aminity->save();


                    $amnlast_id = $aminity->id;
                    $pathamt = Config::get('DocumentConstant.AMENITYICON_ADD');
            
                    if ($request->hasFile('amenityicon_'.$key)) {
            
                        if ($aminity->amenityicon+$key) {
                            $delete_file_eng= storage_path(Config::get('DocumentConstant.AMENITYICON_DELETE') . $aminity->amenityicon.$key);
                            if(file_exists($delete_file_eng)){
                                unlink($delete_file_eng);
                            }
            
                        }
                        $amticon='amenityicon_'.$key;
                        $fileNameamt = $amnlast_id."_icon.". $request->$amticon->extension();
                        uploadImage($request, $amticon, $pathamt, $fileNameamt);
                        $amtstatus = Amenities::find($amnlast_id);
                        $amtstatus->amenityicon = $fileNameamt;
                        $amtstatus->save();

                    }
                    $pathnew =  Config::get('DocumentConstant.AMENITY_ADD');

                    if ($request->hasFile('amenityimage_'.$key)) {
            
                        if ($aminity->amenityicon+$key) {
                            $delete_file_eng= storage_path(Config::get('DocumentConstant.AMENITY_DELETE') . $aminity->amenityicon.$key);
                            if(file_exists($delete_file_eng)){
                                unlink($delete_file_eng);
                            }
            
                        }
                        $amtimg='amenityimage_'.$key;
                        $amenityImg = $amnlast_id."_image.". $request->$amtimg->extension();
                        uploadImage($request,$amtimg, $pathnew, $amenityImg);
                       
                        $amtstatus = Amenities::find($amnlast_id);
                        $amtstatus->image = $amenityImg;
                        $amtstatus->save();

                    }
                }
            }

            $features = $request->input('featurename');
            if(count($features))
            {
                foreach($features as $key=>$value)
                {
                    $features = new Features();
                    $features->project_id = $project->id;
                    $features->feature = $value;
                    $features_saved = $features->save();
                }
            }
           
            
            $path = Config::get('DocumentConstant.MAIN_LAYOUT_ADD');
                if ($request->hasFile('image')) {
                    if ($project->image) {
                        $delete_file_eng= storage_path(Config::get('DocumentConstant.MAIN_LAYOUT_DELETE') . $project->image);
                        if(file_exists($delete_file_eng)){
                            unlink($delete_file_eng);
                        }

                    }
                    $fileName = $last_id.".". $request->image->extension();
                    uploadImage($request, 'image', $path, $fileName);
                
                    $newstatus = Projects::find($last_id);
                    $newstatus->main_layout_image = $fileName;
                    $newstatus->save();
                }
          if($images){
                foreach ($images as $pr=>$image)
                {
                    $project_images =  new ProjectImages();
                    $path = Config::get('DocumentConstant.PROJECT_ADD');
                    $fileName = $project->id."_".$pr.".". $image->extension();
                    uploadMultiImage($image, 'image', $path, $fileName);
                    $project_images->project_id = $project->id;
                    $project_images->image = $fileName;
                    $projectstatus = $project_images->save();
                 
                }
            }

        Session::flash('success', 'Success! Record added successfully.');
        return \Redirect::to('manage_projects');
    }else
    {
        Session::flash('error', "Error! Oop's something went wrong.");
        return \Redirect::back();
    }
}

    public function edit($id)
    {
        $id = base64_decode($id);
        $data1     = Projects::find($id);
        $project_images = ProjectImages::where('project_id','=',$id)->get();
        $layout_images = LayoutImages::where('project_id','=',$id)->get();
        $amenities = Amenities::where('project_id','=',$id)->get();
        $features = Features::where('project_id','=',$id)->get();
       
        $data['images']      = $project_images;
        $data['layout_images']      = $layout_images;
        $data['amenities']      = $amenities;
        $data['features']      = $features;
        $data['data']      = $data1;
        $data['page_name'] = "Edit";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'edit',$data);
    }

    public function update(Request $request,$id)
    {  
        // dd($request->all());
        $temp=[];
        $new_arr = [];
        $images = $request->file('images');
        $amenity_collection =  collect($request->all())->reject(function($item, $key){
            if (strpos($key,'amenityimage_') !== false) {
                return false;
            } else {
                return true;
            }
        })->toArray();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'area' => 'required',
            'images' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $project = Projects::find($id);
        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
        $project->area = $request->area;
        $project->plot_area = $request->plot_area;
        $project->available_plot = $request->available_plot;
        $project->map_link = $request->map_link;
      
        $status = $project->save();
        $last_id = $project->id;
        if (!empty($status))
        {
            $temp = [];
            $amenities = $request->input('amenityname');
            if(count($amenities))
            {
                $amt_delete = Amenities::where('project_id',$id);
                $amt_delete->delete();
                if($amt_delete){
                    foreach($amenities as $key=>$value)
                    {
                        // dd($key);
                        $aminity = new Amenities();
                        $aminity->project_id = $project->id;
                        $aminity->aminity = $value;
                        $aminity_saved = $aminity->save();
    
    
                        $amnlast_id = $aminity->id;
                        $pathamt = Config::get('DocumentConstant.AMENITYICON_ADD');
                
                        if ($request->hasFile('amenity_icon')) {
                            $icons = $request->amenity_icon;
                            foreach($icons as $icon){
                                if ($aminity->amenityicon+$key) {
                                    $delete_file_eng= storage_path(Config::get('DocumentConstant.AMENITYICON_DELETE') . $aminity->amenityicon.$key);
                                    if(file_exists($delete_file_eng)){
                                        unlink($delete_file_eng);
                                    }
                    
                                }
                                $amticon='amenityicon_'.$key;
                                $fileNameamt = $amnlast_id."_icon.". $icon->extension();
                                uploadImage($request, $amticon, $pathamt, $fileNameamt);
                                $amtstatus = Amenities::find($amnlast_id);
                                $amtstatus->amenityicon = $fileNameamt;
                                $amtstatus->save();
                            }
                         
    
                        }
                        $pathnew =  Config::get('DocumentConstant.AMENITY_ADD');
    
                        if ($request->hasFile('amenityimage_'.$key)) {
                
                            if ($aminity->amenityicon+$key) {
                                $delete_file_eng= storage_path(Config::get('DocumentConstant.AMENITY_DELETE') . $aminity->amenityicon.$key);
                                if(file_exists($delete_file_eng)){
                                    unlink($delete_file_eng);
                                }
                
                            }
                            $amtimg='amenityimage_'.$key;
                            $amenityImg = $amnlast_id."_image.". $request->$amtimg->extension();
                            uploadImage($request,$amtimg, $pathnew, $amenityImg);
                           
                            $amtstatus = Amenities::find($amnlast_id);
                            $amtstatus->image = $amenityImg;
                            $amtstatus->save();
    
                        }
                    }
                }
               
            }

            // $features = $request->input('featurename');
            // if(count($features))
            // {
            //     foreach($features as $key=>$value)
            //     {
            //         $features = new Features();
            //         $features->project_id = $project->id;
            //         $features->feature = $value;
            //         $features_saved = $features->save();
            //     }
            // }
           
            
            $path = Config::get('DocumentConstant.MAIN_LAYOUT_ADD');
                if ($request->hasFile('image')) {
                    if ($project->image) {
                        $delete_file_eng= storage_path(Config::get('DocumentConstant.MAIN_LAYOUT_DELETE') . $project->image);
                        if(file_exists($delete_file_eng)){
                            unlink($delete_file_eng);
                        }

                    }
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';
                
                    for ($i = 0; $i < 10; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                    $fileName = $randomString.".". $request->image->extension();
                    uploadImage($request, 'image', $path, $fileName);
                
                    $newstatus = Projects::find($id);
                    $newstatus->main_layout_image = $fileName;
                    $newstatus->save();
                }
          if($images){
                foreach ($images as $pr=>$image)
                {
                    $project_images =  new ProjectImages();
                    $path = Config::get('DocumentConstant.PROJECT_ADD');
                    $fileName = $project->id."_".$pr.".". $image->extension();
                    uploadMultiImage($image, 'image', $path, $fileName);
                    $project_images->project_id = $project->id;
                    $project_images->image = $fileName;
                    $projectstatus = $project_images->save();
                 
                }
            }

        Session::flash('success', 'Success! Record added successfully.');
        return \Redirect::to('manage_projects');
    }else
    {
        Session::flash('error', "Error! Oop's something went wrong.");
        return \Redirect::back();
    }
}
    public function delete($id)
    {
        $id = base64_decode($id);
        $all_data=[];
        $project = Projects::find($id);
        $project->delete();

        $project_images = ProjectImages::where('project_id','=',$id);
        $project_images->delete();
        Session::flash('success', 'Success! Record deleted successfully.');
        return \Redirect::to('manage_projects');
    }

    public function delete_project_image($id)
    {
        $all_data=[];
       
        $project_images = ProjectImages::where('id','=',$id);
        $project_images->delete();
        return \Redirect::to('manage_projects');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $arr_data = [];
        $data1     = Projects::find($id);
        $project_images = ProjectImages::where('project_id','=',$id)->get();
        $layout_images = LayoutImages::where('project_id','=',$id)->get();
        $amenities = Amenities::where('project_id','=',$id)->get();
        $features = Features::where('project_id','=',$id)->get();
       
        $data['data']      = $data1;
        $data['images']      = $project_images;
        $data['layout_images']      = $layout_images;
        $data['amenities']      = $amenities;
        $data['features']      = $features;
        $data['page_name'] = "View";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'view',$data);
    }


    public function change_status($id)
    {
        // dd($id);
        $data =  \DB::table('projects')->where(['id'=>$id])->first();
        //dd($data->is_active);
        if($data->status=='1')
        {
            $category = \DB::table('projects')->where(['id'=>$id])->update(['status'=>'0']);
            Session::flash('success', 'Success! Record deactivated successfully.');
            
        }
        else
        {
            $category = \DB::table('projects')->where(['id'=>$id])->update(['status'=>'1']);
            Session::flash('success', 'Success! Record activated successfully.');
        }
        return \Redirect::back();
    }
}