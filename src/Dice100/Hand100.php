<?php

namespace Seb\Dice100;

/**
 * Dice, a class supporting the game through GET, POST and SESSION.
 */
class Hand100
{
    /**
     * @var int $handValue      Value of hand.
     * @var int $numberOfDice   Number of dice.
     */
    private $handValue;
    private $numberOfDice;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $handValue        Value of the hand.
     * @param int $numberOfDice     Amount of dice to be thrown.
     */
    public function __construct(int $numberOfDice = 3)
    {
        $this->numberOfDice = $numberOfDice;
        $this->handValue = 0;
    }

    /**
     * Throw hand.
     *
     * @return void
     */
    public function throwHand()
    {
        $dice = new Dice100();

        for ($i=0; $i < $this->numberOfDice; $i++) {
            $dice->throwDice();
            if ($dice->getDiceValue() == 1) {
                $this->handValue = 0;
                break;
            } else {
                $this->handValue += $dice->getDiceValue();
            }
        }
    }

    /**
     * Return the hand value.
     *
     * @return int
     */
    public function getHandValue()
    {
        return $this->handValue;
    }
}
