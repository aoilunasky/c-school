@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('teacher_index.teacher_list') }}<a href="{{route('teachers.create')}}"
                    class="btn btn-block btn-outline-info float-right  col-md-2">{{ __('teacher_index.create_new_teacher') }}</a></div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('teacher_index.no') }}</th>
                                <th>{{ __('teacher_index.name') }}</th>
                                <th>{{ __('teacher_index.email') }}</th>
                                <th>{{ __('teacher_index.phone') }}</th>
                                <th>{{ __('teacher_index.job_type') }}</th>
                                <th>{{ __('teacher_index.country') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($teachers->total() > 0)
                            @php
                            $i = ($teachers->currentpage()-1)* $teachers->perpage() + 1;
                            @endphp
                            @foreach ($teachers as $key=>$teacher)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $teacher->user->name }}
                                </td>
                                <td>{{ $teacher->user->email }}</td>
                                <td>{{ $teacher->user->phone }}</td>
                                <td>{{ $teacher->job_type_name }}</td>
                                <td>{{ $teacher->country->name}}</td>
                                <td>
                                    <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-sm btn-success">{{ __('default.detail') }}</a>
                                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-info">{{ __('default.edit') }}</a>
                                    <a href="{{ route('teachers.delete', $teacher->id) }}" class="btn btn-sm btn-danger deleteBtn" data-id="{{$teacher->id}}">{{ __('default.delete') }}</a>
                                    <form id="teacher-delete-form{{$teacher->id}}" action="{{ route('teachers.delete', $teacher->id) }}" style="display: none;" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a href="{{ route('teachers.mark_absent', $teacher->id) }}" class="btn btn-sm btn-danger absentBtn my-1" data-id="{{$teacher->id}}">{{ __('teacher_index.mark_absent') }}
                                        @if ($teacher->absence_count >0)
                                        <span class="badge badge-light badge-pill" style="position: static;">{{$teacher->absence_count}}</span>
                                        @endif
                                        </a>
                                    <form id="teacher-absent-form{{$teacher->id}}" action="{{ route('teachers.mark_absent', $teacher->id) }}" style="display: none;" method="POST">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center text-warning">{{ __('default.no_data') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $teachers->links()}}
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
            if(confirm('Are you sure to delete?')){
                $('#teacher-delete-form'+$(this).data("id")).submit();
            }
        });
        $('.absentBtn').click(function(e){
            e.preventDefault();
            if(confirm('Are you sure to mark as Absent?')){
                $('#teacher-absent-form'+$(this).data("id")).submit();
            }
        });
    });
</script>
@endsection
