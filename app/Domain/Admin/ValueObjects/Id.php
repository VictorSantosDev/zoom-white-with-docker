<?php

namespace App\Domain\Admin\ValueObjects;

class Id
{
    public function __construct(
        private ?int $id
    ) {
    }

    public function getId()
    {
        return $this->id;
    }
}
