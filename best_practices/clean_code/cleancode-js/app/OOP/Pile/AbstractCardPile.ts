import CardInterface from "../Card/CardInterface";

export default abstract class AbstractCardPile {
    protected cards: CardInterface[] = [];

    addCard(card: CardInterface) {
        this.cards.push(card);
    }

    getTopCard(): CardInterface {
        if(this.isPileEmpty()) {
            throw new Error('Pile is empty');
        }
        return this.cards.shift()!;
    }

    isPileEmpty(): boolean {
        return this.cards.length === 0;
    }

    getCards(): CardInterface[] {
        return this.cards;
    }

    getNumberOfCards(): number {
        return this.cards.length;
    }
}