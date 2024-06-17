@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('package_index.package_list') }}</div>
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
                                <td><a href="{{ route('student.package.buy', $package->id) }}"
                                        class="btn btn-sm btn-primary">{{ __('package_index.buy') }}</a>
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
