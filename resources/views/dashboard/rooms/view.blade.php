@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('room/view') }}">Rooms</a></li>
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
              <h6 class="card-title">Rooms List</h6>
            </div>
            @can('Add Room')
              <div class="col-md-6">
                <a href="{{ url('room/add') }}" type="button" class="btn btn-primary" style="float:right;">Add Room</a>
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
                    Capacity
                  </th>
                  <th class="text-center">
                    Assigned Teachers
                  </th>
                  <th class="text-center" data-orderable="false">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($rooms as $serial => $room)
                <tr>
                  <td>{{ $serial + 1 }}</td>
                  <td>{{ $room->name }}</td>
                  <td>{{ $room->capacity }}</td>
                  <td class="text-center">
                    <!-- Button trigger modal -->
                    <a title="View" data-toggle="modal" data-target="#teachersModal{{$serial}}">
                      <button type="button" class="btn btn-primary btn-icon">
                        <i data-feather="eye"></i>
                      </button>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade text-left" id="teachersModal{{$serial}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Teacher for {{ $room->name }}:</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @foreach($room->teachers as $teacher)
                              {{ $teacher->name }}<br>
                            @endforeach
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="text-center">
                      @can('Assign Teacher')
                        <a title="Assign Teachers" data-toggle="modal" data-target="#assignModal{{$serial}}">
                          <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="user"></i>
                          </button>
                        </a>
                        <div class="modal fade text-left" id="assignModal{{$serial}}" style="overflow:hidden;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <form method="POST" action="{{ url('room/assign_teacher/'.encrypt($room->id)) }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Assign teachers to this room</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                      <label for="teachers">Select Teachers for this Room<span style="color:red;"> *</span></label><br>
                                      <select required class="js-example-basic-single w-100" name="teachers[]" multiple="multiple">
                                        @foreach($teachers as $teacher)
                                        <?php
                                         $array = $room->teachers->pluck('id')->toArray();
                                         $teacher_id = $teacher->id;
                                        ?>
                                        <option value="{{$teacher->id}}" @if(in_array($teacher_id, $array)) selected @endif >{{ $teacher->name }}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Yes</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      @endcan
                      @can('Edit Room')
                        <a title="Edit" href="{{ url('room/edit/'.encrypt($room->id)) }}">
                          <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="edit"></i>
                          </button>
                        </a>
                      @endcan                  
                      
                      @can('Delete Room')
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
                                Are you sure you want to delete this teacher?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{{ url('room/destroy/'.encrypt($room->id)) }}" type="button" class="btn btn-primary">Yes</a>
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
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script>
    $('select').select2({
      dropdownParent: $('#my_amazing_modal')
    });
  </script>
@endpush