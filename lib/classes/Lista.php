<?php
require PROJECT_ADDRESS."/lib/classes/Attribute.php";
require PROJECT_ADDRESS."/lib/classes/Paginador.php";

class Lista implements Paginavel {
private $lista;
private $quantidade_por_pagina;
private $paginador;

 public function Lista() {
 $this->lista = array();
 $this->quantidade_por_pagina = $this->getSize();
 }

 public function setQuantidadePorPagina($q) {
 $this->quantidade_por_pagina = $q;
 }

 public function getQuantidadePorPagina() {
 return $this->quantidade_por_pagina;
 }
 
 public function get_array() {
 return $this->lista;
 }
 
 public function addElement($element) {
 array_push($this->lista,$element);
 $this->setQuantidadePorPagina($this->getSize());
 }

 public function remove($i) {
  if ($i >= 0 and $i < count($this->lista)) {
  $novalista = array();
  $q = count($this->lista) - 1;
  $k = 0;
   while ($k < $i) {
   $novalista[$k] = $this->lista[$k];
   $k = $k + 1;
   }
   while ($k < $q) {
   $novalista[$k] = $this->lista[$k + 1];
   $k = $k + 1;
   }
  $this->lista = $novalista;
  }
 }

 public function limpar() {
  while (count($this->lista) > 0) {
  array_pop($this->lista);
  }
 }

 public function getElement($i) {
 return $this->lista[$i];
 }

 public function fromArray($array) {
 $q = count($array);
  for ($i = 0; $i < $q; $i++) {
  $this->addElement($array[$i]);
  }
 }

 // adiciona elementos a uma lista a partir de uma string XML
 public function fromXMLString($xml_string,$xml_query) {
 $xml = new SimpleXMLElement($xml_string);
 $query = $xml->xpath($xml_query);
  for ($i = 0; $i < count($query); $i++) {
  $this->addElement($query[$i]);
  }
 }

 // adiciona elementos a uma lista a partir de um arquivo XML
 public function fromXMLFile($xml_file,$xml_query) {
 $xml_string = file_get_contents($xml_file);
 $this->fromXMLString($xml_string,$xml_query);
 }

 public function getXML() {
 $s = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
 $s .= "<itens>";
  for ($i = 0; $i < $this->getSize(); $i++) {
  $s .= "<item>".$this->getElement($i)."</item>";
  }
 $s .= "</itens>";
 return $s;
 }

 public function getSize() {
 return count($this->lista);
 }
 
 public function isEmpty() {
 return ($this->getSize() == 0);
 }

 public function mostrar_tudo() {
 echo "{";
  for ($i = 0; $i < $this->getSize(); $i++) {
  echo "[ ".$this->getElement($i)." ]";
   if ($i < ($this->getSize() - 1)) {
   echo ", ";
   }
  }
 echo "}\n";
 }
 
public function json() {
 $s = "[\n";
  for ($i = 0; $i < $this->getSize(); $i++) {
  $s .= " ".$this->getElement($i);
   if ($i < ($this->getSize() - 1)) {
   $s .= ", \n";
   }
  }
 $s .= "\n]";
 return $s;
 }

 public function ordenarString($order) {
 $array = $this->get_array();
  switch ($order) {
  case 1:
  sort($array,SORT_STRING);
  break;
  case -1:
  rsort($array,SORT_STRING);
  break;
  }
 $lista = new Lista();
 $lista->fromArray($array);
 return $lista;
 }

 public function ordenarNumeric($order) {
 $array = $this->toArray();
  switch ($order) {
  case 1:
  sort($array,SORT_NUMERIC);
  break;
  case -1:
  rsort($array,SORT_NUMERIC);
  break;
  }
 $lista = new Lista();
 $lista->fromArray($array);
 return $lista;
 }

 public function getPaginador() {
 return $this->paginador;
 }

 public function paginar() {
 $this->paginador = new Paginador("",$this->quantidade_por_pagina);
 return $this->paginador;
 }

 public function setPaginador(Paginador $paginador) {
 $this->paginador = $paginador;
 }

 public function scroll() {
 $s = new Scroller($this->quantidade_por_pagina);
 return $s;
 }

 public function from() {
 $f = 0;
  if (isset($_GET[$this->paginador->getVarPagina()])) {
  $p = $_GET[$this->paginador->getVarPagina()];
  $f = ($p - 1) * $this->quantidade_por_pagina;
  }
 return $f;
 }

 public function to() {
 $t = $this->paginador->getQuantidade();
  if (isset($_GET[$this->paginador->getVarPagina()])) {
  $p = $_GET[$this->paginador->getVarPagina()];
  $t = $p * $this->quantidade_por_pagina;
  }
  if ($t > $this->getSize()) {
  $t = $this->getSize();
  }
 return $t;
 }
 
 public function to_string() {
 $i = $this->from();
 $mostrar = $this->to();
 $s = "";
  if ($this->getSize() > 0) {
   if ($this->getSize() < $mostrar) {
   $mostrar = $this->getSize();
   }
   for ($n = $i; $n < $mostrar; $n++) {
   $s .= $this->getElement($n)."\n";
   }
  }
 return $s;
 }
 
 public function to_s($output_method, $params) {
 $args = explode(",",$params);
 $i = $this->from();
 $mostrar = $this->to();
 $s = "";
  if ($this->getSize() == 0) {
  $s .= "...";
  }
  else {
   if ($this->getSize() < $mostrar) {
   $mostrar = $this->getSize();
   }
   for ($n = $i; $n < $mostrar; $n++) {
   $s .= call_user_func_array(array($this->getElement($n),$output_method),$args)."\n\n";
   }
  }
 return $s;
 }

}

function lista_meses() {
$meses = new Lista();
$meses->addElement("Janeiro");
$meses->addElement("Fevereiro");
$meses->addElement("Março");
$meses->addElement("Abril");
$meses->addElement("Maio");
$meses->addElement("Junho");
$meses->addElement("Julho");
$meses->addElement("Agosto");
$meses->addElement("Setembro");
$meses->addElement("Outubro");
$meses->addElement("Novembro");
$meses->addElement("Dezembro");
return $meses;
}
?>