<?php
require_once('src/Ant.php');
$ant = new Ant();
$i = 1;
while (!$ant->isOnHighway())
{
    echo $i++;
    echo ": ";
    $ant->run();
    echo "\n";
}