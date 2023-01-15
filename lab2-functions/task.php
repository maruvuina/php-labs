<?php

echo "<h2>Задание</h2>";
echo "<h3>Вычислить определенный интеграл I = ∫f(x)dx от a до b методом прямоугольников.</h3>";
echo "<p>Например:</p></br>";

//1/log($x)
//a=2, b=5, n=10

function fun($x) //Подынтегральная функция
{
    return sin($x); //Например, sin(x)
}

function CalcIntegral($a, $b, $n) {
    $result = 0;

    $h = ($b - $a) / $n; //Шаг

    for($i = 0; $i < $n; $i++)
    {
        $result += fun($a + $h * ($i + 0.5)); //Вычисляем
    }
    $result *= $h;

    return $result;
}

$integral = CalcIntegral(0, 3.14, 500);
echo "<p>Интеграл: a=0, b=3.14, ∫sin(x)dx = $integral</p>";

?>