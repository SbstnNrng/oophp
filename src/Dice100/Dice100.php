<?php

namespace Seb\Dice100;

/**
 * Dice, a class supporting the game through GET, POST and SESSION.
 */
class Dice100
{
    /**
     * @var int $sides          Number of sides on dice.
     * @var int $throwValue     Value of dice throw.
     */
    private $sides;
    private $throwValue;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $sides  The current amount of sides, default 6 to initiate
     *                    the dice from start.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Randomize the dice value between 1 and 6.
     *
     * @return integer random value between 1 and 6
     */
    public function throwDice()
    {
        $this->throwValue = rand(1, 6);
        return $this->throwValue;
    }

    /**
     * Return the dice value.
     *
     * @return int
     */
    public function getDiceValue()
    {
        return $this->throwValue;
    }
}
