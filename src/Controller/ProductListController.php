<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ProductListController extends AbstractController
{
    #[Route('/product/list', name: 'app_product_list')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductListController.php',
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function getProductById(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Привет',
            'path' => 'src/Controller/ProductListController.php',
        ]);
    }
}
