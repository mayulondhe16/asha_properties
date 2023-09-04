@extends('layout.master')
 
@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">{{ $title }}</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">View {{ $title }}</li>
          </ol>
          {{-- <h6 class="font-weight-bolder mb-0">Tables</h6> --}}
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
              <form action="{{ url('/')}}/store_{{$url_slug}}" method="post" role="form" data-parsley-validate="parsley" enctype="multipart/form-data" autocomplete="off">
                {!! csrf_field() !!} 
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="oldpassword">Project Images<span style="color:red;" >*</span></label>
                        <div class="row">
                          @foreach($images as $key=> $image)
                          <div class="col-md-4">
                            {{-- {{ $key+1 }} --}}
                            <p>
                            
                              <img src="{{ Config::get('DocumentConstant.PROJECT_VIEW') }}{{$image->image}}" height="200px" width="300px"> 
                            </p>
                          </div>
                          @endforeach
                        </div>
                            {{-- <div class="input-group input-group-outline mb-3">
                            <input type="file"  name="images[]" accept="image/*" required="true" multiple>
                        </div> --}}
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Name</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" name="name"  data-parsley-error-message="Please enter valid shop name." required="true" value="{{ $data['name'] }}" readonly>
                        </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Address</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" name="address"  data-parsley-error-message="Please enter valid address." required="true" value="{{ $data['address'] }}" readonly>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Details Description</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <textarea  class="form-control" name="description" data-parsley-error-message="Please enter valid desciption." required="true" readonly>{{ $data['description'] }}</textarea>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Area</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="area"  data-parsley-error-message="Please enter valid area." required="true" value="{{ $data['area'] }}" readonly>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Plot Area</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="area"  data-parsley-error-message="Please enter valid area." required="true" value="{{ $data['plot_area'] }}" readonly>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Available Plots</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="area"  data-parsley-error-message="Please enter valid area." required="true" value="{{ $data['available_plot'] }}" readonly>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Map Link</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="map_link"  data-parsley-error-message="Please enter valid area." required="true" value="{{ $data['map_link'] }}" readonly>
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
                        <th>Images</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($amenities as $amenity)
                      <?php
                          $amenity_images = \DB::table('aminity_images')->where('aminity_id','=',$amenity->id)->get();
                       ?>
                      <tr>
                        <td>
                            <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" value="{{$amenity->aminity}}" readonly>
                            </div>
                        </td>
                        <td>
                          <div class="input-group input-group-outline mb-3">
                            <img src="{{ Config::get('DocumentConstant.AMENITYICON_VIEW') }}{{ $amenity->amenityicon }}" height="20px" width="30px"> 
                          </div>
                      </td>
                        @foreach ( $amenity_images as $am )
                        <td>
                          <img src="{{ Config::get('DocumentConstant.AMENITY_VIEW') }}{{ $am->images }}" height="20px" width="30px"> 
                        </td>
                        @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{-- <a class="btn btn-primary" onclick="addRow('0','amenity')" id="addRowid">Add Row</a> --}}
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
                         <th>Images</th>
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
                          <input type="text" class="form-control" value="{{$feature->feature}}" readonly>
                          </div>
                        </td>
                        @foreach ($feature_images as $key=>$ft)
                        <td>
                          <img data-image-id="myImg{{$key}}" id="myImg{{$key}}" class="getSrc" src="{{ Config::get('DocumentConstant.FEATURES_VIEW') }}{{ $ft->images }}" height="20px" width="30px"> 
                        </td>
                        @endforeach
                      </tr>
                      @endforeach
                     </tbody>
                   </table>
                   {{-- <a class="btn btn-primary" onclick="addRow('1','feature')">Add Row</a> --}}
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
                              <img src="{{ Config::get('DocumentConstant.MAIN_LAYOUT_VIEW') }}{{$data['main_layout_image']}}" height="200px" width="300px"> 
                            </p>
                            {{-- <div class="input-group input-group-outline mb-3">
                            <input type="file"  name="image" accept="image/*" required="true">
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="col-md-6">
                  <div class="form-group">
                      <label for="oldpassword">Layout Images<span style="color:red;" >*</span></label>
                        <div class="row">
                          @foreach($layout_images as $image)
                          <div class="col-md-4">
                            <p>
                              <img src="{{ Config::get('DocumentConstant.LAYOUT_VIEW') }}{{$image->images}}" height="200px" width="300px"> 
                            </p>
                          </div>
                          @endforeach
                        </div>
                          <input type="hidden" id="count" name="cnt">
                        </div>
                  </div> --}}
              </div>
              </div>
              <div class="box-footer">
                <a href="{{url('/')}}/manage_projects" type="submit" class="btn btn-primary pull-right">Back</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      

<script>
    
  function addRow(id,field)
  {
    const table = document.getElementById('dynamic-table'+id).getElementsByTagName('tbody')[0];
    const newRow = table.insertRow(table.rows.length);
    const rowId = table.rows.length;
    const index = rowId-1;
    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);

    // Add content to the new cells (you can customize this part as needed)
    cell1.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="text" placeholder="Enter Value" name="'+field+'name[]" class="form-control"></div>';
    cell2.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'images_'+index+'[]" accept="image/*" multiple></div>';
    cell3.innerHTML = '<a class="btn btn-danger" onclick="deleteRow(this,'+id+')">Remove</a>';
  }

  function deleteRow(button,id)
  {
    const row = button.parentNode.parentNode;
    const table = document.getElementById('dynamic-table'+id).getElementsByTagName('tbody')[0];
    table.deleteRow(row.rowIndex);
  }
</script>
@endsection