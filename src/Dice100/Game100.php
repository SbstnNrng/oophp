<?php

namespace Seb\Dice100;

/**
 * Game, a class supporting the game through GET, POST and SESSION.
 */
class Game100
{
    /**
     * @var int $playerScore        Player score.
     * @var int $computerScore      Computer score.
     * @var int $turnScore          Turn score.
     * @var int $compTurnScore          Turn score.
     */
    private $playerScore;
    private $computerScore;
    private $turnScore;
    private $compTurnScore;

    /**
     * Constructor to initiate the object with current game settings,
     * if available.
     *
     * @param int $playerScore          Value of the turn.
     * @param int $computerScore        Value of the turn.
     * @param int $turnScore            Value of the turn.
     * @param int $compTurnScore        Value of the turn.
     */
    public function __construct()
    {
        $this->playerScore = 0;
        $this->computerScore = 0;
        $this->turnScore = 0;
        $this->compTurnScore = 0;
    }

    /**
     * Roll dice
     *
     * @return int
     */
    public function rollDice()
    {
        $turn = new Turn100();

        $turn->throwHand();
        if ($turn->getTurnValue() == 0) {
            $this->turnScore = 0;
            $this->computerPlay();
            return $turn->getTurnValue();
        } else {
            $this->turnScore += $turn->getTurnValue();
            return $turn->getTurnValue();
        }
    }

    /**
     * End turn
     *
     * @return void
     */
    public function endTurn()
    {
        $this->playerScore += $this->turnScore;
        $this->turnScore = 0;
        $this->computerPlay();
    }

    /**
     * End turn
     *
     * @return void
     */
    public function computerPlay()
    {
        $compTurn = new Turn100();
        for ($i=0; $i < 2; $i++) {
            $compTurn->throwHand();
            if ($compTurn->getTurnValue() == 0) {
                $this->compTurnScore = 0;
                break;
            } else {
                $this->compTurnScore += $compTurn->getTurnValue();
                $compTurn->resetTurn();
            }
        }
        $this->computerScore += $this->compTurnScore;
        $this->compTurnScore = 0;
    }

    /**
     * Check score
     *
     * @return string
     */
    public function checkScore()
    {
        if ($this->playerScore >= 100 && $this->computerScore >= 100) {
            return "Game Over! It was a draw!";
        } elseif ($this->playerScore >= 100) {
            return "Game Over! Player won!";
        } elseif ($this->computerScore >= 100) {
            return "Game Over! Computer won!";
        }
    }

    /**
     * get player score
     *
     * @return int
     */
    public function getPlayerScore()
    {
        return $this->playerScore;
    }

    /**
     * get computer score
     *
     * @return int
     */
    public function getComputerScore()
    {
        return $this->computerScore;
    }

    /**
     * get turn score
     *
     * @return int
     */
    public function getTurnScore()
    {
        return $this->turnScore;
    }
}
