import Actor from "./Actor/Actor";
import { ranks, suits } from "./Card/CardInterface";

export function main() {
    const actor: Actor = new Actor();

    console.log('default deck: ', actor.deck.getCards());

    actor.deck.generateDeck([...suits], [...ranks]);

    console.log('generated deck: ', actor.deck.getCards());

    actor.deck.shuffle();

    console.log('shuffled deck: ', actor.deck.getCards());

    console.log('hand before draw : ', actor.hand.getCards());
    console.log('deck before draw: ', actor.deck.getCards());

    actor.drawCardFromDeck();

    console.log('hand after draw: ', actor.hand.getCards());
    console.log('deck after draw: ', actor.deck.getCards());

    console.log('discard pile before discard: ', actor.discard.getCards());
    console.log('deck before discard: ', actor.deck.getCards());

    actor.discardCardFromDeck();

    console.log('discard pile after discard: ', actor.discard.getCards());
    console.log('deck after discard: ', actor.deck.getCards());
}