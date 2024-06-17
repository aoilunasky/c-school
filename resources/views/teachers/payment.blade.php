@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="nav-tabs-boxed">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link" href="{{ route('teachers.show', $teacher->id) }}">{{ __('teacher_payment.profile ') }}</a>
          </li>
          <li class="nav-item"><a class="nav-link active"
              href="{{ route('teachers.payment', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_payment.payment') }}</a></li>
          <!-- <li class="nav-item"><a class="nav-link"
              href="{{ route('teachers.student', [ 'id'=> $teacher->id ]) }}">Students</a></li> -->
          <li class="nav-item"><a class="nav-link" href="{{ route('teachers.files', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_payment.files') }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
              <div class="card-header">
                {{ __('teacher_payment.payment_list') }} <b>{{$teacher->user->name}}</b>
              </div>
              <div class="card-body">
              <form method="get" action="{{route('teachers.paymentSearch')}}">
                @csrf
                  <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">{{ __('payments_index.month') }}</label>
                      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="month">
                      @for($i=1;$i< 13;$i++)
                        <option value="{{$i}}" {{ $i == $month ? 'selected' : '' }}>{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                      @endfor
                      </select>
                    </div>
                    <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">{{ __('payments_index.year') }}</label>
                      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="year">
                      @for($i=3;$i>-1;$i--)
                        <option value="{{date('Y')-$i}}" {{ date("Y")-$i == $year ? 'selected' : '' }}>{{date("Y")-$i}}</option>
                      @endfor
                      </select>
                    </div>
                    <input type="hidden" name="teacherid" value="{{$teacher->id}}">

                    <div style="align-self: end;margin: 0.3em;">
                      <button type="submit" class="btn btn-primary" >{{ __('payments_index.search') }}</button>
                    </div>
                  </div>
                </form>

                <div class="row">
                  <table class="table table-responsive-sm ">
                    @if(count($payments) > 0)
                    <thead>
                      <tr>
                        <td>{{ __('teacher_payment.no') }}</td>
                        <td>{{ __('teacher_payment.type') }}</td>
                        <td>{{ __('teacher_payment.salary_rate') }}</td>
                        <td>{{ __('teacher_payment.date') }}</td>
                        <td>{{ __('teacher_payment.total_hour') }}</td>
                        <td>{{ __('teacher_payment.total_amount') }}</td>
                        <td>{{ __('teacher_payment.action') }}</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($payments as $key=>$payment)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{Config::get('constants.job_type.'.$teacher->job_type)}}</td>
                        @if($teacher->job_type == 1)
                        <td>{{$teacher->salary_rate}} USD / hr</td>
                        @else
                        <td>{{$teacher->salary_rate}}</td>
                        @endif
                        <td>{{$payment->date}}</td>
                        <td>{{$payment->total_hour}}</td>
                        <td>{{$payment->amount}} USD</td>
                        <td>
                          <a class="btn btn-warning" href="{{route('payments.edit',$payment->id)}}">{{ __('payments_index.edit') }}</a>
                          <a class="btn btn-success" href="{{route('payments.generatePDF',$payment->id)}}">{{ __('payments_index.pdf') }}</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    @else
                    <h3>{{ __('teacher_payment.no_payment') }}</h3>
                    @endif
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
