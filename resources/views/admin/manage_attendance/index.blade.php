@extends('../layouts.admin')
@section('sub-title','MANAGE ATTENDANCE')

@section('sidebar')
    @include('../partials.admin.sidebar')
@endsection

@section('navbar')
    @include('../partials.admin.navbar')
@endsection
@section('style')
<style>
    #bodyScan {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    canvas{
        position: absolute;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
  <div class="row mt-4">
      
      <div class="col-lg-12">
       
        <div class="card mb-4" >
          <div class="col-md-10 mx-auto" id="bodyScan">
            <video id="videoInput" width="720" height="550" muted controls>
          </div>
          <div class="col-md-6 mx-auto mt-2 p-2" style="border: 1px solid #111;">
              <div class="form-group">
                  <label for="start_time">START CLASS:</label>
                <input type="time" class="form-control" id="start_time">
              </div>
          </div>
          <div class="col-md-10 mx-auto text-center">
            <h6 id="loading_state"></h6>
          </div>
        </div>
      </div>
      <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">LIST OF ATTENDEES</h6>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center ">
                <tbody id="attendance_list">
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
<script src="{{ asset('/face_recognition/js/face-api.min.js') }}"></script>
<script>
        document.getElementById("start_time").defaultValue = "07:30";
        
        const video = document.getElementById('videoInput')

        Promise.all([
            faceapi.nets.faceRecognitionNet.loadFromUri('/face_recognition/models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('/face_recognition/models'),
            faceapi.nets.ssdMobilenetv1.loadFromUri('/face_recognition/models') //heavier/accurate version of tiny face detector
        ]).then(start)

        function start() {
            $('#loading_state').addClass('text-danger')
            $('#loading_state').text('LOADING..')

            navigator.getUserMedia(
                { video:{} },
                stream => video.srcObject = stream,
                err => console.error(err)
            )
            
            //video.src = '../videos/speech.mp4'
            console.log('video added')
            attendance_record()
            recognizeFaces()
            
        }

        async function recognizeFaces() {

            const labeledDescriptors = await loadLabeledImages()
            console.log(labeledDescriptors)
            const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.7)


            video.addEventListener('play', async () => {
                console.log('Playing')
                const canvas = faceapi.createCanvasFromMedia(video)
                $('#bodyScan').append(canvas)

                const displaySize = { width: video.width, height: video.height }
                faceapi.matchDimensions(canvas, displaySize)

                

                setInterval(async () => {
                    const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()

                    const resizedDetections = faceapi.resizeResults(detections, displaySize)

                    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

                    const results = resizedDetections.map((d) => {
                        return faceMatcher.findBestMatch(d.descriptor)
                    })
                    results.forEach( (result, i) => {
                        const box = resizedDetections[i].detection.box
                        const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
                        drawBox.draw(canvas)
                        console.log(result.label)
                        attendance(result.label)
                        attendance_record()
                    })
                }, 1000)
            })
        }

        function attendance(student_folder){
            $.ajax({
                url:"/admin/attendance",
                method:'POST',
                data: {
                    _token: '{!! csrf_token() !!}', student_folder: student_folder, start_time:$('#start_time').val(),
                },
                dataType:"json",
                beforeSend:function(){

                },
                success:function(data){
                    if(data.success){
                      $('#loading_state').removeClass('text-danger')
                      $('#loading_state').addClass('text-success')
                      $('#loading_state').text(data.success)
                    }
                    if(data.student_attendent){
                      $('#loading_state').removeClass('text-success')
                      $('#loading_state').addClass('text-danger')
                      $('#loading_state').text(data.student_attendent)
                    }

                }
            })
        }

        function attendance_record(){
            $.ajax({
                url:"/admin/attendances",
                method:'GET',
                data: {
                    _token: '{!! csrf_token() !!}'
                },
                dataType:"json",
                beforeSend:function(){

                },
                success:function(data){
                    console.log(data.attendances);
                    var attendances = "";
                    $.each(data.attendances, function(key,value){
                        attendances += `
                            <tr>
                              <td class="w-30">
                                <div class="d-flex px-2 py-1 align-items-center">
                                  <div class="icon icon-shape icon-sm me-3 bg-warning shadow text-center">
                                    <img src="`+value.image+`"  width="50" height="50" alt="no_image">
                                  </div>
                                  <div class="ms-4">
                                    <p class="text-xs font-weight-bold mb-0">Student:</p>
                                    <h6 class="text-sm mb-0 text-uppercase">
                                        `+value.student+`
                                    </h6>
                                  </div>
                                </div>
                              </td>
                              <td>
                              <p class="text-xs font-weight-bold mb-0">Attendance By:</p>
                                  <h6 class="text-sm mb-0 text-uppercase">
                                    `+value.attendance_by+`
                                  </h6>
                              </td>
                              <td>
                                  <p class="text-xs font-weight-bold mb-0">Attended At:</p>
                                  <h6 class="text-sm mb-0 text-uppercase">
                                    `+value.date_time+`
                                    <span class="`+value.status_color+`">
                                      (`+value.status+` `+value.diff+` mins)
                                    </span> 
                                  </h6>
                              </td>
                              <td class="align-middle text-sm">
                                  <div class="d-flex">
                                      <button remove="`+value.id+`" class="btn btn-danger btn-sm remove">
                                        REMOVE
                                      </button>
                                  </div>
                              </td>
                            </tr>
                           `; 
                    })
                    $('#attendance_list').empty().append(attendances);
                }
            })
        }

        function loadLabeledImages() {
            const labels = JSON.parse(`<?php echo $students; ?>`);
        
            return Promise.all(
                labels.map(async (label)=>{
                    const descriptions = []
                    for(let i=1; i<=2; i++) {
                        const img = await faceapi.fetchImage(`/face_recognition/labeled_images/${label}/${i}.jpg`)
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                        console.log(label + i + JSON.stringify(detections))
                        descriptions.push(detections.descriptor)
                    }
                    $('#loading_state').removeClass('text-danger')
                    $('#loading_state').addClass('text-success')
                    $('#loading_state').text('FACE SCANNER READY')
                    return new faceapi.LabeledFaceDescriptors(label, descriptions)
                    
                })
            )
        }

        $(document).on('click', '.remove', function(){
          var id = $(this).attr('remove');
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
                              url:"/admin/attendance/"+id,
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
                                    
                                    $('#loading_state').removeClass('text-danger')
                                    $('#loading_state').addClass('text-success')
                                    $('#loading_state').text(data.success)
                                    attendance_record();
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
