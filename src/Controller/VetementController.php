<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; 
use App\Form\VetementType;
use App\Repository\CouleurRepository;
use App\Entity\Vetement;

class VetementController extends AbstractController
{
    /**
     * @Route("/", name="vetementHome")
     */
    public function index()
    {
        return $this->render('vetement/index.html.twig', [
            'controller_name' => 'VetementController',
        ]);
    }

    /**
     * @Route("/{token}/insert/{vetement}/{color}", name="vetementEdit")
     * @Route("/{token}/newVetement", name="vetementNew")
     */
    public function VetementForm(Vetement $vetement = null, Request $request, EntityManagerInterface $manager, CouleurRepository $repoColor)
    {
        if (!$vetement)
        {
            $vetement = new Vetement();
        }
        
        $form = $this->createForm(VetementType::class, $vetement); 
        $form->handleRequest($request);             
        // dd($form);

        if ($form->isSubmitted() && $form->isValid()) {
            $vetement->setIdcolor($form->get('id_color')->getData());
            $manager->persist($vetement);            
            $manager->flush();                  
            
            return $this->redirectToRoute('vetementHome', ['id' => $vetement->getId()]);
        }
        
        return $this->render('vetement/newvetement.html.twig', [
            'formVetement' => $form->createView(),       
            'editMode' => $vetement->getId() !== null   
        ]);
    }
    
}
