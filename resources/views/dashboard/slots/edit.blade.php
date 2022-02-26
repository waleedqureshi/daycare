@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('session/view') }}">Session</a></li>
      <li class="breadcrumb-item active" aria-current="page">Slots</li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
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

  
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Edit Slot for Session - {{ $slot->session->name }}</h6>
           <form method="POST" action="{{ url('/slot/update/'.encrypt($slot->id)) }}" class="forms-sample" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="day">Day<span style="color:red;"> *</span></label>
                  <select required class="js-example-basic-single w-100" id="day" name="day">
                    <option selected value="">Select</option>
                    <option  @if($slot->day == 'Monday') selected @endif>Monday</option>
                    <option  @if($slot->day == 'Teusday') selected @endif>Teusday</option>
                    <option  @if($slot->day == 'Wednesday') selected @endif>Wednesday</option>
                    <option  @if($slot->day == 'Thursday') selected @endif>Thursday</option>
                    <option  @if($slot->day == 'Friday') selected @endif>Friday</option>
                    <option  @if($slot->day == 'Saturday') selected @endif>Saturday</option>
                    <option  @if($slot->day == 'Sunday') selected @endif>Sunday</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone_no">Start Time<span style="color:red;"> *</span></label>
                  <input required type="time" class="form-control" id="start" name="start" autocomplete="off" value="{{$slot->start}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="end">End Time<span style="color:red;"> *</span></label>
                  <input required type="time" class="form-control" id="end" name="end" autocomplete="off" value="{{$slot->end}}">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a class="btn btn-light" href="{{ url('/slot/view/'.encrypt($slot->session->id)) }}">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
@endpush