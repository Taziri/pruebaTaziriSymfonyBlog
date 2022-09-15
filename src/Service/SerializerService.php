<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Post;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerService
{
    private SerializerInterface $serializer;
    public function __construct(SerializerInterface $serializer){
        $this->serializer = $serializer;
    }

    /**
     * @param string $postJson
     * @return Post[]
     * @throws \Exception
     */
    function unSerializePostList(string $postJson): array
    {
        $postListArray = json_decode($postJson);
        $posts = [];
        foreach($postListArray as $postArray){
            $stringPost = json_encode($postArray);
            if($stringPost) {
                $posts[] = $this->deserializePost($stringPost);
            }else{
                throw new \Exception('Error post format');
            }
        }
        return $posts;
    }

    function deserializePost(string $postJson): Post
    {
        return $this->serializer->deserialize($postJson, Post::class, 'json');
    }

    function deserializeAuthor(string $postJson): Author
    {
        return $this->serializer->deserialize($postJson, Author::class, 'json');
    }
}