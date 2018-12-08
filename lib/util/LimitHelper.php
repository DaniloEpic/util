<?php
class Limit {
private $comecando_em;
private $por_pagina;
private $maximo;

 public function fromString($str) {
 $s = explode(",",$str);
  if (count($s) > 1) {
  $this->comecando_em = (intval($s[0]) - 1) * intval($s[1]);
  $this->por_pagina = intval($s[1]);
  $this->maximo = intval($s[1]);
   if (count($s) > 2) {
   $this->maximo = intval($s[1]) * intval($s[2]);
   }
  }
 }
 
 public function ultimaPagina($q) {
 $i = intval($q / $this->por_pagina);
 $j = $q % $this->por_pagina;
  if ($j > 0) {
  $i += 1;
  }
 $this->comecando_em = ($i - 1) * $this->por_pagina;
 }

 public function getComecando_em() {
 return $this->comecando_em;
 }

 public function getPor_pagina() {
 return $this->por_pagina;
 }

 public function getMaximo() {
 return $this->maximo;
 }
 
 public function query() {
 $m = $this->maximo + 1;
 return " limit ".intval($this->comecando_em).", ".intval($m);
 }
	
 public function json_pages($m) {
 $c = ($this->comecando_em / $this->por_pagina) + 1;
 $cur = "\"current\":\"".$c."\"";
 $pre = "\"previous\":false";
  if ($this->comecando_em > 0) {
  $pre = "\"previous\":true";
  }
 $nex = "\"next\":false";
  if ($m > $this->por_pagina) {
  $nex = "\"next\":true";
  }
 $las = "\"last\":true";
  if ($m > $this->maximo) {
  $las = "\"last\":false";
  }
 return "{ ".$cur.",".$pre.",".$nex.",".$las." }";
 }

}

abstract class LimitHelper {
public static $limit;
public static $vector;

 public static function init($str) {
 self::$limit = new Limit();
 self::$limit->fromString($str);
 self::$vector = limit_query();
 }

 public static function json() {
 $js = "{";
 $js .= "\"itens\": ".json_itens(self::$vector);
 $js .= ",\"pages\": ".self::$limit->json_pages(self::$vector->getSize());
 $js .= "}";
 return $js;
 }

}
?>