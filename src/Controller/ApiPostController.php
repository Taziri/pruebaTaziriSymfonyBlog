<?php

namespace App\Controller;

use App\Models\ApiResponse;
use App\Service\HttpService;
use App\Service\SerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiPostController extends AbstractController
{
    #[Route('/api/posts', name: 'api_post_list', methods: ["GET"])]
    public function index(HttpService $httpService, SerializerService $serializerService): Response
    {
        try{
            $postResponse = $httpService->getPostList();
            if($postResponse->getStatusCode() == Response::HTTP_OK){
                $content = $postResponse->getContent();
                $posts = $serializerService->unSerializePostList($content);
                $posts = $httpService->updateAuthors($posts);
                $response = new ApiResponse($posts);
                return $this->json($response);
            }else{
                $error = new \Exception('Error post request');
            }
        } catch (ClientExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|
        TransportExceptionInterface|\Exception $e) {
            $error = $e;
        }
        return $this->json(new ApiResponse(null, $error->getTraceAsString()));
    }

    #[Route('/api/post', name: 'api_post_save', methods: ["POST"])]
    public function save(Request $request, SerializerService $serializerService,ValidatorInterface $validator): Response
    {
        try{
            $contentString = $request->getContent();
            if($contentString && is_string($contentString)){
                $post = $serializerService->deserializePost($contentString);
                $errorList = $validator->validate($post);
                if($errorList->count() > 0){
                    $errorMessage = '';
                    for ($i=0;$i<$errorList->count();$i++){
                        $fieldName = $errorList->get($i)->getPropertyPath();
                        $errorMessage .= "($fieldName) ".$errorList->get($i)->getMessage();
                    }
                    return $this->json(new ApiResponse(null, $errorMessage));
                }
                //En este punto, sería el momento de hacer persist y flush en la base de datos.
                return $this->json(new ApiResponse($post));
            }else{
                return $this->json(new ApiResponse(null, 'No content found'));
            }
        }catch (\Exception $e){
            return $this->json(new ApiResponse(null, $e->getMessage()));
        }
    }
}