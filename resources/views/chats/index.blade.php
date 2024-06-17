@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-accent-info">
        <div class="card-body h-100">
            @if (Auth::user()->role == 1)
            <chats-view :user=@json(Auth::user()) :teachers='{{$teachers->toJson()}}'></chats-view>
            @else
            <chat-message-form-component :email='@json(Auth::user()->email)' :user='@json(Auth::user())' :isadmin='false' :notifyid='1'>
            </chat-message-form-component>
            @endif
        </div>
    </div>
</div>
@endsection