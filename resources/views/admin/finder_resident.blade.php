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
                          <h6 class="mb-2">Select a resident</h6>
                        </div>
                        <div class="form-group">
                          <select name="select_resident" id="select_resident" class="form-control select2" style="width: 100%;">
                            <option value="">Select resident</option>
                            @foreach($residents as $resident1)
                              <option value="{{$resident1->id}}" {{$resident->id == $resident1->id ? 'selected' : ''}}>{{$resident1->name}}</option>
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
            <h6>RESIDENT INFORMATION</h6>
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" style="width: 100%;">
                <thead>
                  <tr>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Address</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Contact Number</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Birth Date</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Birth Place</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Civil Status</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Gender</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Is Voter?</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">With Record?</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Is Employed?</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Is Student?</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Is PWD?</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Senior Citizen?</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Register At</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <button id="{{$resident->id}}" class="btn btn-primary btn-sm view" >
                              VIEW/EDIT
                            </button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->name ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->address ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->contact_number ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->birthdate ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->birthplace ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->civil_status ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->gender ?? ''}}</h6>
                          </div>
                        </div>
                      </td>
                      <td  class="align-middle text-center text-sm">
                          <span class="badge badge-sm {{$resident->isVoter == true ? 'bg-success':'bg-danger'}}">
                            {{$resident->isVoter == true ? 'YES':'NO'}}
                          </span>
                      </td>
                      <td  class="align-middle text-center text-sm">
                          <span class="badge badge-sm {{$resident->isRecord == true ? 'bg-success':'bg-danger'}}">
                            {{$resident->isRecord == true ? 'YES':'NO'}}
                          </span>
                      </td>
                      <td  class="align-middle text-center text-sm">
                          <span class="badge badge-sm {{$resident->isEmployed == true ? 'bg-success':'bg-danger'}}">
                            {{$resident->isEmployed == true ? 'YES':'NO'}}
                          </span>
                      </td>
                      <td  class="align-middle text-center text-sm">
                          <span class="badge badge-sm {{$resident->isStudent == true ? 'bg-success':'bg-danger'}}">
                            {{$resident->isStudent == true ? 'YES':'NO'}}
                          </span>
                      </td>
                      <td  class="align-middle text-center text-sm">
                          <span class="badge badge-sm {{$resident->isPWD == true ? 'bg-success':'bg-danger'}}">
                            {{$resident->isPWD == true ? 'YES':'NO'}}
                          </span>
                      </td>
                      <td  class="align-middle text-center text-sm">
                          <span class="badge badge-sm {{$resident->isSr == true ? 'bg-success':'bg-danger'}}">
                            {{$resident->isSr == true ? 'YES':'NO'}}
                          </span>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$resident->created_at->format('M j , Y h:i A') ?? ''}}</h6>
                         
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
            <h6>REQUESTED DOCUMENTS</h6>
          </div>
          <div class="card-body ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-secondary opacity-7"></th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Request Number</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Resident</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Document</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Claiming Date</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Payment</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Amount To Pay</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Requested By</th>
                    <th class="text-uppercase text-xxs text-dark font-weight-bolder opacity-7">Requested At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($requested_documents as $document)
                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <a href="/admin/request_document/{{$document->resident->id}}/{{$document->document->id}}/{{$document->id}}" class="btn btn-primary btn-sm">VIEW/EDIT</a>
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
        <h6 class="text-uppercase">RESIDENT INFORMATION</h6>
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
                    <label class="control-label text-uppercase" >Address <span class="text-danger">*</span></label>
                    <input type="text" name="address" id="address" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-address"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Contact Number <span class="text-danger">*</span></label>
                    <input type="number" name="contact_number" id="contact_number" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-contact_number"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Birth Date <span class="text-danger">*</span></label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-birthdate"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Birth Place <span class="text-danger">*</span></label>
                    <input type="text" name="birthplace" id="birthplace" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-birthplace"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Civil Status <span class="text-danger">*</span></label>
                    <select name="civil_status" id="civil_status" class="form-control" style="appearance: searchfield;">
                        <option value="SINGLE">SINGLE</option>
                        <option value="MARRIED">MARRIED</option>
                        <option value="WIDOWED">WIDOWED</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Gender <span class="text-danger">*</span></label>
                    <select name="gender" id="gender" class="form-control" style="appearance: searchfield;">
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Is Voter? <span class="text-danger">*</span></label>
                    <select name="isVoter" id="isVoter" class="form-control" style="appearance: searchfield;">
                        <option value="1">YES</option>
                        <option value="0">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >WITH RECORD? <span class="text-danger">*</span></label>
                    <select name="isRecord" id="isRecord" class="form-control" style="appearance: searchfield;">
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Is Employed? <span class="text-danger">*</span></label>
                    <select name="isEmployed" id="isEmployed" class="form-control" style="appearance: searchfield;">
                        <option value="1">YES</option>
                        <option value="0">NO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Is Student? <span class="text-danger">*</span></label>
                    <select name="isStudent" id="isStudent" class="form-control" style="appearance: searchfield;">
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Is PWD? <span class="text-danger">*</span></label>
                    <select name="isPWD" id="isPWD" class="form-control" style="appearance: searchfield;">
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Is Senior? <span class="text-danger">*</span></label>
                    <select name="isSr" id="isSr" class="form-control" style="appearance: searchfield;">
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
                <div class="card-footer text-center m-4">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn-wd btn btn-primary text-uppercase" value="Submit" />
                   
                </div>
            </div>
            
        </form>
    </div>
  </div>
</div>
@endsection 

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
      $('.select2').select2()

      var id = null;
      $(document).on('click', '.view', function(){
          id = $(this).attr('id');

          $.ajax({
              url :"/admin/residents/"+id+"/edit",
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
          var fixedPlugin1 = document.querySelector('.fixed-plugin1');
          var fixedPlugin2 = document.querySelector('.fixed-plugin2');

          if (!fixedPlugin.classList.contains('show')) {
              fixedPlugin.classList.add('show');
              fixedPlugin1.classList.remove('show');
              fixedPlugin2.classList.remove('show');
          } else {
              fixedPlugin.classList.remove('show');
          }
      });

      $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var url = "/admin/residents/" + id;
        var method = "PUT";

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
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

      $('#select_resident').on("change", function(event){
        var resident = $(this).val();
        window.location.href = '/admin/finder_resident/'+resident;
      });

      
  })
</script>


@endsection
