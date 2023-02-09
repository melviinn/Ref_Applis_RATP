<?php

namespace App\Entity;

use App\Repository\FAILLESAPPLICATIONSRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FAILLESAPPLICATIONSRepository::class)]
class FAILLESAPPLICATIONS
{

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?APPLICATIONS $ID_APPLICATION = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FAILLES $ID_FAILLE = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IMPACTE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TRAITEMENT = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $COMMENTAIRES = null;

    public function getIDAPPLICATION(): ?APPLICATIONS
    {
        return $this->ID_APPLICATION;
    }

    public function setIDAPPLICATION(?APPLICATIONS $ID_APPLICATION): self
    {
        $this->ID_APPLICATION = $ID_APPLICATION;

        return $this;
    }

    public function getIDFAILLE(): ?FAILLES
    {
        return $this->ID_FAILLE;
    }

    public function setIDFAILLE(?FAILLES $ID_FAILLE): self
    {
        $this->ID_FAILLE = $ID_FAILLE;

        return $this;
    }

    public function isIMPACTE(): ?bool
    {
        return $this->IMPACTE;
    }

    public function setIMPACTE(?bool $IMPACTE): self
    {
        $this->IMPACTE = $IMPACTE;

        return $this;
    }

    public function getTRAITEMENT(): ?string
    {
        return $this->TRAITEMENT;
    }

    public function setTRAITEMENT(?string $TRAITEMENT): self
    {
        $this->TRAITEMENT = $TRAITEMENT;

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
}
