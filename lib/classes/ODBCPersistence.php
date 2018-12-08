<?php
require_once PROJECT_ADDRESS."/lib/classes/Persistence.php";

class ODBCPersistence extends Persistence implements DBPersistence {
private $conexao;
private static $instance;

 public static function getInstance($h,$u,$p) {
  if (!isset(self::$instance)) {
  self::$instance = new ODBCPersistence($h,$u,$p);
  }
 return self::$instance;
 }

 private function ODBCPersistence($host,$user,$password) {
 $this->conexao = odbc_connect($host,$user,$password);
 }

 public function getConnection() {
 return $this->conexao;
 }

 public function executeDDL($query) {
 //
 }

 public function executeDML($query) {
 return odbc_exec($this->conexao, $query);
 }

 public function numRows($result) {
 return odbc_num_rows($result);
 }

 public function fetchArray($result) {
 $array = odbc_fetch_array($result);
 return $array;
 }

 public function escape_string($value) {
 return $value;
 }

}
?>