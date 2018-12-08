<?php
function get_fn($mo) {
$s = " public function json() {\n";
$s .= " \$js = \"{\";\n";
$at = explode(",",$mo->attrs());
$i = 0;
 do {
 $s .= " \$js .= ";
 $s .= "\" \\\"".$at[$i]."\\\" : ";
 $s .= "\\\"\".";
 $s .= "\$this->".$at[$i];
 $s .= ".\"\\\"";
 $i += 1;
  if ($i < count($at)) {
  $s .= " ,";
  }
 $s .= "\";\n";
 }
 while ($i < count($at));
$s .= " \$js .= \"}\";\n";
$s .= " return \$js;\n";
$s .= " }";
echo $s;
}

function json_transposta($matriz,$atributos) {
$s = "{";
 $k = explode(",",$atributos);
 $j = 0;
 do {
 $s .= "\"".$k[$j]."\":[";
 $i = 0;
 while ($i < count($matriz)) {
  $value = json_value($matriz[$i][$k[$j]]);
  $s .= $value;
  $i = $i + 1;
   if ($i < count($matriz)) {
   $s .= ",";
   }
  }
 $s .= "]";
 $j = $j + 1;
  if ($j < count($k)) {
  $s .= ",\n";
  }
 }
 while ($j < count($k));
$s .= "}";
return $s;
}

function get_data($a,$b) {
$s = "\"".$b."\" : [";
$i = 0;
 while ($i < count($a)) {
 $s .= "\"".$a[$i][$b]."\"";
 $i = $i + 1;
  if ($i < count($a)) {
  $s .= ",";
  }
 }
$s .= "]";
return $s;
}

//
function loop_data($a,$b) {
$s = "\"".$b."\" : [";
$i = 0;
 while ($i < count($a)) {
 $s .= who_can_do_it($a[$i][$b]);
 $i = $i + 1;
  if ($i < count($a)) {
  $s .= ",";
  }
 }
$s .= "]";
return $s;
}

function json_value($a) {
$b = "";
 if (strpos($a,"{") === 0) {
 $b .= escape_to_json($a);
 }
 else {
 $b .= "\"".escape_to_json($a)."\"";
 }
return $b;
}

class JSON_Attribute {
private $name;
private $str;
 
 public function JSON_Attribute($name) {
 $this->name = $name;
 $this->false_value();
 }
 
 public function true_value() {
 $this->str =  "\"".$this->name."\":true";
 }
 
 public function false_value() {	 
 $this->str = "\"".$this->name."\":false";
 }
 
 //
 public function nil() {
 $this->str = "\"".$this->name."\":null";
 }
 
 public function set_value($m) {
 $n = "\"".$m."\"";
  if (strpos($n,"{") == 1) {
  $n = $m;
  }
 $this->str = "\"".$this->name."\":".$n;
 }
 
 public function to_s() { 
 return $this->str;
 }
}

class JSON_Array {
private $itens;
 
 public function JSON_Array($itens) {
 $this->itens = $itens;
 }
 
 //
 public function getItens() {
 return $this->itens;
 }
 
 //
 public function get_data($b,$n = false) {
 $js = "[";
 $i = 0;
  while ($i < count($this->itens)) {
   if ($n) {
    if ($this->itens[$i][$b]) {
    $js .= "true";
    }
    else {
    $js .= "false";
    }
   }
   else {
   $js .= "\"".escape_to_json($this->itens[$i][$b])."\"";
   }
  $i = $i + 1;
   if ($i < count($this->itens)) {
   $js .= ",";
   }
  }
 $js .= "]";
 return $js;
 }
 
 public function getData($ats) {
 $js = "";
 $at = explode(",",$ats);
 $i = 0;
  while ($i < count($at)) {
  $t = "\"".$at[$i]."\":[";
  $j = 0;
   while ($j < count($this->itens)) {
   $k = "\"".escape_to_json($this->itens[$j][$at[$i]])."\"";
   $j += 1;
    if ($j < count($this->itens)) {
    $k .= ",";
    }
   $t .= $k;
   }
  $t .= "]";
  $i += 1;
   if ($i < count($at)) {
   $t .= ",";
   }
  $js .= $t;
  }
 return $js;
 }
 
 public function loop_data($a) {
 $js = "[";
 $i = 0;
  while ($i < count($this->itens)) {
  $js .= who_can_do_it($this->itens[$i][$a]);
  $i = $i + 1;
   if ($i < count($this->itens)) {
   $js .= ",";
   }
  }
 $js .= "]";
 return $js;
 }
 
 public function loop_bool($k) {
 $s = "[";
 $i = 0;
  while ($i < count($this->itens)) {
   if ($this->itens[$i][$k]) {
   $s .= "true";
   }
   else {
   $s .= "false";
   }
  $i = $i + 1;
   if ($i < count($this->itens)) {
   $s .= ",";
   }
  }
 $s .= "]";
 return $s;
 }
 
 public function loop_with($b,$c) {
 $js = "[";
 $i = 0;
  while ($i < count($this->itens)) {
  $js .= do_something($this->itens[$i],$b,$c);
  $i = $i + 1;
   if ($i < count($this->itens)) {
   $js .= ",";
   }
  }
 $js .= "]";
 return $js;
 }

}

//
function lista_to_json(Lista $lista,$f) {
$s = "\"".$f."\":[";
$i = 0;
 while ($i < $lista->getSize()) {
 $x = $lista->getElement($i);
 $y = $x->get_method($f);
 $s .= "\"".$y->invoke($x)."\"";
 $i = $i + 1;
  if ($i < $lista->getSize()) {
  $s .= ",";
  }
 }
$s .= "]";
return $s;
}

function escape_to_json($a) {
$a = addcslashes($a,"\\");
$a = addcslashes($a,"\n");
$a = addcslashes($a,"\r");
$a = addcslashes($a,"\"");
return $a;
}
?>