<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function create(CreatePostRequest $request):JsonResponse
    {
        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'status' => Post::PRIVATE
        ]);
        return response()->json(['Post created successfully.', $post], Response::HTTP_CREATED);
    }

    public function update(UpdatePostRequest $request, Post $post):JsonResponse
    {
        $post->update([
            'title' => $request->has('title') ? $request->title : $post->title,
            'text' => $request->has('text') ? $request->text : $post->text,
        ]);

        return response()->json(['Post updated successfully.', $post], Response::HTTP_OK);
    }

    public function activatePost(Post $post):JsonResponse
    {
        if(!$post){
            return response()->json('Post not found.', Response::HTTP_NOT_FOUND);
        }
        $post->status = Post::PUBLIC;
        $post->save();
        return response()->json('Post published successfully.', Response::HTTP_OK);
    }

    public function disablePost(Post $post):JsonResponse
    {
        if(!$post){
            return response()->json('Post not found.', Response::HTTP_NOT_FOUND);
        }
        $post->status = Post::PRIVATE;
        $post->save();
        return response()->json('The post was successfully made private.', Response::HTTP_OK);
    }



}
