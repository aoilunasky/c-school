@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('level_edit.edit_level') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('levels.update', $level->id) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="name">{{ __('level_edit.level_name') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="name" type="text" name="name"
                                            placeholder=" {{ __('level_edit.enter_level_name') }}" value="{{ (old('name'))? old('name') : $level->name }}" required>
                                        @error('name')
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
