<?php
require_once PROJECT_ADDRESS."/lib/classes/Node.php";

class LinkedList {
protected $tamanho;
protected $primeiro;
protected $ultimo;

 public function LinkedList() {
 $this->tamanho = 0;
 $this->primeiro = null;
 $this->ultimo = null;
 }

 public function isEmpty() {
 return ($this->tamanho == 0);
 }

 public function getSize() {
 return ($this->tamanho);
 }

 public function getFirst() {
 return ($this->primeiro);
 }

 public function getLast() {
 return ($this->ultimo);
 }

 public function get($i) {
 $j = 0;
  if ( ($i > 0) and ($i <= $this->tamanho) ) {
   if ( ($i - 1) < ($this->tamanho - $i) ) {
   $node = $this->getFirst();
    while ($j < ($i - 1)) {
    $node = $node->getSucessor();
    $j += 1;
    }
   }
   else {
   $node = $this->getLast();
    while ($j < ($this->tamanho - $i)) {
    $node = $node->getAntecessor();
    $j += 1;
    }
   }
  }
 return ($node);
 }

 public function set($elemento,$i) {
 $node = new Node($elemento);
  if ($this->isEmpty()) {
  $this->primeiro = $node;
  $this->ultimo = $this->primeiro;
  $this->tamanho += 1;
  }
  else {
  $q = $this->tamanho;
   if ( ($i > 0) and ($i <= ($q + 1)) ) {
   	if ($i == 1) {
   	$sucessor = $this->primeiro;
   	$sucessor->setAntecessor($node);
   	$node->setSucessor($sucessor);
   	$this->primeiro = $node;
   	$this->tamanho += 1;
   	}
   	if ($i == ($q + 1)) {
   	$antecessor = $this->ultimo;
   	$antecessor->setSucessor($node);
   	$node->setAntecessor($antecessor);
   	$this->ultimo = $node;
   	$this->tamanho += 1;
   	}
   	if ( ($i > 1) and ($i < ($q + 1)) ) {
   	$antecessor = $this->get(($i - 1));
   	$sucessor = $antecessor->getSucessor();
   	$antecessor->setSucessor($node);
   	$sucessor->setAntecessor($node);
   	$node->setAntecessor($antecessor);
   	$node->setSucessor($sucessor);
   	$this->tamanho += 1;
   	}
   }
  }
 }

 public function append($elemento) {
 $this->set($elemento,($this->tamanho + 1));
 }

 public function clear() {
 $this->primeiro = null;
 $this->ultimo = null;
 $this->tamanho = 0;
 }

 public function remove($i) {
 $q = $this->tamanho;
 $removed = ( ($i > 0) and ($i <= $q) );
  if ($removed) {
   if ($i == 1) {
    if ($q == 1) {
    $this->clear();
    }
    else {
    $this->primeiro = $this->get($i + 1);
    $this->primeiro->setAntecessor(null);
    $this->tamanho -= 1;
    }
   }
   if ($i == $q) {
   $this->ultimo = $this->get($this->tamanho - 1);
   $this->ultimo->setSucessor(null);
   $this->tamanho -= 1;
   }
   if ($i > 1 and $i < $q) {
   $this->get($i - 1)->setSucessor($this->get($i + 1));
   $this->get($i + 1)->setAntecessor($this->get($i - 1));
   $this->tamanho -= 1;
   }
  }
 return $removed;
 }

 public function refresh($elemento,$i) {
  if ($this->remove($i)) {
  $this->set($elemento,$i);
  }
 }

}
?>