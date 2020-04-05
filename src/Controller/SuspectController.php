<?php

namespace App\Controller;

use App\Entity\Suspect;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\SecurityService;
use App\Services\JsonEncodeService;
use Doctrine\ORM\EntityManagerInterface;

class SuspectController extends AbstractController
{
    /**
     * @Route("{token}/suspects", name="supects")
     */
    public function findAll(EntityManagerInterface $em, SecurityService $secu, JsonEncodeService $JSEncode,$token)
    {

        $autorise = $secu->CheckToken($token);
        if(!is_bool($autorise)) {
            return $autorise;
        }

        $repSuspect = $this->getDoctrine()->getRepository(Suspect::Class);
        //objet coupable a serialize avant suspect
        $suspects = $repSuspect->findAll(); 
       
        $res = $JSEncode->JsonResponse($suspects);

        // dd($res);
        return $res;
    }

    /**
     * @Route("{token}/supects/genre/{genre}/age/{age}", name="supectsGenreAgeSup")
     */
    public function findByGenreAgeSup(EntityManagerInterface $em, SecurityService $secu, JsonEncodeService $JSEncode, $token, $genre, $age)
    {
        $autorise = $secu->CheckToken($token);
        if(!is_bool($autorise)) {
            return $autorise;
        }

        $repSuspect = $this->getDoctrine()->getRepository(Suspect::Class);
        $Suspects = $repSuspect->findByGenreAgeSup($genre, $age);
        if ($Suspects == []){
            $response = new Response();
            $response->setContent(json_encode([
            'error' => 'error',
            'resultat' => false,
            'errorMessage' => "Suspect du genre ". $genre . " et de l'age superieur a " . $age . " n'existe pas.",
            ]));

            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } 
        else {
            $res = $JSEncode->JsonResponse($Suspects);
            return $res;
        }
        

    }

}
