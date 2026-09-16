<?php

namespace App\DTO\User;

readonly class StoreUserDTO
{
    public function __construct(
        public string $name,
        public string $surname,
        public string $phone,
        public ?string $img_path=null,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'img_path' => $this->img_path,
        ];
    }
}
