<?php
class Documento {
private $conteudo;
private $apresentacao;

 public function Documento() {
 $this->conteudo = new DOMDocument();
 $this->apresentacao = new DOMDocument();
 }
 
 public function setConteudoFromString($xml) {
 //$this->conteudo->loadXML(utf8_encode($xml));
 $this->conteudo->loadXML($xml);
 }
 
 public function setConteudoFromFile($xml_file) {
 $this->conteudo->load($xml_file);
 }
 
 public function setApresentacao($xsl_file) {
 $this->apresentacao->load($xsl_file);
 }
 
 public function getConteudo() {
 return $this->conteudo;
 }
 
 public function getApresentacao() {
 return $this->apresentacao;
 }
 
 public function outPut() {
 $processor = new XSLTProcessor();
 $processor->importStyleSheet($this->apresentacao);
 $out = $processor->transformToXML($this->conteudo);
 return $out;
 }
 
 public function append_child($name,$value) {
 $s = new SimpleXMLElement($this->conteudo->saveXML());
 $s->addChild($name,$value);
 $this->setConteudoFromString($s->asXML());
 }

}
?>