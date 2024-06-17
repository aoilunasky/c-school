@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('buy.package_detail') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">{{
                                    __('package_create.title') }}</label>
                                <label class="col-md-9 col-form-label">{{ $package->title }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">{{
                                    __('package_create.total_hours') }}</label>
                                <label class="col-md-9 col-form-label">{{ $package->total_hours }} Hr</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">{{
                                    __('package_create.fee')
                                    }}</label>
                                <label class="col-md-9 col-form-label">{{ $package->fees }} $</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">{{ __('buy.ticket_amount') }}</label>
                                <label class="col-md-9 col-form-label">{{ $package->ticket_amount }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('buy.payment') }}</div>
                <div class="card-body">
                    <form action="{{ route('student.package.makePurchase') }}" method="post">
                        @csrf
                        <input type="hidden" name="packageid" value="{{$package->id}}">
                        <div class="col-md-12 text-center">
                            <label class="form-check-label" for="type1">
                                <div class="card" style="width: 18rem;margin-bottom: 10px;">
                                    <img src="{{ asset('images/rakuten-logo.png') }}" width="100%" height="100%"
                                        class="Rakuten" alt="..." style="padding: 5px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Card Owner C-meister co.ltd</h5>
                                        <p class="card-text">Account Number 7227624</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label">{{ __('buy.customer_card') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="owner" value=""
                                    placeholder="Enter Card Owner Name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="control-label">{{ __('buy.customer_account') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="cardnumber" value=""
                                    placeholder="Enter Account Number">
                            </div>
                        </div>
                        <div class="row form-group" style="justify-content: center;">
                            <input type="submit" class="btn btn-primary" value="Buy Packege">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
