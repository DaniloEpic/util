<?php
require "../classes/Arquivo.php";
?>

<?php
if (isset($_POST["arquivo"])) {
$arquivo = Arquivo::init($_POST["arquivo"]);
 if ($arquivo) {
  
  // salvar
  if ($_POST["conteudo"]) {
  file_put_contents($arquivo->getCaminho(),$_POST["conteudo"]);
  }
  
  $f = file_get_contents($arquivo->getCaminho());
  echo "<div style=\"text-align:center;\">";
  echo "<h2>".$arquivo->getNome()." - ".$arquivo->getDataModificacao("d/m/Y - H:i:s")."</h2>";
  echo "<textarea>".
       $f.
	   "</textarea>";
  echo "<div style=\"margin-top:5px;\">".
       "<button>Limpar</button>".
	   "<button id=\"btn_salvar\" disabled=\"true\" onclick=\"salvar()\">Salvar</button>".
	   "</div>";
  echo "</div>";
  
 }
}
?>