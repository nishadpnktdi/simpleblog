@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="h1 display-4 mb-3">{{ $post->title }}</h1>
    <h5 class="font-weight-normal text-muted mb-5">Authored by <strong>{{ $post->author }}</strong> On <strong>{{ $post->created_at->format('d M Y') }}</strong></h5>
    <p class="lead mt-3 mb-4">{{ $post->content }}</p>
    <h5 class="font-weight-normal text-muted">Category: {{ $post->category['name'] }}</h5>
</div>

@endsection