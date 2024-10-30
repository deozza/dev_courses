export default interface CardInterface {
    rank: Rank;
    suit: Suit;
}

export const suits = ['hearts', 'diamonds', 'clubs', 'spades'] as const;
export type Suit = typeof suits[number];

export const ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'] as const;
export type Rank = typeof ranks[number];