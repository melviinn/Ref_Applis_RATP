<?php

namespace App\Entity;

use App\Repository\REGROUPEMENTRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: REGROUPEMENTRepository::class)]
class REGROUPEMENT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_REG = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLIBREG(): ?string
    {
        return $this->LIB_REG;
    }

    public function setLIBREG(?string $LIB_REG): self
    {
        $this->LIB_REG = $LIB_REG;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->LIB_REG;
    }
}
