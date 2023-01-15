<?php

$txt="раз деление";
$data = file('syn.txt');
$arr = [];
foreach($data as $v){
    list($k_,$v_) = explode('|',$v);
    @$arr[$k_] = $v_;
}
print strtr($txt, $arr);