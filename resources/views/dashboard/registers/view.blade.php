@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('register/view') }}">Register</a></li>
      <li class="breadcrumb-item active" aria-current="page">View</li>
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
              <h6 class="card-title">Registers List</h6>
            </div>
            @can('Add Register')
              <div class="col-md-6">
                <a href="{{ url('register/add') }}" type="button" class="btn btn-primary" style="float:right;">Add Register</a>
              </div>
            @endcan
          </div>
          <div class="table-responsive pt-3">
            <table id="dataTableExample" class="table table-hover">
              <thead>
                <tr>
                  <th style="width:5%;white-space:normal!important;">
                    #
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Date of Birth
                  </th>
                  <th>
                    Parent/Carer
                  </th>
                  <th class="text-center" data-orderable="false">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($registers as $serial => $register)
                <tr>
                  <td>{{ $serial + 1 }}</td>
                  <td>{{ $register->child_name }}</td>
                  <td>{{ ($register->child_date_of_birth) ?  ($register->child_date_of_birth) : 'N/A'}}</td>
                  <td>{{ ($register->family1_name) ?  ($register->family1_name) : 'N/A'}}</td>
                  <td class="text-center">
                      @can('Allocate Session')
                        <a title="Allocate Session" href="{{ url('session/allocate/'.encrypt($register->id)) }}">
                          <button type="button" class="btn btn-primary btn-icon">
                            <i class="mdi mdi-calendar-clock"></i>
                          </button>
                        </a>
                      @endcan
                      @can('Edit Register')
                        <a title="Edit" href="{{ url('register/edit/'.encrypt($register->id)) }}">
                          <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="edit"></i>
                          </button>
                        </a>
                      @endcan                  
                      
                      @can('Delete Register')
                        <a title="Delete" data-toggle="modal" data-target="#actionModal{{$serial}}">
                          <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="trash-2"></i>
                          </button>
                        </a>
                        <div class="modal fade text-left" id="actionModal{{$serial}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm your action!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this register?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{{ url('register/destroy/'.encrypt($register->id)) }}" type="button" class="btn btn-primary">Yes</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endcan
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