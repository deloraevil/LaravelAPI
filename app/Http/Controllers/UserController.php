<?php

namespace App\Http\Controllers;

use App\DTO\User\StoreUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;

class UserController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly UserServiceInterface $userService) {

    }

    public function index(): JsonResponse
    {
        return $this->withErrorHandling(function () {
            $users = $this->userService->getAllUsers();

            return $this->success(UserResource::collection($users));
        });
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->withErrorHandling(function () use ($request) {
            $img_path = null;

            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')->store('users', 'public');
            }

            $user = $this->userService->create(
                storeUserDTO: new StoreUserDTO(
                    name: $request->validated('name'),
                    surname: $request->validated('surname'),
                    phone: $request->validated('phone'),
                    img_path: $img_path,
                )
            );

            return $this->success(new UserResource($user));
        });
    }

    public function show(User $user): JsonResponse
    {
        return $this->withErrorHandling(function () use ($user) {
            $user = $this->userService->getUser(user: $user);

            return $this->success(new UserResource($user));
        });
    }

    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        return $this->withErrorHandling(function () use ($request, $user) {
            $data = $request->validated();

            if ($request->hasFile('img_path')){
                $data['img_path'] = $request->file('img_path')->store('users', 'public');
            }
            elseif ($request->has('img_path') && blank($request->input('img_path'))) {
                $data['img_path'] = null;}
            else{
                unset($data['img_path']);
            }


            $user = $this->userService->update(
                updateUserDTO: new UpdateUserDTO(data: $data),
                user: $user,
            );

            return $this->success(new UserResource($user));
        });
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->withErrorHandling(function () use ($user) {
            $this->userService->delete(user: $user);

            return $this->success([
                'id' => $user->id,
                'message' => 'Пользователь удалён',
            ]);
        });
    }
}
