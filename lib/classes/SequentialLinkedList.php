<?php
require_once PROJECT_ADDRESS."/lib/classes/HNode.php";

function e_maior($objeto_a, $objeto_b, $atributo) {
$valor_a = call_user_func(array($objeto_a,$atributo),"");
$valor_b = call_user_func(array($objeto_b,$atributo),"");
return (($valor_a != $valor_b) and ($valor_a > $valor_b));
}

function e_menor($objeto_a, $objeto_b, $atributo) {
$valor_a = call_user_func(array($objeto_a,$atributo),"");
$valor_b = call_user_func(array($objeto_b,$atributo),"");
return (($valor_a != $valor_b) and ($valor_a < $valor_b));
}

class SequentialLinkedList {
private $tamanho;
private $primeiro;
private $ultimo;

 public function SequentialLinkedList() {
 $this->tamanho = 0;
 $this->primeiro = null;
 $this->ultimo = null;
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

 public function get($propriedade,$valor) {
  if ($this->tamanho > 0) {
  $n = $this->getFirst();
   for ($i = 0; $i < $this->tamanho; $i++) {
   $v = call_user_func(array($n->getElemento(),$propriedade),"");
    if ($valor == $v) {
    $node = $n;
    $i = $this->tamanho;
    }
    if ($n->getSucessor() != null) {
    $n = $n->getSucessor();
    }
   }
  }
 return $node;
 }

 public function set($elemento,$propriedade) {
 $node = new Node($elemento);
  if ($this->tamanho == 0) {
  $this->primeiro = $node;
  $this->ultimo = $this->primeiro;
  $this->tamanho += 1;
  }
  else {
  $valor = call_user_func(array($elemento,$propriedade),"");
   if ($this->get($propriedade,$valor) == null) {
   $q = $this->tamanho;
    // Inserir depois do último
    if (e_maior($node->getElemento(),$this->getLast()->getElemento(),$propriedade)) {
    $this->ultimo->setSucessor($node);
    $node->setAntecessor($this->ultimo);
    $this->ultimo = $node;
    }
    // Inserir antes do primeiro
    if (e_menor($node->getElemento(),$this->getFirst()->getElemento(),$propriedade)) {
    $this->primeiro->setAntecessor($node);
    $node->setSucessor($this->primeiro);
    $this->primeiro = $node;
    }
    //
    else {
    $ref = $this->getFirst()->getSucessor();
     for ($i = 0; $i < $this->getSize() - 1; $i++) {
      if (e_menor($node->getElemento(),$ref->getElemento(),$propriedade)) {
      $a = $ref->getAntecessor();
      $node->setAntecessor($a);
      $a->setSucessor($node);
      $node->setSucessor($ref);
      $ref->setAntecessor($node);
      $i = $this->getSize() - 1;
      }
      else {
       if ($ref->getSucessor() != null) {
       $ref = $ref->getSucessor();
       }
      }
     }
    }
   $this->tamanho = $q + 1;
   }
   else {
   //echo "Valor já inserido na lista";
   }
  }
 }

 public function remove($propriedade,$valor) {
 $n = $this->get($propriedade,$valor);
  if ($n != null) {
   if ($n->getAntecessor() == null) {
    if ($n->getSucessor() == null) {
	$this->primeiro = null;
	$this->ultimo = null;
	}
	else {
	$node = $n->getSucessor();
    $node->setAntecessor(null);
    $this->primeiro = $node;
	}
   }
   else {
    if ($n->getSucessor() == null) {
	$node = $n->getAntecessor();
    $node->setAntecessor(null);
    $this->ultimo = $node;
	}
	else {
	$antecessor = $n->getAntecessor();
    $sucessor = $n->getSucessor();
    $antecessor->setSucessor($sucessor);
    $sucessor->setAntecessor($antecessor);
	}
   }
  $this->tamanho = $this->tamanho - 1;
  }
 }

 public function to_lista() {
 $lista = new Lista();
  if ($this->tamanho > 0) {
  $node = $this->getFirst();
   for ($n = 0; $n < $this->tamanho; $n++) {
   $lista->addElement($node->getElemento());
    if ($node->getSucessor() != null) {
    $node = $node->getSucessor();
    }
   }
  }
 return $lista;
 }

}
?>