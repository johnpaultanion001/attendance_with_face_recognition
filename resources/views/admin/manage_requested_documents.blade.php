@extends('../layouts.admin')
@section('sub-title','REQUESTED DOCUMENTS')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection
@section('style')
<style>
  .fixed-plugin.show .card {
    right: 0;
  }
  .fixed-plugin .card {
    right: -760px;
    width: 760px;
  }

  .fixed-plugin1.show .card {
    right: 0;
  }
  .fixed-plugin1 .card {
    right: -760px;
    width: 760px;
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
                <h6>MANAGE REQUESTED DOCUMENTS</h6>
                </div>
                <div class="col-md-2">
                </div>
                </div>
           
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table  class="table align-items-center mb-0" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Request Number</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Resident</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Document</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Claiming Date</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Payment</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Amount To Pay</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Remarks</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Requested By</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Requested At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($documents as $document)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <a href="/admin/request_document/{{$document->resident->id}}/{{$document->document->id}}/{{$document->id}}" class="btn btn-primary btn-sm view">VIEW/EDIT</a>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-primary">{{$document->request_number ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$document->resident->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$document->document->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$document->claiming_date ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"> ₱ {{$document->document->amount ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">  ₱ {{$document->amount_to_pay ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$document->remarks ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$document->user->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$document->created_at->format('M j , Y h:i A') ?? ''}}</h6>
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

  });





</script>


@endsection
