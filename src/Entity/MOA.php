<?php

namespace App\Entity;

use App\Repository\MOARepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MOARepository::class)]
class MOA
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_MOA = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_MOA = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCODEMOA(): ?string
    {
        return $this->CODE_MOA;
    }

    public function setCODEMOA(?string $CODE_MOA): self
    {
        $this->CODE_MOA = $CODE_MOA;

        return $this;
    }

    public function getLIBMOA(): ?string
    {
        return $this->LIB_MOA;
    }

    public function setLIBMOA(?string $LIB_MOA): self
    {
        $this->LIB_MOA = $LIB_MOA;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->CODE_MOA;
    }
}
