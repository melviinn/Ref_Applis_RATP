<?php

namespace App\Entity;

use App\Repository\AMOAPOLERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AMOAPOLERepository::class)]
class AMOAPOLE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_POLE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_POLE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCODEPOLE(): ?string
    {
        return $this->CODE_POLE;
    }

    public function setCODEPOLE(?string $CODE_POLE): self
    {
        $this->CODE_POLE = $CODE_POLE;

        return $this;
    }

    public function getLIBPOLE(): ?string
    {
        return $this->LIB_POLE;
    }

    public function setLIBPOLE(?string $LIB_POLE): self
    {
        $this->LIB_POLE = $LIB_POLE;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->CODE_POLE;
    }
}
