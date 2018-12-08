<?php
class Paginador {
private $VAR_PAGINA = "pagina";
private $url;
private $quantidade;

 public function Paginador($url,$quantidade) {
 $this->url = $url;
 $this->quantidade = $quantidade;
 }

 public function setVarPagina($var_pagina) {
 $this->VAR_PAGINA = $var_pagina;
 }

 public function getVarPagina() {
 return $this->VAR_PAGINA;
 }

 public function setURL($url) {
 $this->url = $url;
 }

 public function getURL() {
 return $this->url;
 }

 public function getQuantidade() {
 return $this->quantidade;
 }

 protected function pagina_anterior($str) {
 $s = "<span>";
  if ($_GET[$this->VAR_PAGINA] > 1) {
  $s .= "<a href=\"".Url_query($this->url).($this->VAR_PAGINA)."=".($_GET[$this->VAR_PAGINA] - 1)."\">".$str.
		"</a>";
  }
  else {
  $s .= $str;
  }
 $s .= "</span>";
 return $s;
 }
 
 protected function proxima_pagina($t,$str) {
 $s = "<span>";
 $p = 1;
  if (isset($_GET[$this->VAR_PAGINA])) {
  $p = $_GET[$this->VAR_PAGINA];
  }
  if ($p * $this->quantidade < $t) {
  $s .= "<a href=\"".Url_query($this->url).($this->VAR_PAGINA)."=".($p + 1)."\">".$str.
		"</a>";
  }
  else {
  $s .= $str;
  }
 $s .= "</span>";
 return $s;
 }
 
 private function comeco($n) {
 $p = 1;
  if (isset($_GET[$this->VAR_PAGINA])) {
  $p = $_GET[$this->VAR_PAGINA];
  }
 $r = $p % $n;
 $c = $p - $r + 1;
  if ($r == 0) {
  $c = $c - $n;
  }
 return $c;
 }
 
 private function ultima_pagina($q) {
 $n = ($q - ($q % $this->quantidade)) / $this->quantidade;
  if ($q % $this->quantidade != 0) {
  $n = $n + 1;
  }
 return $n;
 }
 
 private function fim($n,$q) {
 $f = $n;
 $c = $this->comeco($n);
  if ($c > $n) {
  $f = $c + $n - 1;
  }
 $u = $this->ultima_pagina($q);
  if ($f > $u) {
  $f = $u;
  }
 return $f;
 }
 
 public function to_s($total) {
 $s = "<div>Total: ".$total."</div>\n";
  if ($total == 0) {
  $s .= "<div>...</div>\n";
  }
  else {
   if ($total <= $this->quantidade) {
   $s .= "<div>1 a ".$total." de ".$total."</div>\n";
   }
   if ($total > $this->quantidade) {
   $s .= "<p>";
   $s .= $this->pagina_anterior("&lt;&lt;&nbsp;Anterior");
   $i = $this->comeco(10);
   $j = $this->fim(10,$total);
   $p = 1;
    if (isset($_GET[$this->VAR_PAGINA])) {
	$p = $_GET[$this->VAR_PAGINA];
	}
    do {
	 if ($i == $p) {
	 $s .= "<span style=\"font-weight:bold;\">";
	 }
	 else {
	 $s .= "<span>";
	 }
    $s .= "<a href=\"".Url_query($this->url).$this->VAR_PAGINA."=".$i."\">".$i."</a>";
    $s .= "</span>\n";
    $i = $i + 1;
    }
    while ($i <= $j);
   $s .= $this->proxima_pagina($total,"&gt;&gt;&nbsp;Próxima");
   $s .= "</p>";
   }
  }
 return $s;
 }

