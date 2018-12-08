<?php
require_once PROJECT_ADDRESS."/lib/classes/XMLFromDB.php";

class XMLFromODBC extends XMLFromDB {

 public function XMLFromODBC($relacao,$registro) {
 parent::XMLFromDB($relacao,$registro);
 }

 public function add_node($xmlnode) {
 parent::add_node($xmlnode);
 }

 public function get_xml() {
 $campo = explode(",",$this->campos);
 $xml = "<".$this->relacao.">\n";
 for ($i = 0; $i < $this->extra->getSize(); $i++) {
 $xml .= $this->extra->getElement($i);
 }
  while ($row = odbc_fetch_array($this->resultado)) {
  $xml .= "<".$this->registro.">\n";
   for ($i = 0; $i < count($campo); $i++) {
   $xml .= "<".$campo[$i].">".$row[$campo[$i]]."</".$campo[$i].">\n";
   }
  $xml .= "</".$this->registro.">\n";
  }
 $xml .= "</".$this->relacao.">\n";
 return $xml;
 }
 
 /*
 public function get_xml_paginado($q,$id) {
 $campo = explode(",",$this->campos);
 $elementos = new Lista();
  while ($row = odbc_fetch_array($this->resultado)) {
  $s = "";
  $s .= "<".$this->registro.">\n";
   for ($i = 0; $i < count($campo); $i++) {
   $s .= "<".$campo[$i].">".$row[$campo[$i]]."</".$campo[$i].">\n";
   }
  $s .= "</".$this->registro.">\n";
  $elementos->addElement($s);
  }
 $elementos->setQuantidadePorPagina($q);
 $paginador = $elementos->paginar();
 $xml = "<".$this->relacao.">\n\n";
 $xml .= $elementos->to_string();
 $xml .= "\n\n";
 $xml .= $paginador->to_xml($elementos->getSize(),$id);
 $xml .= "\n\n</".$this->relacao.">\n";
 return $xml;
 }
 */

}
?>