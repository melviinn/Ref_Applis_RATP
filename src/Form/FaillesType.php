<?php

namespace App\Form;

use App\Entity\APPLICATIONS;
use App\Entity\FAILLES;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FaillesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ID_APPLICATION', EntityType::class, [
                'class' => APPLICATIONS::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => ' mb-3'
                ],
                'label' => 'Applications impactées',
                'label_attr' => [
                    'class' => 'checkbox-inline'
                ],
                'required' => false,
            ])
            ->add('LIB_FAILLE', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Libellé de la faille',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('COMP_FAILLE', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Composant impacté',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DATE_FAILLE', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date d\'identification de la faille',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('STATUT', ChoiceType::class, [
                'choices' => [
                    'En cours' => 'En cours',
                    'A traiter' => 'A traiter',
                    'Traité' => 'Traité'
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Statut du traitement',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DATE_FERMETURE', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date de fermeture du traitement',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FAILLES::class
        ]);
    }

    public function getName()
    {
        return 'faille';
    }
}
