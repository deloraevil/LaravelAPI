<?php

namespace App\DTO\User;

readonly class UpdateUserDTO
{
    public function __construct(public array $data){ }

    public function toArray(): array
    {
        return $this->data;
    }
}
