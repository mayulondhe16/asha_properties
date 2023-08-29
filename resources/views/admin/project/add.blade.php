@extends('layout.master')
 
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">{{ $title }}</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add {{ $title }}</li>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oldpassword">Project Images<span style="color:red;" >*</span></label>
                            <p>
                            <img id="output_image1" height="200px" width="300px" src="{{asset('assets/img/top.jpeg')}}" />
                            </p>
                            <div class="input-group input-group-outline mb-3">
                            <input type="file"  name="images[]" accept="image/*" required="true" multiple>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Name</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" name="name"  data-parsley-error-message="Please enter valid shop name." required="true">
                        </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Address</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" name="address"  data-parsley-error-message="Please enter valid address." required="true">
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Details Description</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                          <textarea  class="form-control" name="description" data-parsley-error-message="Please enter valid desciption." required="true"></textarea>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Total Area</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="area"  data-parsley-error-message="Please enter valid area." required="true">
                      </div>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Plot Area</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="plot_area"  data-parsley-error-message="Please enter valid plot area." required="true">
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Available Plots</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="available_plot"  data-parsley-error-message="Please enter valid available plots." required="true">
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                {{-- <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Latitude</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="lat"  data-parsley-pattern="^[0-9 .]+$" data-parsley-error-message="Please enter valid latitude." required="true">
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Longitude</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="long" data-parsley-pattern="^[0-9 .]+$"  data-parsley-error-message="Please enter valid longitude." required="true">
                      </div>
                  </div>
                </div> --}}
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Map Link</label><span style="color:red;" >*</span>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="map_link"  data-parsley-error-message="Please enter valid link." required="true">
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
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
                         <th>Images</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody>
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
                            <img id="output_image1" height="200px" width="300px" src="{{asset('assets/img/top.jpeg')}}" />
                            </p>
                            <div class="input-group input-group-outline mb-3">
                            <input type="file"  name="image" accept="image/*" required="true">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="oldpassword">Layout Images<span style="color:red;" >*</span></label>
                          <p>
                          <img id="output_image1" height="200px" width="300px" src="{{asset('assets/img/top.jpeg')}}" />
                          </p>
                          <div class="input-group input-group-outline mb-3">
                          <input type="file"  name="layout_images[]" accept="image/*" required="true" multiple>
                          <input type="hidden" id="count" name="cnt">
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
// //to get count of rows
//   var count = 0;
//   var button = document.getElementById("addRowid");
//   button.addEventListener("click", function() {
//       count++;
//       document.getElementById("count").value=count;
//   });
//to add rows in table
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
      cell2.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'icon_'+index+'" accept="image/*"></div>';
      cell3.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'images_'+index+'[]" accept="image/*" multiple></div>';
      cell4.innerHTML = '<a class="btn btn-danger" onclick="deleteRow(this,'+id+')">Remove</a>';
    }else{
      cell2.innerHTML = '<div class="input-group input-group-outline mb-3"><input type="file"  name="'+field+'images_'+index+'[]" accept="image/*" multiple></div>';
      cell3.innerHTML = '<a class="btn btn-danger" onclick="deleteRow(this,'+id+')">Remove</a>';

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