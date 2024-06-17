@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('student_index.student_list') }}<a href="{{route('students.create')}}"
                    class="btn btn-block btn-outline-info float-right  col-md-2">{{ __('student_index.create_new_student') }}</a></div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('student_index.no') }}</th>
                                <th>{{ __('student_index.name') }}</th>
                                <th>{{ __('student_index.email') }}</th>
                                <th>{{ __('student_index.phone') }}</th>
                                <th>{{ __('student_index.age') }}</th>
                                <th>{{ __('student_index.lesson_type') }}</th>
                                <th>{{ __('student_index.ticket_amt') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($students->total() > 0)
                            @php
                            $i = ($students->currentpage()-1)* $students->perpage() + 1;
                            @endphp
                            @foreach ($students as $key=>$student)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>{{ $student->user->phone }}</td>
                                <td>{{ $student->age }}</td>
                                <td>{{ $student->lesson_type_name }}</td>
                                <td>{{ $student->ticket_amt }}</td>
                                <td>
                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-success">{{ __('default.detail') }}</a>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-info">{{ __('default.edit') }}</a>
                                    <a href="{{ route('students.delete', $student->id) }}" class="btn btn-sm btn-danger deleteBtn" data-id="{{$student->id}}">{{ __('default.delete') }}</a>
                                    <form action="{{ route('students.delete', $student->id) }}" style="display: none;" method="GET" id="student-delete-form{{$student->id}}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    {{-- <a href="{{ url('companies.delete') }}" onclick="event.preventDefault();
                                    document.getElementById('company-delete-form').submit();" class="btn btn-sm btn-danger">{{ __('default.delete') }}</a>
                                    <form id="company-delete-form" action="{{ url('companies.delete') }}" style="display: none;" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form> --}}
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
                        {{ $students->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
