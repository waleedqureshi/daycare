@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('register/view') }}">Register</a></li>
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
  
  @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Warning!</strong> {{ $message }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h6 class="card-title">Attendance List</h6>
            </div>
          </div>
          <div class="table-responsive pt-3">
            <table id="dataTableExample" class="table table-hover">
              <thead>
                <tr>
                  <th style="width:5%;white-space:normal!important;">
                    #
                  </th>
                  <th class="text-center">
                    Date
                  </th>
                  <th class="text-center">
                    Session
                  </th>
                  <th class="text-center">
                    Slot
                  </th>
                  <th class="text-center">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($attendances as $serial => $attendance)
                <tr>
                  <td>{{ $serial + 1 }}</td>
                  <td class="text-center">{{ $attendance->date }}</td>
                  <td class="text-center">{{ ($attendance->allocation->slot->session->name) ?  ($attendance->allocation->slot->session->name) : 'N/A'}}</td>
                  <td class="text-center">{{ ($attendance->allocation->slot->start) . ' - ' .  ($attendance->allocation->slot->end)}}</td>
                  <td class="text-center">
                    @if($attendance->attendance == 'Present')
                    <span class="badge bg-success">{{ $attendance->attendance }}</span>
                    @elseif($attendance->attendance == 'Absent')
                    <span class="badge bg-warning">{{ $attendance->attendance }}</span>
                    @else
                    N/A
                    @endif
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
  
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush