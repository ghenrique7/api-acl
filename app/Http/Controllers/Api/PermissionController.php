<?php

namespace App\Http\Controllers\Api;

use App\DTO\Permission\EditPermissionDTO;
use App\DTO\Permission\CreatePermissionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePermissionRequest;
use App\Http\Requests\Api\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = $this->permissionRepository->getPaginate(
            totalPerPage: $request->total_per_page ?? 15,
            page: $request->page ?? 1,
            filter: $request->get('filter', '')
        );

        return PermissionResource::collection($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = $this->permissionRepository->createNew(
            new CreatePermissionDTO(...$request->validated())
        );

        return new PermissionResource($permission);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$permission = $this->permissionRepository->findById($id)) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        return new PermissionResource($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        $response = $this->permissionRepository->update(new EditPermissionDTO(... [$id, ...$request->validated()]));
        if (!$response) {
            return response()->json(['message' => 'User not updated.'], 404);
        }

        return response()->json(['message' => 'permission updated with access']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->permissionRepository->delete($id);
        if (!$response) {
            return response()->json(['message' => 'User not deleted.'], 404);
        }

        return response()->json([], 204);
    }
}
