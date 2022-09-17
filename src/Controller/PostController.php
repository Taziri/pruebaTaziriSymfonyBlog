<?php

namespace App\Controller;

use App\Service\HttpService;
use App\Service\SerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PostController extends AbstractController
{
    #[Route('/', name: 'post_index', methods: ['GET'])]
    public function index(HttpService $httpService, SerializerService $serializerService): Response
    {
        try {
            $response = $httpService->getPostList();
            if (Response::HTTP_OK == $response->getStatusCode()) {
                $content = $response->getContent();
                $posts = $serializerService->unSerializePostList($content);

                return $this->render('post/index.html.twig', ['posts' => $posts]);
            } else {
                $error = new \Exception('Error post request');
            }
        } catch (ClientExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|
                        TransportExceptionInterface|\Exception $e) {
                            $error = $e;
                        }

        return $this->render('errors/error.html.twig', ['error' => $error]);
    }

    #[Route('/show/{id}', name: 'post_show', methods: ['GET'])]
    public function show(int $id, HttpService $httpService, SerializerService $serializerService): Response
    {
        try {
            $postJson = $httpService->getPostElement($id);
            if (Response::HTTP_OK == $postJson->getStatusCode()) {
                $post = $serializerService->deserializePost($postJson->getContent());
                $authorJson = $httpService->getAuthor($post->getUserId());
                if (Response::HTTP_OK == $authorJson->getStatusCode()) {
                    $author = $serializerService->deserializeAuthor($authorJson->getContent());

                    return $this->render('post/show.html.twig', ['post' => $post, 'author' => $author]);
                }
                $error = "We can't find this author";
            } else {
                $error = 'This post does not exist';
            }
        } catch (ClientExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|
        TransportExceptionInterface|\Exception $e) {
            $error = $e;
        }

        return $this->render('errors/error.html.twig', ['error' => $error]);
    }
}
