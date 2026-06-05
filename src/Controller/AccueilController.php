<?php
// src/Controller/AccueilController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{   
    #[Route('/')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('accueil/index.html.twig');
        
    }
}