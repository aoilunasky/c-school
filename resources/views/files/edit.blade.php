@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('file_edit.file') }}</strong> {{ __('default.edit') }}</div>
                <div class="card-body">
                    <form class="form" action="{{route('files.update',$file->id)}}" method="post" id="file-update-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="subject">{{ __('file_edit.subject') }}:</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="subject_id" required id="subject">
                                    <option selected disabled>{{ __('file_edit.choose_subject') }}</option>
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if ($file->subject_id == $subject->id)
                                        selected
                                    @endif>{{ $subject->name }} -
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
                            <label class="col-sm-2 col-form-label" for="file">{{ __('file_edit.choose_file') }}:</label>
                            <div class="col-sm-6">
                                <label>{{$file->file_name}}</label>
                                <input class="" id="file" type="file" name="dFile"
                                    accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                                @error('dFile')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" form="file-update-form"> {{ __('file_edit.edit') }}</button>
                    <button class="btn btn-sm btn-danger" type="reset" form="file-update-form"> {{ _('file_edit.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
