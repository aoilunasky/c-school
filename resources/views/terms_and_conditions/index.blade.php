@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('t&c_index.teacher_t&c') }}</strong>{{ __('default.create') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url('terms-and-conditions-update') }}" id="teacher-t-n-c"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="Ttandc" name="content"
                                value="{{$teacher_t_and_c->content ?? ''}}"
                                placeholder="{{ __('t&c_index.enter_teacher_t&c') }}">{{$teacher_t_and_c->content ?? ''}}</textarea>
                            <input type="hidden" name="content_id" value="{{$teacher_t_and_c->role ?? 1}}">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="teacher-t-n-c" class="btn btn-sm btn-primary"> {{ __('default.save')
                        }}</button>
                    <button type="reset" form="teacher-t-n-c" class="btn btn-sm btn-danger"> {{ __('default.reset')
                        }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('t&c_index.student_t&c') }}</strong>{{ __('default.create') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="student-t-n-c" action="{{ url('terms-and-conditions-update') }}"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="Standc" name="content"
                                value="{{$student_t_and_c->content ?? ''}}"
                                placeholder="{{ __('t&c_index.enter_student_t&c') }}"> {{$student_t_and_c->content ?? ''}}</textarea>
                            <input type="hidden" name="content_id" value="{{$student_t_and_c->role ?? 2}}">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="student-t-n-c" class="btn btn-sm btn-primary"> {{ __('default.save')
                        }}</button>
                    <button type="reset" form="student-t-n-c" class="btn btn-sm btn-danger"> {{ __('default.reset') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
$(function() {   
    CKEDITOR.replace( 'Ttandc' );
    CKEDITOR.replace( 'Standc');
});
</script>
@endsection