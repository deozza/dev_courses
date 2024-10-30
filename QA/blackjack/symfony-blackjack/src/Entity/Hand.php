<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

class Hand
{
    #[Groups(['game', 'turn'])]
    private array $cards = [];

    #[Groups(['game', 'turn'])]
    private ?int $score = null;

    #[Groups(['game', 'turn'])]
    private ?bool $isBlackjack = null;

    #[Groups(['game', 'turn'])]
    private ?bool $isBusted = null;

    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(array $cards): static
    {
        $this->cards = $cards;

        return $this;
    }

    public function addCard(Card $card): static
    {
        $this->cards[] = $card;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getIsBlackjack(): ?bool
    {
        return $this->isBlackjack;
    }

    public function setIsBlackjack(bool $isBlackjack): static
    {
        $this->isBlackjack = $isBlackjack;

        return $this;
    }

    public function getIsBusted(): ?bool
    {
        return $this->isBusted;
    }

    public function setIsBusted(bool $isBusted): static
    {
        $this->isBusted = $isBusted;

        return $this;
    }
}
