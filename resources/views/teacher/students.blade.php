@extends('../layouts.admin')
@section('sub-title','STUDENTS')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection
@section('style')
<style>

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
                  <h6>LIST OF YOUR STUDENTS</h6>
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
              </div>
              </div>
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Subject</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Age</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Address</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Grade</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Section</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Schedule</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Created At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach(auth()->user()->subjectsTeachersStudents()->get() as $teacherSubject)
                    <tr>

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
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->age ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->address ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->grade ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->section ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->schedule ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$teacherSubject->student->created_at->format('M j , Y h:i A') ?? ''}}</h6>
                         
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


@section('script')

<script>
  $(document).ready(function () {
        var table = $('.table').DataTable({
            'columnDefs': [{ 'orderable': false, 'targets': [0] }],
        });

        table.columns(0).search( $('#filter_subject').val() ).draw();

      $('#filter_subject').on("change", function(event){
        table.columns(0).search( this.value ).draw();
      });
  });


</script>


@endsection
