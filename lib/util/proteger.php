<?php
function e_potencia($numero,$base) {
$b = false;
$num = log($numero,$base) - (int) log($numero,$base);
$b = ($num == 0);
return $b;
}

function hamming($str1,$str2) {
$quadro = array();
$vetor1 = str_split($str1);
$vetor2 = str_split($str2);
$q = count($vetor1);
$i = 0;
 do {
  if (e_potencia($i+1,2)) {
   if (isset($vetor2[0])) {
   array_push($quadro,$vetor2[0]);
   array_shift($vetor2);
   }
   else {
   array_push($quadro,"_");
   }
  }
  else {
  array_push($quadro,$vetor1[0]);
  array_shift($vetor1);
  $q = count($vetor1);
  }
 $i += 1;
 }
 while ($q > 0);
return $quadro;
}

function limpar($protegido) {
$valor = "";
 for ($j = 0; $j < count($protegido); $j = $j + 1) {
  if (!e_potencia($j + 1, 2)) {
  $valor .= $protegido[$j];
  }
 }
return $valor;
}

function protecao($s1,$s2) {
$a = hamming($s1,$s2);
$s = sha1(implode("",$a));
return $s;
}

function binario($numero) {
$s = "";
 do {
 $s = ($numero % 2)."".$s;
 $numero = $numero / 2;
 }
 while (intval($numero) > 0);
return $s;
}

function embaralhar($a,$b) {
 if (strlen($a) % 2 == 0) {
 $pass = $a;
 }
 else {
 $pass = strrev($a);
 }
$pwd = str_split($pass);
$cod = str_split(strtolower($b));
$i = 0;
 do {
  if (e_potencia($i,2)) {
  $t = $pwd[$i];
   if (count($cod) > 0) {
   $pwd[$i] = array_pop($cod);
   }
   else {
   $pwd[$i] = "_";
   }
  $pwd[count($pwd)] = $t;
  }
 $i = $i + 1;
 }
 while ($i < strlen($a));
$str = implode("",$pwd);
 do {
 $n = count($cod) - 1;
  if ($n % 2 == 0) {
  $str .= "".array_pop($cod);
  }
  else {
  $str = array_pop($cod)."".$str;
  }
 }
 while (count($cod) > 0);
return sha1($str);
}
?>