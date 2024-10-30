import DeckPile from "../Pile/DeckPile";
import HandPile from "../Pile/HandPile";

export default class Actor {
    public deck: DeckPile;
    public hand: HandPile;
    public discard: DeckPile;

    constructor() {
        this.deck = new DeckPile();
        this.hand = new HandPile();
        this.discard = new DeckPile();
    }

    public drawCardFromDeck() {
        try {
            const card = this.deck.getTopCard();
            this.hand.addCard(card);
            return card;
        } catch (e) {
            console.error(e);
        }
    }

    public discardCardFromHand() {
        try {
            const card = this.hand.getTopCard();
            this.discard.addCard(card);
            return card;
        } catch (e) {
            console.error(e);
        }
    }

    public discardCardFromDeck() {
        try {
            const card = this.deck.getTopCard();
            this.discard.addCard(card);
            return card;
        } catch (e) {
            console.error(e);
        }
    }
}