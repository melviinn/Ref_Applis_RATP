<?php

namespace App\Entity;

use App\Repository\ENVIRONNEMENTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ENVIRONNEMENTRepository::class)]
class ENVIRONNEMENT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?APPLICATIONS $ID_APPLICATION = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $NOM_SERVEUR = null;

    #[ORM\Column(nullable: true)]
    private ?bool $DEV_LOCAUX = null;

    #[ORM\ManyToOne]
    private ?SITE $ID_SITE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TYPE_APPLI = null;

    #[ORM\Column(nullable: true)]
    private ?bool $QUALIFIE = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_REFORME = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DATE_FIN_SUP = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IMPACT_MV_OS = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IMPACT_O365 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IMPACT_REORG = null;

    #[ORM\Column(nullable: true)]
    private ?bool $IMPACT_PROJET = null;

    #[ORM\ManyToOne]
    private ?CYBER $ID_CYBER = null;

    #[ORM\Column(nullable: true)]
    private ?bool $DIAG_CYBER = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AUTH = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $FLUX_IN = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TYPE_FLUX_IN = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $FLUX_OUT = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TYPE_FLUX_OUT = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TYPE_ACCES = null;

    #[ORM\ManyToMany(targetEntity: BRIQUES::class)]
    private ?Collection $BRIQUES;


    public function __construct()
    {
        $this->BRIQUES = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDAPPLICATION(): ?APPLICATIONS
    {
        return $this->ID_APPLICATION;
    }

    public function setIDAPPLICATION(?APPLICATIONS $ID_APPLICATION): self
    {
        $this->ID_APPLICATION = $ID_APPLICATION;

        return $this;
    }

    public function getNOMSERVEUR(): ?string
    {
        return $this->NOM_SERVEUR;
    }

    public function setNOMSERVEUR(?string $NOM_SERVEUR): self
    {
        $this->NOM_SERVEUR = $NOM_SERVEUR;

        return $this;
    }

    public function isDEVLOCAUX(): ?bool
    {
        return $this->DEV_LOCAUX;
    }

    public function setDEVLOCAUX(?bool $DEV_LOCAUX): self
    {
        $this->DEV_LOCAUX = $DEV_LOCAUX;

        return $this;
    }

    public function getIDSITE(): ?SITE
    {
        return $this->ID_SITE;
    }

    public function setIDSITE(?SITE $ID_SITE): self
    {
        $this->ID_SITE = $ID_SITE;

        return $this;
    }

    public function getTYPEAPPLI(): ?string
    {
        return $this->TYPE_APPLI;
    }

    public function setTYPEAPPLI(?string $TYPE_APPLI): self
    {
        $this->TYPE_APPLI = $TYPE_APPLI;

        return $this;
    }

    public function isQUALIFIE(): ?bool
    {
        return $this->QUALIFIE;
    }

    public function setQUALIFIE(?bool $QUALIFIE): self
    {
        $this->QUALIFIE = $QUALIFIE;

        return $this;
    }

    public function getDATEREFORME(): ?\DateTimeInterface
    {
        return $this->DATE_REFORME;
    }

    public function setDATEREFORME(?\DateTimeInterface $DATE_REFORME): self
    {
        $this->DATE_REFORME = $DATE_REFORME;

        return $this;
    }

    public function getDATEFINSUP(): ?\DateTimeInterface
    {
        return $this->DATE_FIN_SUP;
    }

    public function setDATEFINSUP(?\DateTimeInterface $DATE_FIN_SUP): self
    {
        $this->DATE_FIN_SUP = $DATE_FIN_SUP;

        return $this;
    }

    public function isIMPACTMVOS(): ?bool
    {
        return $this->IMPACT_MV_OS;
    }

    public function setIMPACTMVOS(?bool $IMPACT_MV_OS): self
    {
        $this->IMPACT_MV_OS = $IMPACT_MV_OS;

        return $this;
    }

    public function isIMPACTO365(): ?bool
    {
        return $this->IMPACT_O365;
    }

    public function setIMPACTO365(?bool $IMPACT_O365): self
    {
        $this->IMPACT_O365 = $IMPACT_O365;

        return $this;
    }

    public function isIMPACTREORG(): ?bool
    {
        return $this->IMPACT_REORG;
    }

    public function setIMPACTREORG(?bool $IMPACT_REORG): self
    {
        $this->IMPACT_REORG = $IMPACT_REORG;

        return $this;
    }

    public function isIMPACTPROJET(): ?bool
    {
        return $this->IMPACT_PROJET;
    }

    public function setIMPACTPROJET(?bool $IMPACT_PROJET): self
    {
        $this->IMPACT_PROJET = $IMPACT_PROJET;

        return $this;
    }

    public function getIDCYBER(): ?CYBER
    {
        return $this->ID_CYBER;
    }

    public function setIDCYBER(?CYBER $ID_CYBER): self
    {
        $this->ID_CYBER = $ID_CYBER;

        return $this;
    }

    public function isDIAGCYBER(): ?bool
    {
        return $this->DIAG_CYBER;
    }

    public function setDIAGCYBER(?bool $DIAG_CYBER): self
    {
        $this->DIAG_CYBER = $DIAG_CYBER;

        return $this;
    }

    public function getAUTH(): ?string
    {
        return $this->AUTH;
    }

    public function setAUTH(?string $AUTH): self
    {
        $this->AUTH = $AUTH;

        return $this;
    }

    public function getFLUXIN(): ?string
    {
        return $this->FLUX_IN;
    }

    public function setFLUXIN(?string $FLUX_IN): self
    {
        $this->FLUX_IN = $FLUX_IN;

        return $this;
    }

    public function getTYPEFLUXIN(): ?string
    {
        return $this->TYPE_FLUX_IN;
    }

    public function setTYPEFLUXIN(?string $TYPE_FLUX_IN): self
    {
        $this->TYPE_FLUX_IN = $TYPE_FLUX_IN;

        return $this;
    }

    public function getFLUXOUT(): ?string
    {
        return $this->FLUX_OUT;
    }

    public function setFLUXOUT(?string $FLUX_OUT): self
    {
        $this->FLUX_OUT = $FLUX_OUT;

        return $this;
    }

    public function getTYPEFLUXOUT(): ?string
    {
        return $this->TYPE_FLUX_OUT;
    }

    public function setTYPEFLUXOUT(?string $TYPE_FLUX_OUT): self
    {
        $this->TYPE_FLUX_OUT = $TYPE_FLUX_OUT;

        return $this;
    }

    public function getTYPEACCES(): ?string
    {
        return $this->TYPE_ACCES;
    }

    public function setTYPEACCES(?string $TYPE_ACCES): self
    {
        $this->TYPE_ACCES = $TYPE_ACCES;

        return $this;
    }

    /**
     * @return Collection<int, BRIQUES>
     */
    public function getBRIQUES(): Collection
    {
        return $this->BRIQUES;
    }

    public function addBRIQUES(BRIQUES $BRIQUES): self
    {
        if (!$this->BRIQUES->contains($BRIQUES)) {
            $this->BRIQUES->add($BRIQUES);
        }

        return $this;
    }

    public function removeBRIQUES(BRIQUES $BRIQUES): self
    {
        $this->BRIQUES->removeElement($BRIQUES);

        return $this;
    }
}
