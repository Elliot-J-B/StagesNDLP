<?php
// src/Controller/AccueilController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{   
    #[Route('/dashboard')]
    #[IsGranted('ROLE_TEACHER')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('dashboard/index.html.twig');
        
    }
}