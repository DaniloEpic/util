<?php
abstract class Controller {

 public static function defaultModel($m=null) {
  if ($m != null) {
  static::$model = $m;
  }
  else {
  return static::$model;
  }
 }

 public static function getMethods() {
 $m = static::$classe->getMethods();
 $a = array();
  for ($i=0; $i < count($m); $i++) {
  $c = $m[$i]->getDeclaringClass()->getName();
   if ($c == static::$classe->getName()) {
   $a[$i]["name"] = $m[$i]->getName();
   }
  }
 return $a;
 }

 public static function set($a,$b) {
 $c = static::$model->getClasse();
 $d = "set".ucfirst(strtolower($a));
 $m = $c->getMethod($d);
 $m->invoke(static::$model,$b);
 }

 public static function get($a) {
 $m = static::$model->get_method($a);
 return $m->invoke(static::$model);
 }

 public static function from_array($m,$n=false) {
 $o = static::$model;
 $q = explode(",",$o->getFields());
  if ($n) {
  $p = $o->getClasse()->newInstance();
  }
  for ($i=0; $i < count($q); $i++) {
  $a = "set".ucfirst(strtolower($q[$i]));
  $r = $o->getClasse()->getMethod($a);
  $b = $m["".$q[$i].""];
   if ($p) {
   $r->invoke($p,$b);
   }
   else {
   $r->invoke($o,$b);
   }
  }
 return $p;
 }

 public static function set_exception($k,$v) {
 static::$exception->set($k,$v);
 }

 public static function unset_exception($n) {
 static::$exception->excluir($n);
 }

 public static function has_exception() {
 return (static::$exception->size() > 0);
 }

 public static function get_exception($n) {
 return static::$exception->get($n);
 }

 public static function print_exception($n,$a=null) {
 $alt = "houve um erro!";
 $h = self::has_exception();
  if ($h) {
  echo self::get_exception($n);
  }
  else {
   if ($a != null) {
   $alt = $a;
   }
  echo $alt;
  }
 }

}
?>