function Colecao() {
this.itens;
this.item_selecionado;
this.selecionar;
this.removerSelecao;

 this.setItens = function (itens) {
 this.itens = itens;
 };
 
 this.getTamanho = function () {
 return this.itens.length;
 };
 
 this.selecionarProximo = function () {
  if (this.getTamanho() > 0) {
   if (this.item_selecionado == null) {
   this.item_selecionado = new ItemSelecionado();
   this.item_selecionado.setElemento(this.itens[0]);
   this.item_selecionado.setIndice(0);
   }
   else {
   ni = this.item_selecionado.indice + 1;
    if (ni < this.getTamanho()) {
	this.removerSelecao();
	this.item_selecionado.setElemento(this.itens[ni]);
	this.item_selecionado.setIndice(ni);
	}
   }
  this.selecionar();
  }
 };
 
 this.selecionarAnterior = function () {
  if (this.getTamanho() > 0) {
   if (this.item_selecionado == null) {
   this.item_selecionado = new ItemSelecionado();
   this.item_selecionado.setElemento(this.itens[this.getTamanho() - 1]);
   this.item_selecionado.setIndice(this.getTamanho() - 1);
   }
   else {
   ni = this.item_selecionado.indice - 1;
    if (ni >= 0) {
	this.removerSelecao();
	this.item_selecionado.setElemento(this.itens[ni]);
	this.item_selecionado.setIndice(ni);
	}
   }
  this.selecionar();
  }
 };
 
};

function ItemSelecionado() {
this.indice;
this.elemento;
 
 this.setIndice = function (e) {
 this.indice = e;
 };
 
 this.setElemento = function (k) {
 this.elemento = k;
 };
}