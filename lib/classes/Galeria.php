<?php
require_once PROJECT_ADDRESS."/lib/classes/Diretorio.php";
require PROJECT_ADDRESS."/lib/classes/Imagem.php";

class Galeria extends Diretorio {
private $imagens;
private $mostras;
private $largura_thumbnail;
private $altura_thumbnail;

 private function Galeria($diretorio) {
 parent::Diretorio($diretorio);
 $this->imagens = new Lista();
 $arquivos = $this->getArquivos();
  for ($i = 0; $i < $arquivos->getSize(); $i = $i + 1) {
  $imagem = Imagem::init($arquivos->getElement($i)->getCaminho());
  if ($imagem) {
  $this->imagens->addElement($imagem);
  }
 }
 $this->mostras = $this->getPastas();
 $this->largura_thumbnail = 100;
 $this->altura_thumbnail = 100;
 }

 public static function init($diretorio) {
 $d = Diretorio::init($diretorio);
  if ($d) {
  $galeria = new Galeria($diretorio);
  }
  /*
  else {
  $n = @mkdir($diretorio);
  if ($n) {
  $galeria = new Galeria($diretorio);
  }
  }
  */
 return $galeria;
 }

 public function getImagens() {
 return $this->imagens;
 }

 public function getMostras() {
 return $this->mostras;
 }

 public function showQImagens($q) {
 $this->imagens->setQuantidadePorPagina($q);
 }

 public function showQMostras($q) {
 $this->mostras->setQuantidadePorPagina($q);
 }

 public function setSize($largura,$altura) {
 $this->largura_thumbnail = $largura;
 $this->altura_thumbnail = $altura;
 }

 public function getLarguraThumbnail() {
 return $this->largura_thumbnail;
 }

 public function getAlturaThumbnail() {
 return $this->altura_thumbnail;
 }

 public function toString() {
 return $this->getImagens()->to_s("boxImg",$this->largura_thumbnail.",".$this->altura_thumbnail);
 }

}
?>