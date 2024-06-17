@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('assignments_create.assignment_create') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('assignment.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="student_id" value="{{$lessonRv->student_id}}" />
                                <input type="hidden" name="teacher_id" value="{{$lessonRv->teacher_id}}" />
                                <input type="hidden" name="subject_id" value="{{$lessonRv->subject_id}}" />

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="title">{{ __('assignments_create.title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="title" type="text" name="title"
                                            placeholder="Enter Assignment Title" value="{{ old('title') }}" required>
                                        @error('title')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="deadline">{{ __('assignments_create.deadline') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="deadline" type="date" name="deadline"
                                            placeholder="Enter Deadline" required value="{{ old('deadline') }}">
                                        @error('deadline')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="question">{{ __('assignments_create.choose_question') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="question" id="question" required  accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                                            <div class="input-group-append">
                                                <span class="input-group-text" data-toggle="tooltip"
                                                    data-placement="right" title="" data-original-title="PDF/DOC Files Only">
                                                    <svg class="c-icon">
                                                        <use
                                                            xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-info') }}">
                                                        </use>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        @error('question')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button class="btn btn-primary" type="submit">{{ __('default.submit')
                                            }}</button>
                                        <button class="btn btn-secondary" type="reset">{{ __('default.reset')
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
</div>
@endsection

@section('js')
<script src="{{ asset('template/js/tooltips.js')}}" type="text/javascript"></script>

@endsection
