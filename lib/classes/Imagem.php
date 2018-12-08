<?php
require_once PROJECT_ADDRESS."/lib/classes/Arquivo.php";

function e_imagem($arquivo) {
 if (file_exists($arquivo)) {
 $file = pathinfo($arquivo);
 $o = in_array($file["extension"],array("bmp","gif","jpg","tif","jpeg","tiff","png"));
 }
return $o;
}

class Imagem extends Arquivo {
private $width;
private $height;
private $type;
private $attr;
private $alt;

 private function Imagem($arquivo) {
 parent::Arquivo($arquivo);
 list($this->width,$this->height,$this->type,$this->attr) = getimagesize($arquivo);
 $file = pathinfo($arquivo);
 $this->alt = $file["basename"];
 }

 public static function init($arquivo) {
 $o = Arquivo::init($arquivo);
  if ($o) {
   if ( e_imagem($arquivo) ) {
   $imagem = new Imagem($arquivo);
   }
  }
 return $imagem;
 }

 public function getWidth() {
 return $this->width;
 }

 public function getHeight() {
 return $this->height;
 }
 
 public function setAlt($alt) {
 $this->alt = $alt;
 }
 
 public function getAlt() {
 return $this->alt;
 }

 public function toString() {
 return "<img src=\"".$this->getCaminho()."\" ".$this->attr." alt=\"".$this->alt."\"/>";
 }
 
 public function box($largura,$altura) {
 $q = $this->width / $this->height;
 $s = "";
  if ($q > 1) {
  $w = $largura;
  $h = $largura * ($this->height / $this->width);
  $s = "width=\"".$w."\"";
  }
  if ($q < 1) {
  $w = $altura * ($this->width / $this->height);
  $h = $altura;
  $s = "height=\"".$h."\"";
  }
  if ($q == 1) {
   if ($largura < $altura) {
   $w = $largura;
   $h = $w;
   }
   else {
   $h = $altura;
   $w = $h;
   }
  $s = "width=\"".$w."\" height=\"".$h."\"";
  }
 $t = ($altura / 2) - ($h / 2);
 $i .= "<img src=\"".$this->getCaminho()."\" ".$s." alt=\"".$this->alt."\" style=\"margin-top:".intval($t)."px;\"/>";
 return $i;
 }
 
 public function zoom($i) {
 $w = $this->width * $i / 100;
 $s = "<img src=\"".$this->getCaminho()."\" width=\"".intval($w)."\" alt=\"".$this->alt."\">\n";
 return $s;
 }

}
?>