<?php
function agulhaNoPalheiro($palheiro, $agulha) {
 if (strlen($agulha) > 0) {
  if (strlen($palheiro) >= strlen($agulha)) {
  $j = strpos($palheiro,$agulha);
   if ($j !== false) {
   $pos = $j;
   }
  }
 }
return $j;
}

// verifica a presença de algum caractere inválido na string
function caracteres_validos($str) {
$k = false;
$i = 0;
 while ($i < strlen($str)) {
 $n = substr($str,$i,strlen($str));
 $x = ord($n);
  if ( $x >= ord('a') and $x <= ord('z') ) {
  $k = true;
  }
  else {
   if ( $x >= ord('0') and $x <= ord('9') ) {
   $k = true;
   }
   else {
    if ( $x == ord('/') or $x == ord('_') or $x == ord('-') ) {
    $k = true;
    }
    else {
    $i = strlen($str);
    $k = false;
    }
   }
  }
 $i += 1;
 }
return $k;
}

// verifica se a string é válida
function string_valida($a) {
$o = false;
 if (strlen($a) <= 20) {
 $b = trim($a,"_/-");
  if (strlen($b) == strlen($a)) {
   if (strpos($a," ") === false) {
   $b = explode("/",$a);
    if (count($b) <= 2) {
     if (caracteres_validos($a)) {
     $o = true;
     }
    }
   }
  }
 }
return $o;
}
?>