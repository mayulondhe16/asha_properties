<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use  App\Models\Count;
use Validator;
use Session;

class CountController extends Controller
{
    public function __construct(Count $Count)
    {
        $data               = [];
        $this->title        = "Counts";
        $this->url_slug     = "counts";
        $this->folder_path  = "admin/counts/";
    }
    public function index(Request $request)
    {
        $contactdetails = Count::get();

        $data['data']      = $contactdetails;
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
            'total_ongoing_projects' => 'required',
            'total_done_projects' => 'required',
            'total_sold_plots' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
        $contactdetails = new Count();
        $contactdetails->total_ongoing_projects = $request->total_ongoing_projects;
        $contactdetails->total_done_projects = $request->total_done_projects;
        $contactdetails->total_sold_plots = $request->total_sold_plots;

        $status = $contactdetails->save();
        if (!empty($status))
        {
            Session::flash('success', 'Success! Record added successfully.');
            return \Redirect::to('manage_counts');
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
        $data1     = Count::find($id);
        $data['data']      = $data1;
        $data['page_name'] = "Edit";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'total_ongoing_projects' => 'required',
            'total_done_projects' => 'required',
            'total_sold_plots' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }
     
        $arr_data               = [];
        $contactdetails = Count::find($id);
        $existingRecord = Count::orderBy('id','DESC')->first();
        $contactdetails->total_ongoing_projects = $request->total_ongoing_projects;
        $contactdetails->total_done_projects = $request->total_done_projects;
        $contactdetails->total_sold_plots = $request->total_sold_plots;
        $status = $contactdetails->update();        
        if (!empty($status))
        {
            Session::flash('success', 'Success! Record updated successfully.');
            return \Redirect::to('manage_counts');
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
        $certificate = Count::find($id);
        $certificate->delete();
        return \Redirect::to('manage_counts');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $arr_data = [];
        $data1     = Count::find($id);
        $data['data']      = $data1;
        $data['page_name'] = "View";
        $data['url_slug']  = $this->url_slug;
        $data['title']     = $this->title;
        return view($this->folder_path.'view',$data);
    }

   
}