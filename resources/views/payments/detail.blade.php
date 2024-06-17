@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
            {{ __('payments_detail.reservation_list') }} <b>{{$payment->teacher->user->name}}</b></div>
            <div class="card-body">
              <div class="row">
                <table class="table table-responsive-sm ">
                  @if(count($reservations)>0)
                  <thead>
                    <tr>
                      <td>{{ __('payments_detail.no') }}</td>
                      <td>{{ __('payments_detail.date') }}</td>
                      <td>{{ __('payments_detail.from') }}</td>
                      <td>{{ __('payments_detail.to') }}</td>
                      <td>{{ __('payments_detail.price') }}</td>
                      <td>{{ __('payments_detail.name_of_student') }}</td>
                      <td>{{ __('payments_detail.total_hour') }}</td>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($reservations as $key=>$reservation)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$reservation->date}}</td>
                      <td>{{$reservation->start_time}}</td>
                      <td>{{$reservation->end_time}}</td>
                      @if($reservation->teacher->job_type == 1)
                      <td>{{$reservation->teacher->salary_rate * ((strtotime($reservation->end_time)-strtotime($reservation->start_time))/3600)}}</td>
                      @else
                      <td>25000</td>
                      @endif
                      <td>{{$reservation->student->user->name}}</td>
                      <td>{{(strtotime($reservation->end_time)-strtotime($reservation->start_time))/3600}}</td>
                      <td></td>

                    </tr>
                    @endforeach

                  </tbody>
                  @else
                  <h3>{{ __('payments_detail.no_reservation_list') }}</h3>
                  @endif
                </table>

              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>
@endsection
