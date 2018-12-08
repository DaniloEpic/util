<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Arquivos</title>
<script type="text/javascript" src="../../public/javascripts/easyajax.js"></script>
<script type="text/javascript" src="../../public/javascripts/evento.js"></script>
<script type="text/javascript" src="filebrowser.js"></script>
<style type="text/css">
* {
margin: 0;
padding: 0
}

input[type="text"] {
padding: 3px;
border-style: inset;
border-width: 1px
}

input[type="button"], button {
padding: 3px;
background-color: gainsboro;
border-style: outset;
border-width: 1px;
border-color: gainsboro;
}

pagina {
position: absolute;
display: block;
width: 90%;
top: 0;
bottom: 0;
left: 5%;
right: 5%;
overflow: auto
}

#diretorio {
width: 820px;
margin: 5px auto;
background-color: white;
border-style: solid;
border-width: 1px;
overflow: auto
}

h1, h2, h3 {
font-weight: normal;
}

h1, h2 {
padding: 5px;
font-family: sans-serif
}

h1 {
letter-spacing: 1px
}

#editor textarea {
width: 500px;
height: 300px;
border-style: inset;
border-width: 1px;
padding: 5px;
font-size: 18px
}

a {
color: blue;
text-decoration: underline;
cursor: pointer
}
</style>
</head>
<body>
<pagina>
<h1 style="width:820px;margin:0 auto;">PhpFileBrowser</h1>
<div id="diretorio" fonte="dir.php"></div>

<script type="text/javascript">
n = document.getElementById("diretorio");
getResponse(n);
</script>
</pagina>
</body>
</html>