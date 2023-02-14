<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    public $productRepo;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $products = $this->productRepo->findAll();
        $productBestSeller = $this->productRepo->findByIsBestSeller(1);
        $productSpecialOffer = $this->productRepo->findByIsSpecialOffer(1);
        $productNewArrival = $this->productRepo->findByIsNewArrival(1);
        $productFeatured = $this->productRepo->findByIsFeatured(1);
        
        return $this->render('home/index.html.twig',
            [
                'products'            => $products,
                'productBestSellers'   => $productBestSeller,
                'productSpecialOffers' => $productSpecialOffer,
                'productNewArrivals'   => $productNewArrival,
                'productFeatureds'     => $productFeatured
            ] 
        );
    }
}
