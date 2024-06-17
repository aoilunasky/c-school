@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('package_edit.package_detail') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('packages.update', $package->id) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="title">{{ __('package_edit.title') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="title" type="text" name="title"
                                            placeholder="{{ __('package_edit.enter_package_title') }}" value="{{ (old('title'))? old('title'): $package->title }}" required>
                                        @error('title')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="total_hour">{{ __('package_edit.total_hours') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="total_hour" type="text" name="total_hour"
                                            placeholder="Enter Total Hour" required
                                            value="{{ (old('total_hour'))? old('total_hour') : $package->total_hours }}">
                                        @error('total_hour')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="fees">{{ __('package_edit.fee') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="fees" type="number" name="fees"
                                            placeholder="{{ __('package_edit.enter_fees') }} " value="{{ (old('fees'))? old('fees') : $package->fees }}" required>
                                        @error('fees')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="ticket_amt">{{ __('package_edit.ticket_amount') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="ticket_amt" type="text" disabled
                                            value="{{ $package->ticket_amount }}">
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
