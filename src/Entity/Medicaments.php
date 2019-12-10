<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicaments
 *
 * @ORM\Table(name="medicaments")
 * @ORM\Entity
 */
class Medicaments
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description_courte", type="string", length=255, nullable=false)
     */
    private $descriptionCourte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="substance_active", type="string", length=255, nullable=false)
     */
    private $substanceActive;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dosage_substance", type="string", length=255, nullable=true)
     */
    private $dosageSubstance;

    /**
     * @var string
     *
     * @ORM\Column(name="methode_utilisation", type="string", length=255, nullable=false)
     */
    private $methodeUtilisation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="taux_remboursement", type="integer", nullable=true)
     */
    private $tauxRemboursement;

    /**
     * @var string
     *
     * @ORM\Column(name="symptomes", type="text", length=65535, nullable=false)
     */
    private $symptomes;

    /**
     * @var string
     *
     * @ORM\Column(name="contre_indications", type="text", length=65535, nullable=false)
     */
    private $contreIndications;

    /**
     * @var string
     *
     * @ORM\Column(name="effets_indesirables", type="text", length=65535, nullable=false)
     */
    private $effetsIndesirables;

    /**
     * @var string
     *
     * @ORM\Column(name="conservation", type="text", length=65535, nullable=false)
     */
    private $conservation;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Medicaments
     */
    public function setNom(string $nom): Medicaments
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Medicaments
     */
    public function setType(string $type): Medicaments
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     * @return Medicaments
     */
    public function setPrix(float $prix): Medicaments
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionCourte(): ?string
    {
        return $this->descriptionCourte;
    }

    /**
     * @param string $descriptionCourte
     * @return Medicaments
     */
    public function setDescriptionCourte(string $descriptionCourte): Medicaments
    {
        $this->descriptionCourte = $descriptionCourte;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Medicaments
     */
    public function setImage(?string $image): Medicaments
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubstanceActive(): ?string
    {
        return $this->substanceActive;
    }

    /**
     * @param string $substanceActive
     * @return Medicaments
     */
    public function setSubstanceActive(string $substanceActive): Medicaments
    {
        $this->substanceActive = $substanceActive;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDosageSubstance(): ?string
    {
        return $this->dosageSubstance;
    }

    /**
     * @param string|null $dosageSubstance
     * @return Medicaments
     */
    public function setDosageSubstance(?string $dosageSubstance): Medicaments
    {
        $this->dosageSubstance = $dosageSubstance;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethodeUtilisation(): ?string
    {
        return $this->methodeUtilisation;
    }

    /**
     * @param string $methodeUtilisation
     * @return Medicaments
     */
    public function setMethodeUtilisation(string $methodeUtilisation): Medicaments
    {
        $this->methodeUtilisation = $methodeUtilisation;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTauxRemboursement(): ?int
    {
        return $this->tauxRemboursement;
    }

    /**
     * @param int|null $tauxRemboursement
     * @return Medicaments
     */
    public function setTauxRemboursement(?int $tauxRemboursement): Medicaments
    {
        $this->tauxRemboursement = $tauxRemboursement;
        return $this;
    }

    /**
     * @return string
     */
    public function getSymptomes(): ?string
    {
        return $this->symptomes;
    }

    /**
     * @param string $symptomes
     * @return Medicaments
     */
    public function setSymptomes(string $symptomes): Medicaments
    {
        $this->symptomes = $symptomes;
        return $this;
    }

    /**
     * @return string
     */
    public function getContreIndications(): ?string
    {
        return $this->contreIndications;
    }

    /**
     * @param string $contreIndications
     * @return Medicaments
     */
    public function setContreIndications(string $contreIndications): Medicaments
    {
        $this->contreIndications = $contreIndications;
        return $this;
    }

    /**
     * @return string
     */
    public function getEffetsIndesirables(): ?string
    {
        return $this->effetsIndesirables;
    }

    /**
     * @param string $effetsIndesirables
     * @return Medicaments
     */
    public function setEffetsIndesirables(string $effetsIndesirables): Medicaments
    {
        $this->effetsIndesirables = $effetsIndesirables;
        return $this;
    }

    /**
     * @return string
     */
    public function getConservation(): ?string
    {
        return $this->conservation;
    }

    /**
     * @param string $conservation
     * @return Medicaments
     */
    public function setConservation(string $conservation): Medicaments
    {
        $this->conservation = $conservation;
        return $this;
    }


}
