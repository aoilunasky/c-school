@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('file_create.file') }}</strong>{{ __('default.create') }} </div>
                <div class="card-body">
                    <form class="form" action="{{route('files.store')}}" method="post" id="file-create-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="subject">{{ __('file_create.subject') }}:</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="subject_id" required id="subject">
                                    <option selected disabled>{{ __('file_create.choose_subject') }}</option>
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }} -
                                        {{ $subject->level->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file">{{ __('file_create.choose_file') }}:</label>
                            <div class="col-sm-6">
                                <input class="" id="file" type="file" name="file"
                                    accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                    required>
                                @error('file')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" form="file-create-form"> {{ __('default.create') }}</button>
                    <button class="btn btn-sm btn-danger" type="reset" form="file-create-form"> {{ __('default.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
