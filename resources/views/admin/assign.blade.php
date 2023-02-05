@extends('../layouts.admin')
@section('sub-title','ASSIGN SUBJECT AND STUDENT')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection

@section('content')
<div class="container-fluid py-4">
  <div class="row mt-4">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-md-10">
                  <h6>ASSIGN SUBJECT AND STUDENT</h6>
              </div>
              <div class="col-md-2">
              <div class="form-group">
                      <label class="control-label text-uppercase" >Filter by Subject <span class="text-danger">*</span></label>
                      <select name="filter_subject" id="filter_subject" class="form-control">
                          @foreach($subjects as $subject)
                              <option value="{{$subject->subject_title}}">{{$subject->subject_title ?? ''}}</option>
                          @endforeach
                      </select>
                    </div>
                    <br>
                  <button class="btn btn-dark btn-sm" id="create_record">
                    ASSIGN
                  </button>
              </div>
              
            </div>
          </div>
          <div class="card-body ">
          <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Subject</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Student Name</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Created At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($teacher->subjectsTeachersStudents()->get() as $teacherSubject)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <button id="{{$teacherSubject->id}}" class="btn btn-primary btn-sm view" >
                              VIEW/EDIT
                            </button>
                            <button id="{{$teacherSubject->id}}" class="btn btn-danger btn-sm remove" >
                              REMOVE
                            </button>
                          </div>
                        </div>
                        
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->subject->subject_title ?? ''}}</h6>
                         
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->name ?? ''}}</h6>
                         
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->created_at->format('M j , Y h:i A') ?? ''}}</h6>
                         
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
        <h6 class="text-uppercase">ASSIGN SUBJECT AND STUDENT</h6>
      </div>
      
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="overflow-auto">
        <form method="post" id="myForm" class="contact-form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="control-label text-uppercase" >Subject <span class="text-danger">*</span></label>
                    <select name="subject_id" id="subject_id" class="form-control">
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject_title ?? ''}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label text-uppercase" >Student <span class="text-danger">*</span></label>
                    <select name="student_id" id="student_id" class="form-control">
                        @foreach($students as $student)
                            <option value="{{$student->id}}">{{$student->name ?? ''}}</option>
                        @endforeach
                    </select>
                </div>
                
                <input type="hidden" name="id" id="id"  />
                <input type="hidden" name="action" id="action" value="ADD"  />
                <input type="hidden" name="teacher_id" id="teacher_id" value="{{$teacher->id}}"  />

                <div class="card-footer text-center">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn-wd btn btn-primary" value="Submit" />
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
      var table =  $('.table').DataTable({
            'columnDefs': [{ 'orderable': false, 'targets': [0] }],
        });

      $('#filter_subject').on("change", function(event){
        table.columns(1).search( this.value ).draw();
      });
  });
  

  $(document).on('click', '#create_record', function(){
      $('#name').focus();
      $('#action').val('ADD');
      $('.form-control').removeClass('is-invalid')
      $('#myForm')[0].reset();
      var fixedPlugin = document.querySelector('.fixed-plugin');
      if (!fixedPlugin.classList.contains('show')) {
          fixedPlugin.classList.add('show');
      } else {
          fixedPlugin.classList.remove('show');
      }
  });
   
    $('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var url = "/admin/staffs/assign";
    var method = "GET";

   
    $.ajax({
        url: url,
        method: method,
        data: $(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);

          
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


  $(document).on('click', '.view', function(){
      var id = $(this).attr('id');
      $('#id').val(id);
      $.ajax({
          url :"/admin/staffs/assign/"+id+"/edit",
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

  $(document).on('click', '.remove', function(){
  var id = $(this).attr('id');
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
                        url:"/admin/staffs/assign/"+id+"/delete",
                        method:'DELETE',
                        data: {
                            _token: '{!! csrf_token() !!}',
                        },
                        dataType:"json",
                        beforeSend:function(){
                          $(".remove").attr("disabled", true);
                        },
                        success:function(data){
                          $(".remove").attr("disabled", false);
                          
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
