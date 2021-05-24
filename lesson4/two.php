<?php

$file = './sum.txt';

/*function writeInFile()
{
    $str = '';

    $len = rand(1000, 1100);

    while(strlen($str) < $len) {
        $str .= rand(0, 9);
    }

    file_put_contents($file, $str . PHP_EOL, FILE_APPEND);
}

writeInFile();
writeInFile();*/

function getReversNumArray($path)
{
    $arr = file($path, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    return [str_split(strrev($arr[0])), str_split(strrev($arr[1]))];
}

function sumLongDigital($path)
{
    $sumArray = getReversNumArray($path);

    $accum = 0;
    $res = [];

    list($num1, $num2) = $sumArray;

    if (count($num1) < count($num2)) {
        list($num1, $num2) = [$num2, $num1];
    }

    for ($i = 0; $i < count($num1); $i++) {
        $sum = $num1[$i] + $num2[$i] + $accum;
        if ($sum < 10) {
            $res[] = $sum;
        } else {
            $res[] = $sum % 10;
            $accum = (int) ($sum / 10);
        }
    }

   file_put_contents($path, implode(array_reverse($res)) . PHP_EOL, FILE_APPEND);
}

function multiplicationLongDigital($path)
{
    $multiArray = getReversNumArray($path);

    $accum = 0;
    $res = [];

    list($num1, $num2) = $multiArray;

    if (count($num1) < count($num2)) {
        list($num1, $num2) = [$num2, $num1];
    }

    for ($i = 0; $i < count($num1); $i++) {
        for ($j = 0; $j < count($num2); $j++) {
            $multi = $res[$i+$j] + $num1[$i] * ($j < (int)count($num2) ? $num2[$j] : 0) + $accum;
            $res[$i+$j] = (int) ($multi % 10);
            $accum = (int) ($multi / 10);
        }
    }

    return implode('', array_reverse($res));
}

//sumLongDigital($file);

echo multiplicationLongDigital($file);
