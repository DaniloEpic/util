<?php
require_once PROJECT_ADDRESS."/lib/classes/Stack.php";

class BinTree {
private $element;
private $parent_node;
private $esquerda;
private $direita;
private $grau;
private $altura;
private $raiz;

 public function BinTree($e) {
 $this->element = $e;
 $this->parent_node = null;
 $this->esquerda = null;
 $this->direita = null;
 $this->grau = 0;
 $this->altura = 0;
 $this->raiz = $this;
 }
 
 public function getRaiz() {
 return $this->raiz;
 }
 
 public function setEsquerda($bt) {
  if ($this->esquerda == null) {
  $this->grau += 1;
  }
 $this->esquerda = $bt;
  if ($bt != null) {
  $bt->parent_node = $this;
  $bt->raiz = $bt->parent_node->raiz;
  }
  else {
  $this->grau -= 1;
   if ($this->direita == null) {
   $this->altura = 0;
   }
  }
 }
 
 public function setDireita($bt) {
  if ($this->direita == null) {
  $this->grau += 1;
  }
 $this->direita = $bt;
  if ($bt != null) {
  $bt->parent_node = $this;
  $bt->raiz = $bt->parent_node->raiz;
  }
  else {
  $this->grau -= 1;
   if ($this->esquerda == null) {
   $this->altura = 0;
   }
  }
 }
 
private function inserir(BinTree $bt) {
  if ($bt->element > $this->element) {
   if ($this->direita == null) {
   $this->setDireita($bt);
    if ($this->esquerda == null) {
	$this->altura += 1;
	$p = $this;
	 do {
	  if ($p->altura == $p->parent_node->altura) {
	  $p->parent_node->altura += 1;
	  }
	 $p = $p->parent_node;
	 }
	 while ($p != null);
	}
   }
   else {
   $this->direita->inserir($bt);
   }
  }
  else {
   if ($this->esquerda == null) {
   $this->setEsquerda($bt);
    if ($this->direita == null) {
	$this->altura += 1;
	$p = $this;
	 do {
	  if ($p->altura == $p->parent_node->altura) {
	  $p->parent_node->altura += 1;
	  }
	 $p = $p->parent_node;
	 }
	 while ($p != null);
	}
   }
   else {
   $this->esquerda->inserir($bt);
   }
  }
 }
 
 public static function insert_node(BinTree $bt, $e) {
 $bt->raiz->inserir(new BinTree($e));
 }
 
 public function getAltura() {
 return $this->altura;
 }
 
 public function getGrau() {
 return $this->grau;
 }
 
 public function getElement() {
 return $this->element;
 }
 
 public function exibir() {
 $s = "";
 $p = $this;
  if ($p != null) {
  $s .= "<table>\n";
  $s .= "<tr><td valign=\"top\"";
   if ($p->grau == 2) {
   $s .= " colspan=\"2\"";
   }
  $s .= ">";
  $s .= $p->element;
  $s .= "<p><tt><sub>Altura: ".$p->altura."</sub><br/><sub>Grau: ".$p->grau."</sub></tt></p>";
  $s .= "</td></tr>\n";
   if ($p->grau > 0) {
   $s .= "<tr>";
    if ($p->esquerda != null) {
	$s .= "<td class=\"sae\" valign=\"top\">".$p->esquerda->exibir()."</td>";
	}
	if ($p->direita != null) {
	$s .= "<td class=\"sad\" valign=\"top\">".$p->direita->exibir()."</td>";
	}
   $s .= "</tr>";
   }
  $s .= "</table>\n";
  }
 return $s;
 }
 
 public function buscar($element) {
 $p = $this;
  if ($p != null) {
   if ($p->element == $element) {
   $bt = $p;
   }
   else {
    if ($element > $p->element) {
	 if ($p->direita != null) {
	 $bt = $p->direita->buscar($element);
	 }
	}
	else {
	 if ($p->esquerda != null) {
	 $bt = $p->esquerda->buscar($element);
	 }
	}
   }
  }
 return $bt;
 }
 
public static function get_node(BinTree $bt, $e) {
 return $bt->raiz->buscar($e);
 }
 
 public function maior_afluente() {
  if ($this->grau > 0) {
   if ($this->esquerda == null) {
   $ma = $this->direita;
   }
   else {
    if ($this->direita == null) {
	$ma = $this->esquerda;
	}
	else {
	$ma = $this->esquerda;
	 if ($this->direita->altura > $this->esquerda->altura) {
	 $ma = $this->direita;
	 }
	}
   }
  }
 return $ma;
 }
 
 public function refresh() {
 $this->altura = 0;
  if ($this->grau > 0) {
  $a = $this->maior_afluente();
  $this->altura = $a->altura + 1;
  }
 $n = $this->parent_node;
  if ($n != null) {
  $n->refresh();
  }
 }
 
 public function maior_que_o_pai() {
  if ($this->parent_node != null) {
   if ($this->element > $this->parent_node->element) {
   return true;
   }
  }
 return false;
 }
 
 public function ordem() {
 $s = "";
 $p = $this;
  if ($p != null) {
   if ($p->esquerda != null) {
   $s .= $p->esquerda->ordem();
   }
  $s .= "[".$p->element."]";
   if ($p->direita != null) {
   $s .= $p->direita->ordem();
   }
  }
 return $s;
 }
 
 public function empilhar(Stack $pilha) {
 $p = $this;
  if ($p != null) {
   if ($p->esquerda != null) {
   $p->esquerda->empilhar($pilha);
   }
  $pilha->push($p);
   if ($p->direita != null) {
   $p->direita->empilhar($pilha);
   }
  }
 }
 
 public function subArvoreEsquerda() {
 $pilha = new Stack();
 $this->esquerda->empilhar($pilha);
 return $pilha;
 }
 
 public function remover($element) {
 $bt = $this->buscar($element);
  if ($bt != null) {
   //
   if ($bt->grau == 0) {
    if ($bt->maior_que_o_pai()) {
	$bt->parent_node->setDireita(null);
	}
	else {
	$bt->parent_node->setEsquerda(null);
	}
   $bt->parent_node->refresh();
   }
   //
   if ($bt->grau == 1) {
    if ($bt->maior_que_o_pai()) {
	$bt->parent_node->setDireita($bt->maior_afluente());
	}
	else {
	$bt->parent_node->setEsquerda($bt->maior_afluente());
	}
   $bt->parent_node->refresh();
   }
   //
   if ($bt->grau == 2) {
   $sae = $bt->subArvoreEsquerda();
   $n = $sae->getTop()->getElemento();
	if ($n->maior_que_o_pai()) {
    $n->parent_node->setDireita(null);
	}
	else {
	$n->parent_node->setEsquerda(null);
	}
   $n->parent_node->refresh();
   $n->setEsquerda($bt->esquerda);
   $n->setDireita($bt->direita);
	if ($bt->maior_que_o_pai()) {
	$bt->parent_node->setDireita($n);
	}
	else {
	$bt->parent_node->setEsquerda($n);
	}
   $n->refresh();
   }
  }
 }
 
 public static function balancear(BinTree &$bt) {
 $e = $bt->maior_afluente();
  if ($e != null) {
  $e->parent_node = $bt->parent_node;
  $bt->parent_node = null;
  $bt->setEsquerda(null);
  $bt->setDireita(null);
  $e->inserir($bt);
  $bt = $e;
  }
 }

}
?>