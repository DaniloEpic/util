import os

class View:
 
 def __init__(self,c):
  self.controller = c
  self.name = self.controller.name.capitalize()+".php"
 #
 
 def toS(self):
  x = os.path.dirname(__file__)
  y = x.replace("\\","/")+"/src"
  a = open(y+"/__view__","r")
  b = a.read()
  b = b.replace("@controller",self.controller.name.capitalize())
  a.close()
  return b
 #
 
 def path(self):
  n = self.controller.model.project+"/app/views/"+self.name;
  return n
 #
 
 def create(self):
  n = self.controller.model.project+"/app/views/"+self.name
  a = open(n,encoding="utf_8",mode="w")
  a.write(self.toS())
  a.close()
 #
 
#