function new_element(tagname,attrs) {
var e = document.createElement(tagname);
 if (attrs != null) {
 var attr = attrs.split(",");
 var i;
  for (i = 0; i < attr.length; i++) {
  var n = attr[i].split("=")[0];
  var v = attr[i].split("=")[1];
  e.setAttribute(n,v);
  }
 }
return e;
}

function byId(k) {
var e;
e = document.getElementById(k);
return e;
}

function delById(e) {
var f = document.getElementById(e);
 if (f) {
 f.parentNode.removeChild(f);
 }
}

function hide(t) {
t.style.display = "none";
}

function Documento(h) {
this.document = h;
 this.get = function (s) {
 t = h.getElementsByTagName(s)[0];
  if (t.childNodes[0]) {
  o = t.childNodes[0].nodeValue;
  }
 return o;
 };
}

function get_element(t,i) {
var ne = new_element(t);
ne.innerHTML = ""+i+"";
return ne;
}

function append_element(t,e) {
var ne = new_element(t);
ne.appendChild(e);
return ne;
}

function Chain(str) {
this.lista = new LinkedList();
this.str = str;
 
 this.get = function () {
 tags = this.str.split(",");
  for (i = 0; i < tags.length; i++) {
  el = new_element(tags[i]);
   if (this.lista.ultimo != null) {
   this.lista.ultimo.elemento.appendChild(el);
   }
  this.lista.append(el);
  }
 return this.lista.primeiro.elemento;
 };
 
 this.inner = function (c) {
 this.lista.ultimo.elemento.innerHTML = c;
 };
 
 this.set_attribute = function (i,str) {
 nod = this.lista.get(i);
  if (nod) {
  attr = str.split("=");
  nod.elemento.setAttribute(attr[0],attr[1]);
  }
 };
 
}

function init_container(el) {
 el.setContent = function (a,b) {
 m = el.getElementsByTagName(a);
 m[0].textContent = b;
 };
 el.get = function (a) {
 m = el.getElementsByTagName(a);
 init_container(m[0]);
 return m[0];
 };
 el.fromObject = function (object,property) {
 el.setContent(property,object[property]);
 };
}

function Container(t) {
this.elemento = t;

 this.setContent = function (t,c) {
 var o = this.elemento.getElementsByTagName(t);
 o[0].textContent = c;
 };
 
 this.get = function (tagname) {
 var o = this.elemento.getElementsByTagName(tagname);
 var s = new Container(o[0]);
 return s;
 };
 
 this.append = function (c) {
 this.elemento.appendChild(c);
 };
 
 this.link = function (h) {
 this.elemento.parentNode.setAttribute("href",h);
 };
 
 this.valueOf = function (t) {
 var o = this.elemento.getElementsByTagName(t);
 var s = new Container(o[0]);
 return s.elemento.textContent;
 }
 
 this.hide = function () {
 this.elemento.style.display = "none";	 
 };

 this.display = function (v) {
 this.elemento.style.display = v;
 };
 
 this.switcher = function (f,d) {
 var s = new Switcher(this.elemento);
  if (d) {
  s.displayStyle = d;
  }
 s.when = (f);
 s.if();
 };

 this.getParent = function () {
 var n = new Container(this.elemento.parentNode);
 return n;
 };
 
 this.evento = function (a,b) {
 auscultarEvento(this.elemento,a,b);
 };
 
 this.text = function (k) {
 this.elemento.textContent = k;
 };

}

function Switcher(e) {
this.elemento = e;
this.when;
this.displayStyle = "block";

 this.if = function () {
  if (this.when) {
  this.elemento.style.display = this.displayStyle;
  }
  else {
  this.elemento.style.display = "none";
  }
 };
 
}

function ActionButton(b) {
this.btn = b;
 this.enable = function () {
 this.btn.disabled = false; 
 };
 this.disable = function () {
 this.btn.disabled = true;
 }
}

function SpanButton(s) {
this.elemento = s;
 this.enable = function () {
 this.elemento.style.display = "inline-block"; 
 };
 this.disable = function () {
 this.elemento.style.display = "none";
 }
}

function Frame(d) {
this.component = new Container(byId(d));
this.components = new SequentialLinkedList();
 this.addComponent = function (n,v) {
 var o = { name : n, value : v };
 this.components.set(o,"name");
 };

 this.getComponent = function (t) {
 var o = this.components.get("name",t);
  if (!o) { console.log("Componente "+t+" não localizado!"); }
 return o.elemento.value;
 };

 this.selectComponent = function (t) {
 var e = this.component.get(t);
 this.addComponent(t,e.elemento);
 return e;
 };
 
}

function TagLista(itens,parent) {
this.itens = itens;
this.parent = parent;
 this.add = function () {
 var i;
  for (i = 0; i < this.itens.length; i++) {
  var k = transform(this.itens[i],i);
  this.parent.appendChild(k);
  }
 };
}