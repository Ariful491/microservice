<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index()
    {
        \Gate::authorize('view', 'users');
        $users = User::paginate();
        return UserResource::collection($users);
    }

    /**
     * @param int $id
     * @return UserResource
     */
    public function show(int $id)
    {
        $user = User::query()->findorFail($id);
        return new UserResource($user);
    }

    /**
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request): Response
    {
        \Gate::authorize('edit', 'users');
        $data = $request->only('first_name', 'last_name', 'email', 'role_id');
        $data['password'] = 12345;
        $user = new User();
        $user->fill($data);
        $user->save();

        return response(new UserResource($user), Response::HTTP_CREATED);

    }

    /**
     * @param UserRequest $request
     * @param int $id
     * @return Response
     */

    public function update(UserRequest $request, int $id): Response
    {
        \Gate::authorize('edit', 'users');
        $user = User::query()->findorFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        if ($request->has('password')) {
            $user->password = 12345;
        }
        $user->update();
        return response(new UserResource($user), Response::HTTP_ACCEPTED);

    }

    /**
     * @param int $id
     * @return Response
     */

    public function destroy(int $id): Response
    {
        \Gate::authorize('edit', 'users');
        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function user()
    {
        $user = auth()->user();
        return (new UserResource($user))->additional([
            'data' => [
                'permissions' => $user->permissions(),

            ]
        ]);
    }

    public function updateInfo(\Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->update();
        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function updatePassword(\Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->password = $request->input('password');
        $user->update();
        return response(new UserResource($user), Response::HTTP_ACCEPTED);

    }


}
