@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('package_index.package_list') }}<a href="{{route('packages.create')}}"
                        class="btn btn-block btn-outline-info float-right  col-md-2">{{ __('package_index.create_new_package') }}</a></div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('package_index.no') }}</th>
                                <th>{{ __('package_index.title') }}</th>
                                <th>{{ __('package_index.total_hours') }}</th>
                                <th>{{ __('package_index.ticket_amounts') }}</th>
                                <th>{{ __('package_index.fee') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($packages->total() > 0)
                            @php
                            $i = ($packages->currentpage()-1)* $packages->perpage() + 1;
                            @endphp
                            @foreach ($packages as $key=>$package)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $package->title }}</td>
                                <td>{{ $package->total_hours }} hrs</td>
                                <td>{{ $package->ticket_amount }}</td>
                                <td>{{ $package->fees }}</td>
                                <td><a href="{{ route('packages.edit', $package->id) }}"
                                        class="btn btn-sm btn-info">{{ __('default.edit') }}</a>
                                    <a href="{{ route('packages.delete',  $package->id) }}" data-id="{{$package->id}}"
                                        class="btn btn-sm btn-danger deleteBtn">{{ __('default.delete') }}</a>
                                    <form id="package-delete-form{{$package->id}}"
                                        action="{{ route('packages.delete',  $package->id) }}" style="display: none;"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center text-warning">{{ __('package_index.no_data_to_show') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $packages->links()}}
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
                $('#package-delete-form'+$(this).data("id")).submit();
            }
        });
    });
</script>
@endsection
