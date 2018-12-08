<?php
require_once PROJECT_ADDRESS."/lib/classes/XMLNode.php";

class Text extends XMLNode {

 public function Text($name,$value = "") {
 parent::XMLNode("input","");
 $this->createAttribute("type","text");
 $this->createAttribute("name",$name);
 $this->createAttribute("value",$value);
 }
 
 public static function init($name,$value,$attrs = null) {
 $t = new Text($name,$value);
  if ($attrs) {
  $t->add_attrs($attrs);
  }
 return $t;
 }

}

//
class Password extends XMLNode {
 
 public function Password($name,$value = "") {
 parent::XMLNode("input","");
 $this->createAttribute("type","password");
 $this->createAttribute("name",$name);
 $this->createAttribute("value",$value);
 }
 
 public static function init($name,$value,$attrs = null) {
 $p = new Password($name,$value);
  if ($attrs) {
  $p->add_attrs($attrs);
  }
 return $p;
 }

}

//
class Textarea extends XMLNode {
 
 public function Textarea($name,$value = "") {
 parent::XMLNode("textarea",$value);
 $this->createAttribute("name",$name);
 }
 
 public static function init($name,$value,$attrs = null) {
 $t = new Textarea($name,$value);
  if ($attrs) {
  $t->add_attrs($attrs);
  }
 return $t;
 }
 
}

//
class Hidden extends XMLNode {

 public function Hidden($name,$value) {
 parent::XMLNode("input","");
 $this->createAttribute("type","hidden");
 $this->createAttribute("name",$name);
 $this->createAttribute("value",$value);
 }
 
 public static function init($name,$value,$attrs = null) {
 $h = new Hidden($name,$value);
  if ($attrs) {
  $this->add_attrs($attrs);
  }
 return $h;
 }
}

//
class Button extends XMLNode {
 
 public function Button($value) {
 parent::XMLNode("input","");
 $this->createAttribute("value",$value);
 }

public static function reset($value, $attrs = null) {
 $r = new Button($value);
 $r->createAttribute("type","reset");
  if ($attrs) {
  $r->add_attrs($attrs);
  }
 return $r;
 }
 
 public static function submit($value, $attrs = null) {
 $s = new Button($value);
 $s->createAttribute("type","submit");
  if ($attrs) {
  $s->add_attrs($attrs);
  }
 return $s;
 }
 
 public static function init($value, $attrs = null) {
 $b = new Button($value);
 $b->createAttribute("type","button");
  if ($attrs) {
  $b->add_attrs($attrs);
  }
 return $b;
 }
}
?>