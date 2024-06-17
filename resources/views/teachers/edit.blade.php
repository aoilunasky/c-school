@extends('layouts.app')

@section('css')
<link href="{{ asset('template/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('teacher_edit.edit_teacher_information') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('teachers.update', $teacher->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="first_name">{{ __('teacher_edit.first_name') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="first_name" type="text" name="f_name"
                                            placeholder="Enter First Name"
                                            value="{{ (old('f_name'))? old('f_name') : $teacher->user->f_name }}"
                                            required>
                                        @error('f_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="last_name">{{ __('teacher_edit.last_name') }}
                                         <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="last_name" type="text" name="l_name"
                                            placeholder="Enter Last Name"
                                            value="{{ (old('l_name'))? old('l_name') : $teacher->user->l_name }}"
                                            required>
                                        @error('l_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('teacher_edit.gender') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio1" type="radio" value="male"
                                                name="gender"
                                                {{ ((old('gender')=='male')|| ($teacher->gender == 'male')) ? 'checked' : ''}}>
                                            <label class="form-check-label" for="inline-radio1">{{ __('teacher_edit.male') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio2" type="radio"
                                                value="female" name="gender"
                                                {{ ((old('gender')=='female')|| ($teacher->gender == 'female')) ? 'checked' : ''}}>
                                            <label class="form-check-label" for="inline-radio2">{{ __('teacher_edit.female') }}</label>
                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="dob">{{ __('teacher_edit.date_of_birth') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="dob" type="date" name="dob"
                                            value="{{ (old('dob'))? old('dob') : $teacher->dob }}" required>
                                        @error('dob')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('teacher_edit.job_type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio3" type="radio" value="1"
                                                name="job_type"
                                                {{ ((old('job_type')== 1)|| ($teacher->job_type == 1)) ? 'checked' : ''}}>
                                            <label class="form-check-label" for="inline-radio3">{{ __('teacher_edit.part_time') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio4" type="radio" value="2"
                                                name="job_type"
                                                {{ ((old('job_type')== 2)|| ($teacher->job_type == 2)) ? 'checked' : ''}}>
                                            <label class="form-check-label" for="inline-radio4">{{ __('teacher_edit.full_time') }}</label>
                                        </div>
                                        @error('job_type')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('teacher_edit.subject') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="subject_type[]" multiple required>
                                            @foreach ($subjects as $subject)
                                            <option value="{{$subject->id}}"
                                            @if (in_array($subject->id,$teachsubjects))
                                                selected
                                                @endif
                                                >
                                                {{$subject->name}}({{$subject->level->name}})</option>
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
                                    <label class="col-md-3 col-form-label text-right" for="phone">{{ __('teacher_edit.phone_number') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="phone" type="text" name="phone"
                                            placeholder="Enter Phone Number" maxlength="15" required
                                            value="{{ (old('phone'))? old('phone') : $teacher->user->phone }}" required>
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="email">{{ __('teacher_edit.email') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="email" type="email" name="email"
                                            placeholder="Enter Email"
                                            value="{{ (old('email'))? old('email') : $teacher->user->email }}" required>
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="address">{{ __('teacher_edit.address') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="address" name="address"
                                            placeholder="Enter your address" rows="5"
                                            value="{{ (old('address'))? old('address') : $teacher->address }}"
                                            required>{{ (old('address'))? old('address') : $teacher->address }}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="strong_points">{{ __('teacher_edit.strong_point') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="strong_points" type="strong_points"
                                            name="strong_points" placeholder="Ex.Can Teach English especially kids"
                                            value="{{ (old('strong_points'))? old('strong_points') : $teacher->strong_points }}">
                                        @error('strong_points')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="education">{{ __('teacher_edit.education') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="education" type="education" name="education"
                                            placeholder="Enter your education"
                                            value="{{ (old('education'))? old('education') : $teacher->education }}"
                                            required>
                                        @error('education')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="profile_image">{{ __('teacher_edit.profile_image') }}</label>
                                    <div class="col-md-6">
                                        <input id="profile_image" type="file" name="profile_image"
                                            value="{{ (old('profile_image'))? old('profile_image') : $teacher->profile_image }}"><br />
                                        <img id="preview-image" />
                                        @error('profile_image')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right"
                                        for="certificates">{{ __('teacher_edit.certification') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="certificates" name="certificates"
                                            placeholder="Enter your certificates" rows="5"
                                            value="{{ (old('certificates'))? old('certificates') : $teacher->certificates }}">{{ (old('certificates'))? old('certificates') : $teacher->certificates }}</textarea>
                                        @error('certificates')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="job_history">{{ __('teacher_edit.job_history') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="job_history" name="job_history"
                                            placeholder="Enter your job history" rows="5"
                                            value="{{ (old('job_history'))? old('job_history') : $teacher->job_history }}">{{ (old('job_history'))? old('job_history') : $teacher->job_history }}</textarea>
                                        @error('job_history')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="country">{{ __('teacher_edit.country') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="country" id="country" required>
                                            <option value="">{{ __('teacher_edit.select_your_country') }}</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}"
                                                {{ ((old('country_id')== $country->id)|| ($teacher->country_id == $country->id)) ? 'selected' : ''}}>
                                                {{$country->name ?? ''}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right"
                                        for="responsibility">{{ __('teacher_edit.responsibility') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="responsibility" name="responsibility"
                                            placeholder="Enter your Responsibility" rows="5"
                                            value="{{ (old('responsibility'))? old('responsibility') : $teacher->responsibility }}">{{ (old('responsibility'))? old('responsibility') : $teacher->responsibility }}</textarea>
                                        @error('responsibility')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="salary_rate">{{ __('teacher_edit.salary_rate') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="salary_rate" type="salary_rate"
                                            name="salary_rate" placeholder="Enter salary rate with number eg.100000"
                                            value="{{ (old('salary_rate'))? old('salary_rate') : $teacher->salary_rate }}">
                                        @error('salary_rate')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="skype_link">{{ __('teacher_edit.skype_id') }} </label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="skype_link" type="skype_link" name="skype_link"
                                            placeholder="Enter teacher's skype link"
                                            value="{{ (old('skype_link'))? old('skype_link') : $teacher->skype_link }}">
                                        @error('skype_link')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="zoom_link">{{ __('teacher_edit.zoom_id') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="zoom_link" type="zoom_link" name="zoom_link"
                                            placeholder="Enter teacher's zoom link"
                                            value="{{ (old('zoom_link'))? old('zoom_link') : $teacher->zoom_link }}">
                                        @error('zoom_link')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="nrc">{{ __('teacher_edit.id_card_number') }} </label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="nrc" type="nrc" name="nrc"
                                            placeholder="Enter teacher's ID card number"
                                            value="{{ (old('nrc'))? old('nrc') : $teacher->nrc }}">
                                        @error('nrc')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="passport">{{ __('teacher_edit.passport') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="passport" type="passport" name="passport"
                                            placeholder="Enter teacher's passport"
                                            value="{{ (old('passport'))? old('passport') : $teacher->passport }}">
                                        @error('passport')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button class="btn btn-primary" type="submit">{{ __('default.update') }}</button>
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
    $(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select your teaching subjects"
    });
    $('#profile_image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image').attr('width', '100px');
            $('#preview-image').attr('height', '100px');
            $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
@endsection
