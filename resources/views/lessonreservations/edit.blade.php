@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('lessonreservations_edit.lesson_reservation_edit') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('lessonrv.update',$event->id) }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.student_name') }} :</label>
                                    <div class="col-md-6">
                                        <label class="form-control text-left">{{$event->student->user->name}}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.teacher_name') }} :</label>
                                    <div class="col-md-6">
                                        <label class="form-control text-left">{{$event->teacher->user->name}}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.subject_name') }} :</label>
                                    <div class="col-md-6">
                                        <label class="form-control text-left">{{$event->subject->name}}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.date') }} :</label>
                                    <div class="col-md-6">
                                        <input type="date" name="date" class="form-control text-left" value="{{$event->date}}" required readonly/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.start_time') }} :</label>
                                    <div class="col-md-6">
                                        <input type="text" name="date" class="form-control text-left" value="{{$event->start_time}}" required readonly/>
                                        {{-- <select name="start_time" class="form-control text-left" required>
                                            <option
                                            @if ($event->start_time == 1)
                                                selected
                                            @endif
                                            >

                                            </option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.end_time') }} :</label>
                                    <div class="col-md-6">
                                        <input type="text" name="date" class="form-control text-left" value="{{$event->end_time}}" required readonly/>
                                        {{-- <select name="end_time" class="form-control text-left" required>
                                            <option
                                            @if ($event->end_time == 1)
                                                selected
                                            @endif
                                            >

                                            </option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.lesson_link') }} :</label>
                                    <div class="col-md-6">
                                        <input type="text" name="lesson_link" class="form-control text-left" value="{{ $event->lesson_link}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">{{ __('lessonreservations_edit.request') }} :</label>
                                    <div class="col-md-6">
                                        <input type="text" name="q" class="form-control text-left" value="{{$event->request}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right"></label>
                                    <div class="col-md-6">
                                        <input type="submit" class=" btn btn-info" value="Update">
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

@section('js')
<script type="text/javascript">
    $( document ).ready(function(){
        $('.deleteBtn').click(function(e){
            e.preventDefault();
            if(confirm('Are you sure to cancel?')){
                $('#cancel-booking').submit();
            }
        });
    });
</script>
@endsection

