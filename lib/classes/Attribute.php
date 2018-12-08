<?php
class Attribute {
protected $attrname;
protected $attrvalue;

 public function Attribute($name, $value) {
 $this->attrname = $name;
 $this->attrvalue = $value;
 }

 public function toString() {
 $s = " ".$this->attrname."=\"".$this->attrvalue."\"";
 return $s;
 }

 public function setName($name) {
 $this->attrname = $name;
 }

 public function getName() {
 return $this->attrname;
 }

 public function setValue($value) {
 $this->attrvalue = $value;
 }

 public function getValue() {
 return $this->attrvalue;
 }

}

class URLAttribute extends Attribute {

 public function URLAttribute($name, $value) {
 parent::Attribute($name, $value);
 }

 public function toString() {
 $s = $this->attrname."=".$this->attrvalue;
 return $s;
 }

}
?>