<?php
function get_indice($array,$element) {
$k = -1;
 if (count($array) > 0) {
 $i = 0;
  do {
   if ($array[$i] == $element) {
   $k = $i;
   $i = count($array);
   }
   else {
   $i = $i + 1;
   }
  }
  while ($i < count($array));
 }
return $k;
}

function sub_array($array,$i,$j) {
$new_array = array();
 if ($i >= 0 and $i <= count($array) - 1) {
  if ($j >= $i and $j <= count($array) - 1) {
  $q = $j - $i + 1;
  $new_array = array_slice($array,$i,$q);
  }
 }
return $new_array;
}

function concatenar($array1,$array2) {
$new_array = array();
 for ($i = 0; $i < count($array1); $i++) {
 array_push($new_array,$array1[$i]);
 }
 for ($j = 0; $j < count($array2); $j++) {
 array_push($new_array,$array2[$j]);
 }
return $new_array;
}

function remover_elemento($array,$elemento) {
$k = get_indice($array,$elemento);
 if ($k >= 0 and $k <= count($array) - 1) {
 $p1 = array();
 $p2 = array();
 $p1 = sub_array($array,0,$k);
  if ($k < count($array) - 1) {
  $p2 = sub_array($array,$k + 1,count($array) - 1);
  }
 array_pop($p1);
 $array = concatenar($p1,$p2);
 }
return $array;
}

function get_codigo($n) {
$chars = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9";
$e = explode(",",$chars);
$cod = "";
 do {
 $num = rand(0,count($e) - 1);
 $f = $e[$num];
 $cod .= $f;
 $e = remover_elemento($e,$f);
 $n = $n - 1;
 }
 while ($n > 0);
return $cod;
}
?>