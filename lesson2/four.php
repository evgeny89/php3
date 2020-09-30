<?php
/**
 * получает число и вычисляет какой строке оно принадлежит (или какому элементу массива)
 * @param $num integer - позиция
 * @return integer - номер строки
 */
function getLine(int $num)
{
    return round(sqrt($num * 2));
}

/**
 * высчитывает количество символов - по сути сама по себе бе сполезна, нужна при рекурсии вычислять количество цифр в цислах с нескольцими цифрами
 * @param $k integer - всего строк
 * @return integer - количество символов
 */
function sumCount(int $k)
{
    return $k * ($k + 1) / 2;
}

/**
 * рекурсивно вычисляет количество символов в последовательности 123456789101112...$line
 * @param int $line - номер строки (например 101)
 * @param int $rec - индекс рекурсии (каждый новый вызов увеличивает на 10 для определения с какой разрядностью работаем)
 * @return int количество цифр в строке
 */
function getCountDigInLine(int $line, $rec = 1)
{
    $count = $line;
    if ($line > 9 * $rec) {
        $count += getCountDigInLine($line - 9 * $rec, $rec * 10);
    }
    return $count;
}

/**
 * рекурсивно вычисляет количество чисел в полном ряде
 * @param $line - номер строки
 * @param int $rec - разрадность для рекурсии
 * @return integer - количество цифр от начала счета до конца указанной строки
 */
function getDigital($line, $rec = 1)
{
    $count = 0;
    if ($line > 0) {
        $count = sumCount($line);
        $count += getDigital($line - 9 * $rec, $rec * 10);
    }
    return $count;
}

/**
 * функция определяет истинную линию последовательности для заданного $position
 * @param $position - номер цифры в бесконечной последовательности
 * @return int - номер строки которой принадлежит искомая цифра
 */
function getLineInPosition($position)
{
    $end = getLine($position);
    if($end < 10) return $end;
    $start = 0;

    while ($start <= $end) {
        $center = round(($end + $start) / 2);
        $centerLine = getDigital($center);
        if (getDigital($center - 1) < $position && $centerLine >= $position) {
            return $center;
        } else {
            $centerLine > $position ? $end = $center : $start = $center + 1;
        }
    }
}

function searchNumberInLine($position) {
   $k = 9;
   $capacity = 1;
   $count = 0;
   $beforeCount = 0;

   while($position > $count) {
       $beforeCount = $count;
       $count += $k * $capacity;
       $k *= 10;
       $capacity++;
   }

   var_dump($k, $capacity, $count, $beforeCount);

   echo ($k - $beforeCount) / $capacity;
}

$num = 999999999999999999;
$line = getLineInPosition($num);
$position =  getCountDigInLine($line) - ($num - getDigital($line - 1));
searchNumberInLine($position);

