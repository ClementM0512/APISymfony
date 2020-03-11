<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface; 
use App\Repository\CouleurRepository;
use App\Repository\VetementRepository;
use App\Form\VetementType;
use App\Entity\Vetement;
use App\Entity\Couleur;

class VetementController extends AbstractController
{
    /**
     * @Route("/{token}/vetements", name="vetHome")
     */
    public function index(VetementRepository $vetRepo)
    {
        $vetement = $vetRepo->loadByAlphaOrder();

        return $this->render('vetement/index.html.twig', [
            'vetements' => $vetement
        ]);
    }

    /**
     * @Route("/{token}/vetement/show/{vetId}", name="vetShow")
     */
    public function patientShow($vetId)
    {
        $vetRepo = $this->getDoctrine()->getRepository(Vetement::class);
        $colorRepo = $this->getDoctrine()->getRepository(Couleur::class);
        
        $vetement = $vetRepo->find($vetId);

        $color = $colorRepo->find($vetement->getIdColor());

        return $this->render('vetement/vetShow.html.twig',[
            'vetement' => $vetement,
            'color'    => $color 
        ]);
    }

    /**
     * @Route("/{token}/vetement/edit/{vetId}/{color}", name="vetEdit")
     * @Route("/{token}/vetement/new", name="vetNew")
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
            
            return $this->redirectToRoute('vetHome',['token' => 1]);
        }
        
        return $this->render('vetement/newvetement.html.twig', [
            'formVetement' => $form->createView(),       
            'editMode' => $vetement->getId() !== null   
        ]);
    }
    
    /**
     * @Route("/{token}/vetement/{vetId}/{vetColorId}", name="vetDel")
     */
    public function vetementDelete(Vetement $vetement, Request $request, EntityManagerInterface $manager, $vetId, $vetColorId){

        $form = $this->createFormBuilder()
        ->add('Delete', SubmitType::class, ['label' => 'OUI, supprimer ce vêtement', 'attr' => ['class' => 'btn btn-danger btn-confirm']])
        ->add('NoDelete', SubmitType::class, ['label' => 'Retour', 'attr' => ['class' => 'btn btn-primary btn-confirm']])
        ->getForm();
        
        $form->handleRequest($request);

        if (($form->getClickedButton() && 'Delete' === $form->getClickedButton()->getName()))
        {
            $vetRepo = $this->getDoctrine()->getRepository(Vetement::class);
            $colorRepo = $this->getDoctrine()->getRepository(Couleur::class);

            $color = $colorRepo->find($vetColorId);
            $vetement = $vetRepo->findBy(
                ['Vetement' => $Vetement->getId()],
                ['colorName' => $color->getColorName()]
            );

            $manager->remove($vetement);        //Pour supprimer un article.
            $manager->flush();
            
            
            return $this->redirectToRoute('vetHome',['token' => 1]);
        }
        if (($form->getClickedButton() && 'NoDelete' === $form->getClickedButton()->getName()))
        {
            return $this->redirectToRoute('vetHome',['token' => 1]);
        }
        return $this->render('templateAPI/validation.html.twig', array('action' => $form->createView(), 'vetement' => $vetement));
        
    }
}
