<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicineRepository")
 */
class Medicine
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=8)
     */
    private $cis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="medicine")
     */
    private $threads;

    /**
     * Les ordonnances
     * @ORM\OneToMany(targetEntity="App\Entity\Prescription", mappedBy="medicine")
     */
    private $prescriptions;

    /**
     * substance active
     * @ORM\Column(type="string", length=255)
     */
    private $activeSubstance;

    /**
     * Le dosage du médicament
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $substanceDosing;

    /**
     * Méthode d'utilisation (cutanée, orale...)
     * @ORM\Column(type="string", length=255)
     */
    private $useMethod;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * taux de remboursement (en %)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refundRate;

    /**
     * Laboratoire créateur
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Laboratory;

    /**
     * Les conditions de prescriptions pour prendre le médicament
     * @ORM\Column(type="string", length=255)
     */
    private $prescriptionConditions;

    /**
     * Service médical rendu (=pour quelle maladie il est utilisé)
     * @ORM\Column(type="text")
     */
    private $medicalService;

    /**
     * Commercialisée ou non
     * @ORM\Column(type="string", length=255)
     */
    private $saleStatus;

    public function __construct()
    {
        $this->threads = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
    }

    public function getCis(): ?string
    {
        return $this->cis;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }



    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
            $thread->setMedicine($this);
        }

        return $this;
    }

    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            // set the owning side to null (unless already changed)
            if ($thread->getMedicine() === $this) {
                $thread->setMedicine(null);
            }
        }

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
            $prescription->setMedicine($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->contains($prescription)) {
            $this->prescriptions->removeElement($prescription);
            // set the owning side to null (unless already changed)
            if ($prescription->getMedicine() === $this) {
                $prescription->setMedicine(null);
            }
        }

        return $this;
    }

    public function getActiveSubstance(): ?string
    {
        return $this->activeSubstance;
    }

    public function setActiveSubstance(string $activeSubstance): self
    {
        $this->activeSubstance = $activeSubstance;

        return $this;
    }

    public function getSubstanceDosing(): ?string
    {
        return $this->substanceDosing;
    }

    public function setSubstanceDosing(?string $substanceDosing): self
    {
        $this->substanceDosing = $substanceDosing;

        return $this;
    }

    public function getUseMethod(): ?string
    {
        return $this->useMethod;
    }

    public function setUseMethod(string $useMethod): self
    {
        $this->useMethod = $useMethod;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRefundRate(): ?string
    {
        return $this->refundRate;
    }

    public function setRefundRate(?string $refundRate): self
    {
        $this->refundRate = $refundRate;

        return $this;
    }

    public function getLaboratory(): ?string
    {
        return $this->Laboratory;
    }

    public function setLaboratory(?string $Laboratory): self
    {
        $this->Laboratory = $Laboratory;

        return $this;
    }

    public function getPrescriptionConditions(): ?string
    {
        return $this->prescriptionConditions;
    }

    public function setPrescriptionConditions(string $prescriptionConditions): self
    {
        $this->prescriptionConditions = $prescriptionConditions;

        return $this;
    }

    public function getMedicalService(): ?string
    {
        return $this->medicalService;
    }

    public function setMedicalService(string $medicalService): self
    {
        $this->medicalService = $medicalService;

        return $this;
    }

    public function getSaleStatus(): ?string
    {
        return $this->saleStatus;
    }

    public function setSaleStatus(string $saleStatus): self
    {
        $this->saleStatus = $saleStatus;

        return $this;
    }
}
