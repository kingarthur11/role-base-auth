<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCommentAPIRequest;
use App\Http\Requests\API\UpdateCommentAPIRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CommentAPIController
 */
class CommentAPIController extends AppBaseController
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepository = $commentRepo;
    }

    /**
     * Display a listing of the Post.
     * GET|HEAD /post
     */
    public function index(Request $request)
    {
        $response = $this->commentRepository->getAllComment();
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
    public function store(CreateCommentAPIRequest $request)
    {
        $response = $this->commentRepository->createComment($request);
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
        $response = $this->commentRepository->getOneComment($id);
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
        return $response = $this->commentRepository->updateComment($request, $id);
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
        $response = $this->commentRepository->destroyComment($id);
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
