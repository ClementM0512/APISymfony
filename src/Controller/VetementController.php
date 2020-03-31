<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface; 
use App\Repository\CouleurRepository;
use App\Repository\VetementRepository;
use App\Services\SecurityService;
use App\Form\VetementType;
use App\Entity\Vetement;
use App\Entity\Couleur;

class VetementController extends AbstractController
{
    /**
     * @Route("/{token}/vetement/insert/{vetName}/{idColor}", name="InsertVetement")
     */
    public function insert(
        SecurityService $secu, 
        ValidatorInterface $validator, 
        EntityManagerInterface $entityManager, 
        $token, $vetName, $idColor): Response
    {
        // vérification de l'accès
        $autorise = $secu->CheckToken($token);

        if(!is_bool($autorise)) {
            return $autorise;
        }

        #$entityManager = $this->getDoctrine()->getManager();
        $vetement = new Vetement();
        $vetement->setNom($vetName);
        $vetement->setDescription("test");

        if($idColor == 0) {
            $idColor = random_int(1, 4);
        }
        // Récupération du dépôt de requete de Couleur
        $repCouleur = $this->getDoctrine()->getRepository(Couleur::Class);
        $couleur = $repCouleur->find($idColor);
        
        // Affectation à Vetement
        $vetement->setIdColor($couleur);

        $entityManager->persist($vetement);
        $entityManager->flush();

        // Encodage du vetement en json
        $response = new Response();
        $response->setContent(json_encode([
            'operation' => 'insert',
            'result' => true,
            'type_objet' => 'vetement',
            'id_objet' => $vetement->getId(),
        ]));

        $response->headers->set('Content-Type', 'application/json');
        # voir aussi use Symfony\Component\HttpFoundation\JsonResponse;

        return $response;
    }

    private function validationObjet($validator, Vetement $vet)
    {
        $errors = $validator->validate($vet);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }
    }

}
