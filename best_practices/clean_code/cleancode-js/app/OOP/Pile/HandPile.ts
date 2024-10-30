import CardInterface from "../Card/CardInterface";
import AbstractCardPile from "./AbstractCardPile";

export default class HandPile extends AbstractCardPile {
    getScore(): number {
        let aceValue: number = 11;
        let acesCount: number = 0;
        let score: number = 0;

        this.cards.forEach((card: CardInterface) => {
            if(card.rank === "A") {
                acesCount++;

                if(score + (aceValue * acesCount) > 21) {
                    aceValue = 1;
                }
                return;
            } 
            
            if(['J', 'Q', 'K'].includes(card.rank) === true) {
                score += 10;
                return;
            }

            score += parseInt(card.rank);
            return;
        });

        for(let i = 0; i < acesCount; i++) {
            score += aceValue;
        }

        return score;
    }

    isBusted(): boolean {
        return this.getScore() > 21;
    }

    isBlackJack(): boolean {
        if(this.getNumberOfCards() !== 2) {
            return false;
        }

        const hasAce: boolean = this.cards.some((card: CardInterface) => card.rank === "A");
        const hasFigure: boolean = this.cards.some((card: CardInterface) => ['J', 'Q', 'K'].includes(card.rank) === true);

        return hasAce && hasFigure;
    }
}