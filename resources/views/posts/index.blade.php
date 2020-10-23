@extends('layouts.app')

@section('content')
<div class="row">
    @foreach ( $posts as $post)
    <div class="col-md-4">
        <div class="card mb-3 border-info text-bold">
            @can(['update','delete'], $post)
            <div class="card-header d-flex justify-content-between">
                @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post->id])}}" class="btn btn-outline-info btn-sm text-bold"><i class="fa fa-pencil"></i></a>
                @endcan()
                @can('delete', $post)
                <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm text-bold"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>
                @endcan
            </div>
            @endcan
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="text-decoration: none;" class="text-dark">
                <img class="card-img-top" src="{{ Storage::url($post->image ?? "no-img.jpg") }}" alt="">
                <div class="card-body">
                    <h3 class="card-title">{{$post->title}}</h3>
                    <p class="card-text">{{Str::limit($post->content, 100, '...')}}</p>
                    <small class="card-text">{{$post->created_at->diffForHumans()}}</small>
                    <small class="card-text float-right">{{$post->comments_count}} Comments</small>
                </div>
            </a>

        </div>
    </div>
    @endforeach
</div>
@endsection