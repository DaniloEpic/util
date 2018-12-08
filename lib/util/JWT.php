<?php
class JWT {
private $header;
private $payload;
private $signature;
private $algoritimo;

 public function setHeader($algoritimo = null) {
 $this->algoritimo = "sha1";
  if ($algoritimo != null) {
  $this->algoritimo = $algoritimo;
  }
 $this->header = "{\"typ\":\"JWT\",\"alg\":\"".$this->algoritimo."\"}";
 }

 public function setPayload($payload) {
 $this->payload = $payload;
 }

 public function getPayload() {
 return $this->payload;
 }

 public function sign($secret) {
 $str = base64_encode($this->header).".".base64_encode($this->payload);
 $this->signature = hash_hmac($this->algoritimo,$str,$secret);
 }

 public function getToken() {
 $token = base64_encode($this->header);
 $token .= ".".base64_encode($this->payload);
 $token .= ".".$this->signature;
 return $token;
 }

 public static function from_token($token,$secret) {
 $vector = explode(".",$token);
  if (count($vector) == 3) {
  $js = json_decode(base64_decode($vector[0]),true);
  $p = $vector[0].".".$vector[1];
   if ( $vector[2] == hash_hmac($js["alg"],$p,$secret) ) {
   $jwt = new JWT();
   $jwt->setHeader($js["alg"]);
   $jwt->setPayload(base64_decode($vector[1]));
   }
  }
 return $jwt;
 }

}
?>