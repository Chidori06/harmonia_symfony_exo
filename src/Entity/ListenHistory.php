<?php

namespace App\Entity;

use App\Repository\ListenHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListenHistoryRepository::class)]
class ListenHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $listenAt = null;

    #[ORM\ManyToOne(inversedBy: 'listenHistories')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'listenHistories')]
    private ?Track $track = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListenAt(): ?\DateTimeImmutable
    {
        return $this->listenAt;
    }

    public function setListenAt(\DateTimeImmutable $listenAt): static
    {
        $this->listenAt = $listenAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTrack(): ?Track
    {
        return $this->track;
    }

    public function setTrack(?Track $track): static
    {
        $this->track = $track;

        return $this;
    }

}
