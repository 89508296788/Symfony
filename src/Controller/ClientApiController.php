<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class ClientApiController extends AbstractController
{

    public function __construct(private readonly ClientRepository $repository )
    {

    }

    #[Route('/client', name: 'app_client_api')]
    public function index(): JsonResponse
    {
        $findAll = $this->repository->findAll();
        $result = [];
        /** @var Client $client */
        foreach ($findAll as $client){
            $result[]=$client->getLogin();


    }
        return new JsonResponse($result);
    }
}
