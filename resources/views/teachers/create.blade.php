
@extends('layouts.app')
@section('css')
<link href="{{ asset('template/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('teacher_create.create_new_teacher') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('teachers.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="first_name">{{ __('teacher_create.first_name') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="first_name" type="text" name="f_name"
                                            placeholder="Enter First Name" value="{{ old('f_name') }}" required>
                                        @error('f_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="last_name">{{ __('teacher_create.last_name') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="last_name" type="text" name="l_name"
                                            placeholder="Enter Last Name" value="{{ old('l_name') }}" required>
                                        @error('l_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('teacher_create.gender') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio1" type="radio" value="male"
                                                name="gender" checked>
                                            <label class="form-check-label" for="inline-radio1">{{ __('teacher_create.male') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio2" type="radio"
                                                value="female" name="gender">
                                            <label class="form-check-label" for="inline-radio2">{{ __('teacher_create.female') }}</label>
                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="dob">{{ __('teacher_create.date_of_birth') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="dob" type="date" name="dob"
                                            value="{{ old('dob') }}" required>
                                        @error('dob')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('teacher_create.job_type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio3" type="radio" value="1"
                                                name="job_type" checked>
                                            <label class="form-check-label" for="inline-radio3">{{ __('teacher_create.part_time') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio4" type="radio" value="2"
                                                name="job_type">
                                            <label class="form-check-label" for="inline-radio4">{{ __('teacher_create.full_time') }}</label>
                                        </div>
                                        @error('job_type')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('teacher_create.subject') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="subject_type[]" multiple required>
                                            @foreach ($subjects as $subject)
                                            <option value="{{$subject->id}}">
                                                {{$subject->name}} ({{$subject->level->name}})</option>
                                            @endforeach
                                        </select>
                                        @error('subject_type')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="phone">{{ __('teacher_create.phone_number') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="phone" type="text" name="phone"
                                            placeholder="Enter Phone Number" maxlength="15" required
                                            value="{{ old('phone') }}" required>
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="email">{{ __('teacher_create.email') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="email" type="email" name="email"
                                            placeholder="Enter Email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="password">{{ __('teacher_create.password') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group" id="show_hide_password">
                                            <input class="form-control" id="password" type="password" name="password"
                                                placeholder="Enter Password" value="{{ old('password') }}" required>
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
                                    <label class="col-md-3 col-form-label text-right" for="address">{{ __('teacher_create.address') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="address" name="address"
                                            placeholder="Enter your address" rows="5" value="{{ old('address') }}"
                                            required></textarea>
                                        @error('address')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="strong_points">{{ __('teacher_create.strong_point') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="strong_points" type="strong_points"
                                            name="strong_points" placeholder="Ex.)Can Teach English especially kids"
                                            value="{{ old('strong_points') }}">
                                        @error('strong_points')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="education">{{ __('teacher_create.education') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="education" type="education" name="education"
                                            placeholder="Enter your education" value="{{ old('education') }}" required>
                                        @error('education')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="profile_image">{{ __('teacher_create.profile_image') }}</label>
                                    <div class="col-md-6">
                                        <input id="profile_image" type="file" name="profile_image" accept="image/*">
                                        <div id="preview-image"></div>
                                        @error('profile_image')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right"
                                        for="certificates">{{ __('teacher_create.certifications') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="certificates" name="certificates"
                                            placeholder="Enter your certificates" rows="5"
                                            value="{{ old('certificates') }}"></textarea>
                                        @error('certificates')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="job_history">{{ __('teacher_create.job_history') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="job_history" name="job_history"
                                            placeholder="Enter your job history" rows="5"
                                            value="{{ old('job_history') }}"></textarea>
                                        @error('job_history')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="country">{{ __('teacher_create.country') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="country" id="country" required>
                                            <option value="">{{ __('teacher_create.select_country') }}</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name ?? ''}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right"
                                        for="responsibility">{{ __('teacher_create.responsibility') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="responsibility" name="responsibility"
                                            placeholder="Enter your Responsibility" rows="5"
                                            value="{{ old('responsibility') }}"></textarea>
                                        @error('responsibility')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="salary_rate">{{ __('teacher_create.salary_rate') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="salary_rate" type="salary_rate"
                                            name="salary_rate" placeholder="Enter salary rate with number eg.100000"
                                            value="{{ old('salary_rate')}}">
                                        @error('salary_rate')
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
<script src="{{ asset('template/select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
    const MAX_WIDTH = 320;
    const MAX_HEIGHT = 180;
    const MIME_TYPE = "image/jpeg";
    const QUALITY = 0.7;
    const input = document.getElementById("profile_image");
    input.onchange = function (ev) {
        const file = ev.target.files[0]; // get the file
        const blobURL = URL.createObjectURL(file);
        const img = new Image();
        img.src = blobURL;
        img.onerror = function () {
            URL.revokeObjectURL(this.src);
        };
        img.onload = function () {
            URL.revokeObjectURL(this.src);
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.arc(95, 50, 40, 0, 2 * Math.PI);
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            $('#preview-image').empty();
            document.getElementById("preview-image").append(canvas);
        };
    };

        function calculateSize(img, maxWidth, maxHeight) {
            let width = img.width;
            let height = img.height;

            // calculate the width and height, constraining the proportions
            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round((height * maxWidth) / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round((width * maxHeight) / height);
                    height = maxHeight;
                }
            }
            return [width, height];
        }
    $(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select your teaching subjects"
    });

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
