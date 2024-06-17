@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('package_create.create_new_package') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('packages.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="title">{{ __('package_create.title') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="title" type="text" name="title"
                                            placeholder="{{ __('package_create.enter_package_title') }}" value="{{ old('title') }}" required>
                                        @error('title')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="total_hour">{{ __('package_create.total_hours') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="total_hour" type="number" name="total_hour"
                                            placeholder="{{ __('package_create.enter_total_hours') }}" required
                                            value="{{ old('total_hour') }}">
                                        @error('total_hour')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="fees">{{ __('package_create.fee') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="fees" type="number" name="fees"
                                            placeholder="{{ __('package_create.enter_fees') }} " value="{{ old('fees') }}" required>
                                        @error('fees')
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
