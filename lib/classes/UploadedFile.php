<?php
class UploadedFile {
private $name;
private $type;
private $size;
private $tmp_name;
private $arquivo;

 public static function get($userfile) {
  if (isset($_FILES[$userfile])) {
   if ( $_FILES[$userfile]["error"] == 0 ) {
   $f = new UploadedFile($userfile);
   }
   if ( $_FILES[$userfile]["error"] == 1 ) {
   $m = "O arquivo selecionado é muito grande!";
   throw new Exception($m);
   }
  }
 return $f;
 }

 private function UploadedFile($userfile) {
 $this->name = $_FILES[$userfile]["name"];
 $this->type = $_FILES[$userfile]["type"];
 $this->size = $_FILES[$userfile]["size"];
 $this->tmp_name = $_FILES[$userfile]["tmp_name"];
 }

 public function getName() {
 return $this->name;
 }

 public function getType() {
 return $this->type;
 }

 public function getSize() {
 return $this->size;
 }

 public function tamanho() {
 $tkb = $this->size / 1024;
  if ($tkb < 1000) {
  $s = number_format($tkb,1,",",".")." Kbytes";
  }
  else {
  $tmb = $tkb / 1024;
  $s = number_format($tmb,1,",",".")." Mbytes";
  }
 return $s;
 }

 public function salvar($destino,$name = null) {
  if (isset($name)) {
  $this->name = $name;
  }
  if (is_dir($destino)) {
  $t = $destino."/".$this->name;
   if (file_exists($t)) {
   $e = "Já existe um arquivo chamado ".$this->name." na pasta ".$destino."!";
   throw new Exception($e);
   }
   else {
   $o = move_uploaded_file($this->tmp_name,$t);
   $this->arquivo = $t;
   }
  }
  else {
  $e = "\"".$destino."\" não é um diretório válido!";
  throw new Exception($e);
  }
 return $o;
 }
 
 public function getArquivo() {
 return Arquivo::init($this->arquivo);
 }

}
?>