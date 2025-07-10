<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        \Gate::authorize('view', 'roles');
        return RoleResource::collection(Role::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Gate::authorize('edit', 'roles');
        $role = Role::create($request->only("name"));
        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permissionId) {
                DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }
        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        \Gate::authorize('view', 'roles');
        $role = Role::query()->findorFail($id);
        return response(new RoleResource($role), Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        \Gate::authorize('edit', 'roles');
        $role = Role::query()->findorFail($id);
        $role->update($request->only("name"));

        DB::table('role_permission')->where('role_id', $id)->delete();

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permissionId) {
                DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        return response(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        \Gate::authorize('edit', 'roles');
        DB::table('role_permission')->where('role_id', $id)->delete();
        $role = Role::query()->findorFail($id);
        $role->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
