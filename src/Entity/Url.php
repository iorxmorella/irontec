<?php

namespace App\Entity;

use App\Repository\UrlRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UrlRepository::class)]
class Url
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $urlAbrv;

    #[ORM\Column(type: 'date')]
    private $creation_date;

    #[ORM\Column(type: 'text')]
    private $url;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'urls')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function __construct($urlAbrv = null, $url = null)
    {
        $this->creation_date = new \DateTime();
        $this->urlAbrv = $urlAbrv;
        $this->url = $url;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlAbrv(): ?string
    {
        return $this->urlAbrv;
    }

    public function setUrlAbrv(string $urlAbrv): self
    {
        $this->urlAbrv = $urlAbrv;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
