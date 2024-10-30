import CardInterface, { Rank, Suit } from "../Card/CardInterface";
import AbstractCardPile from "./AbstractCardPile";

export default class DeckPile extends AbstractCardPile {

    generateDeck(suits: Suit[], ranks: Rank[]) {
        for(const suit of suits) {
            for(const rank of ranks) {
                const card: CardInterface = {rank, suit};
                this.addCard(card);
            }
        }
    }

    shuffle() {
        this.cards.sort(() => Math.random() - 0.5);
    }
}