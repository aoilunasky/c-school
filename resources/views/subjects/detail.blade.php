@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="text-capitalize">{{ $subject->name }}({{ $subject->level->name }})</h1>
    <p>Available Teacher List</p>
    <div class="row">
        @foreach ($subject->teachers as $teacher)
        <div class="col-md-12">
            <a href="{{ route("student.teachers.detail",$teacher->id) }}" class="text-decoration-none text-dark">
                <div class="card border-info">
                    <div class="card-header">
                        <u>{{ $teacher->user->name }}</u>
                        <span class="float-right">{{ $teacher->getTeachSubjects() }}</span>
                    </div>
                    <div class="card-body">
                        {{$teacher->responsibility }}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection