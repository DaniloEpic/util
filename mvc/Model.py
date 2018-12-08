import os

class Model:
 
 def __init__(self,name):
  self.name = name
 #
 
 def set_attributes(self,a,b=None):
  if b is None:
   self.attributes = a.split(",")
  else:
   self.attributes = a.split(b)
 #
 
 def get_attrs(self):
  s = ""
  for a in self.attributes:
   s += "private $"+a+";\n"
  return s
 #
 
 def accessor_methods(self):
  "Gera os gets e sets do modelo."
  s = ""
  for a in self.attributes:
   s += " \n"
   s += " public function set"+a.capitalize()+"($"+a+") {\n"
   s += " $this->"+a+" = $"+a+";\n"
   s += " }\n"
   s += " \n"
   s += " public function get"+a.capitalize()+"() {\n"
   s += " return $this->"+a+";\n"
   s += " }\n"
  return s
 #
 
 def toS(self):
  "gera o código do modelo"
  x = os.path.dirname(__file__)
  y = x.replace("\\","/")+"/src"
  a = open(y+"/__model__","r")
  b = a.read()
  b = b.replace("@name",self.name)
  b = b.replace("@attributes",self.get_attrs())
  b = b.replace("@accessor_methods",self.accessor_methods())
  c = ",".join(self.attributes)
  b = b.replace("@attrs","\""+c+"\"")
  a.close()
  return b
 #
 
 def create(self):
  "cria o modelo solicitado"
  os.mkdir(self.project+"/"+self.name.lower())
  a = self.project+"/app/models/"+self.name+".php"
  b = open(a,encoding="utf_8",mode="w")
  b.write(self.toS())
  b.close()
 #
 
#