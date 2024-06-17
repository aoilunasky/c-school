@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('assignments_index.assignment_list') }}</div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('assignments_index.no') }}</th>
                                <th>{{ __('assignments_index.title') }}</th>
                                @if (Auth::user()->role == 2)
                                <th>{{ __('assignments_index.student_name') }}</th>
                                @elseif(Auth::user()->role==3)
                                <th>{{ __('assignments_index.teacher_name') }}</th>
                                @endif
                                <th>{{ __('assignments_index.subject_name') }}</th>
                                <th>{{ __('assignments_index.deadline') }}</th>
                                <th>{{ __('assignments_index.status') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($assignments->total() >0)
                            @php
                            $i = ($assignments->currentpage()-1)* $assignments->perpage() + 1;
                            @endphp
                            @foreach ($assignments as $assignment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $assignment->title }}</td>
                                @if (Auth::user()->role == 2)
                                <td>{{ $assignment->student->user->name }}</td>
                                @elseif(Auth::user()->role==3)
                                <td>{{ $assignment->teacher->user->name }}</td>
                                @endif
                                <td class="text-capitalize">{{ $assignment->subject->name }}</td>
                                <td>{{ $assignment->deadline }}</td>
                                <td class="text-uppercase">{{ $assignment->status_text }}</td>
                                <td>
                                    <a href="{{ route('assignment.detail', $assignment->id) }}" class="btn btn-sm btn-info">{{ __('default.detail') }}</a>
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
                        {{ $assignments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 2)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('assignments_index.student_list') }}</div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('assignments_index.no') }}</th>
                                <th>{{ __('assignments_index.name') }}</th>
                                <th>{{ __('assignments_index.subject') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($students->total() >0)
                            @php
                            $i = ($students->currentpage()-1)* $students->perpage() + 1;
                            @endphp
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $student->student->user->name }}</td>
                                <td>{{ $student->subject->name }}</td>
                                <td>
                                    <a href="{{ route('assignment.create', $student->id) }}" class="btn btn-sm btn-info">{{ __('assignments_index.give_assignment') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-warning">{{ __('default.no_data') }}</td>
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
    @endif

</div>
@endsection
