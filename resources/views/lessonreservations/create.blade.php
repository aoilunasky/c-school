@extends('layouts.app')
@section('css')
<style>
    .table td,
    .table th {
        padding: 2rem 0.75rem !important
    }
</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('bookings_create.reservation_form') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('student.booking.store') }}" method="POST" class="form">
                                @csrf
                                <input type="hidden" name="studentId" value="{{ Auth::user()->student->id }}">
                                <input type="hidden" name="teacherId" value="{{ $teacher->id }}">
                                <input type="hidden" name="startTime" value="{{ $availableTimeSlots[0]->id }}">
                                <table class="table pt-5">
                                    <tbody>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.teacher') }} :</th>
                                            <td>
                                                <a href="{{ url('lecturer/'.$teacher->id) }}">
                                                    {{$teacher->user->name}}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.user') }} :</th>
                                            <td>{{ Auth::user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.date') }} :</th>
                                            <td>{{ $date }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.start_time') }} :</th>
                                            <td>{{ $startTime }}
                                                @error('startTime')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.end_time') }} :</th>
                                            <td>
                                                <select name="endTime" class="form-control">
                                                    @foreach ($availableTimeSlots as $slot)
                                                    <option value="{{$slot->end_time}}">{{$slot->end_time}}</option>
                                                    @endforeach
                                                </select>
                                                @error('endTime')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Lesson Type :</th>
                                            <td>
                                                <select name="type" class="form-control" required>
                                                    <option value="1" selected>Zoom Lesson</option>
                                                    <option value="1">Skype Lesson</option>
                                                </select>
                                                @error('type')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.course') }} :</th>
                                            <td>
                                                <select name="subject" class="form-control">
                                                    @foreach ($teacher->subjects as $subject)
                                                    <option value="{{$subject->id}}">{{
                                                        $subject->name}}({{$subject->level->name}})
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('subject')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('bookings_create.request') }} :</th>
                                            <td>
                                                <textarea name="q" class="w-100" rows="6"
                                                    placeholder="Enter Your Request"></textarea>
                                                @error('request')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <br>
                                                <input type="submit" value="Book"
                                                    class="btn btn-primary mt-3 text-white">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection