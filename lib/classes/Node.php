<?php
class Node {
private $elemento;
private $antecessor;
private $sucessor;

 public function Node($elemento) {
 $this->elemento = $elemento;
 $this->antecessor = null;
 $this->sucessor = null;
 }

 public function getElemento() {
 return ($this->elemento);
 }

 public function setAntecessor($antecessor) {
 $this->antecessor = $antecessor;
 }

 public function setSucessor($sucessor) {
 $this->sucessor = $sucessor;
 }

 public function getAntecessor() {
 return ($this->antecessor);
 }

 public function getSucessor() {
 return ($this->sucessor);
 }

}
?>