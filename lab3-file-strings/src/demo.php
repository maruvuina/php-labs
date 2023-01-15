<?php
function Synonim($text){
    $txt=$text;
    if(!file_exists("./syn.txt")) return $txt;
    $handle = fopen("./syn.txt", "r");
    $contents = ''; $i=0;
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
        $marr=explode("=",$buffer);
        $original=$marr[0];
        $syn=$marr[1];
        $syn=str_replace("","",$syn);
        $txt=str_replace(" ".$original." "," ".$syn." ",$txt);
        $txt=str_replace(" ".$original.","," ".$syn.",",$txt);
        $txt=str_replace(" ".$original."."," ".$syn.".",$txt);
        $txt=str_replace(" ".$original."?"," ".$syn."?",$txt);
        $txt=str_replace(" ".$original."!"," ".$syn."!",$txt);
        $txt=str_replace(" ".$original.":"," ".$syn.":",$txt);
        $i++;
    }
    fclose($handle);

    $result=$txt;
    return $result;
}

$vastext = "she likes milk";
echo Synonim($vastext);
?>