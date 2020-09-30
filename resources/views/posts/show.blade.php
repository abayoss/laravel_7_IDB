@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-secondary mb-3">
            <div class="card-body">
                <h3 class="card-title">{{$post->title}}</h3>
                <p class="card-text">{{$post->content}}</p>
            </div>
        </div>
    </div>
</div>
@endsection