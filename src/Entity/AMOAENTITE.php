<?php

namespace App\Entity;

use App\Repository\AMOAENTITERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AMOAENTITERepository::class)]
class AMOAENTITE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_ENTITE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_ENTITE = null;

    #[ORM\ManyToOne]
    private ?AMOAPOLE $ID_POLE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCODEENTITE(): ?string
    {
        return $this->CODE_ENTITE;
    }

    public function setCODEENTITE(?string $CODE_ENTITE): self
    {
        $this->CODE_ENTITE = $CODE_ENTITE;

        return $this;
    }

    public function getLIBENTITE(): ?string
    {
        return $this->LIB_ENTITE;
    }

    public function setLIBENTITE(?string $LIB_ENTITE): self
    {
        $this->LIB_ENTITE = $LIB_ENTITE;

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

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->CODE_ENTITE;
    }
}
