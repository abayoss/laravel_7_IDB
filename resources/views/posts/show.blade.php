@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-secondary mb-3">
            <img class="card-img-top" src="{{ Storage::url($post->image ?? "no-img.jpg") }}" alt="">
            <div class="card-body">
                <h3 class="card-title">{{$post->title}}</h3>
                <p class="card-text">{{$post->content}}</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <form method="post" action="{{ route('posts.comment', ['post' => $post]) }}">
                    @csrf    
                    <div class="form-group">
                        <label for="comment" class="mr-4">Your Comment</label>
                        <input type="text" class="form-control" name="comment" id="comment">
                    </div>
                    <button class="btn btn-primary float-right">Add Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($post->comments as $comment)
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">{{$comment->content}}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection