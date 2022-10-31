@extends('../layouts.admin')
@section('sub-title','MANAGE STUDENT')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection
@section('style')
<style>
.picture-container {
  position: relative;
  cursor: pointer;
}
.picture {
  width: 120px;
  height: 106px;
  background-color: #d8d1c9;
  border: 4px solid transparent;
  color: #FFFFFF;
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
  object-fit: cover;
  
}
.picture:hover {
  border-color: #2ca8ff;
}
.picture-src {
  width: 100%;
}
.picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}

.cta {
    margin: 5px;
    padding: 10px;
    background-color: #18ce0f !important;
}

</style>
@endsection

@section('content')
<div class="container-fluid py-4">
  <div class="row mt-4">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
              <div class="row">
                <div class="col-md-10">
                  <h6>MANAGE studentS</h6>
                </div>
                <div class="col-md-2">
                    <button class="btn-success btn btn-sm" id="create_record">NEW STUDENT</button>
                </div>
              </div>
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Age</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Address</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Grade</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Section</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Schedule</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Created By</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Created At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($students as $student)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <button id="{{$student->id}}" class="btn btn-primary btn-sm view" >
                              VIEW/EDIT
                            </button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->age ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->address ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->grade ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->section ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->schedule ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->user->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$student->created_at->format('M j , Y h:i A') ?? ''}}</h6>
                         
                          </div>
                        </div>
                      </td>
                      
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
      @section('footer')
          @include('../partials.admin.footer')
      @endsection
  </div>
@endsection

@section('rightbar')
<div class="fixed-plugin">
  <div class="card shadow-lg">
    <div class="card-header pb-0 pt-3 ">
      
      <div class="float-end mt-2">
        <button class="btn btn-link text-danger p-0 fixed-plugin-close-button">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <br>
      <div class="float-start">
        <h6 class="text-uppercase">STUDENT INFORMATION</h6>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="overflow-auto">
        <form method="post" id="myForm" class="contact-form">
            @csrf
            <div class="card-body">
               
                <div class="form-group">
                    <label class="control-label text-uppercase" >Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-name"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Age <span class="text-danger">*</span></label>
                    <input type="number" name="age" id="age" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-age"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Address <span class="text-danger">*</span></label>
                    <input type="text" name="address" id="address" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-address"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Grade <span class="text-danger">*</span></label>
                    <input type="text" name="grade" id="grade" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-grade"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Section <span class="text-danger">*</span></label>
                    <input type="text" name="section" id="section" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-section"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Schedule <span class="text-danger">*</span></label>
                    <textarea name="schedule" id="schedule" class="form-control"></textarea>
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-schedule"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Image 1 <span class="text-danger">*</span></label>
                    <div class="picture-container">
                        <div class="form-group">
                            
                            <div class="picture">
                            
                                <img src="https://p.kindpng.com/picc/s/244-2446316_computer-icons-camera-photography-area-text-png-add.png"
                                 class="picture-src" id="image1" title="" />
                                <input type="file" id="image_file_1" name="image1" accept="image/*" >
                                
                            </div>
                            <span >
                                <strong style="font-size: .875em; color: #dc3545;" id="error-image_file_1"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Image 2 <span class="text-danger">*</span></label>
                    <div class="picture-container">
                        <div class="form-group">
                            
                            <div class="picture">
                                <img src="https://p.kindpng.com/picc/s/244-2446316_computer-icons-camera-photography-area-text-png-add.png"
                                 class="picture-src" id="image2" title="" />
                                <input type="file" id="image_file_2" name="image2" accept="image/*" >
                                
                            </div>
                            <span >
                                <strong style="font-size: .875em; color: #dc3545;" id="error-image_file_2"></strong>
                            </span>
                        </div>
                    </div>
                </div>
              
              
                <div class="card-footer text-center m-4">
                <input type="submit" name="action_button" id="action_button" class="text-uppercase btn-wd btn btn-primary text-uppercase" value="Submit" /><br>
                    <input type="button" name="remove_button" id="remove_button" class="text-uppercase btn-wd btn btn-danger text-uppercase" value="Remove" /> 

                    
                </div>
            </div>
            
        </form>
    </div>
  </div>
</div>
@endsection 

@section('script')

