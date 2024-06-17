@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ __('payments_index.edit') }} for <b>{{$payment->teacher->user->name}}</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal" action="{{ route('payments.update', $payment) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="amount">{{ __('payments_index.amount') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input class="form-control" id="amount" type="text" name="amount"
                                            placeholder="{{ __('payments_index.enter_update_amount') }}" value="{{ (old('amount'))? old('amount'): $payment->amount }}" required>
                                        @error('amount')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right" for="note">{{ __('payments_index.note') }} <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                    <input class="form-control" id="note" type="text" name="note"
                                            placeholder="{{ __('payments_index.enter_note') }}" value="{{ (old('note'))? old('note'): $payment->note }}" required>
                                        @error('amount')
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
</div><div class="container-fluid">
 
</div>
@endsection
