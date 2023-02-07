<?php

namespace App\Form;

use App\Entity\AMOAENTITE;
use App\Entity\AMOAEQUIPE;
use App\Entity\AMOAPOLE;
use App\Entity\BRIQUES;
use App\Entity\CYBER;
use App\Entity\MOA;
use App\Entity\MOE;
use App\Entity\MOEEXT;
use App\Entity\MOEINT;
use App\Entity\REGROUPEMENT;
use App\Entity\SITE;
use App\Entity\STATUT;
use App\Entity\UTILISATEURS;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ApplicationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('APPLICATION', TextType::class, [
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
            ->add('NOM_SERVEUR', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Nom du Serveur',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DEV_LOCAUX', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3',
                ],
                'label' => 'Developpeur Locaux ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_SITE', EntityType::class, [
                'class' => SITE::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Site d\'hébergement',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('TYPE_APPLI', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Type d\'Application',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('QUALIFIE', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Disponible sur centre logiciel ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DATE_REFORME', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date réforme applicative',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DATE_FIN_SUP', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date fin de support',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('IMPACT_MV_OS', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Impact montée de version OS ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('IMPACT_O365', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Dépendance O365 ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('IMPACT_REORG', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Impact réorganisation ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('IMPACT_PROJET', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Dépendance projet ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('ID_CYBER', EntityType::class, [
                'class' => CYBER::class,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Cyber',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DIAG_CYBER', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Diagnostic cyber effectué ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('AUTH', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Méthode d\'Authentification',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('BRIQUES', EntityType::class, [
                'class' => BRIQUES::class,
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'mb-3',
                ],
                'label' => 'Briques',
                'label_attr' => [
                    'class' => 'checkbox-inline'
                ],
                'required' => false,
            ])
            ->add('FLUX_IN', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Origine flux entrants',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('TYPE_FLUX_IN', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Type de flux entrant',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('FLUX_OUT', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Cibles flux sortants',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('TYPE_FLUX_OUT', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Type de flux sortant',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('TYPE_ACCES', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Type d\'accès',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('OBSOLESCENCE', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Obsolescence ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('MV', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Montée de version prévue ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('TYPE_MV', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Type de montée de version',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('PORTAGE', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Portage technique prévu ?',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('TYPE_PORTAGE', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Type de portage technique',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('RAISON_PORTAGE', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Raisons du portage',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('STATUT_SUIVI', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Statut',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DATE_DEBUT', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date de début',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('DATE_FIN', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date de fin',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
            ])
            ->add('COMMENTAIRES_SUIVI', TextareaType::class, [
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
            'data_class' => null,
        ]);
    }
}
