@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('assignments_detail.assignment_detail') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('assignments_detail.title') }}
                                    :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    {{$assignment->title}}
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{
                                    __('assignments_detail.student_name') }} :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    {{$assignment->student->user->name}}
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{
                                    __('assignments_detail.subject_name') }} :</label>
                                <label class="col-md-10 col-form-label text-left text-capitalize">
                                    {{$assignment->subject->name}}
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('assignments_detail.question')
                                    }} :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    <a href="{{ $assignment->questionFullPath }}" download>
                                        {{$assignment->fileName}} <span class="c-icon cil-cloud-download"></span>
                                    </a>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('assignments_detail.deadline')
                                    }} :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    {{$assignment->deadline}}
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('assignments_detail.status') }}
                                    :</label>
                                <label class="col-md-10 col-form-label text-left text-uppercase">
                                    {{$assignment->status_text}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role == 3 && $assignment->status != 2)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('assignments_detail.assignment_submit') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('student.answer.submit') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="assignment_id" value="{{$assignment->id}}" />
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="question">{{
                                        __('assignments_detail.choose_answer_file') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="file" id="question" required
                                            accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                                        @error('file')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button class="btn btn-primary" type="submit">{{ __('assignments_detail.submit')
                                            }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Auth::user()->role == 2 && $assignment->status == 2)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('assignments_detail.assignment_answer') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal"
                                action="{{ route('answer.feedback',$assignment->answer->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{
                                        __('assignments_detail.submitted_date') }} :</label>
                                    <label class="col-md-6 col-form-label text-left">
                                        {{$assignment->answer->submitted_date}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{
                                        __('assignments_detail.submitted_file') }} :</label>
                                    <label class="col-md-6 col-form-label text-left">
                                        {{$assignment->answer->fileName}}
                                        <a href="{{ $assignment->answer->file_full_path }}"
                                            class="btn btn-sm btn-outline-primary" target="_blank"><span
                                                class="fa fa-cloud-download-alt"></span>
                                        </a>
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="feedback">{{
                                        __('assignments_detail.feedback') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control w-100" id="feedback" name="feedback" rows="5"
                                            placeholder="Enter Deadline" required>{{ old('feedback') }}</textarea>
                                        @error('feedback')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @if (empty($assignment->answer->feedback))
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button class="btn btn-primary" type="submit">{{ __('default.submit')
                                            }}</button>
                                        <button class="btn btn-secondary" type="reset">{{ __('default.reset')
                                            }}</button>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
