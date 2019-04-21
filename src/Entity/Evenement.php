<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mailContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneContact;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize="5242880",
 *         mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif",
     *          "application/pdf",
     *          "application/x-pdf"
     *      }
     * )
     */
    private $upload;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="event")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->setDateStart(new \DateTime('now'));
        $this->setDateEnd(new \DateTime('now'));
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

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameContact()
    {
        return $this->nameContact;
    }

    /**
     * @param mixed $nameContact
     * @return Evenement
     */
    public function setNameContact($nameContact): Evenement
    {
        $this->nameContact = $nameContact;

        return $this;
    }

    /*public function setNomContact(?string $nameContact): self
    {
        $this->nameContact = $nameContact;

        return $this;
    }*/

    public function getMailContact(): ?string
    {
        return $this->mailContact;
    }

    public function setMailContact(?string $mailContact): self
    {
        $this->mailContact = $mailContact;

        return $this;
    }

    public function getPhoneContact(): ?string
    {
        return $this->phoneContact;
    }

    public function setPhoneContact(?string $phoneContact): self
    {
        $this->phoneContact = $phoneContact;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUpload(): ?string
    {
        return $this->upload;
    }

    public function setUpload(?string $upload): self
    {
        $this->upload = $upload;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Commande $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setEvent($this);
        }

        return $this;
    }

    public function removeOrder(Commande $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getEvent() === $this) {
                $order->setEvent(null);
            }
        }

        return $this;
    }
}
