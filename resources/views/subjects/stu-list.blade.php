@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1> <strong>{{ __('subjects_index.subject') }}</strong></h1>
    <div class="row">
        @if($subjects->total() > 0)
        @php
        $i = ($subjects->currentpage()-1)* $subjects->perpage() + 1;
        @endphp
        @foreach ($subjects as $subject)

        <div class="card text-white bg-info text-center col-2 mx-1">
            <a href="{{ route('student.course.show',$subject->id) }}" class="text-white">
                <div class="card-body">
                    <p class="text-capitalize">{{ $subject->name }}</p>
                    ({{ $subject->level->name }})
                </div>
            </a>
        </div>

        @endforeach
        @else
        <h3>{{ __('subjects_index.no_data') }}</h3>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            {{ $subjects->links()}}
        </div>
    </div>
</div>
@endsection