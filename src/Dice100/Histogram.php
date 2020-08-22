<?php

namespace Seb\Dice100;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $dots = "";
        $strHist = "";
        for ($i=0; $i < $this->max; $i++) {
            for ($j=0; $j < count($this->serie); $j++) {
                if (($i + 1) == $this->serie[$j]) {
                    $dots .= "*";
                }
            }
            $strHist .= ($i + 1) . ": " . $dots . "\n";
            $dots = "";
        }
        return $strHist;
    }
}
