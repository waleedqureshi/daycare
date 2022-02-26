@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 pr-md-0">
                            <div class="auth-left-wrapper" style="background-image: url('{{ asset('assets/images/login_full.png') }}');" >
                            </div>
                         </div>
                        <div class="col-md-6 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a target="_blank" href="https://paradisedaycare.co.uk/" class="text-center noble-ui-logo d-block mb-2">
                                    <img src="{{ asset('assets/images/full_logo.png') }}" style="width:230px;">
                                </a><br>
                                <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email Address</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            Remember me
                                        </label>
                                    </div> -->
                                    <div class="mt-3 text-center">
                                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0" style="color:white; background-color: #951b81; ">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
