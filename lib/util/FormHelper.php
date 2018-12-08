<?php
require PROJECT_ADDRESS."/lib/classes/Formulario.php";

class FormHelper {
private $model;
private $reflection_class;
private $fields;

 public function FormHelper(DefaultModel $dm, $attrs = null) {
 $this->model = $dm;
 $this->reflection_class = new ReflectionClass(get_class($dm));
  if ($attrs == null) {
  $ma = $this->reflection_class->getMethod("attrs");
  $attrs = $ma->invoke($dm,"");
  }
 $col = explode(",",$attrs);
 $this->fields = array();
  for ($i = 0; $i < count($col); $i++) {
  $this->fields[$col[$i]] = $this->get_attr($col[$i]);
  }
 }
 
 private function get_attr($s) {
 $rm = $this->reflection_class->getMethod("get".ucfirst($s));
 return $rm->invoke($this->model,"");
 }
 
 public function getModel() {
 return $this->model;
 }
 
 public function getFields() {
 return $this->fields;
 }
 
 public function get_form_field($s,$t) {
 $rt = new ReflectionClass(ucfirst($t));
 $f = $rt->newInstance($s,$this->fields[$s]);
 return $f;
 }
 
 public static function to_form(DefaultModel $dm) {
 $rc = new ReflectionClass(get_class($dm));
 $rm = $rc->getMethod("attrs");
 $attrs = $rm->invoke($dm,"");
 $at = explode(",",$attrs);
  for ($i = 0; $i < count($at); $i++) {
  $g = $rc->getMethod("get".ucfirst($at[$i]));
  $f = new Text($at[$i],$g->invoke($dm,""));
  echo "<div>";
  echo "<strong>".$at[$i].": </strong>".
       $f->to_s();
  echo "</div>\n";
  }
 }

}
?>