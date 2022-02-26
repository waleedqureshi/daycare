@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('register/view') }}">Registers</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add</li>
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
  <form method="POST" action="{{ url('register/store') }}" class="forms-sample" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Child Details</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_name">Name<span style="color:red;"> *</span></label>
                  <input required type="text" class="form-control" id="child_name" name="child_name" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_date_of_birth">Date of Birth</label>
                  <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" class="form-control" id="child_date_of_birth" name="child_date_of_birth" autocomplete="off"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_sex">Sex</label>
                  <select class="js-example-basic-single w-100" id="child_sex" name="child_sex">
                    <option selected value="">Select</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="child_address">Address</label>
                  <textarea type="text" class="form-control" id="child_address" name="child_address"></textarea>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_postcode">Postcode</label>
                  <input type="text" class="form-control" id="child_postcode" name="child_postcode" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_homephone">Home Phone</label>
                  <input type="text" class="form-control" id="child_homephone" name="child_homephone" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_school">School Detail</label>
                  <input type="text" class="form-control" id="child_school" name="child_school" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_year">Year</label>
                  <input type="text" class="form-control" id="child_year" name="child_year" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_start_date">Start Date</label>
                  <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" class="form-control" id="child_start_date" name="child_start_date" autocomplete="off"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="child_group">Group</label>
                  <input type="text" class="form-control" id="child_group" name="child_group" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Carer One Details</h6>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_name">Name</label>
                  <input type="text" class="form-control" id="family1_name" name="family1_name" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_relation">Relation</label>
                  <input type="text" class="form-control" id="family1_relation" name="family1_relation" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_occupation">Occupation</label>
                  <input type="text" class="form-control" id="family1_occupation" name="family1_occupation" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_employer">Employer</label>
                  <input type="text" class="form-control" id="family1_employer" name="family1_employer" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_work_phone">Work Phone</label>
                  <input type="text" class="form-control" id="family1_work_phone" name="family1_work_phone" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_mobile_phone">Mobile Phone</label>
                  <input type="text" class="form-control" id="family1_mobile_phone" name="family1_mobile_phone" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_email">Email Address</label>
                  <input type="text" class="form-control" id="family1_email" name="family1_email" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family1_postcode">Postcode</label>
                  <input type="text" class="form-control" id="family1_postcode" name="family1_postcode" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="family1_address">Address</label>
                  <textarea type="text" class="form-control" id="family1_address" name="family1_address"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Carer Two Details</h6>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_name">Name</label>
                  <input type="text" class="form-control" id="family2_name" name="family2_name" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_relation">Relation</label>
                  <input type="text" class="form-control" id="family2_relation" name="family2_relation" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_occupation">Occupation</label>
                  <input type="text" class="form-control" id="family2_occupation" name="family2_occupation" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_employer">Employer</label>
                  <input type="text" class="form-control" id="family2_employer" name="family2_employer" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_work_phone">Work Phone</label>
                  <input type="text" class="form-control" id="family2_work_phone" name="family2_work_phone" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_mobile_phone">Mobile Phone</label>
                  <input type="text" class="form-control" id="family2_mobile_phone" name="family2_mobile_phone" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_email">Email Address</label>
                  <input type="text" class="form-control" id="family2_email" name="family2_email" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="family2_postcode">Postcode</label>
                  <input type="text" class="form-control" id="family2_postcode" name="family2_postcode" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="family2_address">Address</label>
                  <textarea type="text" class="form-control" id="family2_address" name="family2_address"></textarea>
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
            <h6 class="card-title">Provider Details</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provider_name">Name</label>
                  <input type="text" class="form-control" id="provider_name" name="provider_name" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provider_email">Email Address</label>
                  <input type="text" class="form-control" id="provider_email" name="provider_email" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provider_registration_no">Ofsted Registration Number</label>
                  <input type="text" class="form-control" id="provider_registration_no" name="provider_registration_no" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="provider_address">Address</label>
                  <textarea type="text" class="form-control" id="provider_address" name="provider_address"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provider_telephone">Telephone No.</label>
                  <input type="text" class="form-control" id="provider_telephone" name="provider_telephone" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provider_emergency_tel_no">Emergency Tel No.</label>
                  <input type="text" class="form-control" id="provider_emergency_tel_no" name="provider_emergency_tel_no" autocomplete="off">
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
            <h6 class="card-title">Emergency Details</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="emergency_name">Name</label>
                  <input type="text" class="form-control" id="emergency_name" name="emergency_name" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="emergency_contact">Contact</label>
                  <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="emergency_relation">Relation</label>
                  <input type="text" class="form-control" id="emergency_relation" name="emergency_relation" autocomplete="off">
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
            <h6 class="card-title">Other Details</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="other_allergy">Does your child have any known allergies?</label>
                  <select class="js-example-basic-single w-100" id="other_allergy" name="other_allergy">
                    <option selected value="">Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="other_allergy_details">Full Details</label>
                  <textarea type="text" class="form-control" id="other_allergy_details" name="other_allergy_details"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="other_condition">Does your child have any known medical conditions?</label>
                  <select class="js-example-basic-single w-100" id="other_condition" name="other_condition">
                    <option selected value="">Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="other_condition_details">Full Details</label>
                  <textarea type="text" class="form-control" id="other_condition_details" name="other_condition_details"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="other_vaccination">Is your child up to date with their NHS vaccinations?</label>
                  <select class="js-example-basic-single w-100" id="other_vaccination" name="other_vaccination">
                    <option selected value="">Select</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="other_vaccination_details">Full Details</label>
                  <textarea type="text" class="form-control" id="other_vaccination_details" name="other_vaccination_details"></textarea>
                </div>
              </div>
            </div>

            <h6 class="card-title">Child's GP</h6>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="other_name">Name</label>
                  <input type="text" class="form-control" id="other_name" name="other_name" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="other_tel">Telephone</label>
                  <input type="text" class="form-control" id="other_tel" name="other_tel" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="other_address">Address</label>
                  <textarea type="text" class="form-control" id="other_address" name="other_address"></textarea>
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
            <h6 class="card-title">Consent Details</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="date">Date</label>
                  <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" class="form-control" id="date" name="date" autocomplete="off"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="signature">Signature</label>
                  <input type="file" class="form-control" id="signature" name="signature" autocomplete="off" accept="image/*,.pdf">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="registration_no">Registeration No.</label>
                  <input type="text" class="form-control" id="registration_no" name="registration_no" autocomplete="off">
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
@endpush