<?php

namespace App\Entity;

use App\Repository\FAILLESRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FAILLESRepository::class)]
class FAILLES
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    //#[ORM\ManyToMany(targetEntity: APPLICATIONS::class)]
    //private Collection $ID_APPLICATION;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $LIB_FAILLE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $COMP_FAILLE = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_FAILLE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $STATUT = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_FERMETURE = null;

    /*public function __construct()
    {
        $this->ID_APPLICATION = new ArrayCollection();
    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, APPLICATIONS>
     */
    /*public function getIDAPPLICATION(): Collection
    {
        return $this->ID_APPLICATION;
    }

    public function addIDAPPLICATION(APPLICATIONS $iDAPPLICATION): self
    {
        if (!$this->ID_APPLICATION->contains($iDAPPLICATION)) {
            $this->ID_APPLICATION->add($iDAPPLICATION);
        }

        return $this;
    }

    public function removeIDAPPLICATION(APPLICATIONS $iDAPPLICATION): self
    {
        $this->ID_APPLICATION->removeElement($iDAPPLICATION);

        return $this;
    }*/

    public function getLIBFAILLE(): ?string
    {
        return $this->LIB_FAILLE;
    }

    public function setLIBFAILLE(?string $LIB_FAILLE): self
    {
        $this->LIB_FAILLE = $LIB_FAILLE;

        return $this;
    }

    public function getCOMPFAILLE(): ?string
    {
        return $this->COMP_FAILLE;
    }

    public function setCOMPFAILLE(?string $COMP_FAILLE): self
    {
        $this->COMP_FAILLE = $COMP_FAILLE;

        return $this;
    }

    public function getDATEFAILLE(): ?\DateTimeInterface
    {
        return $this->DATE_FAILLE;
    }

    public function setDATEFAILLE(?\DateTimeInterface $DATE_FAILLE): self
    {
        $this->DATE_FAILLE = $DATE_FAILLE;

        return $this;
    }

    public function getSTATUT(): ?string
    {
        return $this->STATUT;
    }

    public function setSTATUT(?string $STATUT): self
    {
        $this->STATUT = $STATUT;

        return $this;
    }

    public function getDATEFERMETURE(): ?\DateTimeInterface
    {
        return $this->DATE_FERMETURE;
    }

    public function setDATEFERMETURE(?\DateTimeInterface $DATE_FERMETURE): self
    {
        $this->DATE_FERMETURE = $DATE_FERMETURE;

        return $this;
    }

    public function __toString()
    {
        return $this->LIB_FAILLE;
    }
}
