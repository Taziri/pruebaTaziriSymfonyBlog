<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Post;
use App\Interface\SerializerServiceInterface;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerService implements SerializerServiceInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return Post[]
     *
     * @throws \Exception
     */
    public function unSerializePostList(string $postJson): array
    {
        $postListArray = json_decode($postJson);
        $posts = [];
        foreach ($postListArray as $postArray) {
            $stringPost = json_encode($postArray);
            if ($stringPost) {
                $posts[] = $this->deserializePost($stringPost);
            } else {
                throw new \Exception('Error post format');
            }
        }

        return $posts;
    }

    public function deserializePost(string $postJson): Post
    {
        return $this->serializer->deserialize($postJson, Post::class, 'json');
    }

    public function deserializeAuthor(string $postJson): Author
    {
        return $this->serializer->deserialize($postJson, Author::class, 'json');
    }
}
