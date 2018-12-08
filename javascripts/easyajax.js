// Requisições assíncronas utilizando o método GET
function getResponse(elemento) {
var request = new XMLHttpRequest();
fonte = elemento.getAttribute("fonte");
request.open("GET",fonte,true);
request.onreadystatechange = function () {
 if (request.readyState == 1) {
 elemento.innerHTML = "Carregando...";
 }
 if (request.readyState == 4) {
  if (request.status == 200) {
  elemento.innerHTML = request.responseText;
  }
 }
};
request.send(null);
}

// requisição síncrona com o método get
function getContent(elemento) {
request = new XMLHttpRequest();
fonte = elemento.getAttribute("fonte");
request.open("GET",fonte,false);
request.onreadystatechange = function () {
 if (request.readyState == 1) {
 elemento.innerHTML = "Carregando...";
 }
 if (request.readyState == 4) {
  if (request.status == 200) {
  elemento.innerHTML = request.responseText;
  }
 }
};
request.send(null);
}

function GetRequest() {
this.url;
 this.setURL = function (url) {
 this.url = url;
 };
 // (assinc=true): requisição assíncrona
 // (assinc=false): requisição síncrona
 this.execute = function (resposta,assinc) {
 var req = new XMLHttpRequest();
 req.open("GET",this.url,assinc);
 req.onreadystatechange = function () {
  if (req.readyState == 4) {
  resposta.response(req);
  }
 };
 req.send(null);
 };
}

function PostRequest() {
this.url;
this.send;
 this.setURL = function (url) {
 this.url = url;
 };
 this.setSend = function (send) {
 this.send = send;
 };
 this.execute = function (resposta,assinc) {
 var req = new XMLHttpRequest();
 req.open("POST",this.url,assinc);
 req.onreadystatechange = function () {
  if (req.readyState == 4) {
  resposta.response(req);
  }
 };
 req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 req.send(this.send);
 };
}

function FormRequest(f) {
this.formulario = new FormData(f);
 this.setURL = function (u) {
 this.url = u;
 };
 this.execute = function (resposta) {
 var req = new XMLHttpRequest();
 req.open("post",this.url,true);
 req.onreadystatechange = function () { 
  if (req.readyState == 4) {
  resposta.response(req);
  }
 };
 req.send(this.formulario);
 };
}

function PutRequest() {
this.url;
this.send;
 this.setURL = function (url) {
 this.url = url;
 };
 this.setSend = function (send) {
 this.send = send;
 };
 this.execute = function (resposta,assinc) {
 var req = new XMLHttpRequest();
 req.open("PUT",this.url,assinc);
 req.onreadystatechange = function () {
  if (req.readyState == 4) {
  resposta.response(req);
  }
 };
 req.send(this.send);
 };
}

function DeleteRequest() {
this.url;
this.send;
 this.setURL = function (url) {
 this.url = url;
 };
 this.setSend = function (send) {
 this.send = send;
 };
 this.execute = function (resposta,assinc) {
 var req = new XMLHttpRequest();
 req.open("DELETE",this.url,assinc);
 req.onreadystatechange = function () {
  if (req.readyState == 4) {
  resposta.response(req);
  }
 };
 req.send(this.send);
 };
}

function AjaxRequest() {
this.req = new XMLHttpRequest();
 this.setURL = function (x) {
 this.url = x;
 };
 this.init = function () { 
 this.req.open(this.method,this.url,true);
 };
 this.get = function () {
 this.method = "GET";
 this.init();
 this.send = null;
 };
 this.post = function () {
 this.method = "POST";
 this.init();
 this.req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 };
 this.put = function () {
 this.method = "PUT";
 this.init();
 };
 this.delete = function () {
 this.method = "DELETE";
 this.init();
 };
 this.setSend = function (send) {
 this.send = send;
 };
 this.execute = function (g) {
  this.req.onreadystatechange = function () {
   if (this.readyState == 4) {
   g.response(this);
   }
  };
 this.req.send(this.send);
  if (doc) {
  doc.addConnection(this.toS());
  }
 };
 this.toS = function () {
 var s = "["+this.method+"] "+this.url;
 return s;
 };
}

function Resposta() {
this.response;
 this.setResponse = function (j) {
 this.response = j;
 };
 this.text = function () {
 return this.response.responseText.trim();
 }; 
 this.isOk = function () {
 return (this.response.status == 200);
 };
}

/*
function stripslashn(str) {
i = str.lastIndexOf("\n") + 1;
f = str.length - i;
return str.substr(i,f);
}
*/

function SourceContainer(elemento) {
this.container = elemento;
 this.response = function (x) {
 this.container.innerHTML = x.responseText;
 this.draw();
 };
 this.getContainer = function () {
 var o = new Container(this.container); 
 return o;
 };
};

function Loader(e) {
this.solicitacao = new GetRequest();
this.resposta = new SourceContainer(e);
 this.load = function () {
 this.solicitacao.setURL(e.getAttribute("fonte"));
 this.solicitacao.execute(this.resposta,true);
 };
};