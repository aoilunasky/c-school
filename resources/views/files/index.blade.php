@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('file_index.file_list') }}
                    @if (Auth::user()->role == 1)
                    <a href="{{route('files.create')}}"
                    class="btn btn-block btn-outline-info float-right  col-md-2">{{ __('file_index.upload_file') }}</a>
                    @endif
                 </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('file_index.no') }}</th>
                                <th>{{ __('file_index.subject') }}</th>
                                <th>{{ __('file_index.file_name') }}</th>
                                 @if (Auth::user()->role == 1)
                                <th>{{ __('file_index.total_assign_users') }}</th>
                                <th>{{ __('default.action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($files->total() >0)
                            @php
                            $i = ($files->currentpage()-1)* $files->perpage() + 1;
                            @endphp
                            @foreach ($files as $file)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $file->subject->name }} - {{ $file->subject->level->name }}</td>
                                <td><a href="{{ $file->file_full_path }}" class="btn btn-sm btn-outline-primary" target="_blank"><span class="fa fa-cloud-download-alt"></span></a> {{ $file->file_name }}</td>
                                @if (Auth::user()->role == 1)
                                <td>{{ count($file->users) }}</td>
                                <td>
                                    <a href="{{ route('files.assign', $file->id) }}" class="btn btn-sm btn-info">{{ __('file_index.assign') }}</a>
                                    <a href="{{ route('files.edit', $file->id) }}" class="btn btn-sm btn-outline-primary">{{ __('default.edit') }}</a>
                                    <a href="{{ route('files.delete', $file->id) }}" onclick="event.preventDefault();
                                    document.getElementById('delete-form{{$file->id}}').submit();" class="btn btn-sm btn-danger">{{ __('default.delete') }}</a>
                                    <form id="delete-form{{$file->id}}" action="{{ route('files.delete', $file->id) }}" style="display: none;" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                                @endif
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
                        {{ $files->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
