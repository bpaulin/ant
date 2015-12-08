<?php

class Ant {
    const WHITE = false;
    const BLACK = true;

    protected $board;
    protected $antX;
    protected $antY;
    protected $antAngle;
    protected $history;

    public function __construct(){
        $this->board = array();
        $this->history = array();
        $this->antX = 0;
        $this->antY = 0;
        $this->antAngle = 0;
    }

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
        printf(
            '%s, %s is %s: ant turn to %s and move to %s, %s',
            $antX,
            $antY,
            ($actualColor == self::WHITE)? 'white': 'black',
            $this->antAngle,
            $this->antX,
            $this->antY
        );
        return $this->isOnHighway();
    }

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

    protected function initColor($x, $y) {
        if (!isset($this->board[$x])) {
            $this->board[$x] = array();
        }
        if (!isset($this->board[$x][$y])) {
            $this->board[$x][$y] = self::WHITE;
        }
    }

    protected function getColor($x, $y){
        $this->initColor($x, $y);
        return $this->board[$x][$y];
    }

    protected function changeColor($x, $y){
        $this->initColor($x, $y);
        $this->board[$x][$y] = !$this->board[$x][$y];
    }

}