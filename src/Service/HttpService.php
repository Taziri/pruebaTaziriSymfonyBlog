<?php

namespace App\Service;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

const HTTP_METHOD_GET = 'GET';
const HTTP_METHOD_POST = 'POST';

const API_URL_BASE_USERS = 'https://jsonplaceholder.typicode.com/users';
const API_URL_BASE_POSTS = 'https://jsonplaceholder.typicode.com/posts';

class HttpService
{
    private HttpClientInterface $client;
    private SerializerService $serializerService;

    public function __construct(HttpClientInterface $client, SerializerService $serializerService)
    {
        $this->client = $client;
        $this->serializerService = $serializerService;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getPostList(): ResponseInterface
    {
        return $this->client->request(
            HTTP_METHOD_GET,
            API_URL_BASE_POSTS
        );
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getPostElement(int $id): ResponseInterface
    {
        return $this->client->request(
            HTTP_METHOD_GET,
            API_URL_BASE_POSTS."/$id"
        );
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getAuthor(int $id): ResponseInterface
    {
        return $this->client->request(
            HTTP_METHOD_GET,
            API_URL_BASE_USERS."/$id"
        );
    }

    /**
     * @param Post[] $posts
     *
     * @return Post[]
     *
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function updateAuthors(array $posts): array
    {
        foreach ($posts as $post) {
            $authorJson = $this->getAuthor($post->getUserId());
            if (Response::HTTP_OK == $authorJson->getStatusCode()) {
                $author = $this->serializerService->deserializeAuthor($authorJson->getContent());
                $post->setAuthor($author);
            }
        }

        return $posts;
    }
}
