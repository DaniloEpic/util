function auscultarEvento(element,listener,resposta) {
 //
 if (typeof element.addEventListener == "undefined") {
  // IE
  if (typeof element.attachEvent != "undefined") {
  element.attachEvent("on"+listener,resposta);
  }
 }
 // Firefox, Safari, Opera, Chrome
 else {
 element.addEventListener(listener,resposta,false);
 }
}

function Evento(e) {
this.element = document.getElementById(e);
this.listener;
this.resposta;

 this.set_element = function (t) {
 this.element = t;
 };

 this.set_element_by_id = function (t) {
 this.element = document.getElementById(t);
 };
	 
 this.set_listener = function (lis,resposta) {
  if (this.element != null) {
   if (typeof this.element.attachEvent != "undefined") {
   this.element.attachEvent("on"+lis,resposta);
   }
   else {
   this.element.addEventListener(lis,resposta,false);
   }
  }
 };
	 
 this.onclick = function (resposta) {
 this.set_listener("click",resposta);
 };
 
}