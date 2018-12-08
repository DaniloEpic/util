<?php
require_once PROJECT_ADDRESS."/lib/classes/Lista.php";
require PROJECT_ADDRESS."/lib/classes/Queue.php";
require_once PROJECT_ADDRESS."/lib/classes/Stack.php";

class HNode {
private $elemento;
private $parent_node;
private $child_nodes;
private $grau;
private $altura;

 public function HNode($elemento) {
 $this->elemento = $elemento;
 $this->parent_node = null;
 $this->child_nodes = new Lista();
 $this->grau = 0;
 $this->altura = 1;
 }

 public function getElemento() {
 return $this->elemento;
 }

 public function setParent_node(HNode $node) {
 $this->parent_node = $node;
 }

 public function getParent_node() {
 return $this->parent_node;
 }

 public function hasChildNodes() {
 return ($this->child_nodes->getSize() > 0);
 }

 public function getChild_nodes() {
 return $this->child_nodes;
 } 

 public function appendChild(HNode $node) {
 $q = $this->child_nodes->getSize();
 $this->child_nodes->addElement($node);
 $node->setParent_node($this);
  if ($q == 0) {
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

 public function maior_afluente() {
 $q = $this->child_nodes->getSize();
  if ($q > 0) {
  $m = $this->child_nodes->getElement(0);
   if ($q > 1) {
   	for ($i = 1; $i < $q; $i = $i + 1) {
   	$n = $this->child_nodes->getElement($i);
   	 if ($n->getAltura() > $m->getAltura()) {
   	 $m = $n;
   	 }
   	}
   }
  }
 return $m;
 }

 public function refresh() {
 $this->altura = 1;
  if ($this->hasChildNodes()) {
  $a = $this->maior_afluente();
  $this->altura = $a->altura + 1;
  }
  $n = $this->parent_node;
  if ($n != null) {
  $n->refresh();
  }
 }

 public function removeChild($i) {
  if ($i >= 0 and $i < $this->child_nodes->getSize()) {
  $h = $this->altura;
  $this->child_nodes->remove($i);
  }
 $this->refresh();
 }

 public function getGrau() {
 return $this->child_nodes->getSize();
 }

 public function getAltura() {
 return $this->altura;
 }

 public function get_fila() {
 $queue = new Queue();
 $queue->in($this->getElemento());
 $node = $this->parent_node;
  if ($node) {
   do {
   $queue->in($node->getElemento());
   $node = $node->parent_node;
   }
   while ($node);
  }
 return $queue;
 }

 public function get_pilha() {
 $pilha = new Stack();
 $pilha->push($this->getElemento());
 $node = $this->parent_node;
  if ($node) {
   do {
   $pilha->push($node->getElemento());
   $node = $node->parent_node;
   }
   while ($node);
  }
 return $pilha;
 }

 public function childNodes() {
 $s = "<table align=\"center\">\n";
  if ($this->child_nodes->getSize() == 0) {
  $s .= "<tr><td valign=\"top\">".$this->getElemento()."</td></tr>\n";
  }
  else {
  $s .= "<tr>";
   if ($this->child_nodes->getSize() == 1) {
   $s .= "<td valign=\"top\">";
   }
   else {
   $s .= "<td colspan=\"".$this->child_nodes->getSize()."\" valign=\"top\">";
   }
  $s .= $this->getElemento();
  $s .= "</td>";
  $s .= "</tr>\n";
  $s .= "<tr>";
   for ($i = 0; $i < $this->child_nodes->getSize(); $i++) {
   $s .= "<td valign=\"top\">";
   $s .= $this->child_nodes->getElement($i)->childNodes();
   $s .= "</td>";
   }
  $s .= "<tr>\n";
  }
 $s .= "</table>\n";
 return $s;
 }

 public function xml_childNodes() {
 $s = "<NODE altura=\"".$this->getAltura()."\" grau=\"".$this->getGrau()."\">\n";
 $s .= "<ELEMENTO>".$this->getElemento()."</ELEMENTO>\n";
 $s .= "<CHILDNODES>\n";
  for ($i = 0; $i < $this->child_nodes->getSize(); $i++) {
  $s .= $this->child_nodes->getElement($i)->xml_childNodes();
  }
 $s .= "</CHILDNODES>\n";
 $s .= "</NODE>\n";
 return $s;
 }

 public function xml_childHNodes($output) {
 $s = "<NODE grau=\"".$this->getGrau()."\" altura=\"".$this->getAltura()."\">\n";
 $s .= "<ELEMENTO>".call_user_func(array($this->getElemento(),$output),"")."</ELEMENTO>\n";
 $s .= "<CHILDNODES>\n";
  for ($i = 0; $i < $this->child_nodes->getSize(); $i++) {
  $s .= $this->child_nodes->getElement($i)->xml_childHNodes($output);
  }
 $s .= "</CHILDNODES>\n";
 $s .= "</NODE>\n\n";
 return $s;
 }

}
?>