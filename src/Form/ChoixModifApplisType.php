<?php

namespace App\Form;

use App\Entity\APPLICATIONS;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoixModifApplisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NOM_APPLICATION', EntityType::class, [
                'attr' => [
                    'class' => 'form-control mb-3 ml-4'
                ],
                'class' => APPLICATIONS::class,
                'label' => false,
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
