function MyString() { 
this.str;
 this.set_str = function (str) {
 this.str = str;
 };
 this.after = function (sigh,aft) {
 a = this.str.substr(0,aft);
 b = this.str.substr(aft,this.str.length - aft);
 g = a+""+sigh+""+b;
 this.str = g;
 return g;
 };
}

function str_reverse(str) {
i = str.length;
s = "";
 while (i > 0) {
 s += str.substr((i-1),1);
 i = i - 1;
 }
return s;
}

function translate(s,p) {
a = p.split(",");
chars = new Array();
sighs = new Array();
 for (i = 0; i < a.length; i++) {
 b = a[i].split(":");
 c = parseInt(b[0]);
 chars.push(c);
 sighs.push(b[1]);
 }
sum = 0;
 for (i = 0; i < chars.length; i++) {
 sum += chars[i];
 }
k = sum;
 while (chars.length > 0) {
 x = s.substr(0,k);
 y = s.substr(k,s.length - k);
 s = x+""+sighs.pop()+""+y;
 k = k - chars.pop();
 }
return s;
}

function starts_with(a,b) {
c = a.substr(0,b.length);
return (c.toLowerCase() == b.toLowerCase());
}

function ltrim(s) {
t = s.length;
 if (t > 0) {
 b = s.indexOf(" ");
  if (b == 0) {
  s = s.substr(1,t-1);
  s = ltrim(s);
  }
 }
return s;
}

function rtrim(s) {
t = s.length;
 if (t > 0) {
 b = s.lastIndexOf(" ");
  if (b == (t-1)) {
  s = s.substr(0,t-1);
  s = rtrim(s);
  }
 }
return s;
}

function trim(s) {
s = ltrim(s);
s = rtrim(s)
return s;
}

function substituir(str,x,y) {
var h = str;
var n = str.indexOf(x);
 if (n >= 0) {
 var g = str.split(x);
 h = g.join(y);
 }
return h;
}

function sliceUrl(m,n) {
var o = "";
var a = m.split("/");
var b;
 for (b = n; b < a.length; b++) {
  if (o.length > 0) {
  o += "/";
  }
 o += a[b];
 }
return o;
}