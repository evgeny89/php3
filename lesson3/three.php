<?php

function countItemInArray($search, $array)
{

    sort($array);

    if (empty($array) || (count($array) === 1 && $array[0] !== $search)) return 0;
    if (count($array) === 1 && $array[0] === $search) return 1;
    if ($search === $array[0] && $search === $array[count($array) - 1]) return count($array);

    $searchStart = null;
    $searchEnd = null;

    $start = 0;
    $end = count($array) - 1;

    while ($start <= $end) {
        $mid = round(($start + $end) / 2);

        if ($array[$mid] === $search && $array[$mid - 1] !== $search) {
            $searchStart = $mid;
            $start = $mid + 1;
            $end = count($array) - 1;
            break;
        } else {
            $array[$mid] >= $search
                ? $end = $mid - 1
                : $start = $mid + 1;
        }
    }

    while ($start <= $end) {
        $mid = round(($start + $end) / 2);

        if ($array[$mid] === $search && $array[$mid + 1] !== $search) {
            $searchEnd = $mid + 1;
            break;
        } else {
            $array[$mid] > $search
                ? $end = $mid - 1
                : $start = $mid + 1;
        }
    }

    return $searchEnd - $searchStart;
}

$arrayEmpty = [];
$arrayOne = [1];
$arrayIdentical = [4, 4, 4, 4, 4, 4];
$arrayDifferent = [50, 12, 14, 90, 65, 90, 90, 35, 90, 11, 27, 88];
$arrayDifferent2 = [50, 12, 14, 90, 65, 90, 90, 35, 90, 11, 27, 88, 3, 3, 3, 3, 3, 3];


echo countItemInArray(1, $arrayEmpty) . '<br>';
echo countItemInArray(1, $arrayOne) . '<br>';
echo countItemInArray(4, $arrayOne) . '<br>';
echo countItemInArray(1, $arrayIdentical) . '<br>';
echo countItemInArray(4, $arrayIdentical) . '<br>';
echo countItemInArray(4, $arrayDifferent) . '<br>';
echo countItemInArray(90, $arrayDifferent) . '<br>';
echo countItemInArray(3, $arrayDifferent2) . '<br>';
