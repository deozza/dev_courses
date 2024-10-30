<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

class Card {
    #[Groups(['game', 'turn'])]
    private string $suit;

    #[Groups(['game', 'turn'])]
    private string $value;

    public function __construct(string $suit, string $value) {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit(): string {
        return $this->suit;
    }

    public function getValue(): string {
        return $this->value;
    }
}