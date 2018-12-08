<?php
require_once PROJECT_ADDRESS."/lib/classes/Arquivo.php";
require_once PROJECT_ADDRESS."/lib/classes/Lista.php";
require PROJECT_ADDRESS."/lib/classes/Pasta.php";

class Diretorio {
private $path;
private $pastas;
private $arquivos;

 protected function Diretorio($diretorio) {
 $this->path = $diretorio;
 $this->pastas = new Lista();
 $this->arquivos = new Lista();
 $dir = @opendir($this->path);
  while (false !== ($item = @readdir($dir))) {
  $pasta = Pasta::init($this->path."/".$item);
   if ($pasta) {
   $this->pastas->addElement($pasta);
   }
   if (is_file($this->path."/".$item) == 1) {
   $arquivo = Arquivo::init($this->path."/".$item);
    if ($arquivo) {
    $this->arquivos->addElement($arquivo);
    }
   }
  }
 }

 public static function init($path) {
  if (is_dir($path)) {
  $diretorio = new Diretorio($path);
  }
  /*
  else {
  $n = @mkdir($diretorio);
  if ($n) {
  $diretorio = new Diretorio($diretorio);
  }
  }
  */
 return $diretorio;
 }

 public function getPath() {
 return $this->path;
 }

 public function refresh() {
 $this->pastas->limpar();
 $this->arquivos->limpar();
 $diretorio = @opendir($this->path);
  while (false !== ($item = @readdir($diretorio))) {
   if (is_dir($this->path."/".$item)) {
   $this->pastas->addElement(Pasta::init($this->path."/".$item));
   }
   if (is_file($this->path."/".$item)) {
   $this->arquivos->addElement(Arquivo::init($this->path."/".$item));
   }
  }
 }

 public function getPastas() {
 return $this->pastas;
 }

 public function getArquivos() {
 return $this->arquivos;
 }

 public function xml_dir() {
 $s = "<DIRETORIO pastas=\"".$this->pastas->getSize()."\" arquivos=\"".$this->arquivos->getSize()."\">\n";
 $s .= $this->pastas->to_s("xml","");
 $s .= $this->arquivos->to_s("xml","");
 $s .= "</DIRETORIO>";
 return $s;
 }

 public function criar_pasta($pasta) {
 return @mkdir($this->path."/".$pasta,0777,true);
 }

 public function excluir_pasta($pasta) {
  if (file_exists($this->path."/".$pasta)) {
  $o = rmdir($this->path."/".$pasta);
  }
 return $o;
 }

 public function excluir_arquivo($arquivo) {
  if (file_exists($this->path."/".$arquivo)) {
  $o = unlink($this->path."/".$arquivo);
  }
 return $o;
 }

}
?>