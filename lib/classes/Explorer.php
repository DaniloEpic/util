<?php
require_once PROJECT_ADDRESS."/lib/classes/Diretorio.php";
require PROJECT_ADDRESS."/lib/classes/HNode.php";

class Explorer extends Diretorio {
private $root;

 public function Explorer($caminho) {
 parent::Diretorio($caminho);
 $this->root = new HNode(new Pasta($this->getPath()));
 }

 public function getRoot() {
 return $this->root;
 }

 public function hierarquia($node = null) {
  if (isset($node)) {
  $explorer = new Explorer($node->getElemento()->getCaminho());
  $root = $node;
  }
  else {
  $explorer = $this;
  $root = $this->root;
  }
 $a = $explorer->getArquivos();
  for ($i = 0; $i < $a->getSize();$i = $i + 1) {
  $arquivo = $a->getElement($i);
  $node = new HNode($arquivo);
  $root->appendChild($node);
  }
 $p = $explorer->getPastas();
  for ($i = 0; $i < $p->getSize(); $i = $i + 1) {
  $pasta = $p->getElement($i);
   if ($pasta->getNome() != "." and $pasta->getNome() != "..") {
   $node = new HNode($pasta);
   $root->appendChild($node);
   $this->hierarquia($node);
   }
  }
 }

 private function excluir_arquivos($pasta) {
 $dir = new Diretorio($pasta->getCaminho());
 $q = $dir->getArquivos()->getSize();
 $k = 0;
  for ($i = 0; $i < $q; $i = $i + 1) {
  $arquivo = $dir->getArquivos()->getElement($i);
  $o = unlink($arquivo->getCaminho());
   if ($o) {
   $k = $k + 1;
   }
  }
 return $k;
 }
 
 private function deletar_pasta($pasta) {
 $dir = new Diretorio($pasta->getCaminho());
 $q = $dir->getArquivos()->getSize();
  if ($q == 0) {
  echo "excluindo a pasta ".$pasta->getNome()."...<br/>";
  $f = rmdir($pasta->getCaminho());
  }
  else {
  echo "excluindo os arquivos da pasta ".$pasta->getNome()."...<br/>";
  $k = $this->excluir_arquivos($pasta);
   if ($k == $q) {
   echo "excluindo a pasta ".$pasta->getNome()."...<br/>";
   $f = rmdir($pasta->getCaminho());
   }
  }
 return $f;
 }

 /* */
 public function excluir_descendentes(HNode $node = null) {
  if (!isset($node)) {
  $node = $this->root;
  }
  if ($node->getGrau() > 0) {
  $child = $node->getChild_nodes()->getElement(0);
  $pasta = $child->getElemento();
   if ($child->getAltura() == 1) {
   $this->deletar_pasta($pasta);
   $node->removeChild(0);
   $this->excluir_descendentes($node);
   }
   else {
   $this->excluir_descendentes($child);
   }
  }
  else {
   if ($node->getParent_node() != null) {
   $node = $node->getParent_node();
   $this->excluir_descendentes($node);
   }
  }
 }

}
?>