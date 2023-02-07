<?php

namespace App\Entity;

use App\Repository\MOEINTRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MOEINTRepository::class)]
class MOEINT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_UNITE_MOE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_EQ_MOE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCODEUNITEMOE(): ?string
    {
        return $this->CODE_UNITE_MOE;
    }

    public function setCODEUNITEMOE(?string $CODE_UNITE_MOE): self
    {
        $this->CODE_UNITE_MOE = $CODE_UNITE_MOE;

        return $this;
    }

    public function getCODEEQMOE(): ?string
    {
        return $this->CODE_EQ_MOE;
    }

    public function setCODEEQMOE(?string $CODE_EQ_MOE): self
    {
        $this->CODE_EQ_MOE = $CODE_EQ_MOE;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->CODE_UNITE_MOE. ' - ' .$this->CODE_EQ_MOE;
    }


}
