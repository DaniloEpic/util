function Paginador(m) {
this.itens_por_pagina = m;
this.paginas_por_consulta = 1;
this.pagina = 1;
this.anterior = false;
this.proxima = false;
this.ultima = false;
this.qitens = 0;

 this.to_s = function () { 
 var s = this.pagina;
 s += ","+this.itens_por_pagina;
 s += ","+this.paginas_por_consulta;
 return s;
 };

 this.go = function () { 
 this.lista = new ListaHelper();
 this.query_data();
 };
 
 this.setProxima = function () { 
  if (this.qitens <= this.itens_por_pagina) {
  this.proxima = false;
  }
 };
 
 this.setLista = function () { 
 this.lista.quantidade_por_pagina = this.itens_por_pagina;
 this.lista.tamanho = this.qitens;
 };
 
 this.init = function (m) {
  if ('current' in m) {
  this.pagina = parseInt(m.current);
  }
  if ('previous' in m) {  
  this.anterior = m.previous;
  }
  if ('next' in m) {
  this.proxima = m.next;
  }
  if ('last' in m) {
  this.ultima = m.last;
  }
 };
 
 this.load = function () {
 this.set_data();
 this.setProxima();
 this.setLista();
 this.lista.loop(0);
 };
 
 this.get_data = function (m,n) {
 this.qitens = n;
 this.init(m);
 this.load();
 mostrarPaginas();
 };
 
 this.previous = function () {
 this.pagina -= 1;
 this.query_data();
 };
 
 this.next = function () { 
 this.pagina += 1;
 this.query_data();
 };
 
 this.first = function () { 
  if (this.anterior == true) {
  this.pagina = "1";
  this.go();
  }
 };
 
 this.last = function () { 
  if (this.proxima == true) {
  this.pagina = "0";
  this.go();
  }
 };
 
 this.numeroDePaginas = function (q) { 
 this.numero_de_paginas = parseInt(q / this.itens_por_pagina);
  if ( (q % this.itens_por_pagina) > 0 ) {
  this.numero_de_paginas += 1;
  }
 };
 
 this.goTo = function (n) {
  if (n <= this.numero_de_paginas) {
  this.pagina = n;
  this.go();
  }
 };
 
 this.all = function () { 
 var g = (this.itens_por_pagina * this.numero_de_paginas);
 this.itens_por_pagina = g;
 this.pagina = "1";
 this.go();
 };
 
 this.getInicio = function () {
 var a = this.pagina % this.qPages;
 var b = this.pagina - a + 1;
  if (a == 0) {
  b = b - this.qPages;
  }
 return b;
 };
 
 this.getFim = function () {
 var f = this.qPages;
 var g = this.getInicio();
  if (g > this.qPages) {
  f = g + (this.qPages) - 1;
  }
  if (f > this.numero_de_paginas) {
  f = this.numero_de_paginas;
  }
 return f;
 };
 
}

function Paginas() {
	
 this.init = function (b) {
 this.tabela = new FakeTable();
 this.tabela.set_container(b);
 this.tabela.set_table_element("pages");
 this.tabela.set_row_element("page");
 };

 this.template = function (t) {
 this.tabela.set_template(t);
 };

 this.show = function () {
 var a = this.tabela.container.get("ltbutton");
 var b = this.tabela.container.get("gtbutton");
 a.display("none");
 b.display("none");
  if (this.paginador.pagina > 1) {
  a.display("inline");
  }
  if (this.paginador.proxima) {
  b.display("inline");
  }
 var i = this.paginador.getInicio();
 var j = this.paginador.getFim();
  do {
  var e = this.tabela.get("numero");
  e.elemento.textContent = i;
  e.link("javascript:irPara('"+i+"')");
   if (i == this.paginador.pagina) {
   this.tabela.template.elemento.setAttribute("class","current");
   }
   else {
   this.tabela.template.elemento.removeAttribute("class");
   }
  this.tabela.add_row();
  i += 1;
  }
  while (i <= j);
 };
 
}

function Slider() {
 
 this.init = function (c) {
 this.container = new Container(byId(c));
 };
 
 this.show = function () {
 var a = this.container.get("ltbutton");
 var b = this.container.get("gtbutton");
 var c = this.container.get("page");
 a.display("none");
 b.display("none");
  if (this.paginador.pagina > 1) {
  a.display("inline");
  }
  if (this.paginador.proxima) {
  b.display("inline");
  }
 c.text(this.paginador.pagina);
 };
}