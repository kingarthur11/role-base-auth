<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePermisionAPIRequest;
use App\Http\Requests\API\UpdatePermisionAPIRequest;
use App\Models\Permision;
use App\Repositories\PermisionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermisionAPIController
 */
class PermisionAPIController extends AppBaseController
{
    private PermisionRepository $permisionRepository;

    public function __construct(PermisionRepository $permisionRepo)
    {
        $this->permisionRepository = $permisionRepo;
    }

    /**
     * Display a listing of the Permisions.
     * GET|HEAD /permisions
     */
    public function index(Request $request): JsonResponse
    {
        $permisions = $this->permisionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($permisions->toArray(), 'Permisions retrieved successfully');
    }

    /**
     * Store a newly created Permision in storage.
     * POST /permisions
     */
    public function storeRole(Request $request): JsonResponse
    {
        $response = $this->userbrtRepository->storeRole($request);
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
     * Store a newly created Permision in storage.
     * POST /permisions
     */
    public function storePermission(Request $request): JsonResponse
    {
        $response = $this->userbrtRepository->storePermission($request);
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
     * Store a newly created Permision in storage.
     * POST /permisions
     */
    public function assignPermissionToRole(Request $request): JsonResponse
    {
        $response = $this->userbrtRepository->assignPermissionToRole($request);
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
     * Store a newly created Permision in storage.
     * POST /permisions
     */
    public function assignRolesToUsers(Request $request): JsonResponse
    {
        $response = $this->userbrtRepository->assignRolesToUsers($request);
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
     * Store a newly created Permision in storage.
     * POST /permisions
     */
    public function store(CreatePermisionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $permision = $this->permisionRepository->create($input);

        return $this->sendResponse($permision->toArray(), 'Permision saved successfully');
    }

    /**
     * Display the specified Permision.
     * GET|HEAD /permisions/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Permision $permision */
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            return $this->sendError('Permision not found');
        }

        return $this->sendResponse($permision->toArray(), 'Permision retrieved successfully');
    }

    /**
     * Update the specified Permision in storage.
     * PUT/PATCH /permisions/{id}
     */
    public function update($id, UpdatePermisionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Permision $permision */
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            return $this->sendError('Permision not found');
        }

        $permision = $this->permisionRepository->update($input, $id);

        return $this->sendResponse($permision->toArray(), 'Permision updated successfully');
    }

    /**
     * Remove the specified Permision from storage.
     * DELETE /permisions/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Permision $permision */
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            return $this->sendError('Permision not found');
        }

        $permision->delete();

        return $this->sendSuccess('Permision deleted successfully');
    }
}
