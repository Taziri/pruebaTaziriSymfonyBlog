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

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string|null
     */
    public function getSuite(): ?string
    {
        return $this->suite;
    }

    /**
     * @param string|null $suite
     */
    public function setSuite(?string $suite): void
    {
        $this->suite = $suite;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     */
    public function setZipcode(?string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return Geo|null
     */
    public function getGeo(): ?Geo
    {
        return $this->geo;
    }

    /**
     * @param Geo|null $geo
     */
    public function setGeo(?Geo $geo): void
    {
        $this->geo = $geo;
    }

}