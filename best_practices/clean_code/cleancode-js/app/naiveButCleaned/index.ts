const cardRanks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
const cardSuits = ['♠', '♣', '♥', '♦'];
let deck: any[] = [];
let hand: any[] = [];
let discard: any[] = [];

function generateDeck(cardRanks: Array<string>, cardSuits: Array<string>) {
    cardRanks.forEach(rank => {
        cardSuits.forEach(suit => {
            addCardToDeck({ rank, suit });
        });
    });
}

function addCardToDeck(card: any) {
    deck.push(card);
}

function shuffleDeck() {
    return deck.sort(() => Math.random() - 0.5);
}

function getTopCardFromDeck() {
    if(isDeckEmpty()) {
        throw new Error('Deck is empty');
    }
    return deck.shift();
}

function isDeckEmpty(): boolean {
    return deck.length === 0;
}

function drawCard() {
    try {
        const card = getTopCardFromDeck();
        hand.push(card);
        return card;
    }catch(e) {
        console.error(e);
    }
}

function discardCard() {
    try {
        const card = getTopCardFromDeck();
        discard.push(card);
        return card;
    }catch(e) {
        console.error(e);
    }
}

export function main() {

    console.log('default deck : ', deck);

    generateDeck(cardRanks, cardSuits);

    console.log('deck after generation : ', deck);

    shuffleDeck();

    console.log('deck after shuffling : ', deck);

    console.log(drawCard());
    console.log('deck after drawing card : ', deck);
    console.log('hand : ', hand);

    console.log(discardCard());
    console.log('deck after discarding card : ', deck);
    console.log('discard : ', discard);

}