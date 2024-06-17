@extends('layouts.auth_app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <div class="card-body">
                <h1 class="text-center">{{ __('login.c_school') }}</h1>
                <p class="text-muted text-center">{{ __('login.sign_in_account') }}</p>
                @if(session()->has('error'))
                <p class="text-center text-danger">{{session()->get('error')}}</p>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row ">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('login.email') }}</label>
                        <div class="col-md-6 input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                                        </use>
                                    </svg>
                                </span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('login.password') }}</label>
                        <div class="col-md-6 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use
                                            xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}">
                                        </use>
                                    </svg>
                                </span>
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    checked>

                                <label class="form-check-label" for="remember">
                                    {{ __('login.remember_me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ __('login.login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                {{ __('login.forgot_password') }}
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-center row mb-0">
                        <div class="col-md-12">
                            Don't Have Account ?
                            <a href="{{ route('register') }}" class="btn btn-link">
                              Click Here To Register
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
