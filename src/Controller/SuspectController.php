<?php

namespace App\Controller;

use App\Entity\Suspect;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\SecurityService;
use Doctrine\ORM\EntityManagerInterface;

class SuspectController extends AbstractController
{
    /**
     * @Route("{token}/supects", name="supects")
     */
    public function findAll(EntityManagerInterface $em, SecurityService $secu, $token)
    {
        $autorise = $secu->CheckToken($token);
        if(!is_bool($autorise)) {
            return $autorise;
        }
        
        $repSuspect = $this->getDoctrine()->getRepository(Suspect::Class);
        $Suspects = $repSuspect->findAll(); 
       
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        
        $jsonContent = $serializer->serialize($Suspects, 'json');


       // Encodage du vetement en json
       $response = new Response();
       $response->setContent($jsonContent);

       $response->headers->set('Content-Type', 'application/json');
       # voir aussi use Symfony\Component\HttpFoundation\JsonResponse;

       return $response;
    }
}
