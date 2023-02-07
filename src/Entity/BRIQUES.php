<?php

namespace App\Entity;

use App\Repository\BRIQUESRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BRIQUESRepository::class)]
class BRIQUES
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TYPE_BRIQUE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_BRIQUE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $V_BRIQUE = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_FIN = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTYPEBRIQUE(): ?string
    {
        return $this->TYPE_BRIQUE;
    }

    public function setTYPEBRIQUE(?string $TYPE_BRIQUE): self
    {
        $this->TYPE_BRIQUE = $TYPE_BRIQUE;

        return $this;
    }

    public function getLIBBRIQUE(): ?string
    {
        return $this->LIB_BRIQUE;
    }

    public function setLIBBRIQUE(?string $LIB_BRIQUE): self
    {
        $this->LIB_BRIQUE = $LIB_BRIQUE;

        return $this;
    }

    public function getVBRIQUE(): ?string
    {
        return $this->V_BRIQUE;
    }

    public function setVBRIQUE(?string $V_BRIQUE): self
    {
        $this->V_BRIQUE = $V_BRIQUE;

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

    // __toString pour afficher le libellé ainsi que son numéro de version dans les formulaires
    public function __toString()
    {
        return $this->id. '. ' .$this->getLIBBRIQUE(). ' ' . $this->getVBRIQUE();
    }
}
