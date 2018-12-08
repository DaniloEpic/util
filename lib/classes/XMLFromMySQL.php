<?php
require_once PROJECT_ADDRESS."/lib/classes/XMLFromDB.php";

class XMLFromMySQL extends XMLFromDB {

 public function XMLFromMySQL($relacao,$registro) {
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
 $q = 0;
  while ($row = mysql_fetch_array($this->resultado)) {
  $q += 1;
  $xml .= "<".$this->registro.">\n";
   for ($i = 0; $i < count($campo); $i++) {
   $xml .= "<".$campo[$i].">".$row[$campo[$i]]."</".$campo[$i].">\n";
   }
  $xml .= "</".$this->registro.">\n";
  }
 $xml .= "<Total>".$q."</Total>\n";
 $xml .= "</".$this->relacao.">\n";
 return $xml;
 }

 public function num_rows() {
 return mysql_num_rows($this->resultado);
 }

}
?>