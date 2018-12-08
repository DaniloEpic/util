<?php
require_once PROJECT_ADDRESS."/lib/classes/Node.php";

class Queue {
private $head;
private $tail;

 public function Queue() {
 $this->head = null;
 $this->tail = null;
 }

 public function isEmpty() {
 return ($this->head == null);
 }

 public function in($elemento) {
 $node = new Node($elemento);
  if ($this->isEmpty()) {
  $this->head = $node;
  $this->tail = $this->head;
  }
  else {
   if ($this->head->getSucessor() == null) {
   $this->head->setSucessor($node);
   $node->setAntecessor($this->head);
   }
   else {
   $this->tail->setSucessor($node);
   $node->setAntecessor($this->tail);
   }
  $this->tail = $node;
  }
 }

 public function getHead() {
 return ($this->head);
 }

 public function getTail() {
 return ($this->tail);
 }

 public function getSize() {
 $q = 0;
  if (!$this->isEmpty()) {
  $q = 1;
  $node = $this->head;
   while ($node->getSucessor() != null) {
   $q = $q + 1;
   $node = $node->getSucessor();
   }
  }
 return ($q);
 }

 public function out() {
 $this->head = $this->head->getSucessor();
 }

 public function walk($d) {
  if ($d >= 0 and $d <= $this->getSize()) {
  $i = 0;
   while ($i < $d) {
   $this->out();
   $i = $i + 1;
   }
  }
 }

 public function clear() {
 $this->walk($this->getSize());
 }

}
?>