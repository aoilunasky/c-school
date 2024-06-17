@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('setting.one_time') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('settings.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right" for="theme">Theme <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="theme" id="theme" required>
                                            <option  selected value="1">Theme 1</option>
                                            <option value="2">Theme 2</option>
                                            <option value="3">Theme 3</option>
                                        </select>
                                        @error('theme')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right" for="min_per_ticket">{{ __('setting.minute') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="min_per_ticket" type="number" name="min_per_ticket"
                                            placeholder="Minutes Per Ticket" value="{{ $configs['ticket_minutes'] }}" required>
                                        @error('min_per_ticket')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right" for="allowed_hour">{{ __('setting.cancellation') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="allowed_hour" type="number" name="allowed_hour"
                                            placeholder="Cancellation Allowed Hour" value="{{ $configs['cancellation_allowed_hour'] }}" required>
                                        @error('allowed_hour')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right" for="noti_minutes_before_lesson_start">{{ __('setting.notification_before_lesson') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="noti_minutes_before_lesson_start" type="number" name="noti_minutes_before_lesson_start"
                                            placeholder="Notification Minutes Before Lesson Start" value="{{ $configs['noti_minutes_before_lesson_start'] }}" required>
                                        @error('noti_minutes_before_lesson_start')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right" for="noti_minutes_before_assignment_deadline">{{ __('setting.notification_before_assignment') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="noti_minutes_before_assignment_deadline" type="number" name="noti_minutes_before_assignment_deadline"
                                            placeholder="Notification Minutes Before Assignment Due" value="{{ $configs['noti_minutes_before_assignment_deadline'] }}" required>
                                        @error('noti_minutes_before_assignment_deadline')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
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
