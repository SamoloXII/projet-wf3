<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThreadRepository")
 */
class Thread
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="id_thread")
     */
    private $id;
    /**
     * @var Collection
     */
    private $comments;



    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdThread(): ?int
    {
        return $this->id_thread;
    }

    public function setIdThread(int $id_thread): self
    {
        $this->id_thread = $id_thread;

        return $this;
    }



    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPremierMessage(): ?string
    {
        return $this->premier_message;
    }

    public function setPremierMessage(string $premier_message): self
    {
        $this->premier_message = $premier_message;

        return $this;
    }

    public function getPublicatioDate(): ?\DateTimeInterface
    {
        return $this->publicatio_date;
    }

    public function setPublicatioDate(\DateTimeInterface $publicatio_date): self
    {
        $this->publicatio_date = $publicatio_date;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setThread($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getThread() === $this) {
                $comment->setThread(null);
            }
        }

        return $this;
    }

    public function getMedicament(): ?Medicaments
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicaments $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }
}
