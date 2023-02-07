<?php

namespace App\Entity;

use App\Repository\AMOAEQUIPERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AMOAEQUIPERepository::class)]
class AMOAEQUIPE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_EQUIPE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_EQUIPE = null;

    #[ORM\ManyToOne]
    private ?AMOAPOLE $ID_POLE = null;

    #[ORM\ManyToOne]
    private ?AMOAENTITE $ID_ENTITE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCODEEQUIPE(): ?string
    {
        return $this->CODE_EQUIPE;
    }

    public function setCODEEQUIPE(?string $CODE_EQUIPE): self
    {
        $this->CODE_EQUIPE = $CODE_EQUIPE;

        return $this;
    }

    public function getLIBEQUIPE(): ?string
    {
        return $this->LIB_EQUIPE;
    }

    public function setLIBEQUIPE(?string $LIB_EQUIPE): self
    {
        $this->LIB_EQUIPE = $LIB_EQUIPE;

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

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->CODE_EQUIPE;
    }
}
