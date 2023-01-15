<?php
$source = "input.txt";
require "synonimizer.php";
ob_implicit_flush(true);

$syn = new synonimizer();
$buffer = file_get_contents($source);

echo "working...\n";

function kupper($matches) {
    return '. ' . ucfirst($matches[1]);
}

// функция обратного вызова
function kreplace($matches)
{
    GLOBAL $syn;
    $text = $syn->syn($matches[2]);
    $text = preg_replace_callback('#\. ([а-я]+)#', "kupper", $text);
    $text = ucfirst($text);
    $text = $matches[1] . $text . $matches[3];
    return $text;
}

$buffer = preg_replace_callback(
    '#( = \')(.*)(\')#U',
    "kreplace",
    $buffer);


file_put_contents('result.txt', $buffer);