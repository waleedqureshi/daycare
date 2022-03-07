@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Attendance</li>
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
  <form method="POST" action="{{ url('attendance/save') }}" class="forms-sample" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Allocate room and session</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="room">Room</label>
                  <select class="js-example-basic-single w-100" id="room" name="room">
                    <option selected value="">Select</option>
                    @foreach($rooms as $room)
                      <option value="{{$room->id}}">{{$room->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group slots_div">
                  <label for="slot">Slot</label>
                  <select class="js-example-basic-single w-100" id="slot" name="slot" onchange="get_childs_1()">
                    <option selected value="">Select</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 date_div">
                <!-- <div class="form-group date_div_date">
                  <label for="date">Date</label>
                  <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" class="form-control" id="date" name="date" autocomplete="off"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                  </div>
                </div> -->
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
            <h6 class="card-title">Occupants in the selected details</h6>
            <div class="table-responsive pt-3">
              <table id="dataTableExample" class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">Child Name</th>
                    <th class="text-center">Attendance</th>
                  </tr>
                </thead>
                <tbody>
                  
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
              <a class="btn btn-light"  href="{{ url('/') }}">Cancel</a>
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
    $('#room').on('change', function(){
      var room_id = $('#room').val();

      if (room_id == '') {
        $('.child_rows').remove();
        $('.slots_dropdown').remove();
          $('.date_div_date').remove(); 
        return;
      }

      $.ajax({
        url: "{{ url('/attendance/get_slots/') }}",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            room_id:room_id,
        },
        success:function(response){
            $('.slots_dropdown').remove();
            $('.child_rows').remove();
          $('.date_div_date').remove(); 
            $('#slot').append(response);
            $('#slot').select2();
        },
        error:function(){
          $('.slots_dropdown').remove();
        }
      });
    });
    
    function get_childs_1(){
      var slot_id = $('#slot').val();

      if (slot_id == '') {
        $('.child_rows').remove();
          $('.date_div_date').remove(); 
        return;
      }

      
      var room_id = $('#room').val();
      var date = $('#date').val();

      $.ajax({
        url: "{{ url('/attendance/get_childs/') }}",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            slot_id:slot_id,
            room_id:room_id,
            date:date,
        },
        success:function(response){
          $('.child_rows').remove(); 
          $('.date_div_date').remove(); 
          $('#dataTableExample > tbody').append(response);
          content = '';
          content += '<div class="form-group date_div_date">';
          content += '        <label for="date">Date</label>';
          content += '       <div class="input-group date datepicker" id="datePickerExample">';
          content += '         <input required type="text" class="form-control" id="date" name="date" autocomplete="off" onchange="get_childs_2()"><span class="input-group-addon"><i data-feather="calendar"></i></span>';
          content += '       </div>';
          content += '      </div>';
          $('.date_div').append(content);
          $('#date').datepicker();
          feather.replace();
        },
        error:function(){
          $('.child_rows').remove();
        }
      });
    }

    function get_childs_2(){
      var slot_id = $('#slot').val();

      if (slot_id == '') {
        $('.child_rows').remove();
          $('.date_div_date').remove(); 
        return;
      }

      
      var room_id = $('#room').val();
      var date = $('#date').val();

      $.ajax({
        url: "{{ url('/attendance/get_childs/') }}",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            slot_id:slot_id,
            room_id:room_id,
            date:date,
        },
        success:function(response){
          $('.child_rows').remove(); 
          $('#dataTableExample > tbody').append(response);
        },
        error:function(){
          $('.child_rows').remove();
        }
      });
    }
  </script>
@endpush