<?php

namespace App\Form;

use App\Entity\Vetement;
use App\Entity\Couleur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VetementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('id_color',EntityType::class,[
                'class' => Couleur::class,
                'choice_label' => 'Color_name',
                'mapped' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vetement::class,
        ]);
    }
}
