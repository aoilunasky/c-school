@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 mb-3">
            <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active"
                            href="{{ route('students.show', $student->id) }}">{{ __('student_detail.profile') }}</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('students.packages', [ 'id'=> $student->id ]) }}">{{ __('student_detail.package') }}</a></li>
                </ul>
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="card-header pb-4">{{ __('student_detail.student_detail') }}
                    <a href="{{ route('students.edit', $student->id) }}"
                        class="btn btn-outline-info float-right col-md-2">{{ __('student_detail.edit') }}</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.name') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->user->name}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.email') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->user->email}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.phone_number') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->user->phone}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.gender') }}:</label>
                                <label class="col-md-10 col-form-label text-left text-capitalize">{{$student->gender}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.age') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->age}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.lesson_type') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->lesson_type_name}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.purpose') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->purpose}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">{{ __('student_detail.ticket_amount') }}:</label>
                                <label class="col-md-10 col-form-label text-left">{{$student->ticket_amt}} {{ __('student_detail.ticket') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
    </div>
    </div>
</div>
@endsection
