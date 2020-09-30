<?php

function writeSpiralNumOrder($col, $row)
{
    $k = 0;
    $arr = [];
    $list = 0;

    while ($list <= $col * $row) {
        for($i = $k; $i < $row - $k; $i++) {
            $arr[$i][$k] = ++$list;
            if($list === $col * $row) break 2;
        }
        for($i = 1 + $k; $i < $col - 1 - $k; $i++){
            $arr[$row - 1 - $k][$i] = ++$list;
            if($list === $col * $row) break 2;
        }
        for($i = $row - 1 - $k; $i >= $k; $i--) {
            $arr[$i][$col - 1 - $k] = ++$list;
            if($list === $col * $row) break 2;
        }
        for($i = $col - 2 - $k; $i > $k; $i--){
            $arr[$k][$i] = ++$list;
            if($list === $col * $row) break 2;
        }
        $k++;
    }
    foreach ($arr as &$value) {
        ksort($value);
    }
    return $arr;
}

foreach (writeSpiralNumOrder(4, 3) as $val) {
    echo implode(' | ', $val) . '<br>';
}

echo '<hr>';

foreach (writeSpiralNumOrder(6, 3) as $val) {
    echo implode(' | ', $val) . '<br>';
}

echo '<hr>';

foreach (writeSpiralNumOrder(5, 4) as $val) {
    echo implode(' | ', $val) . '<br>';
}

echo '<hr>';

foreach (writeSpiralNumOrder(5, 5) as $val) {
    echo implode(' | ', $val) . '<br>';
}

echo '<hr>';

foreach (writeSpiralNumOrder(3, 5) as $val) {
    echo implode(' | ', $val) . '<br>';
}
