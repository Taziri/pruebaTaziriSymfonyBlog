<?php

namespace App\Interface;

use App\Entity\Author;
use App\Entity\Post;
use Symfony\Component\Serializer\SerializerInterface;

interface SerializerServiceInterface
{
    public function __construct(SerializerInterface $serializer);

    /**
     * @return Post[]
     *
     * @throws \Exception
     */
    public function unSerializePostList(string $postJson): array;

    public function deserializePost(string $postJson): Post;

    public function deserializeAuthor(string $postJson): Author;
}
