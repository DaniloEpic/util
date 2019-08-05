function verificar(f) {
camposFaltando = new Array();
 for (i = 0; i < f.length; i++) {
  if (f.elements[i].getAttribute("required") == "true") {
  str = f.elements[i].value;
   if (str == "" || str.split(" ")[0].length == 0) {
   camposFaltando.push(f.elements[i]);
   }
  }
 }
 if (camposFaltando.length == 0) {
 return true;
 }
 else {
  for (j = 0; j < camposFaltando.length; j++) {
  camposFaltando[j].style.backgroundColor = "deeppink";
  }
  alert("Campos de preenchimento obrigatório!");
  for (j = 0; j < camposFaltando.length; j++) {
  camposFaltando[j].style.backgroundColor = "";
  }
 return false;
 }
}

function frm_validate(f) {
c = new Array();
 for (i = 0; i < f.elements.length; i = i + 1) {
  if (f.elements[i].getAttribute("required") == "1") {
  str = f.elements[i].value;
   if (str.length == 0 || str.split(" ")[0].length == 0) {
   c.push(f.elements[i]);
   }
  }
 }
 if (c.length == 0) {
 f.submit();
 }
 else {
  for (j = 0; j < c.length; j = j + 1) {
  c[j].style.backgroundColor = "tomato";
  }
  alert("Campos de preenchimento obrigatório!");
  for (j = 0; j < c.length; j = j + 1) {
  c[j].style.backgroundColor = "";
  }
  c[0].focus();
 }
}

function check_frm(f) {
c = new Array();
 for (i = 0; i < f.elements.length; i = i + 1) {
  if (f.elements[i].getAttribute("required") == "1") {
  str = f.elements[i].value;
   if (str.length == 0 || str.split(" ")[0].length == 0) {
   c.push(f.elements[i]);
   }
  }
 }
 if (c.length > 0) {
  for (j = 0; j < c.length; j = j + 1) {
  c[j].style.backgroundColor = "tomato";
  }
 alert("Campos de preenchimento obrigatório!");
  for (j = 0; j < c.length; j = j + 1) {
  c[j].style.backgroundColor = "";
  }
 c[0].focus();
 }
return (c.length == 0);
}

function campos_requeridos(f) {
s = "";
 for (i = 0; i < f.elements.length; i = i + 1) {
  if (f.elements[i].getAttribute("required") == "1") {
   if (s.length > 0) {
   s += ",";
   }
  s += f.elements[i].getAttribute("name");
  }
 }
return s;
}

function remover_espaco(str) {
k = str.indexOf(" ");
if (k != -1) {
p1 = str.split(" ")[0];
t = str.length;
p2 = str.substr(k+1,t-k);
str = p1+p2;
}
return str;
}

function remover_espacos(str) {
k = str.indexOf(" ");
if (k != -1) {
p1 = str.split(" ")[0];
t = str.length;
p2 = str.substr(k+1,t-k);
str = remover_espacos(p1+p2);
}
return str;
}

function get_not_null(frm) {
s = "";
 for (i = 0; i < frm.elements.length; i++) {
 cam = frm.elements[i];
 noc = cam.getAttribute("name");
  if (noc) {
   if (cam.value.length > 0) {
    if (s.length > 0) {
	s += "&";
	}
   s += noc+"="+encodeURIComponent(cam.value);
   }
  }
 }
return s;
}

function frm_to_json(g) {
s = "";
 for (i = 0; i < g.elements.length; i++) {
 cm = g.elements[i];
 nc = cm.getAttribute("name");
  if (nc) {
   if (cm.value.length > 0) {
    if (s.length > 0) {
    s += ",";
    }
   s += "\""+nc+"\" : \""+cm.value+"\"";
   }
  }
 }
s = "{"+s+"}";
return s;
}

function check_email(e) {
pu = e.indexOf('@');
val = (pu > 0 && (pu + 1 < e.length));
return val;
}

function validar_cpf(x) {
var b = false;
 if (x.length == 11) {
 var i = 0;
 var soma1 = 0;
  do {
  var j = 9 - ((8 - i) % 10);
  soma1 = soma1 + (parseInt(x[i]) * j);
  i = i + 1;
  }
  while (i < x.length - 2);
 var d1 = (soma1 % 11) % 10;
  if (parseInt(x[9]) == d1) {
  var soma2 = 0;
  i = 0;
   do {
   j = 9 - ((9 - i) % 10);
   soma2 = soma2 + (parseInt(x[i]) * j);
   i = i + 1;
   }
   while (i < x.length - 2);
  var d2 = (soma2 + (d1 * 9) % 11) % 10;
   if (parseInt(x[10]) == d2) {
   b = true;
   }
   else {
   //console.log("O segundo dígito verificador deveria ser '"+d2+"'");
   }
  }
  else {
  //console.log("O primeiro dígito verificador deveria ser '"+d1+"'");
  }
 }
return b;
}

function MyForm(x) {
this.formulario = x;
this.isValid;
this.whatIsYourProblem;
 
 this.validate = function () {
 this.isValid = true;
 };
 
 this.send = function () {
  if (this.isValid) {
  this.formulario.submit();
  }
  else {
  this.whatIsYourProblem();
  }
 };
 
 this.fromObject = function (o,attrs) {
 var at = attrs.split(",");
 var i;
  for (i = 0; i < at.length; i++) {
  this.formulario[at[i]].value = o[at[i]];
  }
 };
 
 this.getFormField = function (n) {
 return this.formulario[n];
 };
 
}

function Elfo(q) {
this.elemento = q;
this.nome = q.name;
 this.definirValor = function (v) {
 this.elemento.value = v;
 };
 this.obterValor = function () {
 return this.elemento.value;
 };
 this.queryString = function () { 
 var v = this.obterValor();
 var s = "";
  if (v.length > 0) {
  s += this.nome+"="+v;
  }
 return s;
 };
}

function FakeForm() {
this.elementos = new SequentialLinkedList();
 this.addElement = function (m) {
 var n = new Elfo(m);
 this.elementos.set(n,"nome");
 };
 this.getElement = function (m) {
 var e = this.elementos.get("nome",m).elemento;
 return e;
 };
 this.valueFor = function (m,n) {
 var e = this.getElement(m);
 e.definirValor(n);
 };
 this.data = function () {
 var i;
 var n = this.elementos.primeiro;
 var s = "";
  for (i = 0; i < this.elementos.tamanho; i++) {
  var q = n.elemento.queryString();
   if (q.length > 0) {
    if (s.length > 0) {
    s += "&";
    }
   s += q;
   }
  n = n.sucessor;
  }
 return s;
 };
}

function onEnter(e) {
var a = e.getAttribute('onEnter');
 if (a) { 
 e.onkeydown = function (x) { 
  if (x.keyCode == 13) {
  eval(a);
  }
 };
 }
}