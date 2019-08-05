function Lista() {
this.elementos = new Array();

 this.add = function (e) {
 this.elementos.push(e);
 };
 
 this.remove = function (i) {
  if (i >= 0 && i < this.size()) {
  nova_lista = new Array();
  q = this.size() - 1;
  k = 0;
   while (k < i) {
   nova_lista[k] = this.get(k);
   k = k + 1;
   }
   while (k < q) {
   nova_lista[k] = this.get(k+1);
   k = k + 1;
   }
  this.elementos = nova_lista;
  }
 };
 
 this.get = function (i) {
 return this.elementos[i];
 };
 
 this.size = function () {
 return this.elementos.length;
 }
 
}


//

function Node(elemento) {
this.elemento = elemento;
this.antecessor = null;
this.sucessor = null;
 
 this.setAntecessor = function (antecessor) {
 this.antecessor = antecessor;
 };
 
 this.setSucessor = function (sucessor) {
 this.sucessor = sucessor;
 };
 
}


//

function LinkedList() {
this.tamanho = 0;
this.primeiro = null;
this.ultimo = null;

 this.isEmpty = function () {
 return (this.tamanho == 0);
 };
 
 this.set = function (elemento,i) {
 node = new Node(elemento);
  if (this.isEmpty()) {
  this.primeiro = node;
  this.ultimo = this.primeiro;
  this.tamanho = this.tamanho + 1;
  }
  else {
  q = this.tamanho;
   if ( (i > 0) && (i <= (q+1)) ) {
    if (i == 1) {
	su = this.primeiro;
	su.setAntecessor(node);
	node.setSucessor(su);
	this.primeiro = node;
	this.tamanho += 1;
	}
	if (i == (q+1)) {
	an = this.ultimo;
	an.setSucessor(node);
	node.setAntecessor(an);
	this.ultimo = node;
	this.tamanho += 1;
	}
	if ( (i > 1) && (i < (q+1)) ) {
	an = this.get((i-1));
   	su = an.sucessor;
   	an.setSucessor(node);
   	su.setAntecessor(node);
   	node.setAntecessor(an);
   	node.setSucessor(su);
   	this.tamanho += 1;
	}
   }
  }
 };
 
 this.append = function (elemento) {
 this.set(elemento, (this.tamanho+1));
 }
 
 this.get = function (i) {
 j = 0;
  if ( (i > 0) && (i <= this.tamanho) ) {
   if ( (i - 1) < (this.tamanho - i) ) {
   node = this.primeiro;
    while (j < (i - 1)) {
	node = node.sucessor;
	j = j + 1;
	}
   }
   else {
   node = this.ultimo;
    while (j < (this.tamanho - i)) {
	node = node.antecessor;
	j = j + 1;
	}
   }
  }
 return node;
 };
 
 this.clear = function () {
 this.primeiro = null;
 this.ultimo = null;
 this.tamanho = 0;
 };
 
 this.remove = function (i) {
 q = this.tamanho;
 removed = ( (i > 0) && (i <= q) );
  if (removed) {
   if (i == 1) {
    if (q == 1) {
	this.clear();
	}
	else {
	this.primeiro = this.get(i + 1);
    this.primeiro.setAntecessor(null);
	this.tamanho -= 1;
	}
   }
   if (i == q) {
   this.ultimo = this.get(this.tamanho - 1);
   this.ultimo.setSucessor(null);
   this.tamanho -= 1;
   }
   if ( (i > 1) && (i < q)) {
   this.get(i - 1).setSucessor(this.get(i + 1));
   this.get(i + 1).setAntecessor(this.get(i - 1));
   this.tamanho -= 1;
   }
  }
 return removed;
 };
 
 this.refresh = function (elemento,i) {
  if (this.remove(i)) {
  this.set(elemento,i);
  }
 };
 
}


//

function SequentialLinkedList() {
this.tamanho = 0;
this.primeiro = null;
this.ultimo = null;

 this.get = function (propriedade,valor) {
 var node = null;
  if (this.tamanho > 0) {
  n = this.primeiro;
   for (i = 0; i < this.tamanho; i++) {
   v = n.elemento[propriedade];
    if (valor == v) {
	node = n;
	i = this.tamanho;
	}
	if (n.sucessor != null) {
	n = n.sucessor;
	}
   }
  }
 return node;
 };
 
 this.set = function (objeto,propriedade) {
 node = new Node(objeto);
  if (this.tamanho == 0) {
  this.primeiro = node;
  this.ultimo = this.primeiro;
  this.tamanho += 1;
  }
  else {
  valor = objeto[propriedade];
   if (this.get(propriedade,valor) == null) {
   q = this.tamanho;
    if (e_maior(node.elemento,this.ultimo.elemento,propriedade)) {
	this.ultimo.setSucessor(node);
	node.setAntecessor(this.ultimo);
	this.ultimo = node;
	}
	if (e_menor(node.elemento,this.primeiro.elemento,propriedade)) {
	this.primeiro.setAntecessor(node);
	node.setSucessor(this.primeiro);
	this.primeiro = node;
	}
	else {
	ref = this.primeiro.sucessor;
	 for (i = 0; i < this.tamanho - 1; i++) {
	  if (e_menor(node.elemento,ref.elemento,propriedade)) {
	  a = ref.antecessor;
	  a.setSucessor(node);
	  node.setAntecessor(a);
	  node.setSucessor(ref);
	  ref.setAntecessor(node);
	  i = this.tamanho - 1;
	  }
	  else {
	   if (ref.sucessor != null) {
	   ref = ref.sucessor;
	   }
	  }
	 }
	}
   this.tamanho = q + 1;
   }
   else {
   //
   }
  }
 };
 
 this.remove = function (propriedade,valor) {
 n = this.get(propriedade,valor);
  if (n != null) {
   if (n.antecessor == null) {
    if (n.sucessor == null) {
	this.primeiro = null;
	this.ultimo = null;
	}
	else {
	node = n.sucessor;
	node.setAntecessor(null);
	this.primeiro = node;
	}
   }
   else {
    if (n.sucessor == null) {
    node = n.antecessor;
    node.setAntecessor(null);
	this.ultimo = node;
	}
	else {
	antecessor = n.antecessor;
	sucessor = n.sucessor;
	antecessor.setSucessor(sucessor);
	sucessor.setAntecessor(antecessor);
	}
   }
  this.tamanho -= 1;
  }
 };
 
}

function e_maior(a,b,c) {
return (a[c] > b[c]);
}

function e_menor(a,b,c) {
return (a[c] < b[c]);
}


//

function ListaHelper() {
this.quantidade_por_pagina;
this.tamanho;
 this.loop = function (i) {
 var j = 0;
  do {
   if (i < this.tamanho) {
   this.whoCanDoIt(i);
   i += 1;
   j += 1;
   }
   else {
   j = this.quantidade_por_pagina;
   }
  }
  while (j < this.quantidade_por_pagina);
 };
}