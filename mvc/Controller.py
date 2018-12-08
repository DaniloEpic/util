import os

class Controller:
 
 def __init__(self,m):
  self.model = m
  self.name = m.name.lower()
 #
 
 def toS(self):
  x = os.path.dirname(__file__)
  y = x.replace("\\","/")+"/src"
  a = open(y+"/__controller__","r")
  b = a.read();
  b = b.replace("@model",self.model.name)
  b = b.replace("@name",self.name)
  a.close()
  return b
 #
 
 def create(self):
  a = self.model.project+"/app/controllers/"+self.model.name+"Controller.php"
  o = open(a,encoding="utf_8",mode="w")
  o.write(self.toS())
  o.close()
 #
 
#