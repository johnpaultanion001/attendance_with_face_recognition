@extends('../layouts.admin')
@section('sub-title','FINDER RESIDENT')

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
                <h6>REQUEST DOCUMENTS</h6>
                </div>
                <div class="col-md-2">
                  
                </div>
                </div>
           
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <h6>SELECT A RESIDENT</h6>
                <select id="select_resident" class="form-control select2" style="appearance: button;">
                      @foreach($residents as $resident1)
                        <option value="{{$resident1->id}}" {{$resident->id == $resident1->id ? 'selected' : ''}}>{{$resident1->name ?? ''}}</option>
                      @endforeach
                </select>
              </div>
              <div class="col-6">
                <h6>SELECT A DOCUMENT</h6>
                <select id="select_document" class="form-control select2" style="appearance: button;">
                    @foreach($documents as $document1)
                      <option value="{{$document1->id}}" {{$document->id == $document1->id ? 'selected' : ''}}>{{$document1->name ?? ''}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-md-6">
                <h6>RESIDENT INFORMATION</h6>
                <div id="resident_info"></div>

              </div>
              <div class="col-md-6">
                <h6>DOCUMENT INFORMATION</h6>
                <div id="document_info"></div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Claiming Date <span class="text-danger">*</span></label>
                        <input type="date" id="claiming_date" class="form-control" value="{{$request->claiming_date ?? ''}}" name="claiming_date">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Amount To Pay <span class="text-danger">*</span></label>
                        <input type="number" id="amount_to_pay" value="{{$request->amount_to_pay ?? ''}}" class="form-control" name="amount_to_pay">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control">{{$request->remarks ?? ''}}</textarea>
                    </div>
                  </div>
                </div>
                  
              </div>
            </div>
           
          </div>
          <div class="row mx-auto">
            <div class="col-md-12">
              <input type="hidden" id="request_id" value="{{$request->id ?? 'request'}}" readonly>
              <button id="action_button" class="btn-primary btn btn-wd">SUBMIT</button>
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
      $('.select2').select2()
      resident_info();
      document_info();

      $('#select_resident').on('change', function () {
          resident_info();
      });
      $('#select_document').on('change', function () {
          document_info();
      });

      $(document).on('click', '#action_button', function(){
        $.ajax({
            url: "/admin/requesting_document", 
            type: "get",
            dataType: "json",
            data: {
                      _token: '{!! csrf_token() !!}',
                      request_id: $('#request_id').val(),
                      resident_id: $('#select_resident').val(),
                      document_id: $('#select_document').val(),
                      amount_to_pay: $('#amount_to_pay').val(),
                      claiming_date: $('#claiming_date').val(),
                      remarks: $('#remarks').val(),
                  },
            beforeSend: function() {
            },
            success: function(data){
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
      
 });

  function resident_info(){
      $.ajax({
          url: "/admin/resident_info/"+$('#select_resident').val(), 
          type: "get",
          dataType: "HTMl",
          beforeSend: function() {
          },
          success: function(response){
              $("#resident_info").html(response);
          }	
      })
  }

  function document_info(){
      $.ajax({
          url: "/admin/document_info/"+$('#select_document').val(), 
          type: "get",
          dataType: "HTMl",
          beforeSend: function() {
          },
          success: function(response){
              $("#document_info").html(response);
          }	
      })
  }
</script>
@endsection
