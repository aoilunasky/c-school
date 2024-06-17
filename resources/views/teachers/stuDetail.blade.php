@extends('layouts.app')
@section('css')
<style>
    td {
        padding: 0.25rem !important;
    }

    .tableFixHead {
        overflow: auto;
        max-height: 400px
    }

    thead,
    th {
        background: #eee;
    }

    .tableFixHead thead th {
        position: sticky;
        top: -1px;
        z-index: 1;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-accent-info">
                <div class="card-header">{{ $teacher->user->name }}</div>
                <div class="card-body">
                <p>{{ $teacher->getTeachSubjects() }}</p>
                <p class="text-black">{{ $teacher->responsibility }}</p>

                <div class="row mb-3 text-center">
                    <a href="?startDate={{\Carbon\Carbon::parse($startDate)->subWeek()->format('Y-m-d')}}"
                        class="col-md-4">{{ __('teacher_detail.last_week') }}</a>
                    <div class="col-md-4">{{date("Y-m-d")}}</div>
                    <a href="?startDate={{\Carbon\Carbon::parse($startDate)->addWeek()->format('Y-m-d')}}"
                        class="col-md-4">{{ __('teacher_detail.next_week') }}</a>
                </div>
                <div class="table-responsive tableFixHead">
                    <table class="table table-bordered time-table">
                        <thead>
                            <tr>
                                <th>{{ __('teacher_detail.date') }}</th>
                                <th>{{$startDate->format('m/d (D)') }}
                                    <input type="hidden" name="date[]" value="{{$startDate->format('Y-m-d') }}" />
                                </th>
                                <th>{{ $startDate->copy()->addDays(1)->format('m/d (D)') }}
                                    <input type="hidden" name="date[]"
                                        value="{{ $startDate->copy()->addDays(1)->format('Y-m-d') }}" />
                                </th>
                                <th>{{ $startDate->copy()->addDays(2)->format('m/d (D)') }}
                                    <input type="hidden" name="date[]"
                                        value="{{ $startDate->copy()->addDays(2)->format('Y-m-d') }}" />
                                </th>
                                <th>{{ $startDate->copy()->addDays(3)->format('m/d (D)') }}
                                    <input type="hidden" name="date[]"
                                        value="{{ $startDate->copy()->addDays(3)->format('Y-m-d') }}" />
                                </th>
                                <th>{{ $startDate->copy()->addDays(4)->format('m/d (D)') }}
                                    <input type="hidden" name="date[]"
                                        value="{{ $startDate->copy()->addDays(4)->format('Y-m-d') }}" />
                                </th>
                                <th>{{ $startDate->copy()->addDays(5)->format('m/d (D)') }}
                                    <input type="hidden" name="date[]"
                                        value="{{ $startDate->copy()->addDays(5)->format('Y-m-d') }}" />
                                </th>
                                <th>{{ $startDate->copy()->addDays(6)->format('m/d (D)') }}
                                    <input type="hidden" name="date[]"
                                        value="{{ $startDate->copy()->addDays(6)->format('Y-m-d') }}" />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0;
                            @endphp
                            @while(\Carbon\Carbon::parse('00:00')->addMinutes($i*$addminutes)->lessThanOrEqualTo(\Carbon\Carbon::parse('15:00')))
                            <tr>
                                @php
                                $time =
                                \Carbon\Carbon::parse('09:00')->addMinutes($i*$addminutes)->format('H:i:s');
                                $i++;
                                @endphp
                                <td>{{ $time }}</td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif

                                </td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->copy()->addDays(1)->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->copy()->addDays(1)->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->addDays(1)->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif

                                </td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->copy()->addDays(2)->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->copy()->addDays(2)->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->addDays(2)->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif

                                </td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->copy()->addDays(3)->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->copy()->addDays(3)->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->addDays(3)->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->copy()->addDays(4)->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->copy()->addDays(4)->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->addDays(4)->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->copy()->addDays(5)->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->copy()->addDays(5)->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->addDays(5)->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($availableSchedules->has($startDate->copy()->addDays(6)->format('Y-m-d'))
                                    &&$availableSchedules->get($startDate->copy()->addDays(6)->format('Y-m-d'))->contains('start_time',$time))
                                    <a
                                        href="{{ route('student.booking.preview',['id'=>$teacher->id,'date'=>$startDate->copy()->addDays(6)->format('Y-m-d'),'time'=>$time])}}">
                                        <div class="text-center bg-info text-white" style="padding: 0.25rem;">Open
                                        </div>
                                    </a>
                                    @else
                                    <div class="text-center">---</div>
                                    @endif
                                </td>
                            </tr>
                            @endwhile
                        </tbody>
                    </table>
                </div>
                <div class="row mb-3 text-center">
                    <a href="?startDate={{\Carbon\Carbon::parse($startDate)->subWeek()->format('Y-m-d')}}"
                        class="col-md-4">{{ __('teacher_detail.last_week') }}</a>
                    <div class="col-md-4">{{date("Y-m-d")}}</div>
                    <a href="?startDate={{\Carbon\Carbon::parse($startDate)->addWeek()->format('Y-m-d')}}"
                        class="col-md-4">{{ __('teacher_detail.next_week') }}</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
