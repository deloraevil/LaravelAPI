<?php

namespace App\DTO\Company;

readonly class StoreCompanyDTO
{
    public function __construct(public string $name, public string $description, public ?string $img_path){

    }

    public function toArray(): array
    {
        return [
            'name'=>$this->name,
            'description'=>$this->description,
            'img_path'=>$this->img_path,
        ];
    }
}
