<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\CommentResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::with('user')->get());
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        return new PostResource($post->load('user'));
    }
    public function show(Post $post)
    {
        return new PostResource($post->load('user', 'comments'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post->load('user'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }

    public function comments($id)
    {
        $post = Post::findOrFail($id);
        return CommentResource::collection($post->comments()->get());
    }
}
