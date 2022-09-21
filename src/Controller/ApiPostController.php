<?php

namespace App\Controller;

use App\Entity\Post;
use App\Interface\HttpServiceInterface;
use App\Interface\SerializerServiceInterface;
use App\Models\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

use OpenApi\Attributes as OA;

class ApiPostController extends AbstractController
{
    #[OA\Response(
        response: 200,
        description: 'Returns Post list',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Post::class))
        )
    )]
    #[Route('/api/posts', name: 'api_post_list', methods: ['GET'])]
    public function list(HttpServiceInterface $httpService, SerializerServiceInterface $serializerService): Response
    {
        try {
            $postResponse = $httpService->getPostList();
            if (Response::HTTP_OK == $postResponse->getStatusCode()) {
                $content = $postResponse->getContent();
                $posts = $serializerService->unSerializePostList($content);
                $posts = $httpService->updateAuthors($posts);
                $response = new ApiResponse($posts);

                return $this->json($response);
            } else {
                $error = new \Exception('Error post request');
            }
        } catch (ClientExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|
        TransportExceptionInterface|\Exception $e) {
            $error = $e;
        }

        return $this->json(new ApiResponse(null, $error->getTraceAsString()));
    }

    #[OA\Response(
        response: 200,
        description: 'Returns Post added',
        content:  new OA\JsonContent(
            ref: new Model(type: Post::class)
        )
    )]
    #[OA\RequestBody(
        description: 'Post json to save',
        required: true,
        content: new OA\JsonContent(ref: new Model(type: Post::class))
    )]
    #[Route('/api/post', name: 'api_post_save', methods: ['POST'])]
    public function save(Request $request, SerializerServiceInterface $serializerService, ValidatorInterface $validator): Response
    {
        try {
            $contentString = $request->getContent();
            if ($contentString && is_string($contentString)) {
                $post = $serializerService->deserializePost($contentString);
                $errorList = $validator->validate($post);
                if ($errorList->count() > 0) {
                    $errorMessage = '';
                    for ($i = 0; $i < $errorList->count(); ++$i) {
                        $fieldName = $errorList->get($i)->getPropertyPath();
                        $errorMessage .= "($fieldName) ".$errorList->get($i)->getMessage();
                    }

                    return $this->json(new ApiResponse(null, $errorMessage));
                }
                // En este punto, sería el momento de hacer persist y flush en la base de datos.
                return $this->json(new ApiResponse($post));
            } else {
                return $this->json(new ApiResponse(null, 'No content found'));
            }
        } catch (\Exception $e) {
            return $this->json(new ApiResponse(null, $e->getMessage()));
        }
    }
}
