<?php
require "../classes/Diretorio.php";
?>

<?php
if (isset($_GET["diretorio"])) {
$dir = Diretorio::init($_GET["diretorio"]);
}
else {
$dir = Diretorio::init($_SERVER["DOCUMENT_ROOT"].dirname($_SERVER["PHP_SELF"]));
}
?>

<?php
if ($dir) {
 
 if (isset($_GET["arquivo"])) {
 $dir->filtrar_arquivos($_GET["arquivo"]);
 $dir->getArquivos()->paginar();
 $xmla = "<ARQUIVOS>";
 $xmla .= $dir->getArquivos()->to_s("xml","");
 $xmla .= "</ARQUIVOS>";
 $arq = new Documento();
 $arq->setConteudoFromString(utf8_decode($xmla));
 $arq->setApresentacao("arquivos.xsl");
 echo $arq->outPut();
 }
 
 else {
  
  if (isset($_GET["pasta"])) {
  $dir->filtrar_pastas($_GET["pasta"]);
  $dir->getPastas()->paginar();
  $xmlp = "<PASTAS>";
  $xmlp .= $dir->getPastas()->to_s("xml","");
  $xmlp .= "</PASTAS>";
  $pas = new Documento();
  $pas->setConteudoFromString(utf8_decode($xmlp));
  $pas->setApresentacao("pastas.xsl");
  echo $pas->outPut();
  }
  
  else {
  $dir->getPastas()->paginar();
  $dir->getArquivos()->paginar();
  ?>
  
  <h2><?php echo $dir->getPath(); ?></h2>
  <div>
   
   <div style="width:200px;float:left;padding:5px;">
   <h3>Pastas</h3>
   <p><input type="text" onkeyup="filtrar_pastas(this)"/></p>
   <?php
   echo "<pastas>";
   $xmlp = "<PASTAS>";
   $xmlp .= $dir->getPastas()->to_s("xml","");
   $xmlp .= "</PASTAS>";
   $pas = new Documento();
   $pas->setConteudoFromString(utf8_decode($xmlp));
   $pas->setApresentacao("pastas.xsl");
   echo $pas->outPut();
   echo "</pastas>";
   ?>
   </div>
   
   <div style="width:600px;float:left;padding:5px;">
   <h3>Arquivos <input type="text" onkeyup="filtrar_arquivos(this)"/></h3>
   <?php
   echo "<arquivos style=\"position:relative;display:block;margin-top:5px;height:50px;overflow:auto;\">";
   $xmla = "<ARQUIVOS>";
   $xmla .= $dir->getArquivos()->to_s("xml","");
   $xmla .= "</ARQUIVOS>";
   $arq = new Documento();
   $arq->setConteudoFromString(utf8_decode($xmla));
   $arq->setApresentacao("arquivos.xsl");
   echo $arq->outPut();
   echo "</arquivos>";
   ?>
    <div style="width:400px;margin:0 auto;">
    <p style="text-align:center;"><input type="text" id="arquivo" style="width:325px;"/></p>
    <p style="text-align:right;font-family:monospace;"><a onclick="abrir_arquivo()">Abrir</a></p>
    </div>
	<div id="editor"></div>
   </div>
   
  </div>
  <?php
  }
 }
 
}
?>