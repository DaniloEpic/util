<?php
require PROJECT_ADDRESS."/lib/classes/Register.php";

abstract class DefaultController {
protected static $exceptions;

 public static function init() {
 self::$exceptions = new Register();
 }

 public static function defineException($name,$value) {
 self::$exceptions->set($name,$value);
 }
 
 public static function getException($name) {
 return self::$exceptions->get($name);
 }

 public static function hasException() {
 return (self::$exceptions->size() > 0);
 }

 public static function removeException($name) {
 self::$exceptions->excluir($name);
 }
 
 public static function print_exception($n,$a = null) {
  if (self::hasException()) {
  echo self::getException($n);
  }
  else {
  $alt = "Houve um erro!";
  if ($a != null) {
  $alt = $a;
  }
  echo $alt;
  }
 }

 public static function validateEmail($email) {
 $pass = (filter_var($email,FILTER_VALIDATE_EMAIL));
  if (!$pass) {
  DefaultController::defineException("email","Endereço de e-mail inválido!");
  }
 return $pass;
 }

 public static function confirmarSenha($pwd1, $pwd2) {
 $pass = ($pwd1 == $pwd2);
  if (!$pass) {
  DefaultController::defineException("senha","Não foi possível confirmar sua senha!");
  }
 return $pass;
 }

}

function __GET($s) {
$a = explode(".",$s);
$controller = ucfirst($a[0])."Controller";
$rc = new ReflectionClass($controller);
$rp = $rc->getProperty($a[0]);
$o = $rp->getValue();
$method = "get".ucfirst($a[1]);
$m = new ReflectionMethod($o,$method);
echo $m->invoke($o);
}
?>