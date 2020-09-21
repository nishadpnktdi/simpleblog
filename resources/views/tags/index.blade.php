@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="modal" tabindex="-1" role="dialog" id="editTagModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tags</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="" placeholder="Tag Name" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>Tags</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tags as $tag)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <a href='/tag/{{ $tag->id }}'>{{ $tag->name }}</a>
@auth
                                <div class="button-group d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1 edit-tag" data-toggle="modal" data-target="#editTagModal" data-id="{{ $tag->id }}" data-name="{{ $tag->name }}">Edit</button>

                                    <form action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
@auth
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Create Tag</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Tag Name" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endauth
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $('.edit-tag').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var url = "{{ url('tag') }}/" + id;

        $('#editTagModal form').attr('action', url);
        $('#editTagModal form input[name="name"]').val(name);
    });
</script>
@endpush