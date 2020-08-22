<?php

namespace Seb\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Dice100 test class.
 */
class Dice100Test extends TestCase
{
    /**
     * Just assert something is true.
     */
    public function testDice100()
    {
        $dice = new Dice100();
        $this->assertInstanceOf("\Seb\Dice100\Dice100", $dice);

        $res = $dice->getDiceValue();
        $exp = null;
        $this->assertEquals($exp, $res);
        $dice->throwDice();
        $res = $dice->getDiceValue();
        $this->assertGreaterThan(0, $res);
        $this->assertLessThan(7, $res);
    }

    /**
     * Just assert something is true.
     */
    public function testHand100()
    {
        $hand = new Hand100();
        $this->assertInstanceOf("\Seb\Dice100\Hand100", $hand);

        $res = $hand->getHandValue();
        $exp = 0;
        $this->assertEquals($exp, $res);
        $hand->throwHand();
        $res = $hand->getHandValue();
        $this->assertGreaterThan(-1, $res);
        $this->assertLessThan(19, $res);
    }

    /**
     * Just assert something is true.
     */
    public function testTurn100()
    {
        $turn = new Turn100(78);
        $this->assertInstanceOf("\Seb\Dice100\Turn100", $turn);

        $turn->resetTurn();
        $res = $turn->getTurnValue();
        $exp = 0;
        $this->assertEquals($exp, $res);
        $turn->throwHand();
        $res = $turn->getTurnValue();
        $this->assertGreaterThan(-1, $res);
        $this->assertLessThan(19, $res);
        $turn->throwHand();
        $this->assertLessThan(39, $res);
    }

    /**
     * Just assert something is true.
     */
    public function testGame100()
    {
        $game = new Game100();
        $this->assertInstanceOf("\Seb\Dice100\Game100", $game);

        $exp = 0;
        $res = $game->getPlayerScore();
        $this->assertEquals($exp, $res);
        $res = $game->getComputerScore();
        $this->assertEquals($exp, $res);
        $res = $game->getTurnScore();
        $this->assertEquals($exp, $res);

        $game->rollDice();
        $game->endTurn();
        $res = $game->getTurnScore();
        $this->assertEquals($exp, $res);

        $exp = null;
        $res = $game->checkScore();
        $this->assertEquals($exp, $res);
    }

    /**
     * Just assert something is true.
     */
    public function testHistogramTrait2()
    {
        $histogram = new Game100();
        $this->assertInstanceOf("\Seb\Dice100\Game100", $histogram);

        $exp = 1;
        $res = $histogram->getHistogramMin();
        $this->assertEquals($exp, $res);

        $exp = 6;
        $res = $histogram->getHistogramMax();
        $this->assertEquals($exp, $res);

        $arr = $histogram->getHistogramSerie();
        $this->assertIsArray($arr);
    }

    /**
     * Just assert something is true.
     */
    public function testHistogram()
    {
        $histogram = new Histogram();
        $game = new Game100();
        $this->assertInstanceOf("\Seb\Dice100\Histogram", $histogram);

        $arr = $histogram->getSerie();
        $this->assertIsArray($arr);

        $histogram->injectData($game);
        
        $str = $histogram->getAsText();
        $this->assertIsString($str);
    }
}
