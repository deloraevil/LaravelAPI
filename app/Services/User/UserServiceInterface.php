<?php

namespace App\Services\User;
use App\DTO\User\StoreUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getAllUsers() :Collection;

    public function create(StoreUserDTO $storeUserDTO) :User;

    public function getUser(User $user) :User;

    public function update(UpdateUserDTO $updateUserDTO, User $user) :User;

    public function delete(User $user) :void;
}
