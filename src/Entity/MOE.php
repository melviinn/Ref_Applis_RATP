<?php

namespace App\Entity;

use App\Repository\MOERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MOERepository::class)]
class MOE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CODE_MOE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCODEMOE(): ?string
    {
        return $this->CODE_MOE;
    }

    public function setCODEMOE(?string $CODE_MOE): self
    {
        $this->CODE_MOE = $CODE_MOE;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->CODE_MOE;
    }
}
