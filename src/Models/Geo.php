<?php

namespace App\Models;

// use App\Repository\FooterRepository;
// use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/*
 *
 */
class Geo
{
    #[Assert\NotNull]
    private ?string $lat = '';

    #[Assert\NotNull]
    private ?string $lng = '';

    /**
     * @return string|null
     */
    public function getLat(): ?string
    {
        return $this->lat;
    }

    /**
     * @param string|null $lat
     */
    public function setLat(?string $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return string|null
     */
    public function getLng(): ?string
    {
        return $this->lng;
    }

    /**
     * @param string|null $lng
     */
    public function setLng(?string $lng): void
    {
        $this->lng = $lng;
    }

}