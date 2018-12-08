<?php
interface Model {

 public function persistir();

 public function registro($i);

 public function registros();
 
 public function delete();

 public function xml();
 
 public function json();
 
 public function attrs();

}
?>