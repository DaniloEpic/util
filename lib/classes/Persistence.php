<?php
class Persistence {

 public function get_row($o) {
 if ($this->numRows($o) == 1) {
  $row = $this->fetchArray($o);
  }
 return $row;
 }
 
 public function toLista($o) {
 $lista = new Lista();
  while ($row = $this->fetchArray($o)) {
  $lista->addElement($row);
  }
 return $lista;
 }
 
 public function toJSON($res,$att) {
 $s = "";
 $ats = explode(",",$att);
  while ($row = $this->fetchArray($res)) {
   if (strlen($s) > 0) {
   $s .= ",";
   }
  $s .= "{";
  $i = 0;
   do {
   $value = "\"".$row[$ats[$i]]."\"";
    if (strpos($value,"{") == 1) {
	$value = $row[$ats[$i]];
	}
   $s .= "\"".$ats[$i]."\" : ".$value."";
   $i = $i + 1;
    if ($i < count($ats)) {
	$s .= ",";
	}
   }
   while ($i < count($ats));
  $s .= "}";
  }
 $s = "[".$s."]";
 return $s;
 }
 
}

interface DBPersistence {

 public function executeDDL($query);

 public function executeDML($query);

 public function numRows($result);

 public function fetchArray($result);

 public function escape_string($value);

}
?>