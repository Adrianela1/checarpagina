<?php

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTNotFoundListener extends AbstractController {
    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $data = [
            'status'  => '403 Forbidden',
            'message' => 'Missing token',
        ];

        // $response = new JsonResponse($data, 403);
        $response = $this->render('errors/error401.html.twig');

        $event->setResponse($response);
    }

}