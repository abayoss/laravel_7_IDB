<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->only(['create','edit','update','destroy']);
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get non Trached posts
        return view('posts.index', ["posts" => Post::withCount('comments')->orderBy('updated_at', 'desc')->get()]);

        // get only Trashed posts
        // return view('posts.index', ["posts" => Post::onlyTrashed()->withCount('comments')->get()]);

        // get all posts
        // return view('posts.index', ["posts" => Post::withTrashed()->withCount('comments')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile("image")) {
            $path = $request->file("image")->store("posts");
        }

        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->title   = $request->title;
        $post->content = $request->content;
        $post->image   = $path ?? null;
        $post->slug    = Str::slug($post->title, '-');
        $post->active  = true;
        $post->save();

        session()->flash('status', 'Post Was created!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }
    /**
     * stores the specified comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function addcomment(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->post()->associate($post)->save();

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(Post::with('comments')->whereId($id)->first());
        $post = Post::with('comments')->whereId($id)->first();
        return view('posts.show', ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // if(Gate::denies('post.update', $post)){
        //     abort(304);
        // }
        Gate::authorize('update', $post);
        return view('posts.edit', ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($request->hasFile("image")) {
            if ($post->image) Storage::delete($post->image);
            $path = $request->file("image")->store("posts");
            $post->image = $path; 
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        session()->flash('status', 'Post Was updated!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();

        session()->flash('status', 'Post Was deleted!');
        return redirect()->route('posts.index');
    }
}
