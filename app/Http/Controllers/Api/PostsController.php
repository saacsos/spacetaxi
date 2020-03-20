<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        return response($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->detail = $request->input('detail');
        $post->user_id = $request->input('user_id');
        if ($post->save()) {
            return response($post);
        }
        return response([
            'error' => 'cannot save post',
            'success' => false
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['user'])->find($id);
        if ($post)
            return response($post);
        return response([
            'success' => false,
            'error' => 'Post not found'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::with(['user'])->find($id);
        if (!$post)
            return response([
                'success' => false,
                'error' => 'Post not found'
            ], 404);
        $post->title = $request->input('title');
        $post->detail = $request->input('detail');
        if ($post->save()) {
            return response($post);
        }
        return response([
            'success' => false,
            'error' => 'cannot update post'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::with(['user'])->find($id);
        if (!$post)
            return response([
                'success' => false,
                'error' => 'Post not found'
            ], 404);
        if ($post->delete()) {
            return response([
                'success' => true
            ]);
        }
        return response([
            'success' => false,
            'error' => 'cannot delete post'
        ], 500);
    }
}
