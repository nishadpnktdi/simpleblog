@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            @if (session('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
            @endif
            <form action="/blogs" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- <div class="form-group">
                    <label for="exampleFormControlInput1">Author</label>
                    <input type="text" class="form-control" name="author" placeholder="eg: John Doe" value="{{ old('author') }}">
                    @error('author')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> -->

                <input type="hidden" class="form-control" name="author" placeholder="" value="{{ Auth::user()->name }}">

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Content</label>
                    <textarea class="form-control" name="content" rows="13" value="{{ old('content') }}"></textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-3">Publish</button>
                <button type="reset" class="btn btn-primary">Clear</button>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <div class="form-group">
                        <select name="category" class="form-control mb-3 select-category">
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <h5 class="card-title">Tags</h5>
                    <div class="form-group select2 js-example-basic-multiple">
                        <select name="tags[]" class="form-control select-tags-basic-multiple" multiple="multiple">
                            @foreach ($tags as $tag )
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select-category').select2();
        $('.select-tags-basic-multiple').select2();
    });
</script>
@endpush