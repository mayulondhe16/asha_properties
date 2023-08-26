<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Aboutus;
use  App\Models\ContactDetails;
use  App\Models\PropertyType;
use  App\Models\Projects;
use  App\Models\ProjectImages;
use  App\Models\Amenities;
use  App\Models\AmenityImages;
use  App\Models\Features;
use  App\Models\FeatureImages;
use  App\Models\LayoutImages;
use  App\Models\SubLayoutImages;
use  App\Models\ContactForm;
use  App\Models\Socialmedialinks;
use  App\Models\Review;
use Validator;
use Session;
use Config;
class ApiController extends Controller
{

    public function __construct()
    {
    
    }
    public function get_aboutus(Request $request)
    {
      try
      {
        $all_data = Aboutus::get();

        foreach ($all_data as $value) {
          $value->image =  Config::get('DocumentConstant.ABOUTUS_VIEW').$value['image'];
        }
          return $this->responseApi($all_data, 'All data get successfully', 'scuccess',200);
        }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function get_reviews(Request $request)
    {
      try
      {
        $all_data = Review::get();

        foreach ($all_data as $value) {
          $value->image =  Config::get('DocumentConstant.Review_VIEW').$value['image'];
        }
          return $this->responseApi($all_data, 'All data get successfully', 'scuccess',200);
        }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function get_amenities(Request $request,$id)
    {
      try
      {
        $all_data = Amenities::where('project_id',$id)->get();

        // foreach ($all_data as $value) {
        //   $value->image =  Config::get('DocumentConstant.Review_VIEW').$value['image'];
        // }
          return $this->responseApi($all_data, 'All data get successfully', 'scuccess',200);
        }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function get_contactDetails(Request $request)
    {
      try
      {
        $all_data = ContactDetails::get();
        $response = [];

        foreach ($all_data as $item) {
            $data = $item->toArray();
            $response['contact_no'] = $data['phone_no'];
            $response['address'] = $data['address'];
            $response['email'] = $data['email'];
        }
        return $this->responseApi($response, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function get_properties(Request $request)
    {
      try
      {
        $all_data = PropertyType::get();
        $response = [];

        foreach ($all_data as $value) {
          $value->image =  Config::get('DocumentConstant.PROPERTY_TYPE_VIEW').$value['image'];
        }
          return $this->responseApi($all_data, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function get_socialmedialinks(Request $request)
    {
      try
      {
       $all_data = Socialmedialinks::get();

        foreach ($all_data as $value) {
          $value->image =  Config::get('DocumentConstant.SOCIALMEDIAICON_VIEW').$value['image'];
        }
          return $this->responseApi($all_data, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }
    public function get_projects(Request $request)
    {
      try
      {
          $temp                      = [];
          $projectData = Projects::get();
          foreach($projectData as $key=>$value)
          {
            $response = [];
                $response['name'] = $value->name;
                $response['address'] = $value->address;
                $response['description'] = $value->description;
                $response['area'] = $value->area;
                $response['main_layout_image'] = $value->main_layout_image;
                $response['status'] = $value->status;
                $response['project_images'] = ProjectImages::where('project_id',$value->id)->get();
                $response['layout_images'] = LayoutImages::where('project_id',$value->id)->get();
                $amt_data = Amenities::where('project_id',$value->id)->get();
                foreach($amt_data as $amt){
                  $amenities = [];
                  $amenities['aminity'] = $amt->aminity;
                  $amenities['amenitiy_images'] = AmenityImages::where('project_id',$value->id)->get();
                }
                $response['amenities'] = $amenities;

                $ftr_data = Features::where('project_id',$value->id)->get();
                foreach($ftr_data as $amt){
                  $features = [];
                  $features['feature'] = $amt->feature;
                  $features['feature_images'] = FeatureImages::where('project_id',$value->id)->get();
                }
                $response['features'] = $features;
                array_push($temp, $response); 

          }
          return $this->responseApi($temp, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
      }

    public function get_done_projects(Request $request)
    {
      try
      {
          $temp                      = [];
          $projectData = Projects::where('projects.status','1')->get();
          foreach($projectData as $key=>$value)
          {
            $response = [];
                $response['name'] = $value->name;
                $response['address'] = $value->address;
                $response['description'] = $value->description;
                $response['area'] = $value->area;
                $response['main_layout_image'] = $value->main_layout_image;
                $response['status'] = $value->status;
                $response['project_images'] = ProjectImages::where('project_id',$value->id)->get();
                $response['layout_images'] = LayoutImages::where('project_id',$value->id)->get();
                $amt_data = Amenities::where('project_id',$value->id)->get();
                foreach($amt_data as $amt){
                  $amenities = [];
                  $amenities['aminity'] = $amt->aminity;
                  $amenities['amenitiy_images'] = AmenityImages::where('project_id',$value->id)->get();
                }
                $response['amenities'] = $amenities;

                $ftr_data = Features::where('project_id',$value->id)->get();
                foreach($ftr_data as $amt){
                  $features = [];
                  $features['feature'] = $amt->feature;
                  $features['feature_images'] = FeatureImages::where('project_id',$value->id)->get();
                }
                $response['features'] = $features;
                array_push($temp, $response); 

          }
          return $this->responseApi($temp, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function get_ongoing_projects(Request $request)
    {
      try
      {
          $temp                      = [];
          $projectData = Projects::where('projects.status','0')->get();
          foreach($projectData as $key=>$value)
          {
            $response = [];
                $response['name'] = $value->name;
                $response['address'] = $value->address;
                $response['description'] = $value->description;
                $response['area'] = $value->area;
                $response['main_layout_image'] = $value->main_layout_image;
                $response['status'] = $value->status;
                $response['project_images'] = ProjectImages::where('project_id',$value->id)->get();
                $response['layout_images'] = LayoutImages::where('project_id',$value->id)->get();
                $amt_data = Amenities::where('project_id',$value->id)->get();
                foreach($amt_data as $amt){
                  $amenities = [];
                  $amenities['aminity'] = $amt->aminity;
                  $amenities['amenitiy_images'] = AmenityImages::where('project_id',$value->id)->get();
                }
                $response['amenities'] = $amenities;

                $ftr_data = Features::where('project_id',$value->id)->get();
                foreach($ftr_data as $amt){
                  $features = [];
                  $features['feature'] = $amt->feature;
                  $features['feature_images'] = FeatureImages::where('project_id',$value->id)->get();
                }
                $response['features'] = $features;
                array_push($temp, $response); 

          }
          return $this->responseApi($temp, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }

    public function add_contact_us(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
            ]);
        
            if ($validator->fails())
            {
                    return $validator->errors()->all();
        
            }else{
                    $alumini = new ContactForm();
                    $alumini->name = $request->name;
                    $alumini->email = $request->email;
                    $alumini->message = $request->message;
                    $alumini->save();
                    return response()->json(['status' => 'Success', 'message' => 'Added successfully','StatusCode'=>'200']);
                }
    }

    public function get_counts(Request $request)
    {
      try{
        $ongoing_projects = Projects::where('status','0')->count();
        $done_projects = Projects::where('status','1')->count();
        $total_projects = Projects::count();
        $response = [];
        return response()->json(['ongoing_projects'=>$ongoing_projects,'done_projects'=>$done_projects,'total_projects'=>$total_projects,'status' => 'Success', 'message' => 'Added successfully','StatusCode'=>'200']);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }
    public function get_project_details(Request $request)
    {
      try
      {
          $temp                      = [];
          $projectData = Projects::where('projects.id',$request->id)->get();
          foreach($projectData as $key=>$value)
          {
            $response = [];
                $response['name'] = $value->name;
                $response['address'] = $value->address;
                $response['description'] = $value->description;
                $response['area'] = $value->area;
                $response['main_layout_image'] = $value->main_layout_image;
                $response['status'] = $value->status;
                $response['project_images'] = ProjectImages::where('project_id',$value->id)->get();
                $response['layout_images'] = LayoutImages::where('project_id',$value->id)->get();
                $amt_data = Amenities::where('project_id',$value->id)->get();
                foreach($amt_data as $amt){
                  $amenities = [];
                  $amenities['aminity'] = $amt->aminity;
                  $amenities['amenitiy_images'] = AmenityImages::where('project_id',$value->id)->get();
                }
                $response['amenities'] = $amenities;

                $ftr_data = Features::where('project_id',$value->id)->get();
                foreach($ftr_data as $amt){
                  $features = [];
                  $features['feature'] = $amt->feature;
                  $features['feature_images'] = FeatureImages::where('project_id',$value->id)->get();
                }
                $response['features'] = $features;
                array_push($temp, $response); 

          }
          return $this->responseApi($temp, 'All data get successfully', 'scuccess',200);
      }catch (\Exception $e)
      {
        return $this->responseApi(array(), $e->getMessage(), 'error',500);
      }
    }
}