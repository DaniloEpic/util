function Biscoito(n,v) {
this.name = n;
this.value = v;
 
 this.setDomain = function (d) {
 this.domain = d;
 };
 
 this.setPath = function (p) {
 this.path = p;
 };
 
 this.registrar = function () {
 s = this.name+"="+encodeURIComponent(this.value);
  if (this.domain) {
  s += "; domain="+this.domain;
  }
  if (this.path) {
  s += "; path="+this.path;
  }
 document.cookie = s;
 };
 
 this.remover = function () {
 dt = new Date();
 dt.setTime(dt.getTime() - 180000);
 var str = ""+this.name+"=00000; path="+this.path+"; expires="+dt.toGMTString();
 document.cookie = str;
 };
 
 this.to_s = function () {
 return decodeURIComponent(this.value);
 };
 
 this.query_string = function () {
 return this.name+"="+this.value;
 }
 
}

function e_maior(a,b,c) {
return (a[c] > b[c]);
}

function e_menor(a,b,c) {
return (a[c] < b[c]);
}

function CookieCollection(p) {
this.lista = new SequentialLinkedList();
this.path = p;
 
 this.load = function () {
  if (document.cookie.length > 0) {
  var c = document.cookie.split(";");
   for (i = 0; i < c.length; i++) {
   d = c[i].split("=");
    if (d.length == 2) {
    b = new Biscoito(d[0].trim(),d[1].trim());
    b.setPath(this.path);
    this.lista.set(b,"name");
    }
   }
  }
 };
 
 this.getCookie = function (n) {
 var e = null;
 var o = this.lista.get("name",n);
  if (o) {
  e = o.elemento;
  }
 return e;
 };
 
 this.excluir = function (n) {
 var c = this.getCookie(n);
  if (c) {
  c.setPath(this.path);
  c.remover();
  this.lista.remove("name",n);
  }
 };
 
 this.isEmpty = function () {
 return (this.lista.tamanho == 0);
 };

}