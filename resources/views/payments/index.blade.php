@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i> {{ __('payments_index.payment_list') }}
                </div>
                <div class="card-body">
                <form method="post" action="{{route('payments.searchPayments')}}">
                  @csrf
                  <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">Month</label>
                      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="month">
                      @for($i=1;$i< 13;$i++)
                        <option value="{{$i}}" {{ $i == $month ? 'selected' : '' }}>{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                      @endfor
                      </select>
                    </div>
                    <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">Year</label>
                      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="year">
                      @for($i=3;$i>-1;$i--)
                        <option value="{{date('Y')-$i}}" {{ date("Y")-$i == $year ? 'selected' : '' }}>{{date("Y")-$i}}</option>
                      @endfor
                      </select>
                    </div>

                    <div style="align-self: end;margin: 0.3em;">
                      <button type="submit" class="btn btn-primary" >Search</button>
                    </div>
                  </div>
                </form>
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                        <tr>
                        <td>{{ __('payments_index.no') }}</td>
                        <td>{{ __('payments_index.name') }}</td>
                        <td>{{ __('payments_index.type') }}</td>
                        <td>{{ __('payments_index.salary_rate') }}</td>
                        <td>{{ __('payments_index.date') }}</td>
                        <td>{{ __('payments_index.total_hour') }}</td>
                        <td>{{ __('payments_index.total_amount') }}</td>
                        <td>{{ __('default.action') }}</td>
                      </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key=>$payment)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$payment->teacher->user->name}}</td>
                        <td>{{Config::get('constants.job_type.'.$payment->teacher->job_type)}}</td>
                        @if($payment->teacher->job_type == 1)
                        <td>{{$payment->teacher->salary_rate}} Yen / hr</td>
                        @else
                        <td>{{$payment->teacher->salary_rate}} Yen / month</td>
                        @endif
                        <td>{{$payment->date}}</td>
                        <td>{{$payment->total_hour}}</td>
                        <td>{{$payment->amount}} Yen
                        </td>
                        <td>
                        <!-- <a class="btn btn-success" href="{{route('payments.show',$payment->id)}}">{{ __('payments_index.detail') }}</a>                         -->
                        <a class="btn btn-success" href="{{route('payments.generatePDF',$payment->id)}}">{{ __('payments_index.pdf') }}</a>

                        </td>
                      </tr>
                      @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $payments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

