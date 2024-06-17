@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('subjects_index.subject') }}</strong>
                    <a href="{{route('subjects.create')}}"
                    class="btn btn-block btn-outline-info float-right  col-md-2">{{ __('subjects_index.create_subject') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('subjects_index.no') }}</th>
                                <th>{{ __('subjects_index.subject_name') }}</th>
                                <th>{{ __('subjects_index.level_name') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($subjects->total() > 0)
                            @php
                            $i = ($subjects->currentpage()-1)* $subjects->perpage() + 1;
                            @endphp
                            @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->level->name }}</td>
                                <td><a href="{{ route('subjects.edit', $subject->id) }}"
                                    class="btn btn-sm btn-info">{{ __('default.edit') }}</a>
                                <a href="{{ route('subjects.delete',  $subject->id) }}" data-id="{{$subject->id}}"
                                    class="btn btn-sm btn-danger deleteBtn">{{ __('default.delete') }}</a>
                                <form id="subject-delete-form{{$subject->id}}"
                                    action="{{ route('subjects.delete',  $subject->id) }}" style="display: none;"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
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
                        {{ $subjects->links()}}
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
                $('#subject-delete-form'+$(this).data("id")).submit();
            }
        });
    });
</script>
@endsection
