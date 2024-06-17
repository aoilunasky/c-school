@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i> {{ __('level_index.levels') }}
                    <a href="{{route('levels.create')}}"
                    class="btn btn-block btn-outline-info float-right col-md-2">{{ __('level_index.create_new_level') }}</a></div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('level_index.no') }}</th>
                                <th>{{ __('level_index.level_name') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($levels->total() >0)
                            @php
                            $i = ($levels->currentpage()-1)* $levels->perpage() + 1;
                            @endphp
                            @foreach ($levels as $level)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $level->name }}</td>
                                <td><a href="{{ route('levels.edit', $level->id) }}"
                                    class="btn btn-sm btn-info">{{ __('default.edit') }}</a>
                                <a href="{{ route('levels.delete',  $level->id) }}" data-id="{{$level->id}}"
                                    class="btn btn-sm btn-danger deleteBtn">{{ __('default.delete') }}</a>
                                <form id="level-delete-form{{$level->id}}"
                                    action="{{ route('levels.delete',  $level->id) }}" style="display: none;"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center text-warning">{{ __('level_index.no_data_to_show') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $levels->links()}}
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
                $('#level-delete-form'+$(this).data("id")).submit();
            }
        });
    });
</script>
@endsection
