<?php
/*
 * 600851475143
 * 13195
 */
$num = (int)str_replace('n=', '', urldecode(file_get_contents('php://input')));

function getMaxSimpleNum($num)
{
    while ($num % 2 === 0) {
        $num /= 2;
    }

    $start = 3;
    $res = 1;
    while ($num > 1) {
        $start = getDividers($num, $start);
        $num /= $start;
        $res = $num !== 1 ? $num : $res;
    }
    return $res;
}

function getDividers($num, $start)
{
    for ($i = $start; $i * $i <= $num; $i += 2) {
        if ($num % $i === 0) return $i;
    }
    return $num;
}

list($start) = explode(' ', microtime());
$res = getMaxSimpleNum($num);
list($end) = explode(' ', microtime());

echo bcsub($end, $start, 6) . ' sec<br>';
echo $res . '<br>';
?>

<form method="post">
    <input type="number" name="n">
    <button>ok</button>
</form>