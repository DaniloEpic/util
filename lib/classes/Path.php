<?php
require_once PROJECT_ADDRESS."/lib/classes/LinkedList.php";

class Component {
private $id;
private $input;
private $output;
private $unset;

 public function Component($id) {
 $this->id = $id;
 $this->input = "";
 $this->output = "";
 $this->unset = "";
 }
 
 public function getId() {
 return $this->id;
 }
 
 public function addInput($input) {
 $i = explode(":",$input);
 $s = "$"."_".strtoupper($i[0])."[\"".$i[1]."\"]";
 $this->input .= $s."<br/>";
 }
 
 public function setInput($input) {
 $this->input .= $input;
 }
 
 public function getInput() {
 return $this->input;
 }
 
 public function addOutput($output) {
 $o = explode(":",$output);
 $s = "$"."_".strtoupper($o[0])."[\"".$o[1]."\"]";
 $this->output .= $s."<br/>";
 }
 
 public function getOutput() {
 return $this->output;
 }
 
 public function setUnset($unset) {
 $this->unset .= $unset;
 }
 
 public function getUnset() {
 return $this->unset;
 }
 
 public function xml() {
 $xml = "<COMPONENT>".
        "<id>".$this->id."</id>".
        "<input>".$this->input."</input>".
        "<output>".$this->output."</output>".
        "<unset>".$this->unset."</unset>".
		"</COMPONENT>";
 return $xml;
 }
 
}

class Path extends LinkedList {

 public function addComponent(Component $c) {
  if ($this->ultimo) {
  $c->setInput($this->ultimo->getElemento()->getOutput());
  }  
 parent::append($c);
 }
 
 public function view() {
 $f = $this->getFirst();
  while ($f) {
  echo "<div style=\"display:inline-block;vertical-align:middle;font-family:sans-serif;\">\n";
  echo "<div style=\"float:left;border-style:solid;border-width:1px;padding:5px;\">".
       "<p><sup>".$f->getElemento()->getInput()."</sup></p>\n";
  echo "<p><strong>".$f->getElemento()->getId()."</strong></p>\n";
  echo "<p><sub>".$f->getElemento()->getOutput()."</sub></p>\n";
  echo "<p><sub><del>".$f->getElemento()->getUnset()."</del></sub></p></div>\n";
   if ($f->getSucessor()) {
   echo "<div style=\"float:right;\">&nbsp;&rarr;&nbsp;</div>";
   }
  echo "</div>\n\n";
  $f = $f->getSucessor();
  }
 }
 
}
?>