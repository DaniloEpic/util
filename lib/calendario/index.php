<!doctype html>
<html lang="pt-br">
<head>
<meta charset="UTF-8"/>
<title>Calendário</title>
<link rel="stylesheet" type="text/css" href="calendario.css"/>
<script type="text/javascript" src="calendario.js"></script>
<script type="text/javascript" src="../../public/javascripts/easyajax.js"></script>
<script type="text/javascript" src="../../public/javascripts/easydom.js"></script>
<script type="text/javascript">
function calendario() {
widgetCalendario.set_date_container(byId("data"));
widgetCalendario.set_calendar_container(byId("calcontainer1"));
widgetCalendario.display();
}

function get_application_base_dir() {
var c = window.location.href.split("/");
return "/"+c[3];
}
</script>
</head>
<body>

<div>
<p><input type="text" id="data"/>&nbsp;&nbsp;
<a href="javascript:calendario()">exibir calendário</a></p>
<div id="calcontainer1"></div>
</div>
	
</body>
</html>