<?php

//add sunday trigger
//verify and validate roll numbers NO TWO ROLL NUMBERS CAN BE IDENTICAL
//session expire problem
//defaulter students list
//
date_default_timezone_set('Asia/Calcutta');
echo date('y-m-d', time()-24*60*60).'<br>';
echo strtotime(h-i-s,time());
$d1= date('h:i:s a',time()).'<br>';
 $d2=date('h:i:s a',time()+(10*60*60));
 $d2='08:11:01 pm';
if($d1>$d2)echo $d1;else echo $d2;
$h="mohit gauniyal";

$h=strrev($h);
$pos= strpos($h,'i').'<br>';
$h[$pos]=' ';
$h=  strrev($h);
echo '<br>'.$h;

echo '<br>'.time($d1);
echo '<br>'.$d1;
$d1='16-09-29';
$d2='16-10-1';
echo date('D', time(strtotime($d2))).'<br>';
while(strtotime($d1)<=strtotime($d2)){
    echo "$d1<br>";
    $d1=date('y-m-d',strtotime('+1 days',strtotime($d1)));
}
$d2='16-10-1';
$d2=date('Y-M-d',strtotime($d2));
echo $d2.'<br>';

$data="cs_3_cpp.anudeep.Anudeep%20gusain";
$data=explode('.',$data);
$subject_id=$data[0];
$username=$data[1];
$teacher_name=$data[2];
$teacher_name=  str_replace('%20', ' ',$teacher_name);
echo "\n$subject_id............$username..........$teacher_name";