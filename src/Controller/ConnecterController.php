<?php
// src/Controller/ConnecterController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnecterController extends AbstractController
{   
    #[Route('/connecter')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('connecter/index.html.twig');
        
    }
}