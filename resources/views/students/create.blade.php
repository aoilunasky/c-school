@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('student_create.create_new_student') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('students.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="first_name">{{ __('student_create.first_name') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="first_name" type="text" name="f_name"
                                            placeholder="{{ __('student_create.enter_firstname') }}" value="{{ old('f_name') }}" required>
                                        @error('f_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="last_name">{{ __('student_create.last_name') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="last_name" type="text" name="l_name"
                                            placeholder="{{ __('student_create.enter_lastname') }}" value="{{ old('l_name') }}">
                                        @error('l_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="phone">{{ __('student_create.phone_number') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="phone" type="text" name="phone"
                                            placeholder="{{ __('student_create.enter_phone_number') }}" maxlength="15" required
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="email">{{ __('student_create.email') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="email" type="email" name="email"
                                            placeholder="{{ __('student_create.enter_email') }}" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="password">{{ __('student_create.password') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group" id="show_hide_password">
                                            <input class="form-control" id="password"
                                                type="password" name="password" placeholder="{{ __('student_create.enter_password') }}"
                                                value="{{ old('password') }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('student_create.gender') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio1" type="radio" value="male"
                                                name="gender" checked>
                                            <label class="form-check-label" for="inline-radio1">{{ __('student_create.male') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio2" type="radio"
                                                value="female" name="gender">
                                            <label class="form-check-label" for="inline-radio2">{{ __('student_create.female') }}</label>
                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="age">{{ __('student_create.age') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="age" type="number" name="age"
                                            placeholder="{{ __('student_create.enter_age') }}" max="70" min="15" value="{{ old('age') }}" required>
                                        @error('age')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('student_create.lesson_type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio3" type="radio" value="1"
                                                name="lesson_type" checked>
                                            <label class="form-check-label" for="inline-radio3">{{ __('student_create.online') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio4" type="radio" value="2"
                                                name="lesson_type">
                                            <label class="form-check-label" for="inline-radio4">{{ __('student_create.school') }}</label>
                                        </div>
                                        @error('lesson_type')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="purpose">{{ __('student_create.purpose') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="purpose" name="purpose"
                                            placeholder="{{ __('student_create.enter_purpose') }}" rows="5"
                                            value="{{ old('purpose') }}"></textarea>
                                        @error('purpose')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button class="btn btn-primary" type="submit">{{ __('default.submit') }}</button>
                                        <button class="btn btn-secondary" type="reset">{{ __('default.reset') }}</button>
                                    </div>
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

@section('js')
<script>
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>
@endsection
