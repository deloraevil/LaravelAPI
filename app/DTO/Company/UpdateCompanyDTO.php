<?php

namespace App\DTO\Company;

readonly class UpdateCompanyDTO
{
    public function __construct(public array $data) {

    }

    public function toArray(): array
    {
        return $this->data;
    }
}
