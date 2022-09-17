<?php

namespace App\Models;

use Symfony\Component\Validator\Constraints as Assert;

class Address
{
    #[Assert\NotNull]
    private ?string $street = '';

    #[Assert\NotNull]
    private ?string $suite = '';

    #[Assert\NotNull]
    private ?string $city = '';

    #[Assert\NotNull]
    private ?string $zipcode;

    private ?Geo $geo;

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getSuite(): ?string
    {
        return $this->suite;
    }

    public function setSuite(?string $suite): void
    {
        $this->suite = $suite;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    public function getGeo(): ?Geo
    {
        return $this->geo;
    }

    public function setGeo(?Geo $geo): void
    {
        $this->geo = $geo;
    }
}
