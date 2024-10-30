<?php

namespace App\Entity;

use App\Repository\TurnRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TurnRepository::class)]
class Turn
{
    #[ORM\Id]
    #[ORM\Column]
    #[Groups(['game', 'turn'])]
    private ?string $id = null;

    #[ORM\ManyToOne(inversedBy: 'turns')]
    #[Groups(['turn'])]
    private ?Game $game = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game', 'turn'])]
    private ?string $status = null;

    #[ORM\Column(type: Types::OBJECT)]
    private array $deck = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['game', 'turn'])]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['game', 'turn'])]
    private ?\DateTimeInterface $lastUpdateDate = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['turn', 'game'])]
    private ?int $wager = null;

    #[ORM\Column(type: Types::OBJECT)]
    #[Groups(['game', 'turn'])]
    private ?Hand $playerHand;

    #[ORM\Column(type: Types::OBJECT)]
    #[Groups(['game', 'turn'])]
    private ?Hand $dealerHand;

    public function __construct()
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->creationDate = new \DateTime();
        $this->lastUpdateDate = new \DateTime();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

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

    /**
     * @return Card[]
     */
    public function getDeck(): array
    {
        return $this->deck;
    }

    /**
     * @param Card[] $deck
     */
    public function setDeck(array $deck): static
    {
        $this->deck = $deck;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

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

    public function getWager(): ?int
    {
        return $this->wager;
    }

    public function setWager(?int $wager): static
    {
        $this->wager = $wager;

        return $this;
    }

    public function getPlayerHand(): ?Hand
    {
        return $this->playerHand;
    }

    public function setPlayerHand(?Hand $playerHand): static
    {
        $this->playerHand = $playerHand;

        return $this;
    }

    public function getDealerHand(): ?Hand
    {
        return $this->dealerHand;
    }

    public function setDealerHand(?Hand $dealerHand): static
    {
        $this->dealerHand = $dealerHand;

        return $this;
    }
}
