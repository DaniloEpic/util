<?php
require_once PROJECT_ADDRESS."/lib/classes/Lista.php";

abstract class ListaHelper {
public static $lista;

 public static function init(Lista $lista, $n) {
 self::$lista = $lista;
 self::$lista->setQuantidadePorPagina($n);
 self::$lista->paginar();
 }
 
 public static function loop() {
 $j = self::$lista->from();
 $k = 0;
  do {
   if ($j < self::$lista->getSize()) {
   whoCanDoIt(self::$lista->getElement($j));
   $j = $j + 1;
   $k = $k + 1;
   }
   else {
   $k = self::$lista->getQuantidadePorPagina();
   }
  }
  while ($k < self::$lista->getQuantidadePorPagina());
 }
 
 public static function loop_when() {
 $j = self::$lista->from();
 $k = 0;
  do {
   if ($j < self::$lista->getSize()) {
   when(self::$lista,$j);
   $j = $j + 1;
   $k = $k + 1;
   }
   else {
   $k = self::$lista->getQuantidadePorPagina();
   }
  }
  while ($k < self::$lista->getQuantidadePorPagina());
 }
 
 public static function paginas() {
 return self::$lista->getPaginador()->to_s(self::$lista->getSize());
 }
 
 public static function slider() {
 $slider = new Slider(self::$lista->getSize(),self::$lista->getQuantidadePorPagina());
 return $slider->to_s();
 }
 
}
?>