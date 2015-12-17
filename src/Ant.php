<?php

/**
 * Class Ant
 *
 * An ant is on a limitless board, with cases either black or white
 * Each turn, the ant turn on the right if the current case is white, or to the left if it's black
 * It then change the color of the current case, and move forward to the case in front of it
 *
 * After a unknow duration, the ant will repeat the same 104 steps forever. it's called the highway
 */
class Ant {

    /**
     * value for white case
     */
    const WHITE = false;
    /**
     * value for black case
     */
    const BLACK = true;

    /**
     * @var array the board where the ant is
     */
    protected $board;
    /**
     * @var int ant's X position
     */
    protected $antX;
    /**
     * @var int ant's Y position
     */
    protected $antY;
    /**
     * @var int ant's orientation
     */
    protected $antAngle;
    /**
     * @var array every orientations
     */
    protected $history;

    /**
     * Constructor
     */
    public function __construct(){
        $this->board = array();
        $this->history = array();
        $this->antX = 0;
        $this->antY = 0;
        $this->antAngle = 0;
    }

    /**
     * Do one turn actions
     *
     *  * turn depending of current case
     *  * change current case color
     *  * move forward
     *
     * @return string log of thes actions
     */
    public function run(){
        $antX = $this->antX;
        $antY = $this->antY;
        $actualColor = $this->getColor(
            $this->antX,
            $this->antY
        );
        $this->history[] = $this->turnAnt( $actualColor );
        $this->changeColor(
            $this->antX,
            $this->antY
        );
        $this->moveAnt();
        return sprintf(
            '%s, %s is %s: ant turn to %s and move to %s, %s',
            $antX,
            $antY,
            ($actualColor == self::WHITE)? 'white': 'black',
            $this->antAngle,
            $this->antX,
            $this->antY
        );
    }

    /**
     * Detect if ant did the same steps twice
     *
     * @param int $duration number of steps
     * @return bool
     */
    public function isOnHighway($duration = 104){
        $max = count($this->history)-1;
        if ($max+1<$duration*2){
            return false;
        }
        for ($i = 0; $i<=$duration; $i++){
            if ($this->history[$max-$i] != $this->history[$max-$i-$duration]) {
                return false;
            }
        }
        return true;
    }

    /**
     * move ant forward, according to its orientation
     */
    protected function moveAnt(){
        switch($this->antAngle){
            case 0:
                $this->antX += 1;
                break;
            case 90:
                $this->antY += 1;
                break;
            case 180:
                $this->antX -= 1;
                break;
            case 270:
                $this->antY -= 1;
                break;
        }
    }

    /**
     * change ant orientation, according to case color
     *
     * @param $color boolean the case where the ant is
     * @return int the new orientation
     */
    protected function turnAnt($color){
        if ($color == self::WHITE) {
            $this->antAngle += 90;
        }
        else {
            $this->antAngle -=90;
        }
        if ($this->antAngle>=360) {
            $this->antAngle -= 360;
        } elseif ($this->antAngle<0) {
            $this->antAngle += 360;
        }
        return $this->antAngle;
    }

    /**
     * Check taht case existsn increasing the board if needed
     *
     * @param $x integer X position
     * @param $y integer Y Position
     */
    protected function initColor($x, $y) {
        if (!isset($this->board[$x])) {
            $this->board[$x] = array();
        }
        if (!isset($this->board[$x][$y])) {
            $this->board[$x][$y] = self::WHITE;
        }
    }

    /**
     * return color in coordinates on board
     *
     * @param $x integer X Position
     * @param $y integer Y Position
     * @return boolean
     */
    protected function getColor($x, $y){
        $this->initColor($x, $y);
        return $this->board[$x][$y];
    }

    /**
     * Change color in coordinates on board
     *
     * @param $x integer X Position
     * @param $y integer Y Position
     */
    protected function changeColor($x, $y){
        $this->initColor($x, $y);
        $this->board[$x][$y] = !$this->board[$x][$y];
    }

}