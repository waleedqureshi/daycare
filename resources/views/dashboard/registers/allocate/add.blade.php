@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('session/view') }}">Session</a></li>
      <li class="breadcrumb-item active" aria-current="page">Allocate</li>
    </ol>
  </nav>

  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> {{ $message }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <form method="POST" action="{{ url('session/allocate/store') }}" class="forms-sample" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="register_id" value="{{$register->id}}">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Room and Session Details</h6>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="room">Room</label>
                  <select class="js-example-basic-single w-100" id="room" name="room">
                    <option selected value="">Select</option>
                    @foreach($rooms as $room)
                      <option value="{{$room->id}}" @if($room->id == $allocated_room) selected @endif>{{$room->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="session">Session</label>
                  <select class="js-example-basic-single w-100" id="session" name="session">
                    <option selected value="">Select</option>
                    @foreach($sessions as $session)
                      <option value="{{$session->id}}" @if($session->id == $allocated_session_id) selected @endif>{{$session->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Slots in the selected session</h6>
            <div class="table-responsive pt-3">
              <table id="dataTableExample" class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" style="width:30%;">Day</th>
                    <th class="text-center" style="width:70%;">Slots</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($slots as $day => $slot)
                      <tr class="slots_rows">
                        <td class="text-center">{{ $day }}</td>
                        <td class="text-center">
                          <div class="form-group">
                            <select class="js-example-basic-single w-100" name="slot[]">
                              <option selected value="">Select</option>
                              @foreach($slots[$day] as $slot)
                                <option value="{{$slot->id}}" @if(in_array($slot->id, $allocation_slots)) selected @endif>{{$slot->start.' - '.$slot->end}}</option>
                              @endforeach
                            </select>
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

    
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <center>
              <a class="btn btn-light"  href="{{ url('register/view') }}">Cancel</a>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </center>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script>
    $('#session').on('change', function(){
      var session_id = $('#session').val();

      if (session_id == '') {
        $('.slots_rows').remove();
        return;
      }

      $.ajax({
        url: APP_URL + "/session/allocate/update_slots",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            session_id:session_id,
        },
        success:function(response){
          $('.slots_rows').remove();
          $('tbody').append(response);
          $('select').select2();
        },
        error:function(){
          $('.slots_rows').remove();
        }
      });
    });
  </script>
@endpush