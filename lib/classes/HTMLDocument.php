<?php
class HTMLDocument {
private $documento;
private $body;

 public function HTMLDocument($htmlfile) {
 $this->documento = new DOMDocument();
 $this->documento->loadHTMLFile($htmlfile);
 $this->body = $this->documento->getElementsByTagName("body")->item(0);
 }

 public function getElementById($id) {
 $node = "";
 $childs = $this->body->getElementsByTagName("*");
  for ($i = 0; $i < $childs->length; $i++) {
   if ($childs->item($i)->getAttribute("id") == $id) {
   $node = $childs->item($i);
   $i = $childs->length;
   }
  }
 return $node;
 }

 public function createElement($tag,$inner) {
 return $this->documento->createElement($tag,$inner);
 }

 public function appendChild($newnode,$id) {
 $reference = $this->getElementById($id);
 $reference->appendChild($newnode);
 }

 public function append_child_node($newnode,$node) {
 $node->appendChild($newnode);
 }

 public function insertBefore($newnode,$id) {
 $reference = $this->getElementById($id);
 $this->body->insertBefore($newnode,$reference);
 }

 public function insert_before_node($newnode,$node) {
 $this->body->insertBefore($newnode,$node);
 }

 public function outPut() {
 return $this->documento->saveHTML();
 }

}
?>