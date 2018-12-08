widgetCalendario = {
 set_date_container : function (o) {
 this.date_container = o;
 },
 set_calendar_container : function (c) {
 this.calendar_container = c;
 },
 get_date : function () {
 return this.date_container.value; 
 },
 display : function () {
 var m = this.get_date();
 var u = "lib/calendario/calendario.php";
  if (m.length == 10) {
  u += "?data="+encodeURIComponent(m);
  }
 var b = byId("calendario");
  if (b == null) {
  b = new_element("div","id=calendario");
  this.calendar_container.appendChild(b);
  }
 b.setAttribute("fonte",get_application_base_dir()+"/"+u);
 getResponse(b);
 },
 selecionar : function (d) {
 delById("calendario");
 this.date_container.value = d;
 this.date_container.focus();
 },
 mes_anterior : function (d) {
 var m = byId("calendario");
 var n = get_application_base_dir()+"/lib/calendario/calendario.php";
 n += "?data="+encodeURIComponent(d)+"&mes=-1";
 m.setAttribute("fonte",n);
 getResponse(m);
 },
 proximo_mes : function (d) {
 var m = byId("calendario");
 var n = get_application_base_dir()+"/lib/calendario/calendario.php";
 n += "?data="+encodeURIComponent(d)+"&mes=1";
 m.setAttribute("fonte",n);
 getResponse(m); 
 }
};