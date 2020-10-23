@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-secondary mb-3">
            <div class="card-body">
                <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <input type="text" class="form-control" name="content" id="content" placeholder="content" value="{{$post->content}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Add image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Update post</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection