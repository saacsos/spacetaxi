<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Gate;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     * GET /posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     * GET /posts/create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     * POST /posts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validatedData = $request->validate([
            'title' => ['required', 'max:100', 'min:3'],
            'detail' => ['required', 'max:500', 'min:3']
        ]);
        $post = new Post;


        $post->title = $request->input('title');
        $post->detail = $request->input('detail');
        $post->user_id = Auth::id();
        $post->save();
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     * GET /posts/14
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /posts/14/edit
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /posts/14
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'title' => ['required', 'max:100', 'min:3'],
            'detail' => ['required', 'max:500', 'min:3']
        ]);

        $post->title = $request->input('title');
        $post->detail = $request->input('detail');
        $post->save();
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /posts/14
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function commentStore(Request $request, $id) {
        $post = Post::findOrFail($id);
        $comment = new Comment;
        $comment->post_id = $post->id;
        $comment->detail = $request->input('detail');
        $comment->save();
        return redirect()->route('posts.show', ['post' => $post->id]);
    }
}
