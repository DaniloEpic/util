<?php
require_once PROJECT_ADDRESS."/lib/classes/Node.php";

class Stack {
private $top;

 public function Stack() {
 $this->top = null;
 }

 public function isEmpty() {
 return ($this->top == null);
 }

 public function push($elemento) {
 $node = new Node($elemento);
  if ($this->isEmpty()) {
  $this->top = $node;
  }
  else {
  $node->setSucessor($this->top);
  $this->top = $node;
  }
 }

 public function getTop() {
 return ($this->top);
 }

 public function getSize() {
 $q = 0;
  if (!$this->isEmpty()) {
  $q = 1;
  $node = $this->top;
   while ($node->getSucessor() != null) {
   $q = $q + 1;
   $node = $node->getSucessor();
   }
  }
 return ($q);
 }

 public function pop() {
 $this->top = $this->top->getSucessor();
 }

 public function clear() {
 $i = 0;
 $q = $this->getSize();
  while ($i < $q) {
  $this->pop();
  $i = $i + 1;
  }
 }
	
 public function skip($n) {
  if ($n >= 0 and $n <= $this->getSize()) {
  $i = 0;
   while ($i < $n) {
   $this->pop();
   $i = $i + 1;
   }
  }
 }

}
?>