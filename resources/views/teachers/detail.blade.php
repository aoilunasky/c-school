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
    @if (Auth::user()->role==1)
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="nav-tabs-boxed">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('teachers.show', $teacher->id) }}">{{
                            __('teacher_detail.profile') }}</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('teachers.payment', [ 'id'=> $teacher->id ]) }}">{{
                            __('teacher_detail.payment') }}</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('teachers.files', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_detail.files')
                            }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="card-header pb-4">{{__('teacher_detail.teacher')}} <b>{{$teacher->user->name."'s
                                ."}}</b>{{__('teacher_detail.detail_info')}}
                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                class="btn btn-block btn-outline-info float-right  col-md-2">{{
                                __('default.edit') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label text-left">{{$teacher->user->f_name}}
                                        {{$teacher->user->l_name}}</label>
                                    <img src="{{ $teacher->profile_image_url}}" width="200px" height="max-height">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.email')
                                            }}:</label>
                                        <label class="col-md-9 col-form-label text-left">
                                            {{$teacher->user->email}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.phone_number') }}:
                                        </label>
                                        <label class="col-md-9 col-form-label text-left">
                                            {{$teacher->user->phone}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.skype_id') }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->skype_link ??
                                            "N/A"}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.zoom_id')
                                            }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->zoom_link ??
                                            "N/A"}}</label>
                                    </div>
                                </div>
                                <div class="col-md-7">

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.job_type') }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->job_type_name
                                            }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.salary_rate') }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->salary_rate
                                            }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.gender')
                                            }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->gender
                                            }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.date_of_birth') }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->dob }}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.id_card_number') }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->nrc ??
                                            "N/A"}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{
                                            __('teacher_detail.passport') }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{ $teacher->passport ??
                                            "N/A"}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.country')
                                            }}:</label>
                                        <label class="col-md-9 col-form-label text-left">{{
                                            $teacher->country->name}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.address')
                                    }}:</label>
                                <label class="col-md-9 col-form-label text-left">
                                    {{$teacher->address ?? "N/A"}}
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.subject')
                                    }}:</label>
                                <label class="col-md-9 col-form-label text-left">
                                    @if($teacher->subjects == null)
                                    N/A
                                    @else
                                    @foreach ($teacher->subjects as $subject)
                                    {{ $subject->name }}@if (!$loop->last),@endif
                                    @endforeach
                                    @endif
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.education')
                                    }}:</label>
                                <label class="col-md-9 col-form-label text-left">
                                    {{$teacher->education ?? "N/A"}}
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.job_history')
                                    }}:</label>
                                <label class="col-md-9 col-form-label text-left">
                                    {{$teacher->job_history ?? "N/A"}}
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.certification')
                                    }}:</label>
                                <label class="col-md-9 col-form-label text-left">
                                    {{$teacher->certificates ?? "N/A"}}
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label text-left">{{ __('teacher_detail.strong_point')
                                    }}:</label>
                                <label class="col-md-9 col-form-label text-left">
                                    {{$teacher->strong_points ?? "N/A"}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 row">
                        <label class="control-label">{{ __('teacher_detail.teacher') }}
                            <strong>{{$teacher->user->name}}</strong> {{ __('teacher_detail.availabe_date_time')
                            }}</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 text-center">
                        <a href="?startDate={{\Carbon\Carbon::parse($startDate)->subWeek()->format('Y-m-d')}}"
                            class="col-md-4">{{ __('teacher_detail.last_week') }}</a>
                        <div class="col-md-4">{{date("Y-m-d")}}</div>
                        <a href="?startDate={{\Carbon\Carbon::parse($startDate)->addWeek()->format('Y-m-d')}}"
                            class="col-md-4">{{ __('teacher_detail.next_week') }}</a>
                    </div>
                    <div class="table-responsive tableFixHead">
                        <form action="{{ route('availableschedules.store') }}" method="POST" id="timeForm">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{$teacher->id}}" />
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('teacher_detail.date') }}</th>
                                        <th>{{$startDate->format('Y-m-d l') }}
                                            <input type="hidden" name="date[]"
                                                value="{{$startDate->format('Y-m-d') }}" />
                                        </th>
                                        <th>{{ $startDate->copy()->addDays(1)->format('Y-m-d l') }}
                                            <input type="hidden" name="date[]"
                                                value="{{ $startDate->copy()->addDays(1)->format('Y-m-d') }}" />
                                        </th>
                                        <th>{{ $startDate->copy()->addDays(2)->format('Y-m-d l') }}
                                            <input type="hidden" name="date[]"
                                                value="{{ $startDate->copy()->addDays(2)->format('Y-m-d') }}" />
                                        </th>
                                        <th>{{ $startDate->copy()->addDays(3)->format('Y-m-d l') }}
                                            <input type="hidden" name="date[]"
                                                value="{{ $startDate->copy()->addDays(3)->format('Y-m-d') }}" />
                                        </th>
                                        <th>{{ $startDate->copy()->addDays(4)->format('Y-m-d l') }}
                                            <input type="hidden" name="date[]"
                                                value="{{ $startDate->copy()->addDays(4)->format('Y-m-d') }}" />
                                        </th>
                                        <th>{{ $startDate->copy()->addDays(5)->format('Y-m-d l') }}
                                            <input type="hidden" name="date[]"
                                                value="{{ $startDate->copy()->addDays(5)->format('Y-m-d') }}" />
                                        </th>
                                        <th>{{ $startDate->copy()->addDays(6)->format('Y-m-d l') }}
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
                                        <td class="p-0">
                                            @php
                                            if ($availableSchedules->has($startDate->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                        <td class="p-0">
                                            @php
                                            if
                                            ($availableSchedules->has($startDate->copy()->addDays(1)->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->copy()->addDays(1)->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->copy()->addDays(1)->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                        <td class="p-0">
                                            @php
                                            if
                                            ($availableSchedules->has($startDate->copy()->addDays(2)->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->copy()->addDays(2)->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->copy()->addDays(2)->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                        <td class="p-0">
                                            @php
                                            if
                                            ($availableSchedules->has($startDate->copy()->addDays(3)->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->copy()->addDays(3)->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->copy()->addDays(3)->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                        <td class="p-0">
                                            @php
                                            if
                                            ($availableSchedules->has($startDate->copy()->addDays(4)->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->copy()->addDays(4)->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->copy()->addDays(4)->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                        <td class="p-0">
                                            @php
                                            if
                                            ($availableSchedules->has($startDate->copy()->addDays(5)->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->copy()->addDays(5)->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->copy()->addDays(5)->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                        <td class="p-0">
                                            @php
                                            if
                                            ($availableSchedules->has($startDate->copy()->addDays(6)->format('Y-m-d'))
                                            &&$availableSchedules->get($startDate->copy()->addDays(6)->format('Y-m-d'))->contains('start_time',$time)){
                                            $selected = "true";
                                            }else {
                                            $selected="false";
                                            }
                                            @endphp
                                            <available-time-check-component
                                                :date="{{ json_encode($startDate->copy()->addDays(6)->format('Y-m-d')) }}"
                                                :time="{{json_encode($time)}}" :selected=@json($selected) />
                                        </td>
                                    </tr>
                                    @endwhile
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="row mb-3 text-center">
                        <a href="?startDate={{\Carbon\Carbon::parse($startDate)->subWeek()->format('Y-m-d')}}"
                            class="col-md-4">{{ __('teacher_detail.last_week') }}</a>
                        <div class="col-md-4">{{date("Y-m-d")}}</div>
                        <a href="?startDate={{\Carbon\Carbon::parse($startDate)->addWeek()->format('Y-m-d')}}"
                            class="col-md-4">{{ __('teacher_detail.next_week') }}</a>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-7 offset-md-5">
                            <button class="btn btn-info" type="submit" form="timeForm">
                                {{ __('default.update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
