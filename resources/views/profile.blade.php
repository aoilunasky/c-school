@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('profile.account_profile') }}</div>
                <div class="card-body">
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.name') }}:</div>
                        <div class="col-md-8">{{Auth::user()->name}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.email') }}:</div>
                        <div class="col-md-8">{{Auth::user()->email}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.phone_number') }}:</div>
                        <div class="col-md-8">{{Auth::user()->phone}}</div>
                    </div>
                    @if (Auth::user()->role==3)
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.gender') }}:</div>
                        <div class="col-md-8">{{Auth::user()->student->gender}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.age') }}:</div>
                        <div class="col-md-8">{{Auth::user()->student->age}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.lesson_type') }}:</div>
                        <div class="col-md-8">{{Auth::user()->student->lesson_type_name}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.purpose') }}:</div>
                        <div class="col-md-8">{{Auth::user()->student->purpose}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-md-3 text-md-right">{{ __('profile.ticket_amount') }}:</div>
                        <div class="col-md-8">{{Auth::user()->student->ticket_amt}} {{ __('profile.ticket') }}</div>
                    </div>
                    <div class="form-group text-center col-md-12">
                        <a class="btn btn-primary btn-pill" href="{{ route('student.packages.list') }}">{{ __('profile.buy_package') }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection