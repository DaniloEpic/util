<?php
class Data {
private $dma;

 public function Data($dia,$mes,$ano) {
 $this->dma = mktime(0,0,0,$mes,$dia,$ano);
 }
 
 public function e_valida() {
 return checkdate($this->mes(),$this->diadomes(),$this->ano());
 }

 public function ano() {
 $ano = date("Y",$this->dma);
 return $ano;
 }

 public function mes() {
 $mes = date("m",$this->dma);
 return $mes;
 }

 public function nomedomes() {
 $m = $this->mes();
 $mes = "";
  switch ($m) {
  case 1:
  $mes = "Janeiro";
  break;
  case 2:
  $mes = "Fevereiro";
  break;
  case 3:
  $mes = "Março";
  break;
  case 4:
  $mes = "Abril";
  break;
  case 5:
  $mes = "Maio";
  break;
  case 6:
  $mes = "Junho";
  break;
  case 7:
  $mes = "Julho";
  break;
  case 8:
  $mes = "Agosto";
  break;
  case 9:
  $mes = "Setembro";
  break;
  case 10:
  $mes = "Outubro";
  break;
  case 11:
  $mes = "Novembro";
  break;
  case 12:
  $mes = "Dezembro";
  break;
  }
 return $mes;
 }

 public function diadoano() {
 $z = date("z",$this->dma);
 return $z + 1;
 }

 public function diadomes() {
 $d = date("d",$this->dma);
 return $d;
 }

 public function diadasemana() {
 $w = date("w",$this->dma);
 return $w;
 }

 public function nomedodiadasemana() {
 $w = $this->diadasemana();
 $diadasemana = "";
  switch ($w) {
  case 0:
  $diadasemana = "Domingo";
  break;
  case 1:
  $diadasemana = "Segunda-feira";
  break;
  case 2:
  $diadasemana = "Terça-feira";
  break;
  case 3:
  $diadasemana = "Quarta-feira";
  break;
  case 4:
  $diadasemana = "Quinta-feira";
  break;
  case 5:
  $diadasemana = "Sexta-feira";
  break;
  case 6:
  $diadasemana = "Sábado";
  break;
  }
 return $diadasemana;
 }

 private function diautil() {
 $w = $this->diadasemana();
 return (($w =! 0) and ($w != 6));
 }

 public function adddia($i) {
 $d = $this->diadomes() + $i;
 $m = $this->mes();
 $a = $this->ano();
 $data = new Data($d,$m,$a);
 return $data;
 }

 public function adddiautil($i) {
 $c = 0;
 $data = $this;
  if ($i > 0) {
   do {
   $data = $data->adddia(1);
    if ($data->diautil()) {
    $c = $c + 1;
    }
   }
   while ($c < $i);
  }
  if ($i == 0) {
  $data = $data->adddia(0);
  }
  if ($i < 0) {
   do {
   $data = $data->adddia(-1);
    if ($data->diautil()) {
    $c = $c + 1;
    }
   }
   while ($c < (0 - $i));
  }
 return $data;
 }

 public function addmes($i) {
 $d = $this->diadomes();
 $m = $this->mes() + $i;
 $a = $this->ano();
 $data = new Data($d,$m,$a);
 return $data;
 }

 public function addano($i) {
 $d = $this->diadomes();
 $m = $this->mes();
 $a = $this->ano() + $i;
 $data = new Data($d,$m,$a);
 return $data;
 }
 
 public function anos_desde(Data $d) {
 $a = $this->ano() - $d->ano();
  if ($a > 0) {
  $b = ($d->mes() - $this->mes());
   if ($b > 0) {
   $a = $a - 1;
   }
   if ($b == 0) {
   $c = $d->diadomes() - $this->diadomes();
    if ($c > 0) {
	$a = $a - 1;
	}
   }
  }
  else {
  $a = 0;
  }
 return $a;
 }

 private function diasdesdesegunda() {
 return date("w",$this->dma) - 1;
 }

 private function diasatesexta() {
 return 5 - date("w",$this->dma);
 }

 private function proximodomingo() {
 return $this->adddia($this->diasatesexta() + 2);
 }

 public function ultimodomingo() {
 return $this->adddia(0 - ($this->diasdesdesegunda() + 1));
 }

 private function diasateofimdoano() {
 $ultimodiadoano = new Data(31,12,$this->ano());
 return $ultimodiadoano->diadoano() - $this->diadoano();
 }

 private function diasnoano() {
 $ultimodiadoano = new Data(31,12,$this->ano());
 return $ultimodiadoano->diadoano();
 }

 /* 
 // $data deve ser um objeto Date e deve ser uma data posterior
 // à data do objeto data que a chama
 */
 public function diferencadias($data) {
 $anos = $data->ano() - $this->ano();
 $dias = 0;
  if ($anos < 0) {
  $d1 = $data->diferencadias($this);
  $dias = 0 - $d1;
  }
  if ($anos == 0) {
  $dias = $data->diadoano() - $this->diadoano();
  }
  if ($anos == 1) {
  $dias = $data->diadoano() + $this->diasateofimdoano();
  }
  if ($anos > 1) {
  $d1 = $this->diasateofimdoano();
  $ai = $this->ano() + 1;
  $af = $data->ano() - 1;
  $d2 = 0;
   for ($a = $ai; $a <= $af; $a++) {
   $dt = new Data(1,1,$a);
   $q = $dt->diasnoano();
   $d2 = $d2 + $q;
   }
  $d3 = $data->diadoano();
  $dias = $d1 + $d2 + $d3;
  }
 return $dias;
 }

 public function diferencadiasuteis($data) {
 $d1 = $this->diasatesexta();
 $d2 = $data->diasdesdesegunda() + 1;
 $inicio = $this->proximodomingo();
 $fim = $data->ultimodomingo();
 $intervalo = $inicio->diferencadias($fim);
 $d3 = $intervalo - ($intervalo / 7 * 2);
 return $d1 + $d2 + $d3;
 }

 public function toString() {
 return date("d/m/Y",$this->dma);
 }

 public function to_datetime() {
 return date("Y-m-d",$this->dma);
 }

 public function xml() {
 $xml = "<DATA>\n";
 $xml .= " <DIADASEMANA>".$this->diadasemana()."</DIADASEMANA>\n";
 $xml .= " <DIADOMES>".$this->diadomes()."</DIADOMES>\n";
 $xml .= " <MES>".$this->mes()."</MES>\n";
 $xml .= " <ANO>".$this->ano()."</ANO>\n";
 $xml .= "</DATA>";
 return $xml;
 }

 public static function fromString($strdata) {
 $valores = explode("/",$strdata);
 $dia = (int) $valores[0];
 $mes = (int) $valores[1];
 $ano = (int) $valores[2];
  if (checkdate($mes,$dia,$ano)) {
  $data = new Data($dia, $mes, $ano);
  }
 return $data;
 }
 
 public static function from_datetime($dt) {
 $d = explode(" ",$dt);
 $dn = explode("-",$d[0]);
 $data = new Data($dn[2],$dn[1],$dn[0]);
 return $data;
 }

 public static function str_2_datetime($dt) {
 $d = explode(" ",$dt);
 $dn = explode("/",$d[0]);
 return $dn[2]."-".$dn[1]."-".$dn[0]." ".$d[2];
 }
 
 public static function datetime_2_str($dt) {
 $d = explode(" ",$dt);
 $dn = explode("-",$d[0]);
 $tn = explode(":",$d[1]);
 return $dn[2]."/".$dn[1]."/".$dn[0]." - ".$tn[0].":".$tn[1];
 }
 
 public static function datestring($dt) {
 $d = explode(" ",$dt);
  if (count($d) == 2) {
  $a = explode("-",$d[0]);
  $data = new Data(intval($a[2]),intval($a[1]),intval($a[0]));
  $ref = new Data(date("d"),date("m"),date("Y"));
  $x = $data->diferencadias($ref);
   if ($x >= 7) {
   $str = $a[2]."/".$a[1]."/".$a[0]." - ".$d[1];
   }
   else {
   $str = $d[1];
    if ($x > 0) {
	$str = $data->nomedodiadasemana()." - ".$str;
	}
   }
  }
 return $str;
 }

}
?>