<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function create(CreatePostRequest $request):JsonResponse
    {
        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'status' => Post::PRIVATE,
        ]);
        return response()->json(['Post created successfully.', $post], Response::HTTP_CREATED);
    }

    public function update(UpdatePostRequest $request):JsonResponse
    {
        $post = Post::find($request->id);
        $post->update([
            'title' => $request->has('title') ? $request->title : $post->title,
            'text' => $request->has('text') ? $request->text : $post->text,
        ]);

        return response()->json(['Post updated successfully.', $post->only(['title', 'text'])], Response::HTTP_OK);
    }

    public function sharePost(Post $post): JsonResponse
    {
        $post->update(['status' => Post::PUBLIC]);

        return response()->json('Post published successfully.', Response::HTTP_OK);
    }


    public function hidePost(Post $post):JsonResponse
    {
        $post->update(['status' => Post::PRIVATE]);

        return response()->json('The post was successfully made private.', Response::HTTP_OK);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json('Post successfully deleted.', Response::HTTP_OK);
    }



}
