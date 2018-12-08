function FakeTable() {
 
 this.set_container = function (c) {
 this.container = new Container(byId(c));
 };
 
 this.set_table_element = function (t) {
 this.tagname = t;
 this.table_element = this.container.get(this.tagname);
 var a = document.importNode(this.table_element.elemento,false);
 this.container.elemento.replaceChild(a,this.table_element.elemento);
 };
 
 this.tableElement = function (g) {
 this.tagname = g.elemento.tagName;
 this.table_element = g;
 this.container = g.getParent();
 var a = document.importNode(this.table_element.elemento,false);
 this.container.elemento.replaceChild(a,this.table_element.elemento);
 };
 
 this.set_row_element = function (t) {
 this.row_element = this.table_element.get(t);
 var c = document.importNode(this.row_element.elemento,true);
 this.container.get(this.tagname).append(c);
 };
 
 this.set_template = function (c) {
 var t = new Container(byId(c));
 this.template = t.get(this.row_element.elemento.tagName);
 };
 
 this.set = function (m,n) {
 this.template.setContent(m,n);
 };
 
 this.get = function (m) {
 return this.template.get(m);
 };
 
 this.add_row = function () {
 var d = document.importNode(this.template.elemento,true);
 this.container.get(this.tagname).append(d);
 this.insertedrow = new Container(d);
 };
 
 this.show = function () { 
 this.container.elemento.style.display = "block";
 };
 
}

function get_fake_table(str) {
var t = new FakeTable();
var s = str.split(",");
 if (s.length == 4) {
 t.set_container(s[0]);
 t.set_table_element(s[1]);
 t.set_row_element(s[2]);
 t.set_template(s[3]);
 }
return t;
}