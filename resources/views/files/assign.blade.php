@extends('layouts.app')

@section('css')
<link href="{{ asset('template/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('file_assign.file') }}</strong> {{ __('file_assign.assign') }} </div>
                <div class="card-body">
                    <form class="form" action="{{route('files.assign.store',$file->id)}}" method="post" id="file-assign-form">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('file_assign.file_name') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ $file->file_name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ __('file_assign.subject') }}:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ $file->subject->name }} - {{ $file->subject->level->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="teacher">{{ __('file_assign.teacher') }}:</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" name="teacher_id[]" required id="teacher" multiple>
                                    @foreach ($file->subject->teachers as $teacher)
                                    <option value="{{ $teacher->user->id }}" @if ($assignedUsers->contains('id',$teacher->user->id)) selected @endif>{{ $teacher->user->name }}</>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" form="file-assign-form"> {{ __('file_assign.assign') }}</button>
                    <button class="btn btn-sm btn-danger" type="reset" form="file-assign-form">{{ __('default.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('template/select2/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select teacher to assign",
        data: {id:9,id:7}
    });
});
</script>
@endsection
