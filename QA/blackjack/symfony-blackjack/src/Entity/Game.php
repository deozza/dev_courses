<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\Column]
    #[Groups(['user', 'game', 'turn'])]
    private string $id;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user', 'game', 'turn'])]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    #[Groups([ 'game', 'turn'])]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups([ 'game', 'turn'])]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups([ 'game', 'turn'])]
    private ?\DateTimeInterface $lastUpdateDate = null;

    #[ORM\OneToMany(targetEntity: Turn::class, mappedBy: 'game')]
    #[Groups([ 'game'])]
    private Collection $turns;

    public function __construct()
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->turns = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getLastUpdateDate(): ?\DateTimeInterface
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(\DateTimeInterface $lastUpdateDate): static
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }

    /**
     * @return Collection<int, Turn>
     */
    public function getTurns(): Collection
    {
        return $this->turns;
    }

    public function addTurn(Turn $turn): static
    {
        if (!$this->turns->contains($turn)) {
            $this->turns->add($turn);
            $turn->setGame($this);
        }

        return $this;
    }

    public function removeTurn(Turn $turn): static
    {
        if ($this->turns->removeElement($turn)) {
            // set the owning side to null (unless already changed)
            if ($turn->getGame() === $this) {
                $turn->setGame(null);
            }
        }

        return $this;
    }
}
