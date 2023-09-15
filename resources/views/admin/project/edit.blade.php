@extends('layout.master')
 
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">{{ $title }}</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit {{ $title }}</li>
          </ol>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-2 text-white text-capitalize ps-3" style="width:100%;float:left">
                {{ $title }} Details
              </div>
            </div>
            <div class="card-body">
              <form action="{{ url('/')}}/update_{{$url_slug}}/{{$data['id']}}" method="post" role="form" data-parsley-validate="parsley" enctype="multipart/form-data" autocomplete="off">
                {!! csrf_field() !!} 
             
              <div class="row">
                @foreach($images as $key=> $image)
                <div class="col-md-4">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-10">
                          <label for="oldpassword">Project Image {{ $key+1 }}<span style="color:red;" >*</span></label>
                      </div>
                      <div class="col-md-2">
                        <p><a href="{{url('/')}}/delete_project_image/{{ $image->id }}" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                           <i class="fa fa-trash"></i></a>
                        </p>
                      </div>
                      </div>
                      <p>
                        <img id="output_image1" height="200px" width="300px" src="{{ Config::get('DocumentConstant.PROJECT_VIEW') }}{{ $image->image }}" />
                      </p>
                    </div>
                </div>
                @endforeach
                <div class="input-group input-group-outline mb-3">
                  <input type="file"  name="images[]" accept="image/*" @if(count($images)<0) required="true" @endif multiple>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Name</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" name="name" value="{{ $data['name'] }}"  data-parsley-error-message="Please enter valid shop name." required="true">
                        </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Address</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" value="{{ $data['address'] }}" name="address"  data-parsley-error-message="Please enter valid address." required="true">
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Details Description</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <textarea  class="form-control" name="description" data-parsley-error-message="Please enter valid desciption." required="true">{{$data['description']}}</textarea>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Total Area</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="area" value="{{ $data['area'] }}"  data-parsley-error-message="Please enter valid area." required="true">
                      </div>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Plot Area</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="plot_area" value="{{ $data['plot_area'] }}"  data-parsley-error-message="Please enter valid plot area." required="true">
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Available Plots</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="available_plot" value="{{ $data['available_plot'] }}"  data-parsley-error-message="Please enter valid available plots." required="true">
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Map Link</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="map_link" value="{{ $data['map_link'] }}"  data-parsley-error-message="Please enter valid link." data-parsley-pattern="^((http|https):\/\/.)[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)$" required="true">
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Video Link</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="video_link" value="{{ $data['video_link'] }}"  data-parsley-error-message="Please enter valid link." data-parsley-pattern="^((http|https):\/\/.)[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)$" required="true">
                      </div>
                  </div>
                </div>
              </div>
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-2 text-white text-capitalize ps-3" style="width:100%;float:left">
                Amenities
               </div>
               <div class="row">
                 <div class="col-md-10">
                   <table class="table table-bordered" id="dynamic-table0">
                     <thead>
                       <tr>
                         <th>Amenity</th>
                         <th>Icon</th>
                         <th>Amenity Images</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($amenities as $key=> $amenity)
                      
                       <tr>
                         <td>
                             <div class="input-group input-group-outline mb-3">
                             <input type="text" class="form-control" value="{{$amenity->aminity}}" name="amenityname[]">
                             </div>
                         </td>
                         <td>
                             <p>
                              <img src="{{ Config::get('DocumentConstant.AMENITYICON_VIEW') }}{{ $amenity->amenityicon }}" height="40px" width="70px">
                              <input type="file"  name="amenity_icon[]" accept="image/*" onchange='getFilename(this,{{ $amenity->id }})'>
                              <input type="hidden" value="{{$amenity->id}}" name="amenity_id[]">
                              <input type="hidden" id="amenity_icon_hidden{{$amenity->id}}" value="" name="amenity_icon_hidden[]">

                            </p>
                          
                       </td>
                     
                         <td>
                           <img src="{{ Config::get('DocumentConstant.AMENITY_VIEW') }}{{ $amenity->image }}" height="40px" width="50px"> 
                            <input type="file"  name="amenity_image[]" accept="image/*" onchange='geImgname(this,{{ $amenity->id }})'>
                            <input type="hidden" value="" id="amenity_image_hidden{{$amenity->id }}" value="" name="amenity_image_hidden[]">

                          </td>
                          <td><a class="btn btn-danger" href="{{url('/')}}/delete_amenity/{{ $amenity->id }}" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                            Remove</a></td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                   <a class="btn btn-primary" onclick="addRow('0','amenity')" id="addRowid">Add Row</a>
                 </div>
               </div>
 
               <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-2 text-white text-capitalize ps-3" style="width:100%;float:left">
                 Features
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <table class="table table-bordered" id="dynamic-table1">
                      <thead>
                        <tr>
                          <th>Feature</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($features as $feature)
                       <?php
                        $feature_images = \DB::table('feature_images')->where('feature_id','=',$feature->id)->get();
                       ?>
                       <tr>
                         <td>
                           <div class="input-group input-group-outline mb-3">
                           <input type="text" class="form-control" value="{{$feature->feature}}" name="featurename[]">
                           </div>
                         </td>
                         <td><a class="btn btn-danger" href="{{url('/')}}/delete_feature/{{ $feature->id }}" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                          Remove</a></td>
                       </tr>
                       @endforeach
                      </tbody>
                    </table>
                    <a class="btn btn-primary" onclick="addRow('1','feature')">Add Row</a>
                  </div>
                </div>
               <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-2 text-white text-capitalize ps-3" style="width:100%;float:left">
                Layouts
               </div>
               <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oldpassword">Layout Main Image<span style="color:red;" >*</span></label>
                            <p>
                              <img id="output_image1" height="200px" width="300px" src="{{ Config::get('DocumentConstant.MAIN_LAYOUT_VIEW') }}{{ $data['main_layout_image'] }}" />
                            </p>
                            <div class="input-group input-group-outline mb-3">
                            <input type="file" id="image" name="image" accept="image/*" @if(!@isset($data['main_layout_image'])) required="true" @endif>
                        </div>
                    </div>
                </div>
               
              </div>
              <div class="box-footer">
                    <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<script>
  function getFilename(elm,id){
    var fn = $(elm).val();
    $('#amenity_icon_hidden'+id).val(fn);
  }

  function geImgname(elm,id){
    var fn = $(elm).val();
    $('#amenity_image_hidden'+id).val(fn);
  }
  
  function addRow(id,field)
  {
    const table = document.getElementById('dynamic-table'+id).getElementsByTagName('tbody')[0];
    const newRow = table.insertRow(table.rows.length);
    const rowId = table.rows.length;
    const index = rowId-1;
    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);
    const cell4 = newRow.insertCell(3);

    // Add content to the new cells (you can customize this part as needed)
    cell1.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="text" placeholder="Enter Value" name="'+field+'name[]" class="form-control"></div>';
    if(field=='amenity')
    {
      cell2.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'_icon[]" accept="image/*"></div>';
      cell3.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'_image[]" accept="image/*"></div>';
      cell4.innerHTML = '<a class="btn btn-danger" onclick="deleteRow(this,'+id+')">Remove</a>';
    }else{
      // cell2.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'images_'+index+'[]" accept="image/*" multiple></div>';
      cell2.innerHTML = '<a class="btn btn-danger" onclick="deleteRow(this,'+id+')">Remove</a>';

    }
  
  }

  function deleteRow(button,id)
  {
    const row = button.childNodes.childNodes;
    const table = document.getElementById('dynamic-table'+id).getElementsByTagName('tbody')[0];
    const rowId = table.rows.length;
    const index = rowId-1;
    if(index!=0){
      table.deleteRow(index);

    }
  }
</script>

@endsection