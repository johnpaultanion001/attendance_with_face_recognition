@extends('../layouts.admin')
@section('sub-title','FINDER STUDENT')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection

@section('style')
<style>
  .fixed-plugin1.show .card {
    right: 0;
  }
  .fixed-plugin1 .card {
    right: -760px;
    width: 760px;
  }
  .fixed-plugin2 .card {
    right: -760px;
    width: 760px;
  }
  .fixed-plugin2.show .card {
    right: 0;
  }


</style>
@endsection

@section('content')
<div class="container-fluid py-4">
      <div class="row">
          <div class="card">
            <div class="card-body mr-auto">
              <div class="row">
                <div class="col-lg-8">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                          <h6 class="mb-2">Select a student</h6>
                        </div>
                        <div class="form-group">
                          <select name="select_student" id="select_student" class="form-control select2" style="width: 100%;">
                            <option value="">Select student</option>
                            @foreach($students as $student1)
                              <option value="{{$student1->id}}" {{$student->id == $student1->id ? 'selected' : ''}}>{{$student1->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      
  <div class="row mt-4">
  <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>STUDENT INFORMATION</h6>
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7"></th>
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
                <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <div class="icon icon-shape icon-sm me-3 bg-warning shadow text-center">
                              <img src="/face_recognition/labeled_images/{{$student->image1}}"  width="50" height="50" alt="no_image">

                            </div>  
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
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>ATTENDANCE RECORDS</h6>
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Attendance By</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Attended At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($attendances as $attendance)
                  <tr>
                     
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->user->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->created_at->format('M j , Y h:i A') ?? ''}}</h6>
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
      @section('footer')
          @include('../partials.admin.footer')
      @endsection
  </div>
@endsection



@section('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('.select2').select2()

      $('#select_student').on("change", function(event){
        var student = $(this).val();
        window.location.href = '/admin/finder_student/'+student;
      });

      
  })
</script>


@endsection
