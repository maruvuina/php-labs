<?php
$nameFile = "input.txt";
$input = fopen($nameFile, 'r');


$arr = array();
while (!feof($input)) {
    $line = fgets($input);
    $arr[] = $line;
}
fclose($input);


echo "<h3>Текст считанный с файла</h3>";
$arrSyn = [];
foreach($arr as $item) {
    echo "<p>$item</p>";
    $arrSyn[] = $item;
}

//$t = implode(" ", $arrSyn);
//echo "<div class = \"input\">$t</div>";

echo "<h3>После синонимизации</h3>";
if(!empty($_POST["act"])){
    if($_POST["act"]=="go") {
        $txt=implode(" ", $arrSyn);//$_POST["text"];
        $data = file('syn.txt');
        $arr = [];
        foreach($data as $v){
            list($k_,$v_) = explode('|',$v);
            @$arr[$k_] = $v_;
        }

        $str = strtr($txt, $arr);
        echo "<p>" . strtr($txt, $arr) . "</p>";
    }

    $fd = fopen("out.txt", 'w') or die("Не удалось создать файл.");
    fwrite($fd, $str);
    fclose($fd);
}

else
{
    echo'<form action="" method="POST">
                <input type="hidden" name="act" value="go">
                <!--<textarea name="text"></textarea><br/>-->
                <input class="button" type="submit" value="синонимировать">
         </form>';
}

