export function main() {
    const cardRanks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    const cardSuits = ['♠', '♣', '♥', '♦'];
    let deck: any[] = [];
    let currentCard: any = null;

    console.log('default deck : ', deck);

    for (const rank of cardRanks) {
        for (const suit of cardSuits) {
            deck.push({ rank, suit });
        }
    }

    console.log('deck after generation : ', deck);


    deck.sort(() => Math.random() - 0.5);

    console.log('deck after shuffling : ', deck);

    let hand: any[] = [];

    console.log('hand before draw : ', hand);
    console.log('deck before draw: ', deck);

    currentCard = deck.shift();

    if(currentCard) {
        hand.push(currentCard);
        currentCard = null;
    }else{
        console.error('Deck is empty');
        return;
    }

    console.log('hand after draw : ', hand);
    console.log('deck after draw: ', deck);

    let discard: any[] = [];

    console.log('discard pile before discard: ', discard);
    console.log('deck before discard: ', deck);

    currentCard = deck.shift();
    if(currentCard) {
        discard.push(currentCard);
        currentCard = null;
    }else{
        console.error('Deck is empty');
        return;
    }

    console.log('discard pile after discard: ', discard);
    console.log('deck after discard: ', deck);
}