 public function paginas($total,$fn) {
 $s = "<div>Total: ".$total."</div>\n";
  if ($total == 0) {
  $s .= "<div>...</div>\n";
  }
  else {
   if ($total <= $this->quantidade) {
   $s .= "<div>1 a ".$total." de ".$total."</div>\n";
   }
   if ($total > $this->quantidade) {
   $s = "<p>";
   $p = 1;
    if (isset($_GET[$this->VAR_PAGINA])) {
    $p = $_GET[$this->VAR_PAGINA];
    }
    // página anterior
    if ($p > 1) {
    $s .= "<span onclick=\"".$fn."('".Url_query($this->url).($this->VAR_PAGINA)."=".($p - 1)."')\">".
          "&lt;&lt;&nbsp;Anterior</span>\n";
    }
    else {
    $s .= "<span>&lt;&lt;&nbsp;Anterior</span>\n";
    }
   // páginas
   $i = $this->comeco(10);
   $j = $this->fim(10,$total);
    do {
    $st = "font-weight:normal;";
     if ($i == $p) {
     $st = "font-weight:bold;";
     }
    $s .= "<span style=\"".$st."\" onclick=\"".$fn."('".Url_query($this->url).$this->VAR_PAGINA."=".$i."')\">";
    $s .= $i."</span>\n";
    $i = $i + 1;
    }
    while ($i <= $j);
    // proxima página
    if ($p * $this->quantidade < $total) {
    $s .= "<span onclick=\"".$fn."('".Url_query($this->url).($this->VAR_PAGINA)."=".($p + 1)."')\">".
          "&gt;&gt;&nbsp;Próxima</span>\n";
    }
    else {
    $s .= "<span>&gt;&gt;&nbsp;Próxima</span>\n";
    }
   $s .= "</p>\n";
   }
  }
 return $s;
 }

}

class Scroller extends Paginador {

public function Scroller($quantidade) {
parent::Paginador("",$quantidade);
}

 public function to_s($total) {
 $s = "<div>Total: ".$total."</div>\n";
  if ($total == 0) {
  $s .= "<div>...</div>\n";
  }
  else {
   if ($total <= $this->quantidade) {
   $s .= "<div>1 a ".$total." de ".$total."</div>\n";
   }
   if ($total > $this->quantidade) {
   $s .= "<p>";
   $s .= $this->pagina_anterior("&lt;&lt;&nbsp;");
   $s .= $this->proxima_pagina($total,"&nbsp;&gt;&gt;");
   $s .= "</p>";
   }
  }
 return $s;
 }

}

class Slider {
private $total;
private $por_pagina;

 public function Slider($total,$por_pagina) {
 $this->total = $total;
 $this->por_pagina = $por_pagina;
 }

 private function anterior($i) {
 $s = "<span>";
  if ($i > 0) {
  $j = $i - $this->por_pagina;
   if ($j < 0) {
   $j = 0;
   }
  $s .= "<a href=\"?limit=".$j.",".$this->por_pagina."\">&lt;</a>";
  }
 $s .= "</span>";
 return $s;
 }

 private function proxima($i) {
 $s = "";
  if ($this->total > $this->por_pagina) {
  $j = $i + $this->por_pagina;
  $s .= "<a href=\"?limit=".$j.",".$this->por_pagina."\">&gt;</a>";
  $s .= "</span>";
  }
 return $s;
 }

 public function to_s() {
 $str = "<p>";
  if (isset($_GET["limit"])) {
  $m = explode(",",$_GET["limit"]);
  $i = intval($m[0]);
  }
  else {
  $i = 0;
  }
 $p .= $this->anterior($i);
 $p .= $this->proxima($i);
 $p .= "</p>\n";
 return $p;
 }

}

interface Paginavel {

public function setQuantidadePorPagina($q);

public function getQuantidadePorPagina();

public function paginar();

public function scroll();

public function to_string();

public function to_s($output_method, $params);

}

function Url_query($url) {
$a = explode("?",$url);
 if (count($a) == 1) {
 $url .= "?";
 }
 else {
 $url .= "&";
 }
return $url;
}
?>