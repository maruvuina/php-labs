<?php
$array = array("//Минск", "Брест", "Гродно", "//Гомель", "Витебск", "Могилёв", "//Бобруйск",
    "//Барановичи", "Новополоцк", "Пинск");

echo "<h2>Исходный массив строк</h2>";
foreach($array as $item)
    echo "<p>$item</p>";

echo "<h2>Задание</h2>";
echo "<h3>1.25.	В массиве из n строк проверьте, содержит ли	k-я	строка первые символы «//».</br>
        Если не	содержит, вставьте эти символы встроку.</h3>";

$str = "//";
foreach ($array as $key => $item)
    if (!strncmp($array[$key], $str, 1 ) == 0)
        $array[$key] = substr_replace($array[$key], $str, 0, 0);

echo "<h2>Результат</h2>";
foreach($array as $item)
    echo "<p>$item</p>";