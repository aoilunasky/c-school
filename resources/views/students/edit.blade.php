@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('student_edit.edit_student') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('students.update', $student->id) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="first_name">{{ __('student_edit.first_name') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="first_name" type="text" name="f_name"
                                            placeholder="{{ __('student_edit.enter_firstname') }}" value="{{ (old('f_name'))? old('f_name') : $student->user->f_name }}" required>
                                        @error('f_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="last_name">{{ __('student_edit.last_name') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="last_name" type="text" name="l_name"
                                            placeholder="{{ __('student_edit.enter_lastname') }}" value="{{ (old('l_name'))? old('l_name') : $student->user->l_name }}">
                                        @error('l_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="phone">{{ __('student_edit.phone_number') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="phone" type="text" name="phone"
                                            placeholder="{{ __('student_edit.enter_phone_number') }}" maxlength="15" required
                                            value="{{ (old('phone'))? old('phone') : $student->user->phone }}">
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="email">{{ __('student_edit.email') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="email" type="email" name="email"
                                            placeholder="{{ __('student_edit.enter_email') }}" value="{{ (old('email'))? old('email') : $student->user->email }}" required>
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('student_edit.gender') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio1" type="radio" value="male"
                                                name="gender" {{ ((old('gender')=='male')|| ($student->gender == 'male')) ? 'checked' : ''}} >
                                            <label class="form-check-label" for="inline-radio1">{{ __('student_edit.male') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio2" type="radio"
                                                value="female" name="gender" {{ ((old('gender')=='female')|| ($student->gender == 'female')) ? 'checked' : ''}} >
                                            <label class="form-check-label" for="inline-radio2">{{ __('student_edit.female') }}</label>
                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="age">{{ __('student_edit.age') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="age" type="number" name="age"
                                            placeholder="{{ __('student_edit.enter_age') }}" max="70" min="15" value="{{ (old('age'))? old('age') : $student->age }}" required>
                                        @error('age')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('student_edit.lesson_type') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio3" type="radio" value="1"
                                                name="lesson_type" {{ ((old('lesson_type')=='1')|| ($student->lesson_type == '1')) ? 'checked' : ''}} >
                                            <label class="form-check-label" for="inline-radio3">{{ __('student_edit.online') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="inline-radio4" type="radio" value="2"
                                                name="lesson_type" {{ ((old('lesson_type')=='2')|| ($student->lesson_type == '2')) ? 'checked' : ''}} >
                                            <label class="form-check-label" for="inline-radio4">{{ __('student_edit.school') }}</label>
                                        </div>
                                        @error('lesson_type')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="purpose">{{ __('student_edit.purpose') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="purpose" name="purpose"
                                            placeholder="{{ __('student_edit.enter_purpose') }}" rows="5">{{ (old('purpose'))? old('purpose'): $student->purpose }}</textarea>
                                        @error('purpose')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button class="btn btn-primary" type="submit">{{ __('default.update') }}</button>
                                        <a class="btn btn-secondary" href="{{ route('students.list') }}">{{ __('student_edit.back') }}</a>
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
