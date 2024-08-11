<?php

namespace App\Repositories;

// use App\Models\Permision;
// use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Permision::class;
    }

    public function storeRole($request)
    {
        $adminRole = Role::create(['name' => $request->role]);
        return ['data' => [], 'message' => "Role created successfuly", 'status' => true];
    }

    public function storePermission($request)
    {
        $editArticles = Permission::create(['name' => $request->permission]);
        return ['data' => [], 'message' => "Permission created successfuly", 'status' => true];
    }

    public function assignPermissionToRole($request)
    {
        $getRole = Role::where('id', $request->roleId)->first();
        if(empty($getRole)) 
        {
           return ['data' => [], 'message' => "Role not found", 'status' => false];
        }
        $getPermission = Permission::where('id', $request->permissionId)->first();
        if(empty($getPermission)) 
        {
           return ['data' => [], 'message' => "Permission not found", 'status' => false];
        }
        $adminRole->givePermissionTo($getPermission->name);
        return ['data' => [], 'message' => "Permission assigned successfuly", 'status' => true];
    }

    public function assignRolesToUsers($request)
    {
        $getRole = Role::where('id', $request->roleId)->first();
        if(empty($getRole)) 
        {
           return ['data' => [], 'message' => "Role not found", 'status' => false];
        }
        $user = User::where('id', $request->userId)->first();
        if(empty($user)) 
        {
           return ['data' => [], 'message' => "User not found", 'status' => false];
        }
        $user->assignRole($getRole->name);
        return ['data' => [], 'message' => "Permission assigned successfuly", 'status' => true];
    }
}
