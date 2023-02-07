<?php

namespace App\Entity;

use App\Repository\OSRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OSRepository::class)]
class OS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_OS = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_FIN = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLIBOS(): ?string
    {
        return $this->LIB_OS;
    }

    public function setLIBOS(?string $LIB_OS): self
    {
        $this->LIB_OS = $LIB_OS;

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
