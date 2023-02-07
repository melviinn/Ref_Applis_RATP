<?php

namespace App\Entity;

use App\Repository\APPLICATIONSRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: APPLICATIONSRepository::class)]
class APPLICATIONS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $APPLICATION = null;

    #[ORM\Column(nullable: true)]
    private ?int $VERSION = null;

    #[ORM\ManyToOne]
    private ?MOA $ID_MOA = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $FINALITE = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $DESCRIPTION = null;

    #[ORM\ManyToOne]
    private ?AMOAPOLE $ID_POLE = null;

    #[ORM\ManyToOne]
    private ?AMOAENTITE $ID_ENTITE = null;

    #[ORM\ManyToOne]
    private ?AMOAEQUIPE $ID_EQUIPE = null;

    #[ORM\ManyToOne]
    private ?UTILISATEURS $CONTACT = null;

    #[ORM\ManyToOne]
    private ?MOE $ID_MOE = null;

    #[ORM\ManyToOne]
    private ?MOEEXT $ID_MOE_EXT = null;

    #[ORM\ManyToOne]
    private ?MOEINT $ID_MOE_INT = null;

    #[ORM\ManyToOne]
    private ?STATUT $ID_STATUT = null;

    #[ORM\ManyToOne]
    private ?REGROUPEMENT $ID_REG = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $COMMENTAIRES = null;

    #[ORM\ManyToOne]
    private ?UTILISATEURS $ID_ADM = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAPPLICATION(): ?string
    {
        return $this->APPLICATION;
    }

    public function setAPPLICATION(?string $APPLICATION): self
    {
        $this->APPLICATION = $APPLICATION;

        return $this;
    }

    public function getVERSION(): ?int
    {
        return $this->VERSION;
    }

    public function setVERSION(?int $VERSION): self
    {
        $this->VERSION = $VERSION;

        return $this;
    }

    public function getFINALITE(): ?string
    {
        return $this->FINALITE;
    }

    public function setFINALITE(?string $FINALITE): self
    {
        $this->FINALITE = $FINALITE;

        return $this;
    }

    public function getDESCRIPTION(): ?string
    {
        return $this->DESCRIPTION;
    }

    public function setDESCRIPTION(?string $DESCRIPTION): self
    {
        $this->DESCRIPTION = $DESCRIPTION;

        return $this;
    }

    public function getCOMMENTAIRES(): ?string
    {
        return $this->COMMENTAIRES;
    }

    public function setCOMMENTAIRES(?string $COMMENTAIRES): self
    {
        $this->COMMENTAIRES = $COMMENTAIRES;

        return $this;
    }

    public function getIDMOA(): ?MOA
    {
        return $this->ID_MOA;
    }

    public function setIDMOA(?MOA $ID_MOA): self
    {
        $this->ID_MOA = $ID_MOA;

        return $this;
    }

    public function getIDPOLE(): ?AMOAPOLE
    {
        return $this->ID_POLE;
    }

    public function setIDPOLE(?AMOAPOLE $ID_POLE): self
    {
        $this->ID_POLE = $ID_POLE;

        return $this;
    }

    public function getIDENTITE(): ?AMOAENTITE
    {
        return $this->ID_ENTITE;
    }

    public function setIDENTITE(?AMOAENTITE $ID_ENTITE): self
    {
        $this->ID_ENTITE = $ID_ENTITE;

        return $this;
    }

    public function getIDEQUIPE(): ?AMOAEQUIPE
    {
        return $this->ID_EQUIPE;
    }

    public function setIDEQUIPE(?AMOAEQUIPE $ID_EQUIPE): self
    {
        $this->ID_EQUIPE = $ID_EQUIPE;

        return $this;
    }

    public function getCONTACT(): ?UTILISATEURS
    {
        return $this->CONTACT;
    }

    public function setCONTACT(?UTILISATEURS $CONTACT): self
    {
        $this->CONTACT = $CONTACT;

        return $this;
    }

    public function getIDMOE(): ?MOE
    {
        return $this->ID_MOE;
    }

    public function setIDMOE(?MOE $ID_MOE): self
    {
        $this->ID_MOE = $ID_MOE;

        return $this;
    }

    public function getIDMOEEXT(): ?MOEEXT
    {
        return $this->ID_MOE_EXT;
    }

    public function setIDMOEEXT(?MOEEXT $ID_MOE_EXT): self
    {
        $this->ID_MOE_EXT = $ID_MOE_EXT;

        return $this;
    }

    public function getIDMOEINT(): ?MOEINT
    {
        return $this->ID_MOE_INT;
    }

    public function setIDMOEINT(?MOEINT $ID_MOE_INT): self
    {
        $this->ID_MOE_INT = $ID_MOE_INT;

        return $this;
    }

    public function getIDSTATUT(): ?STATUT
    {
        return $this->ID_STATUT;
    }

    public function setIDSTATUT(?STATUT $ID_STATUT): self
    {
        $this->ID_STATUT = $ID_STATUT;

        return $this;
    }

    public function getIDREG(): ?REGROUPEMENT
    {
        return $this->ID_REG;
    }

    public function setIDREG(?REGROUPEMENT $ID_REG): self
    {
        $this->ID_REG = $ID_REG;

        return $this;
    }

    public function getIDADM(): ?UTILISATEURS
    {
        return $this->ID_ADM;
    }

    public function setIDADM(?UTILISATEURS $ID_ADM): self
    {
        $this->ID_ADM = $ID_ADM;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->APPLICATION;
    }
}
