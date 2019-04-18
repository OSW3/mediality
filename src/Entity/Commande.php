<?php

namespace App\Entity;

date_default_timezone_set('Europe/Paris');

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameApplicant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRequest;

    /**
     * @ORM\Column(type="text")
     */
    private $observation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDelivery;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDiffusion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users", inversedBy="order")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="orders")
     */
    private $event;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->setDateRequest(new \DateTime('now'));
        $this->setDateDelivery(new \DateTime('now'));
        $this->setDateDiffusion(new \DateTime('now'));
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNameApplicant(): ?string
    {
        return $this->nameApplicant;
    }

    public function setNameApplicant(string $nameApplicant): self
    {
        $this->nameApplicant = $nameApplicant;

        return $this;
    }

    public function getDateRequest(): ?\DateTimeInterface
    {
        return $this->dateRequest;
    }

    public function setDateRequest(\DateTimeInterface $dateRequest): self
    {
        $this->dateRequest = $dateRequest;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->dateDelivery;
    }

    public function setDateDelivery(\DateTimeInterface $dateDelivery): self
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    public function getDateDiffusion(): ?\DateTimeInterface
    {
        return $this->dateDiffusion;
    }

    public function setDateDiffusion(\DateTimeInterface $dateDiffusion): self
    {
        $this->dateDiffusion = $dateDiffusion;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    public function getEvent(): ?Evenement
    {
        return $this->event;
    }

    public function setEvent(?Evenement $event): self
    {
        $this->event = $event;

        return $this;
    }
}
