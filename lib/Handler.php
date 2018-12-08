<?php
require_once PROJECT_ADDRESS."/lib/classes/Arquivo.php";
require_once PROJECT_ADDRESS."/lib/classes/SequentialLinkedList.php";

class Handler {
private $scripts;
private $registrados;

 public function Handler($e) {
 $this->scripts = new SequentialLinkedList();
 $f = Arquivo::init($e);
  if ($f) {
  $this->registrados = $f;
  }
  else {
  file_put_contents($e,"");
  $this->registrados = Arquivo::init($e);
  }
 }
 
 public function load() {
 $c = file_get_contents($this->registrados->getCaminho());
 $a = explode("\n",$c);
  for ($i = 0; $i < count($a); $i++) {
  $f = Arquivo::init($a[$i]);
   if ($f) {
   $this->scripts->set($f,"getCaminho");
   }
  }
 }
 
 private function get_scripts() {
 $v = $this->scripts->to_lista();
 $s = "";
  for ($i = 0; $i < $v->getSize(); $i++) {
   if ($s != "") {
   $s .= "\n";
   }
  $s .= $v->getElement($i)->getCaminho();
  }
 return $s;
 }
 
 public function registrar($p) {
 $f = Arquivo::init($p);
 $k = $this->scripts->getSize();
 $this->scripts->set($f,"getCaminho");
  if ($this->scripts->getSize() > $k) {
  file_put_contents($this->registrados->getCaminho(),$this->get_scripts());
  }
 }

}
?>