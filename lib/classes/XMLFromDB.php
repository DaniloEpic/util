<?php
require_once PROJECT_ADDRESS."/lib/classes/XMLNode.php";

abstract class XMLFromDB {
protected $relacao;
protected $registro;
protected $campos;
protected $resultado;
protected $extra;

 public function XMLFromDB($relacao,$registro) {
 $this->relacao = $relacao;
 $this->registro = $registro;
 $this->extra = new Lista();
 }

 public function getRelacao() {
 return $this->relacao;
 }

 public function getRegistro() {
 return $this->registro;
 }

 public function setCampos($campos) {
 $this->campos = $campos;
 }

 public function getCampos() {
 return $this->campos;
 }

 public function setResultado($resultado) {
 $this->resultado = $resultado;
 }

 public function getResultado() {
 return $this->resultado;
 }

 public function add_node($xmlnode) {
 $str = $xmlnode->toString()."\n";
 $this->extra->addElement($str);
 }

}
?>