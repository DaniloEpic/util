<?php
require_once PROJECT_ADDRESS."/lib/classes/Persistence.php";

class PGPersistence extends Persistence implements DBPersistence {
private $conexao;
private $host;
private $port;
private $user;
private $password;
private $base;
private $schema;

private static $instance;

 public static function getInstance($f) {
  if (!isset(self::$instance)) {
  self::$instance = new PGPersistence($f);
  }
 return self::$instance;
 }

 private function PGPersistence($xml) {
 $s = new SimpleXMLElement(file_get_contents($xml));
 $host = $s->xpath("/CONEXAO/HOST");
 $this->host = $host[0];
 $port = $s->xpath("/CONEXAO/PORT");
 $this->port = $port[0];
 $user = $s->xpath("/CONEXAO/USER");
 $this->user = $user[0];
 $password = $s->xpath("/CONEXAO/PASSWORD");
 $this->password = $password[0];
 $base = $s->xpath("/CONEXAO/BASE");
 $this->base = $base[0];
 $schema = $s->xpath("/CONEXAO/SCHEMA");
 $this->schema = $schema[0];
 }
 
 private function connect() {
 $str = "host=".$this->host." ";
 $str .= "port=".$this->port." ";
 $str .= "dbname=".$this->base." ";
 $str .= "user=".$this->user." ";
 $str .= "password=".$this->password;
 $this->conexao = @pg_connect($str);
  if (!$this->conexao) {
  die("Serviço indisponível!");
  }
 return $this->conexao;
 }
 
 public function executeDDL($query) {
 //	
 }
 
 public function executeDML($query) {
 return pg_query($this->connect(),$query);
 }
 
 public function numRows($r) {
 return pg_num_rows($r);
 }
 
 public function fetchArray($r) {
 return pg_fetch_array($r);
 }
 
 public function escape_string($e) {
 return pg_escape_string($e);
 }
}
?>