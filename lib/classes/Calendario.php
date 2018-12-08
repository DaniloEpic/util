<?php
require PROJECT_ADDRESS."/lib/classes/Data.php";
require_once PROJECT_ADDRESS."/lib/classes/Lista.php";

class Calendario {

 public static function hoje() {
 $hoje = new Data(date("d"),date("m"),date("Y"));
 return $hoje;
 }

 public static function semana($data) {
 $semana = new Lista();
 $dom = $data->adddia(0 - $data->diadasemana());
 $seg = $dom->adddia(1);
 $ter = $seg->adddia(1);
 $qua = $ter->adddia(1);
 $qui = $qua->adddia(1);
 $sex = $qui->adddia(1);
 $sab = $sex->adddia(1);
 $semana->addElement($dom);
 $semana->addElement($seg);
 $semana->addElement($ter);
 $semana->addElement($qua);
 $semana->addElement($qui);
 $semana->addElement($sex);
 $semana->addElement($sab);
 $semana->paginar();
 return $semana;
 }

 public static function xml_semana($data) {
 $xml = "<SEMANA dia=\"".$data->diadomes()."\" mes=\"".$data->mes()."\" ano=\"".$data->ano()."\">\n";
 $xml .= Calendario::semana($data)->to_s("xml","");
 $xml .= "</SEMANA>\n\n";
 return $xml;
 }

 public static function xml_mes($data) {
 $di = new Data(1,$data->mes(),$data->ano());
 $df = $di->addmes(1)->adddia(-1);
 $a = 7 - $di->diadasemana();
 $b = $df->diadasemana() + 1;
 $n = $df->diadomes();
 $k = $n - ($a + $b);
 $q = $k / 7;
 $i = 0;
 $s = "<MES nome=\"".$data->nomedomes()."\" dia=\"".$data->diadomes()."\" mes=\"".$data->mes()."\" ano=\"".$data->ano()."\">\n";
 $hoje = Calendario::hoje();
 $s .= "<HOJE dia=\"".$hoje->diadomes()."\" mes=\"".$hoje->mes()."\" ano=\"".$hoje->ano()."\"/>\n\n";
 $s .= Calendario::xml_semana($di);
 $data = $di->adddia(7);
  do {
  $s .= Calendario::xml_semana($data);
  $i = $i + 1;
  $data = $data->adddia(7);
  }
  while ($i < $q);
 $s .= Calendario::xml_semana($df);
 $s .= "</MES>";
 return $s;
 }

}
?>