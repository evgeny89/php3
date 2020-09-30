<?php
/*
 * примеры
 * "Это тестовый вариант проверки (задачи со скобками). И вот еще скобки: {[][()]}"
 * 'Это тестовый вариант проверки (задачи со скобками). И вот еще скобки: {[][()]}'
 * 'Это тестовый вариант проверки (задачи со скобками)'. И вот еще скобки: {[][()]}
 * Это тестовый вариант проверки (задачи со скобками). И вот еще скобки: {[][()]}
 * ((a + b)/ c) - 2
 * "([ошибка)"
 * ([ошибка)
 * "(")
*/

$bracketsOpen = ['(', '{', '['];
$bracketsClose = [
    '(' => ')',
    '[' => ']',
    '{' => '}'
];

$pattern = ['/(".*"|\'.*\')/', '/([^\[\]\(\)\{\}]+)/'];

$str = preg_replace($pattern, '', urldecode(file_get_contents('php://input')));
$obj = new ArrayObject(str_split($str));
$iter = $obj->getIterator();

$stack = new SplStack();

while ($iter->valid()) {
    if (in_array($iter->current(), $bracketsOpen)) {
        $stack->push($iter->current());
    }
    if ((!$stack->isEmpty() && in_array($iter->current(), $bracketsClose) && $iter->current() !== $bracketsClose[$stack->top()]) || ($stack->isEmpty() && in_array($iter->current(), $bracketsClose))) {
        $stack->push('key = ' . $iter->key());
        break;
    }
    if (!$stack->isEmpty() && in_array($iter->current(), $bracketsClose) && $iter->current() === $bracketsClose[$stack->top()]) {
        $stack->pop();
    }
    $iter->next();
}

echo '<h4>' . ($stack->isEmpty() ? 'true' : 'false') . '</h4>';
?>

<form method="post">
    <input type="text" name="s">
    <button>ok</button>
</form>
