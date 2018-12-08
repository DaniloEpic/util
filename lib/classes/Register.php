<?php
require_once PROJECT_ADDRESS."/lib/classes/SequentialLinkedList.php";

class Register {
private $atributos;

 public function Register() {
 $this->atributos = new SequentialLinkedList();
 }
 
 public function from_array($vector,$attributes) {
 $attrs = explode(",",$attributes);
  for ($i = 0; $i < count($attrs); $i++) {
  $na = $attrs[$i];
  $va = $vector["".$na.""];
  $at = new Attribute($na,$va);
  $this->atributos->set($at,"getName");
  }
 }
 
 public function from_string($str) {
 $a = explode(";",$str);
  for ($i = 0; $i < count($a); $i++) {
  $m = explode(":=",$a[$i]);
   if (count($m) == 2) {
   $at = new Attribute($m[0],$m[1]);
   $this->atributos->set($at,"getName");
   }
  }
 }
 
 public function to_string() {
 $node = $this->atributos->getFirst();
 $s = "";
  for ($n = 0; $n < $this->atributos->getSize(); $n++) {
  $at = $node->getElemento();
   if (strlen($s) > 0) {
   $s .= ";";
   }
  $s .= $at->getName().":=".$at->getValue();
   if ($node->getSucessor() != null) {
   $node = $node->getSucessor();
   }
  }
 return $s;
 }
 
 public function getAtributos() {
 return $this->atributos;
 }
 
 public function get_lista() {
 return $this->atributos->to_lista();
 }
 
 public function set($name,$value) {
 $n = $this->atributos->get("getName",$name);
  if ($n) {
  $n->getElemento()->setValue($value);
  }
  else {
  $att = new Attribute($name,$value);
  $this->atributos->set($att,"getName");
  }
 }
 
 public function get($name) {
 $n = $this->atributos->get("getName",$name);
  if ($n) {
  $e = $n->getElemento();
   if ($e) {
   $v = $e->getValue();
   }
  }
 return $v;
 }
 
 public function excluir($name) {
 $d = false;
 $k = $this->atributos->getSize();
 $this->atributos->remove("getName",$name);
  if ($this->atributos->getSize() < $k) {
  $d = true;
  }
 return $d;
 }
 
 public function size() {
 return $this->atributos->getSize();
 }
 
}
?>