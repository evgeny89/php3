<?php

function searchSkipItem($arr)
{
    $count = count($arr);
    if (!$count) return 1;

    $start = 0;
    $end = $count - 1;

    while ($start < $end) {
        $mid = (int)round(($end + $start) / 2);

        if ($arr[$mid] === $mid + 1 && $arr[$mid + 1] === $mid + 3) return $mid + 2;

        $arr[$mid] === $mid + 1
            ? $start = $mid + 1
            : $end = $mid - 1;
    }
    return 0;
}

$arr1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16];
$arr2 = [1, 2, 4, 5, 6];
$arr3 = [];

echo searchSkipItem($arr1) . '<br>';
echo searchSkipItem($arr2) . '<br>';
echo searchSkipItem($arr3);
