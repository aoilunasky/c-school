@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="nav-tabs-boxed">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link" href="{{ route('teachers.show', $teacher->id) }}">{{ __('teacher_file.profile ') }}</a>
          </li>
          <li class="nav-item"><a class="nav-link"
              href="{{ route('teachers.payment', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_file.payment') }}</a></li>
          <!-- <li class="nav-item"><a class="nav-link"
              href="{{ route('teachers.student', [ 'id'=> $teacher->id ]) }}">Students</a></li> -->
          <li class="nav-item"><a class="nav-link active" href="{{ route('teachers.files', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_file.files') }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <div class="card-header">{{__('teacher_file.files_for')}} <b>{{$teacher->user->name}}</b></div>
            <div class="card-body">
              <div class="row">
                <table class="table table-responsive-sm ">
                  <thead>
                    <tr>
                      <td>{{ __('teacher_file.no') }}</td>
                      <td>{{ __('teacher_file.subject') }}</td>
                      <td>{{ __('teacher_file.file_name') }}</td>

                    </tr>
                  </thead>
                  <tbody>
                   @if ($teacher->user->files->count() >0)
                    @php
                    $i =1;
                    @endphp
                    @foreach($teacher->user->files as $file)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$file->subject->name}} {{$file->subject->level->name}}</td>
                      <td><a href="{{ $file->file_full_path }}" class="btn btn-sm btn-outline-primary" target="_blank"><span class="fa fa-cloud-download-alt"></span></a>{{$file->file_name}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center text-warning">{{ __('default.no_data') }}</td>
                    </tr>
                    @endif
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
