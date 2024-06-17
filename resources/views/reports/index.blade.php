@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('reports_index.lesson_progress_report') }}
                 </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('reports_index.no') }}</th>
                                <th>{{ __('reports_index.assignment_title') }}</th>
                                <th>{{ __('reports_index.teacher') }}</th>
                                <th>{{ __('reports_index.subject') }}</th>
                                <th>{{ __('reports_index.feedback') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($feedbacks->total() >0)
                            @php
                            $i = ($feedbacks->currentpage()-1)* $feedbacks->perpage() + 1;
                            @endphp
                            @foreach ($feedbacks as $assignment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><a href="{{route('assignment.detail',$assignment->id)}}">{{ $assignment->title }}</a></td>
                                <td><a href="{{ route('teachers.show',$assignment->teacher->id) }}">{{ $assignment->teacher->user->name }}</a></td>
                                <td>{{ $assignment->subject->name }}</td>
                                <td>{{ $assignment->answer->feedback }}</td>
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
                        {{ $feedbacks->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
