@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="nav-tabs-boxed">
        <ul class="nav nav-tabs" role="tablist">
          @if (Auth::user()->role != 3 )
          <li class="nav-item"><a class="nav-link" href="{{ route('students.show', $student->id) }}">{{
              __('student_ownedpackage.profile') }}</a>
          </li>
          @endif
          <li class="nav-item"><a class="nav-link active"
              href="{{ route('students.packages', [ 'id'=> $student->id ]) }}">{{ __('student_ownedpackage.packages')
              }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <div class="card-header">{{ __('student_ownedpackage.package_list_of') }} <b>{{$student->user->name}}</b>
            </div>
            <div class="card-body">
              <div class="row">
                @if ($packages->count()== 0)
                <span class="text-muted">{{ __('student_ownedpackage.no_package') }}</span>
                @else
                <table class="table table-responsive-sm ">
                  <thead>
                    <tr>
                      <td>{{ __('student_ownedpackage.package_name') }}</td>
                      <td>{{ __('student_ownedpackage.fees') }}</td>
                      <td>{{ __('student_ownedpackage.payment_type') }}</td>
                      <td>{{ __('student_ownedpackage.owner_name') }}</td>
                      <td>{{ __('student_ownedpackage.card_number') }}</td>
                      <td>{{ __('student_ownedpackage.purchased_date') }}</td>
                      <td>{{ __('student_ownedpackage.status') }}</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($packages as $package)
                    <tr>
                      <td>{{$package->title}}</td>
                      <td>{{$package->pivot->fees}}{{ __('student_ownedpackage.dollar') }}</td>
                      <td>{{Config::get('constants.banks.'.$package->pivot->type)}}</td>
                      <td>{{$package->pivot->card_name}}</td>
                      <td>{{$package->pivot->card_number}}</td>
                      <td>{{$package->pivot->date}}</td>
                      @if (Auth::user()->role == 1)
                      @if($package->pivot->status == \App\Models\PackageHistory::CONFIRM )
                      <td>Confirmed</td>
                      @else
                      <td>
                        <a class="btn btn-warning" href="{{ route('students.confirmpackage',$package->pivot->id)}}"
                          onclick="event.preventDefault();
                                document.getElementById('confirm-form{{$package->pivot->id}}').submit();">{{
                          __('student_ownedpackage.confirm') }}</a>
                        <form id="confirm-form{{$package->pivot->id}}" action="{{ route('students.confirmpackage',$package->pivot->id)}}"
                          style="display: none;" method="POST">
                          @csrf
                        </form>

                      </td>
                      @endif
                      @else
                      <td class="text-capitalize">{{Config::get('constants.package_status.'.$package->pivot->status)}}
                      </td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection