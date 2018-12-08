<?php
class Pasta {
private $caminho;
private $nome;
private $quantidade_itens;

 private function Pasta($caminho) {
 $file = pathinfo($caminho);
 $this->caminho = $caminho;
 $this->nome = $file["basename"];
 $diretorio = @opendir($this->caminho);
 $q = 0;
  while (false !== ($item = @readdir($diretorio))) {
  $q = $q + 1;
  }
 $this->quantidade_itens = $q;
 }
 
 public static function init($caminho) {
  if (is_dir($caminho) == 1) {
  $p = new Pasta($caminho);
  }
 return $p;
 }

 public function getCaminho() {
 return $this->caminho;
 }

 public function getNome() {
 return $this->nome;
 }

 public function getQuantidadeItens() {
 return $this->quantidade_itens;
 }

 // Descrição XML do objeto da classe Pasta
 public function xml() {
 $s = "<PASTA>\n";
 $s .= " <CAMINHO>".$this->caminho."</CAMINHO>\n";
 $s .= " <NOME>".$this->nome."</NOME>\n";
 $s .= " <QUANTIDADEITENS>".$this->quantidade_itens."</QUANTIDADEITENS>\n";
 $s .= "</PASTA>";
 return $s;
 }

 public function salvar($arquivo) {
 $arquivo->mover_para($this->caminho);
 }

 public function renomear($novonome) {
 $path = pathinfo($this->caminho);
 $dir = $path["dirname"];
 $base = $path["basename"];
  if (@rename($this->caminho, $dir."/".$novonome)) {
  $name = $novonome;
  }
  else {
  $name = $base;
  }
 return $name;
 }

 public function mover_para($destino) {
 $origem = $this->getCaminho();
 $base = $this->getNome();
 $o = @rename($origem,$destino."/".$base);
 return $o;
 }

}
?>