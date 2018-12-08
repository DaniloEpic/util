<?php
require PROJECT_ADDRESS."/lib/util/LimitHelper.php";

abstract class Set {
public static $lista;
public static $total;
public static $limit;

 public static function init() {
 self::$limit = new Limit();
 }
 
 public static function setLista(Lista $a) {
 self::$lista = $a;
 }
 
 public static function setLimit($m) {
 self::$limit->fromString($m);
 }
 
 public static function getLimit($n = null) {
  if ($n != null) {
  self::$total = $n;
   if ( intval(self::$limit->getComecando_em()) < 0 ) {
   self::$limit->ultimaPagina($n);
   }
  }
 return self::$limit;
 }
 
 public static function itens($s) {
 $i = new JSON_Attribute("itens");
 $i->set_value(json_transposta(self::$lista->get_array(),$s));
 return $i;
 }
 
 public static function data_json_array($k) {
 $a = new JSON_Array(self::$lista->get_array());
 $s = $a->get_data($k);
 return "\"".$k."\":".$s;
 }
 
 public static function loop() {
 $a = new JSON_Array(self::$lista->get_array());
 $s = $a->loop_with(null,null);
 return $s;
 }
 
 public static function pages() {
 $p = new JSON_Attribute("pages");
 $p->set_value(self::$limit->json_pages(self::$lista->getSize()));
 return $p;
 }
 
 public static function total() {
 $t = new JSON_Attribute("total");
 $t->set_value(self::$total);
 return $t;
 }

}

function get_limit($x = null) {
return Set::getLimit($x);
}
?>