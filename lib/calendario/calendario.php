<?php
require "../app/project.php";
require "../classes/Calendario.php";
require "../classes/Documento.php";
?>

<?php
 if (isset($_GET["data"])) {
 $data = Data::fromString($_GET["data"]);
 }
 else {
 $data = Calendario::hoje();
 }
 
 if (isset($_GET["mes"])) {
 $data = $data->addmes($_GET["mes"]);
 }

$xml = Calendario::xml_mes($data);
$doc = new Documento();
$doc->setConteudoFromString($xml);
$doc->setApresentacao("calendario.xsl");
echo $doc->outPut();
?>