function filtrar_arquivos(c) {
d = document.getElementById("diretorio");
x = d.getElementsByTagName("arquivos")[0];
f = d.getAttribute("fonte");
 if (f.indexOf("?") == -1) {
 url = f+"?arquivo="+c.value;
 }
 else {
 url = f+"&arquivo="+c.value;
 }
x.setAttribute("fonte",url);
getResponse(x);
}

function filtrar_pastas(c) {
d = document.getElementById("diretorio");
x = d.getElementsByTagName("pastas")[0];
f = d.getAttribute("fonte");
 if (f.indexOf("?") == -1) {
 url = f+"?pasta="+c.value;
 }
 else {
 url = f+"&pasta="+c.value;
 }
x.setAttribute("fonte",url);
getResponse(x);
}

function ir_para_pasta(s) {
x = s.lastIndexOf("/");
y = s.length;
z = s.substr(x+1,y);
str = s;
 if (z == ".") {
 str = s.substr(0,x);
 }
 if (z == "..") {
 str = s.substr(0,x);
 str = str.substr(0,str.lastIndexOf("/"));
 }
n = document.getElementById("diretorio");
url = "dir.php?diretorio="+str;
n.setAttribute("fonte",url);
getResponse(n);
}

function selecionar_arquivo(s) {
i = document.getElementById("arquivo");
i.value = s;
}

function abrir_arquivo() {
i = document.getElementById("arquivo");
e = document.getElementById("editor");
 if (i.value.length > 0) {
 r = new Resposta();
 r.response = function (req) {
 e.innerHTML = req.responseText;
 editar();
 };
 pr = new PostRequest();
 pr.setURL("editor.php");
 pr.setSend("arquivo="+i.value);
 pr.execute(r,false);
 }
}

function editar() {
e = document.getElementById("editor");
ta = e.getElementsByTagName("textarea")[0];
ta.focus();
auscultarEvento(ta,"keypress",function () {
bs = document.getElementById("btn_salvar");
bs.disabled = false;
});
}

function salvar() {
i = document.getElementById("arquivo");
e = document.getElementById("editor");
c = e.getElementsByTagName("textarea")[0];
r = new Resposta();
 r.response = function (req) {
 e.innerHTML = req.responseText;
 abrir_arquivo();
 };
pr = new PostRequest();
pr.setURL("editor.php");
pr.setSend("arquivo="+i.value+"&conteudo="+c.value);
pr.execute(r,false);
}

