@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            Profile Image:
            <div>
            <img src="https://picsum.photos/150" width="150" height="150"></img>
            </div>
            Full Name:
            <div>
            {{$user->name}}
            </div>
            E-mail:
            <div>
            {{$user->email}}
            </div>
            Profile created:
            <div>
            {{$user->created_at}}
            </div>
        </div>
    </div>
</div>

@endsection