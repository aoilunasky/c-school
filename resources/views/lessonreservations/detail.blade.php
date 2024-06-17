@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('lessonreservations_detail.lesson_reservation_detail') }}
                    @if ($event->date > now())
                    <div class="d-inline">
                        <a href="{{ route('lessonrv.edit',  $event->id) }}" class="btn btn-outline-info float-right col-md-2">{{ __('default.edit') }}</a>
                        <a href="{{ route('lessonrv.delete',  $event->id) }}"
                            class="btn col-md-2 mr-2 btn-danger deleteBtn float-right">{{ __('lessonreservations_detail.cancel_reservation') }}</a>
                        <form id="cancel-booking"
                            action="{{ route('lessonrv.delete',  $event->id) }}" style="display: none;"
                            method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.student_name') }} :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    <a href="{{ route('students.show', $event->student->id)}}">
                                        {{$event->student->user->name}}
                                    </a>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.teacher_name') }} :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    <a href="{{ route('teachers.show', $event->teacher->id)}}">
                                        {{$event->teacher->user->name}}
                                    </a>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.subject_name') }} :</label>
                                <label class="col-md-10 col-form-label text-left">{{$event->subject->name}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.date') }} :</label>
                                <label class="col-md-10 col-form-label text-left">{{$event->date}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.start_time') }} :</label>
                                <label class="col-md-10 col-form-label text-left">{{$event->start_time}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.end_time') }} :</label>
                                <label class="col-md-10 col-form-label text-left">{{$event->end_time}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.lesson_link') }} :</label>
                                <label class="col-md-10 col-form-label text-left">
                                    <a href="{{ $event->lesson_link }}" target="_blank">{{ $event->lesson_link}}</a>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('lessonreservations_detail.request') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$event->request}}</label>
                            </div>
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

