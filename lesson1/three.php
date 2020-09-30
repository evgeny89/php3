<?php

$path = $_GET['path'] ?? __DIR__;
$upPath = dirname($path);

echo "<a href=\"?path={$upPath}\">..</a><br>";

$queue = new SplQueue();

foreach (new DirectoryIterator($path) as $fileInfo) {
    if ($fileInfo->isDot()) continue;
    if ($fileInfo->isDir()) {
        echo "<a href=\"?path={$path}/{$fileInfo->getFilename()}\">{$fileInfo->getFilename()}</a><br>";
    } else {
        $queue->enqueue($fileInfo->getFilename());
    }
}

foreach ($queue as $file) {
    echo $file . '<br>';
}



