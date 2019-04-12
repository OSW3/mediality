<?php

namespace App\Entity;

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
    private $nom_demandeur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_demande;

    /**
     * @ORM\Column(type="text")
     */
    private $observation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_livraison;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_diffusion;

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

    public function getNomDemandeur(): ?string
    {
        return $this->nom_demandeur;
    }

    public function setNomDemandeur(string $nom_demandeur): self
    {
        $this->nom_demandeur = $nom_demandeur;

        return $this;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->date_demande;
    }

    public function setDateDemande(\DateTimeInterface $date_demande): self
    {
        $this->date_demande = $date_demande;

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

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $date_livraison): self
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getDateDiffusion(): ?\DateTimeInterface
    {
        return $this->date_diffusion;
    }

    public function setDateDiffusion(\DateTimeInterface $date_diffusion): self
    {
        $this->date_diffusion = $date_diffusion;

        return $this;
    }
}
