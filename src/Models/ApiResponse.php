<?php

namespace App\Models;

use DateTime;

class ApiResponse
{
    private mixed $data;

    private bool $status = false;

    private ?string $error;

    private \DateTimeInterface $date;

    public function __construct(mixed $data = null, ?string $error = null)
    {
        $this->setDate(new DateTime());
        if($data){
            $this->setStatus(true);
            $this->setData($data);
        }
        if($error){
            $this->setStatus(false);
            $this->setError($error);
        }
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     */
    public function setDate(\DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param string|null $error
     */
    public function setError(?string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed|null
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed|null $data
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }
}