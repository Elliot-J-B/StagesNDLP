<?php
// src/Controller/Page1Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Page1Controller extends AbstractController
{   
    #[Route('/page1')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('page1/index.html.twig');
        
    }
}