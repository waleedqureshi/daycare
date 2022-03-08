@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center flex-wrap grid-margin">
        <div>
            <h2 class="mb-3 mb-md-0">Dashboard</h2>
        </div>
    </div>
    
    <div class="row">
        @can('View Occupancy')
            <div class="col-md-3"> 
                <div class="card">
                    <img src="{{asset('assets/images/dashboard/occupancy.jpg')}}" class="card-img-top" alt="occupencies">
                    <div class="card-body">
                    <h5 class="card-title">Occupancy Details</h5>
                    <p class="card-text mb-3">Click here to view the details of occupancy sheet.</p>
                    <a href="{{url('/occupancy')}}" class="btn btn-primary">View Sheet</a>
                    </div>
                </div>
            </div>
        @endcan
        
        @can('Mark Attendance')
            <div class="col-md-3"> 
                <div class="card">
                    <img src="{{asset('assets/images/dashboard/attendance.jpg')}}" class="card-img-top" alt="occupencies">
                    <div class="card-body">
                    <h5 class="card-title">Attendance</h5>
                    <p class="card-text mb-3">Click here to mark the attendance.</p>
                    <a href="{{url('/attendance')}}" class="btn btn-primary">Mark Attendance</a>
                    </div>
                </div>
            </div>
        @endcan
    </div>
      
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
