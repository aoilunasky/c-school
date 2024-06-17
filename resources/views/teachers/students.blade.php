@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="nav-tabs-boxed">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link" href="{{ route('teachers.show', $teacher->id) }}">{{ __('teacher_student.profile ') }}</a>
          </li>
          <li class="nav-item"><a class="nav-link"
              href="{{ route('teachers.payment', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_student.payment') }}</a></li>
          <li class="nav-item"><a class="nav-link active"
              href="{{ route('teachers.student', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_student.students') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('teachers.files', [ 'id'=> $teacher->id ]) }}">{{ __('teacher_student.files') }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <div class="card-header">{{ __('teacher_student.student_list') }} <b>{{$teacher->user->f_name}} {{$teacher->user->l_name}}</b></div>
            <div class="card-body">
              <div class="row">
                <table class="table table-responsive-sm ">
                  @if(count($teacher->lessonReservations)>0)
                  <thead>
                    <tr>
                      <td>{{ __('teacher_student.no') }}</td>
                      <td>{{ __('teacher_student.name') }}</td>
                      <td>{{ __('teacher_student.course') }}</td>
                      <td>{{ __('teacher_student.total_time') }}</td>
                      <td>{{ __('teacher_student.teached_time') }}</td>
                      <td>{{ __('teacher_student.status') }}</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($teacher->lessonReservations as $key=>$reservation)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$reservation->student->user->name}}</td>
                      <td>{{$reservation->subject->name.'('.$reservation->subject->level->name.')'}}</td>
                      <td>40</td>
                      <td>10</td>
                      <td>Done</td>
                    </tr>
                    @endforeach
                    <!-- <tr>
                      <td>2</td>
                      <td>Delphine Schowalter Carissa Turcotte</td>
                      <td>Japanese N5</td>
                      <td>40</td>
                      <td>25</td>
                      <td>Done</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Lester Mayer V Melyssa Fritsch Sr.</td>
                      <td>Japanese N5</td>
                      <td>20</td>
                      <td>15</td>
                      <td>Teaching</td>
                    </tr> -->
                  </tbody>
                  @else
                  <h3>{{ __('teacher_student.no_reservation_list') }} </h3>
                  @endif
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
