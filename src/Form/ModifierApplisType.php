<?php

namespace App\Form;

use App\Entity\AMOAENTITE;
use App\Entity\AMOAEQUIPE;
use App\Entity\AMOAPOLE;
use App\Entity\MOA;
use App\Entity\MOE;
use App\Entity\MOEEXT;
use App\Entity\MOEINT;
use App\Entity\REGROUPEMENT;
use App\Entity\STATUT;
use App\Entity\UTILISATEURS;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ModifierApplisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('APPLICATION', TextType::class, [
                'mapped' => true,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Application',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un nom d\'Application'
                    ])
                ]
            ])
            ->add('VERSION', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Numéro de version',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_MOA', EntityType::class, [
                'class' => MOA::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'MOA',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('FINALITE', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Finalité',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DESCRIPTION', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('ID_POLE', EntityType::class, [
                'class' => AMOAPOLE::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Pôle AMOA',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_ENTITE', EntityType::class, [
                'class' => AMOAENTITE::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Entité AMOA',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_EQUIPE', EntityType::class, [
                'class' => AMOAEQUIPE::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Equipe AMOA',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('CONTACT', EntityType::class, [
                'class' => UTILISATEURS::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Contact AMOA',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_MOE', EntityType::class, [
                'class' => MOE::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'MOE',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_MOE_EXT', EntityType::class, [
                'class' => MOEEXT::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'MOE externe',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_MOE_INT', EntityType::class, [
                'class' => MOEINT::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'MOE interne',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_STATUT', EntityType::class, [
                'class' => STATUT::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Statut',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_REG', EntityType::class, [
                'class' => REGROUPEMENT::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Regroupement par domaine',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_ADM', EntityType::class, [
                'class' => UTILISATEURS::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Admin',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('COMMENTAIRES', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Commentaire(s)',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
