<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

/**
 * Class PostAPIController
 */
class PostAPIController extends AppBaseController
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     * GET|HEAD /post
     */
    public function index(Request $request)
    {
        $response = $this->postRepository->getAllPost();
        if ($response['status']) {
            return response()->json([
                'data' => $response['data'],
                'message' => $response['message'],
                'status' => true
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $response['message'],
                'data' => $response['data'],
                'status' => false
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Store a newly created Post in storage.
     * POST /post
     */
    public function store(CreatePostAPIRequest $request)
    {
        $response = $this->postRepository->createPost($request);
        if ($response['status']) {
            return response()->json([
                'data' => $response['data'],
                'message' => $response['message'],
                'status' => true
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => $response['message'],
                'data' => $response['data'],
                'status' => false
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Display the specified Post.
     * GET|HEAD /post/{id}
     */
    public function show($id)
    {
        $response = $this->postRepository->getOnePost($id);
        if ($response['status']) {
            return response()->json([
                'data' => $response['data'],
                'message' => $response['message'],
                'status' => true
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $response['message'],
                'data' => $response['data'],
                'status' => false
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified Post in storage.
     * PUT/PATCH /post/{id}
     */
    public function update($id, Request $request)
    {
        return $response = $this->postRepository->updatePost($request, $id);
        if ($response['status']) {
            return response()->json([
                'data' => $response['data'],
                'message' => $response['message'],
                'status' => true
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $response['message'],
                'data' => $response['data'],
                'status' => false
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified Post from storage.
     * DELETE /post/{id}
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->postRepository->destroyPost($id);
        if ($response['status']) {
            return response()->json([
                'data' => $response['data'],
                'message' => $response['message'],
                'status' => true
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $response['message'],
                'data' => $response['data'],
                'status' => false
            ], Response::HTTP_NOT_FOUND);
        }
    }

}
