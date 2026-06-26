<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function __construct(
        private RouterInterface $router,
        private RequestStack $requestStack
    ) {}

    public function handle(Request $request, AccessDeniedException $exception): RedirectResponse
        {
            $request->getSession()->set('_error_message', "Vous n'avez pas les droits pour accéder à cette page.");
            return new RedirectResponse($this->router->generate('app_accueil_number'));
        }
}