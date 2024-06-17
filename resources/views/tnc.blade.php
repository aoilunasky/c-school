@extends('layouts.auth_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card p-4">
                <div class="card-body">
                    {!! $tnc->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection