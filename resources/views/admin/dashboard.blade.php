@extends('../layouts.admin')
@section('sub-title','DASHBOARD')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection


@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-2">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Students</p>
                    <h5 class="font-weight-bolder">
                     {{$students->count()}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-success shadow-danger text-center rounded-circle">
                    <i class="fa-solid fa-users text-sm opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-2">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Teachers</p>
                    <h5 class="font-weight-bolder">
                      {{$teachers->count()}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-default shadow-danger text-center rounded-circle">
                    <i class="fa-solid fa-users text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">ATTENDANCE FOR TODAY</h6>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center ">
                <tbody>
                  @forelse($attendances as $attendance)
                  <tr>
                    <td class="w-30">
                      <div class="d-flex px-2 py-1 align-items-center">
                        <div class="icon icon-shape icon-sm me-3 bg-warning shadow text-center">
                          <img src="/face_recognition/labeled_images/{{$attendance->student->image1 ?? ''}}"  width="50" height="50" alt="no_image">
                        </div>
                        <div class="ms-4">
                          <p class="text-xs font-weight-bold mb-0">Student:</p>
                          <h6 class="text-sm mb-0 text-uppercase">
                            {{$attendance->student->name ?? ''}}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">Attendance By:</p>
                        <h6 class="text-sm mb-0 text-uppercase">{{$attendance->user->name ?? ''}}</h6>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">Attendance At</p>
                        <h6 class="text-sm mb-0 text-uppercase">{{$attendance->created_at->format('M j , Y h:i A') ?? ''}}</h6>
                    </td>
                    <td class="align-middle text-sm">
                        <div class="d-flex">
                          <a href="/admin/finder_student/{{$attendance->student->id}}" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                        </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td class="w-30">
                      <div class="d-flex px-2 py-1 align-items-center">
                      
                        <div class="ms-4">
                          <h6 class="text-sm mb-0 text-uppercase">
                            <h6 class="mb-1 text-dark text-sm text-uppercase">NO DATA FOUND</h6>
                          </h6>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                
                  
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

@section('rightbar')

@endsection 

@section('script')
<script>


</script>
@endsection
