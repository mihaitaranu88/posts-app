<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Post::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @@return Post|\Illuminate\Http\Response
     */
    public function store( PostRequest $request)
    {
        $post = Post::create((array) $request->except(['id']));

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Post|\Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return Post|\Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->update($request->except(['id']));

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id',$id)->delete();

        return response()->json(null, 204);
    }
}
