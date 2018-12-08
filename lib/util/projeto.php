<?php
require PROJECT_ADDRESS."/lib/classes/Explorer.php";
?>

<?php
$dir = new Explorer(".");
$dir->hierarquia();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Projeto</title>
<style type="text/css">
* {
margin: 0;
padding: 0
}
table {
border-style: solid;
border-width: 1px;
border-color: gray
}
table {
padding: 10px
}
td {
padding: 5px
}
NODE {
display: inline-block;
border-style: solid;
border-width: 1px;
border-color: gray;
padding: 5px;
margin: 50px;
font-family: monospace
}
CHILDNODES {
display: block;
max-width: 1000px
}
h1 {
font-weight: normal;
font-family: sans-serif;
font-size: 50px
}
</style>
</head>
<body>
<div style="width:1000px;margin:0 auto;background-color:ghostwhite;">
<?php
echo "<h1>".dirname($_SERVER["PHP_SELF"])."</h1>";
$r = $dir->getRoot();
echo $r->xml_childHNodes("getNome");
?>
</div>
</body>
</html>