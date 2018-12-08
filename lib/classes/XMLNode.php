<?php
require_once PROJECT_ADDRESS."/lib/classes/Lista.php";

class XMLNode {
private $nodename;
private $nodevalue;
private $attributes;

 public function XMLNode($name, $value) {
 $this->nodename = $name;
 $this->nodevalue = $value;
 $this->attributes = new Lista();
 }
 
 public function getName() {
 return $this->nodename;
 }
 
 public function setValue($v) {
 $this->nodevalue = $v;
 }
 
 public function getValue() {
 return $this->nodevalue;
 }
 
 public function appendValue($v) {
 $this->nodevalue .= $v;
 }

 public function createAttribute($name,$value) {
 $attr = new Attribute($name, $value);
 $this->attributes->addElement($attr);
 }
 
 public function add_attrs($s) {
 $attrs = explode(",",$s);
  for ($i = 0; $i < count($attrs); $i++) {
  $attribute = explode("=",$attrs[$i]);
  $attr = new Attribute($attribute[0],$attribute[1]);
  $this->attributes->addElement($attr);
  }
 }

 public function toString() {
 $s = "<".$this->nodename;
  for ($i = 0; $i < $this->attributes->getSize(); $i++) {
  $me = $this->attributes->getElement($i);
  $s .= $me->toString();
  }
 $s .= ">";
 $s .= $this->nodevalue;
 $s .= "</".$this->nodename.">";
 return $s;
 }
 
 public function to_s() {
 $s = "<".$this->nodename;
  for ($i = 0; $i < $this->attributes->getSize(); $i++) {
  $me = $this->attributes->getElement($i);
  $s .= $me->toString();
  }
 $s .= "/>";
 return $s;
 }
 
 public function to_xsl() {
 $s = "<xsl:element name=\"".$this->nodename."\">";
  for ($i = 0; $i < $this->attributes->getSize(); $i++) {
  $me = $this->attributes->getElement($i);
  $s .= "\n<xsl:attribute name=\"".$me->getName()."\">".
        $me->getValue()."</xsl:attribute>";
  }
 $s .= $this->nodevalue;
 $s .= "</xsl:element>";
 return $s;
 }

}
?>