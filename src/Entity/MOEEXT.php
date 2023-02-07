<?php

namespace App\Entity;

use App\Repository\MOEEXTRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MOEEXTRepository::class)]
class MOEEXT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_MOE_EXT = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLIBMOEEXT(): ?string
    {
        return $this->LIB_MOE_EXT;
    }

    public function setLIBMOEEXT(?string $LIB_MOE_EXT): self
    {
        $this->LIB_MOE_EXT = $LIB_MOE_EXT;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->LIB_MOE_EXT;
    }
}
