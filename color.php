<?php
function getDarketColor($color, $value = 50)
{
    $color = str_replace('#', '', $color);
    $items = str_split($color, 2);
    foreach ($items as &$item) {
        $item = hexdec($item) - $value;
        if($item < 0) $item = 0;
        $item = dechex($item);
        if(strlen($item) === 1) $item = "0$item";
    }
    echo '#' . implode($items);
}

getDarketColor('#238fd4', 30);