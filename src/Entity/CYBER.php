<?php

namespace App\Entity;

use App\Repository\CYBERRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CYBERRepository::class)]
class CYBER
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $NUM_CYBER = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_CYBER = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNUMCYBER(): ?int
    {
        return $this->NUM_CYBER;
    }

    public function setNUMCYBER(?int $NUM_CYBER): self
    {
        $this->NUM_CYBER = $NUM_CYBER;

        return $this;
    }

    public function getLIBCYBER(): ?string
    {
        return $this->LIB_CYBER;
    }

    public function setLIBCYBER(?string $LIB_CYBER): self
    {
        $this->LIB_CYBER = $LIB_CYBER;

        return $this;
    }

    // __toString pour afficher le libellé dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->LIB_CYBER;
    }
}
