<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VetementRepository;
use App\Repository\CouvreChefRepository;
use App\Repository\SuspectRepository;
use App\Services\SecurityService;
use App\Entity\Coupable;
use App\Entity\Suspect;
use App\Entity\Vetement;
use App\Entity\CouvreChef;

class CoupableController extends AbstractController
{
    /**
     * @Route("/{token}/coupable/insert/{suspectId}/{sessionToken}/{prenom}", name="coupableInsert")
     * @Route("/{token}/coupable/insert/{suspectId}", name="coupableInsertPost", methods={"GET"})
     */
    public function coupableInsert(SecurityService $secu, EntityManagerInterface $em, 
    $token, $suspectId, $sessionToken = 0, $prenom = 0)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        // vérification de l'accès
        $autorise = $secu->CheckToken($token);

        if(!is_bool($autorise)) {
            return $autorise;
        }

        $repVet = $this->getDoctrine()->getRepository(Vetement::Class);
        $vet1 = new Vetement();
        $vet1 = $repVet->find(1);
        
        $vet2 = new Vetement();
        $vet2 = $repVet->find(2);

        $repCC = $this->getDoctrine()->getRepository(CouvreChef::Class);
        $couvreChef = new CouvreChef();
        $idCC = random_int(1,2);
        $couvreChef = $repCC->find($idCC);

        $repSuspect = $this->getDoctrine()->getRepository(Suspect::Class);
        $suspect = new Suspect();
        $suspect = $repSuspect->find($suspectId);

        $coupable = new Coupable();

        if ($method = "POST") {
            $coupable->setPrenom($_POST["prenom"])
            ->setSessionToken($_POST["sessionToken"]);
        }
        else {
            $coupable->setPrenom($prenom)
            ->setSessionToken($sessionToken);
        }
       
            $coupable->addVetement($vet1)
            ->addVetement($vet2)
            ->setCouvreChef($couvreChef)
            ->setSuspect($suspect)
        ;    

        $em->persist($coupable);
        $em->flush();

        // Encodage du vetement en json
        $response = new Response();
        $response->setContent(json_encode([
            'operation' => 'insert',
            'result' => true,
            'type_objet' => 'vetement',
            'id_objet' => $coupable->getId(),
        ]));

        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
}
