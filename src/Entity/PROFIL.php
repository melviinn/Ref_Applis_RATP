<?php

namespace App\Entity;

use App\Repository\PROFILRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PROFILRepository::class)]
class PROFIL
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_PROFIL = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLIBPROFIL(): ?string
    {
        return $this->LIB_PROFIL;
    }

    public function setLIBPROFIL(?string $LIB_PROFIL): self
    {
        $this->LIB_PROFIL = $LIB_PROFIL;

        return $this;
    }

    public function __toString()
    {
        return $this->id. '. ' .$this->LIB_PROFIL;
    }
}
