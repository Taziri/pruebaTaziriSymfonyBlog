<?php

namespace App\Interface;

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

interface HttpServiceInterface
{
    public function __construct(HttpClientInterface $client, SerializerServiceInterface $serializerService);

    /**
     * @throws TransportExceptionInterface
     */
    public function getPostList(): ResponseInterface;

    /**
     * @throws TransportExceptionInterface
     */
    public function getPostElement(int $id): ResponseInterface;

    /**
     * @throws TransportExceptionInterface
     */
    public function getAuthor(int $id): ResponseInterface;

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
    public function updateAuthors(array $posts): array;
}
