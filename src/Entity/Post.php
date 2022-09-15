<?php

namespace App\Entity;

// use App\Repository\FooterRepository;
// use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/*
 *
 */

use Doctrine\Common\Collections\ArrayCollection;

class Post
{

    /*
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /*
     * @ORM\Column(type="string", length=255)
     */
    private ?int $userId;

    /*
     * ManyToOne
     */
    private ?Author $author;

    /*
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 50)]
    private string $title;

    /*
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 250)]
    private string $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return Author|null
     */
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): void
    {
        $this->author = $author;
    }

}