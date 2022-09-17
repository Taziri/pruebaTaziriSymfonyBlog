<?php

namespace App\Models;

use Symfony\Component\Validator\Constraints as Assert;

class Company
{
    #[Assert\NotNull]
    private ?string $name = '';

    #[Assert\NotNull]
    private ?string $catchPhrase = '';

    #[Assert\NotNull]
    private ?string $bs = '';

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCatchPhrase(): ?string
    {
        return $this->catchPhrase;
    }

    public function setCatchPhrase(?string $catchPhrase): void
    {
        $this->catchPhrase = $catchPhrase;
    }

    public function getBs(): ?string
    {
        return $this->bs;
    }

    public function setBs(?string $bs): void
    {
        $this->bs = $bs;
    }
}
