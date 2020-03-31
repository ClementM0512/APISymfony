<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class SecurityService
{
    public function CheckToken($token)
    {
        if($token != 12345) {

            $response = new Response();
            $response->setContent(json_encode([
            'error' => 'error',
            'resultat' => false,
            'errorMessage' => 'Le token est invalide',
            ]));

            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {
            return true;
        }
    }
}