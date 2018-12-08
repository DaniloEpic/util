<?php
class RestRequest {
private $method;
private $params;

 public function RestRequest() {
 $this->method = $_SERVER["REQUEST_METHOD"];
  switch (strtolower($this->method)) {
  case "get":
  $this->params = $_GET;
  break;
  case "post":
  $this->params = $_POST;
  break;
  case "put":
  parse_str(file_get_contents("php://input"),$_PUT);
  $this->params = $_PUT;
  break;
  case "delete":
  parse_str(file_get_contents("php://input"),$_DELETE);
  $this->params = $_DELETE;
  break;
  }
 }
 
 public function getMethod() {
 return $this->method;
 }
 
 public function getParams() {
 return $this->params;
 }
 
 public function getParam($v) {
 return $this->params[$v];
 }
 
}
?>