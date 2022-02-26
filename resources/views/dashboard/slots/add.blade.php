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
          <h6 class="card-title">Add Slots for Session - {{ $session->name }}</h6>
           <form method="POST" action="{{ url('/slot/store') }}" class="forms-sample" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="session_id" value="{{$session->id}}">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="day">Day<span style="color:red;"> *</span></label>
                  <select required class="js-example-basic-single w-100" id="day" name="day">
                    <option selected value="">Select</option>
                    <option>Monday</option>
                    <option>Teusday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone_no">Start Time<span style="color:red;"> *</span></label>
                  <input required type="time" class="form-control" id="start" name="start" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="end">End Time<span style="color:red;"> *</span></label>
                  <input required type="time" class="form-control" id="end" name="end" autocomplete="off">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Add</button>
            <a class="btn btn-light" href="{{ url('/session/view') }}">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h6 class="card-title">Session Slots List</h6>
            </div>
          </div>
          <div class="table-responsive pt-3">
            <table id="dataTableExample" class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Day</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th class="text-center" data-orderable="false">Actions</th>
                </tr>
              </thead>
              <tbody>
                 @foreach ($slots as $serial => $slot)
                    <tr>
                      <td>{{ $serial+1 }}</td>
                      <td>{{ $slot->day }}</td>
                      <td>{{ $slot->start }}</td>
                      <td>{{ $slot->end }}</td>
                      <td class="text-center">
                        <a title="Edit"  href="{{ url('slot/edit/'.encrypt($slot->id)) }}">
                          <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="edit"></i>
                          </button>
                        </a>
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
                                  Are you sure you want to delete this slot?
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <a href="{{ url('slot/destroy/'.encrypt($slot->id)) }}" type="button" class="btn btn-primary">Yes</a>
                              </div>
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