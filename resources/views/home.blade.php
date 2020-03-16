@extends('layouts.app')

@section('content')

<div class="container">

    <div id="delete-message" class="d-none alert alert-danger"></div>

    <div class="row">
        @if ($blogs->count() < 1 ) 
        <span class="col-md-12 mb-3">
            <div class="alert alert-warning mt-3">
                No data
            </div>
            </span>
    </div>
    @endif

    @foreach($blogs as $blog)
    <div class="col-md-4 mb-3">
        <a href="/blogs/{{ $blog->id }}">
            <div class="card">
            <img src="https://picsum.photos/id/{{ $blog->id }}/1080" class="card-img-top" style="height: 10rem" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $blog->author }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $blog->category['name'] }}</h6>
                    @auth
                    <a href="/blogs/{{ $blog->id }}/edit" class="card-link">Edit</a>

                    <a class="card-link delete-blog" data-id="{{ $blog->id }}" href="">Delete</a>
                    @endauth
                </div>
            </div>
        </a>
    </div>

    <!-- <div class="card-deck">
        <a href="/blogs/{{ $blog->id }}">
            <div class="card mr-3" style="width: 18rem">
                <img src="https://picsum.photos/200/300" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">{{ $blog->author }}</small></p>
                </div>
            </div>
        </a>
    </div> -->

    @endforeach
</div>

@endsection

@push('scripts')
<script>
    $('.delete-blog').on('click', function() {
        let _that = $(this);
        $.ajax({
            url: '/blogs/' + _that.data('id'),
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                // Do something with the result
                $('#delete-message').removeClass('d-none');
                $('#delete-message').html(result.message);
                _that.closest('.col-md-4').remove();
            }
        });
    });
</script>
@endpush