<script>
  $(document).ready(function () {
        var table = $('.table').DataTable({
            'columnDefs': [{ 'orderable': false, 'targets': [0] }],
        });

        $("#image_file_1").change(function(){
          readURL1(this);
        });

        function readURL1(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      $('#image1').attr('src', e.target.result).fadeIn('slow');
                  }
                  reader.readAsDataURL(input.files[0]);
              }
        }
        $("#image_file_2").change(function(){
          readURL2(this);
        });

        function readURL2(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      $('#image2').attr('src', e.target.result).fadeIn('slow');
                  }
                  reader.readAsDataURL(input.files[0]);
              }
        }

    
  });

  var id = null;
  var action = null;
  $(document).on('click', '.view', function(){
      id = $(this).attr('id');
      action = 'EDIT';

      $.ajax({
          url :"/admin/students/"+id+"/edit",
          dataType:"json",
          beforeSend:function(){
              $("#action_button").attr("disabled", true);
          },
          success:function(data){
              $("#action_button").attr("disabled", false);

              $.each(data.result, function(key,value){
                  if(key == $('#'+key).attr('id')){
                      $('#'+key).val(value)
                  }
                  if(key == 'image1'){
                    $('#image1').attr('src','{!! asset("face_recognition/labeled_images/") !!}'+'/'+value)
                  }
                  if(key == 'image2'){
                    $('#image2').attr('src','{!! asset("face_recognition/labeled_images/") !!}'+'/'+value)
                  }
              })
          }
      })

      var fixedPlugin = document.querySelector('.fixed-plugin');

      if (!fixedPlugin.classList.contains('show')) {
          fixedPlugin.classList.add('show');
      } else {
          fixedPlugin.classList.remove('show');
      }
  });

  $(document).on('click', '#create_record', function(){
      action = 'ADD';
      var fixedPlugin = document.querySelector('.fixed-plugin');

      if (!fixedPlugin.classList.contains('show')) {
          fixedPlugin.classList.add('show');
      } else {
          fixedPlugin.classList.remove('show');
      }
      $('#myForm')[0].reset();
      $('.picture-src').attr('src','https://p.kindpng.com/picc/s/244-2446316_computer-icons-camera-photography-area-text-png-add.png')
  });


  $('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var url = "/admin/students";
    var method = "POST";

    if(action == 'EDIT'){
          url = "/admin/students/" + id;
          method = "POST";
    }

    $.ajax({
        url: url,
        method: method,
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType:"json",

        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").val("Submitting");
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
            $("#action_button").val("Submit");
            
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                    if(key == 'image1'){
                        $('#image_file_1').addClass('is-invalid')
                        $('#error-image_file_1').text(value)
                    }
                    if(key == 'image2'){
                        $('#image_file_2').addClass('is-invalid')
                        $('#error-image_file_2').text(value)
                    }
                })
            }
           if(data.success){
                $.confirm({
                    title: data.success,
                    content: "",
                    type: 'green',
                    buttons: {
                        confirm: {
                            text: '',
                            btnClass: 'btn-green',
                            keys: ['enter', 'shift'],
                            action: function(){
                                location.reload();
                            }
                        },
                    }
                });
            }
           
        }
    });
  });

  $(document).on('click', '#remove_button', function(){
    $.confirm({
        title: 'Confirmation',
        content: 'You really want to remove this record?',
        type: 'red',
        buttons: {
            confirm: {
                text: 'confirm',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    return $.ajax({
                        url:"/admin/students/"+id,
                        method:'DELETE',
                        data: {
                            _token: '{!! csrf_token() !!}',
                        },
                        dataType:"json",
                        beforeSend:function(){
                          $("#remove_button").attr("disabled", true);
                          $("#remove_button").val("Removing");
                        },
                        success:function(data){
                          $("#remove_button").attr("disabled", false);
                          $("#remove_button").val("Remove");
                            if(data.success){
                              $.confirm({
                                title: 'Confirmation',
                                content: data.success,
                                type: 'green',
                                buttons: {
                                        confirm: {
                                            text: 'confirm',
                                            btnClass: 'btn-blue',
                                            keys: ['enter', 'shift'],
                                            action: function(){
                                                location.reload();
                                            }
                                        },
                                        
                                    }
                                });
                            }
                        }
                    })
                }
            },
            cancel:  {
                text: 'cancel',
                btnClass: 'btn-red',
                keys: ['enter', 'shift'],
            }
        }
    });
  });
</script>


@endsection
