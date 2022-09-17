<?php

namespace App\Models;

use Symfony\Component\Validator\Constraints as Assert;

class Geo
{
    #[Assert\NotNull]
    private ?string $lat = '';

    #[Assert\NotNull]
    private ?string $lng = '';

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): void
    {
        $this->lat = $lat;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): void
    {
        $this->lng = $lng;
    }
}
