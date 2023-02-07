<?php

namespace App\Entity;

use App\Repository\BDDRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BDDRepository::class)]
class BDD
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_BDD = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $V_BDD = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_FIN = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLIBBDD(): ?string
    {
        return $this->LIB_BDD;
    }

    public function setLIBBDD(?string $LIB_BDD): self
    {
        $this->LIB_BDD = $LIB_BDD;

        return $this;
    }

    public function getVBDD(): ?string
    {
        return $this->V_BDD;
    }

    public function setVBDD(?string $V_BDD): self
    {
        $this->V_BDD = $V_BDD;

        return $this;
    }

    public function getDATEFIN(): ?\DateTimeInterface
    {
        return $this->DATE_FIN;
    }

    public function setDATEFIN(?\DateTimeInterface $DATE_FIN): self
    {
        $this->DATE_FIN = $DATE_FIN;

        return $this;
    }
}
