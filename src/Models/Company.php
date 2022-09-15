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

    /**
     * @return string|null
     */
    public function getCatchPhrase(): ?string
    {
        return $this->catchPhrase;
    }

    /**
     * @param string|null $catchPhrase
     */
    public function setCatchPhrase(?string $catchPhrase): void
    {
        $this->catchPhrase = $catchPhrase;
    }

    /**
     * @return string|null
     */
    public function getBs(): ?string
    {
        return $this->bs;
    }

    /**
     * @param string|null $bs
     */
    public function setBs(?string $bs): void
    {
        $this->bs = $bs;
    }

}