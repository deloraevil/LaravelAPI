<?php

namespace App\Services\User;

use App\DTO\User\StoreUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function create(StoreUserDTO $storeUserDTO): User
    {
        return User::create($storeUserDTO->toArray());
    }

    public function getUser(User $user) :User
    {
        return $user;
    }

    public function update(UpdateUserDTO $updateUserDTO, User $user): User
    {
        $user->update($updateUserDTO->toArray());
        return $user->refresh();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
