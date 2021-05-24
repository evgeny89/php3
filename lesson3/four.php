<?php

function arraySortFromMerge(array $array): array
{
    $count = count($array);

    if($count <= 1) return $array;

    $left = array_slice($array, 0, round($count / 2));
    $right = array_slice($array, round($count / 2));

    $left = arraySortFromMerge($left);
    $right = arraySortFromMerge($right);

    return merge($left, $right);
}

function merge(array $left, array $right): array
{
    $result = [];

    while (count($left) > 0 && count($right) > 0) {
        $result[] = $left[0] > $right[0] ? array_shift($right) : array_shift($left);
    }

    array_splice($result, count($result), count($left), $left);
    array_splice($result, count($result), count($right), $right);

    return $result;
}

$oddArray = [1, 3, 5, 24, 12, 51, 9, 65, 4, 11, 2];
$evenArray = [32, 46, 12, 11, 3, 14, 95, 99, 47, 2, 25, 28];

var_dump(arraySortFromMerge($oddArray));
var_dump(arraySortFromMerge($evenArray));
