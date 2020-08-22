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
     * @var array $serie        Dice serie
     */
    private $handValue;
    private $numberOfDice;
    private $serie;

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

        // for ($i=0; $i < $this->numberOfDice; $i++) {
        //     $dice->throwDice();
        //     if ($dice->getDiceValue() == 1) {
        //         $this->handValue = 0;
        //         break;
        //     } else {
        //         $this->handValue += $dice->getDiceValue();
        //     }
        // }
        for ($i=0; $i < $this->numberOfDice; $i++) {
            $dice->throwDice();
            $this->serie[] = $dice->getDiceValue();
        }
        
        for ($i=0; $i < $this->numberOfDice; $i++) {
            if ($this->serie[$i] == 1) {
                $this->handValue = 0;
                break;
            } else {
                $this->handValue += $this->serie[$i];
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

    /**
     * Return the serie.
     *
     * @return array
     */
    public function getSerie()
    {
        return $this->serie;
    }
}
