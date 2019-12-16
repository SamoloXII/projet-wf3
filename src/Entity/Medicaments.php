<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Medicaments
 *
 * @ORM\Table(name="medicaments")
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentsRepository")
 */
class Medicaments
{
    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     *
     * @ORM\Column(name="description_courte", type="string", length=255, nullable=false)
     */
    private $descriptionCourte;

    /**
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     *
     */
    private $image;

    /**
     *
     * @ORM\Column(name="substance_active", type="string", length=255, nullable=false)
     */
    private $substanceActive;

    /**
     *
     * @ORM\Column(name="dosage_substance", type="string", length=255, nullable=true)
     */
    private $dosageSubstance;

    /**
     *
     * @ORM\Column(name="methode_utilisation", type="string", length=255, nullable=false)
     */
    private $methodeUtilisation;

    /**
     *
     * @ORM\Column(name="taux_remboursement", type="integer", nullable=true)
     */
    private $tauxRemboursement;

    /**
     *
     * @ORM\Column(name="symptomes", type="text", length=65535, nullable=false)
     */
    private $symptomes;

    /**
     *
     * @ORM\Column(name="contre_indications", type="text", length=65535, nullable=false)
     */
    private $contreIndications;

    /**
     *
     * @ORM\Column(name="effets_indesirables", type="text", length=65535, nullable=false)
     */
    private $effetsIndesirables;

    /**
     *
     * @ORM\Column(name="conservation", type="text", length=65535, nullable=false)
     */
    private $conservation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prescription", mappedBy="medicaments")
     */
    private $prescriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="medicament")
     */
    private $threads;



    public function __construct()
    {
        $this->prescriptions = new ArrayCollection();
        $this->threads = new ArrayCollection();
    }

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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Medicaments
     */
    public function setImage($image): Medicaments
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

    /**
     * @return Collection|Prescription[]
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): self
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions[] = $prescription;
            $prescription->setMedicaments($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->contains($prescription)) {
            $this->prescriptions->removeElement($prescription);
            // set the owning side to null (unless already changed)
            if ($prescription->getMedicaments() === $this) {
                $prescription->setMedicaments(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Thread[]
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }

    public function addThread(Thread $thread): self
    {
        if (!$this->threads->contains($thread)) {
            $this->threads[] = $thread;
            $thread->setMedicament($this);
        }

        return $this;
    }

    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            // set the owning side to null (unless already changed)
            if ($thread->getMedicament() === $this) {
                $thread->setMedicament(null);
            }
        }

        return $this;
    }



}
