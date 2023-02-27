@extends('../layouts.admin')
@section('sub-title','ATTENDANCE RECORDS')

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
                <div class="col-md">
                  <h6>ATTENDANCE RECORDS</h6>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <select  id="filter_user" class="select2" style="width: 100%;">
                            <option value="">FILTER BY USER</option>
                            @foreach($users as $user)
                              <option value="{{$user->name ?? ''}}">{{$user->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <select  id="filter_student" class="select2" style="width: 100%;">
                            <option value="">FILTER BY STUDENT</option>
                            @foreach($students as $student)
                              <option value="{{$student->name ?? ''}}">{{$student->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <select name="filter_dd" id="filter_dd" class="select2" style="width: 100%;">
                            <option value="daily">FILTER BY DATE</option>
                            <option value="daily" {{ request()->is('admin/attendance_records/daily') ? 'selected' : '' }}>DAILY</option>
                            <option value="weekly" {{ request()->is('admin/attendance_records/weekly') ? 'selected' : '' }}>WEEKLY</option>
                            <option value="monthly" {{ request()->is('admin/attendance_records/monthly') ? 'selected' : '' }}>MONTHLY</option>
                            <option value="yearly" {{ request()->is('admin/attendance_records/yearly') ? 'selected' : '' }}>YEARLY</option>
                            <option value="all" {{ request()->is('admin/attendance_records/all') ? 'selected' : '' }}>ALL</option>
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
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7"></th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Grade</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Section</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Schedule</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Attendance By</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Attendance At</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <div class="icon icon-shape icon-sm me-3 bg-warning shadow text-center">
                              <img src="/face_recognition/labeled_images/{{$attendance->student->image1}}"  width="50" height="50" alt="no_image">

                            </div>  
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->student->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->student->grade ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->student->section ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->student->schedule ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->user->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      @php
                      $string_date = $attendance->start_time;
                      $start = new DateTime($string_date);

                      $to = $attendance->created_at;
                      $from = $start;
                      $diff = $to->diffInMinutes($from);

                      if($from  < $to){
                        $status = "LATE";

                      }else{
                        $status = "EARLY";
                      }
                      @endphp
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$attendance->created_at->format('M j , Y h:i A') ?? ''}} 
                              @if($status == "LATE")
                              <span class="text-danger">
                                (Late {{$diff}} mins)
                              </span>
                              @else
                              <span class="text-success">
                                (Early {{$diff}} mins)
                              </span>
                              @endif
                            </h6>
                         
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

@endsection 

@section('script')
<script>
  $(document).ready(function () {
        var table = $('.table').DataTable({
            'columnDefs': [{ 'orderable': false, 'targets': [0] }],
        });

        $('#filter_dd').on("change", function(event){
            var date = $(this).val();
            window.location.href = '/admin/attendance_records/'+date;
        });

        $('#filter_user').on('change', function () {
          table.columns(5).search( this.value ).draw();
        });

        $('#filter_student').on('change', function () {
          table.columns(1).search( this.value ).draw();
        });
        $('.select2').select2()
  });
</script>


@endsection
