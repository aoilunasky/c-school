@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('subjects_edit.edit') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('subjects.update', $subject->id) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="subject_name">{{ __('subjects_edit.title') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="subject_name" type="text" name="name"
                                            placeholder="{{ __('subjects_create.enter_subject_name') }}" value="{{ (old('name'))? old('name'): $subject->name }}" required>
                                        @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="level_id">{{ __('subjects_edit.grade') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        @php
                                            $old_id = (old('level_id'))? old('level_id') : $subject->level_id;
                                        @endphp
                                        <select class="form-control" name="level_id" id="level_id" required>
                                            <option disabled selected >{{ __('subjects_edit.choose_grade') }}</option>
                                            @foreach ($levels as $level)
                                            <option value="{{ $level->id }}"
                                            @if ($old_id == $level->id )
                                                selected
                                            @endif
                                            >{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('level_id')
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
