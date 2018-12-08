<?php
require_once PROJECT_ADDRESS."/lib/classes/Persistence.php";

class MySQLPersistence extends Persistence implements DBPersistence {
private $conexao;
private $host;
private $user;
private $password;
private $db;
private $limit;
private $query;
private $numrows;

private static $instance;
public static $formato_data;

 public static function getInstance($f) {
  if (!isset(self::$instance)) {
  $con = json_decode(file_get_contents($f),true);
  self::$instance = new MySQLPersistence($con);
  self::$formato_data = "%d/%m/%Y - %H:%i";
  }
 return self::$instance;
 }
 
 private function MySQLPersistence($vec) {
 $this->host = $vec["host"];
 $this->user = $vec["user"];
 $this->password = $vec["password"];
 $this->db = $vec["db"];
 }
 
 private function connect() {
 $this->conexao = @ new mysqli($this->host,$this->user,$this->password,$this->db);
  if ($this->conexao->connect_error) {
  die("Serviço indisponível!");
  }
 }

 public function executeDDL($query) {
 //
 }
 
 //
 public function executeDML($query = null) {
  if (!$this->conexao) {
  $this->connect();
  }
  if (!$query) {
  $query = $this->query;
  }
 return $this->conexao->query($query);
 }
 
 //
 public function get_inserted_id() {
 return $this->conexao->insert_id;
 }
 
 public function numRows($res) {
 $this->numrows = $res->num_rows;
 return $res->num_rows;
 }
 
 //
 public function getNumRows() {
 return $this->numrows;
 }
 
 public function fetchArray($res) {
 $array = $res->fetch_array(MYSQLI_ASSOC);
 return $array;
 }
 
 public function escape_string($v) {
 $v = strip_tags($v);
  if (!$this->conexao) {
  $this->connect();
  }
 return $this->conexao->real_escape_string($v);
 }
 
 public function str_or_null($v) {
  if (isset($v)) {
  $s = "'".$this->escape_string($v)."'";
  }
  else {
  $s = "null";
  }
 return $s;
 }
 
 public function set_limit($limit) {
 $this->limit = $limit;
 }
 
 public function get_limit() {
 return $this->limit;
 }
 
 public function with_limits(Limit $limit) {
 $this->limit = $limit->query();
 }
 
 //
 public function setQuery($q) {
 $this->query = $q;
 }
 
 //
 public function getQuery() {
 return $this->query;
 }

}

// timesavers
function dateFormat($s,$t = null) {
 if ($t == null) {
 $i = strpos($s,".");
  if ($i) {
  $q = strlen($s);
  $t = substr($s,$i+1,$q-($i+1));
  }
  else {
  $t = $s;
  }
 }
$str = "date_format(".$s.",'".MySQLPersistence::$formato_data."') '".$t."'";
return $str;
}

function json_concat($ats) {
$m = explode(",",$ats);
$s = "concat('{',";
$i = 0;
 do {
 $s .= "'\"".$m[$i]."\":\"',";
 $s .= $m[$i].",";
 $s .= "'\"',";
 $i = $i + 1;
  if ($i < count($m)) {
  $s .= "',',";
  }
 }
 while ($i < count($m));
$s .= "'}')";
return $s;
}
?>