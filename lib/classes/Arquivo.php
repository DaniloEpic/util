<?php
class Arquivo {
protected $caminho;
protected $nome;
protected $tamanho;
protected $data_de_modificacao;

 protected function Arquivo($caminho) {
 $arquivo = pathinfo($caminho);
 $this->caminho = $caminho;
 $this->nome = $arquivo["basename"];
 $this->tamanho = filesize($caminho);
 $this->data_de_modificacao = filemtime($caminho);
 }

 public static function init($caminho) {
  if (file_exists($caminho)) {
  $arquivo = new Arquivo($caminho);
  }
 return $arquivo;
 }

 public function getCaminho() {
 return $this->caminho;
 }

 public function getNome() {
 return $this->nome;
 }

 public function getTamanho() {
 return $this->tamanho;
 }

 public function getDataModificacao($f = null) {
 $d = $this->data_de_modificacao;
  if (isset($f)) {
  $d = date($f,$this->data_de_modificacao);
  }
 return $d;
 }
 
 public function xml() {
 $s = "<ARQUIVO>\n";
 $s .= " <CAMINHO>".$this->caminho."</CAMINHO>\n";
 $s .= " <NOME>".$this->nome."</NOME>\n";
 $s .= " <TIPO>".$this->tipo."</TIPO>\n";
 $s .= " <TAMANHO>".$this->tamanho."</TAMANHO>\n";
 $s .= " <DATAMODIFICACAO>".$this->data_de_modificacao."</DATAMODIFICACAO>\n";
 $s .= "</ARQUIVO>";
 return $s;
 }
 
 public function xml_formatado() {
 $s = "<ARQUIVO>\n";
 $s .= " <CAMINHO>".$this->caminho."</CAMINHO>\n";
 $s .= " <NOME>".$this->nome."</NOME>\n";
 $s .= " <TIPO>".$this->tipo."</TIPO>\n";
 $s .= " <TAMANHO>".number_format(($this->tamanho/1024),1,",",".")."</TAMANHO>\n";
 $s .= " <DATAMODIFICACAO>".date("d/m/Y - H:i:s",$this->data_de_modificacao)."</DATAMODIFICACAO>\n";
 $s .= "</ARQUIVO>";
 return $s;
 }

 public function renomear($novonome) {
 $g = pathinfo($this->caminho);
 $to = $g["dirname"]."/".$novonome;
  if (file_exists($to)) {
  $f = "Não foi possível renomear o arquivo selecionado!<br/>";
  $f .= "Já existe um arquivo chamado <b>".$this->nome."</b> na pasta <b>".$destino."</b>.";
  throw new Exception($f);
  }
  else {
  $o = @rename($this->caminho,$to);
  }
 return $o;
 }
 
 public function copiar_para($destino) {
 $to = $destino."/".$this->nome;
  if (file_exists($to)) {
  $f = "Não foi possível copiar o arquivo selecionado!<br/>";
  $f .= "Já existe um arquivo chamado <b>".$this->nome."</b> na pasta <b>".$destino."</b>.";
  throw new Exception($f);
  }
  else {
  $o = @copy($this->caminho,$to);
  }
 return $o;
 }
 
 public function mover_para($destino,$novonome = null) {
 $n = $this->nome;
  if ($novonome) {
  $n = $novonome;
  }
 $to = $destino."/".$n;
  if (file_exists($to)) {
  $f = "Não foi possível mover o arquivo selecionado!<br/>";
  $f .= "Já existe um arquivo chamado <b>".$this->nome."</b> na pasta <b>".$destino."</b>.";
  throw new Exception($f);
  }
  else {
  $o = @rename($this->caminho,$to);
  }
 return $o;
 }
 
 public function compactar($zipfile) {
 $x = new ZipArchive();
 $x->open($zipfile,ZipArchive::CREATE);
 $x->addFile($this->getCaminho(),$this->getNome());
 $x->close();
 }

}

function download(Arquivo $a) {
header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: attachment; filename=\"".$a->getNome()."\"");
readfile($a->getCaminho());
}
?>