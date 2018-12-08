<?php
class RestResource {
protected $request;

 public function setRequest() {
 $this->request = new RestRequest();
 }
 
 public function getRequest($n = null) {
  if (isset($n)) {
  $m = $this->request->getParam($n);
  }
  else {
  $m = $this->request->getParams();
  }
 return $m;
 }
 
 public function init() {
  switch ($this->request->getMethod()) {
  case "GET":
  $this->doGet();
  break;
  case "PUT":
  $this->doPut();
  break;
  case "POST":
  $this->doPost();
  break;
  case "DELETE":
  $this->doDelete();
  break;
  }
 }
 
}
?>