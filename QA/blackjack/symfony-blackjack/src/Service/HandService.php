<?php

namespace App\Service;

use App\Entity\Hand;

class HandService
{
    public function calculateScore(Hand $hand): array
    {

        $handAfterCalculating = new Hand();
        $score = 0;
        $aces = 0;
        $faces = 0;
        foreach ($hand->getCards() as $card) {
            $value = $card->getValue();
            if ($value === 'J' || $value === 'Q' || $value === 'K') {
                $score += 10;
                $faces++;
            } elseif ($value === 'A') {
                $aces++;
            } else {
                $score += (int) $value;
            }
        }

        for ($i = 0; $i < $aces; $i++) {
            if ($score + 11 <= 21) {
                $score += 11;
            } else {
                $score += 1;
            }
        }

        $handAfterCalculating->setIsBusted($score > 21);
        $handAfterCalculating->setScore($score);

        if(count($hand->getCards()) === $faces + $aces && count($hand->getCards()) === 2 && $score === 21){
            $handAfterCalculating->setIsBlackjack(true);
        }

        $handAfterCalculating->setCards($hand->getCards());

        return [$handAfterCalculating, null];
    }

}