<?php
require PROJECT_ADDRESS."/lib/util/json.php";

abstract class DefaultModel {
protected static $connection;
protected $xml_model;
protected $table;
protected $fields;
protected $classe;
protected $id;

 public function init() {
 $this->table = get_class($this);
 $this->classe = new ReflectionClass(get_class($this));
 /*
 $h = new Handler(PROJECT_ADDRESS."/app/models/handlers/".get_class($this).".txt");
 $h->load();
 $h->registrar($_SERVER["DOCUMENT_ROOT"].$_SERVER["PHP_SELF"]);
 */
 }
 
 public function getClasse() {
 return $this->classe;
 }

 public function setId($id) {
 $this->id = $id;
 }

 public function getId() {
 return $this->id;
 }

 public function setConnection($c) {
 self::$connection = $c;
 }

 public function getConnection() {
 return self::$connection;
 }

 public function setTable($table) {
 $this->table = $table;
 }

 public function getTable() {
 return $this->table;
 }
 
 public function setFields($fields) {
 $this->fields = $fields;
 }
 
 public function getFields() {
 return $this->fields;
 }

 public function setXMLModel($xml_model) {
 $this->xml_model = $xml_model;
 }

 public function getXMLModel() {
 return $this->xml_model;
 }
 
 public function get_method($s) {
 $m = $this->classe->getMethod("get".ucfirst($s));
 return $m;
 }
 
 public function escape($att) {
 $m = $this->get_method($att);
 return $this->getConnection()->escape_string($m->invoke($this));
 }
 
 public function value_of($t, $q = false) {
 $me = $this->get_method($t);
 $str = $me->invoke($this);
  if ($str) {
   if ($q) {
   $str = "'".$str."'";
   }
  }
  else {
  $str = "null";
  }
 return $str;
 }
 
 public function escape_param($t,$q = false) {
 $s = $this->getConnection()->escape_string($t);
  if ($q) {
  $s = "'".$s."'";
  }
 return $s;
 }
 
 public function session($attrs = null) {
  if ($attrs == null) {
  $attrs = $this->attrs();
  }
 $at = explode(",",$attrs);
  for ($i = 0; $i < count($at); $i++) {
  $m = $this->get_method($at[$i]);
  $_SESSION[strtolower($n)][$at[$i]] = $m->invoke($this);
  }
 }
 
 public function getJson($attrs) {
 $at = explode(",",$attrs);
 $json = "";
 $i = 0;
  do {
  $m = $this->get_method($at[$i]);
  $value = "\"".$m->invoke($this)."\"";
   if (strpos($value,"{") == 1) {
   $value = $m->invoke($this);
   }
  $json .= "\"".$at[$i]."\":".$value;
  $i = $i + 1;
   if ($i < count($at)) {
   $json .= ",";
   }
  }
  while ($i < count($at));
 $js = "{".$json."}";
 return $js;
 }
 
 public function json_attribute($a) {
 $x = new JSON_Attribute($a);
 $m = $this->get_method($a);
 $b = $m->invoke($this);
 $c = escape_to_json($b);
 $x->set_value($c);
 return $x->to_s();
 }
 
 public function atualizar($n,$string = false) {
 $m = $this->escape($n);
  if ($string) {
  $m = "'".$this->escape($n)."'";
  }
 $query = "update ".$this->getTable()." set ".$n." = ".$m.
          " where id = ".$this->escape("id");
 return $this->getConnection()->executeDML($query);
 }
 
 public function get_lista($o) {
 return $this->getConnection()->toLista($o);
 }

}
?>