@extends('layouts.app')

@section('content')
<div class="row">
    @foreach ( $posts as $post)
    <div class="col-md-4">
        <div class="card mb-3 border-info text-bold">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="text-decoration: none;" class="text-white">
                <div class="card-body">
                    <h3 class="card-title">{{$post->title}}</h3>
                    <p class="card-text">{{$post->content}}</p>
                    <small class="card-text">{{$post->created_at->diffForHumans()}}</small>
                    <small class="card-text float-right">{{$post->comments_count}} Comments</small>
                </div>
            </a>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('posts.edit', ['post' => $post->id])}}" class="btn btn-outline-warning text-bold">Edit</a>
                <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger text-bold">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection