from pathlib import Path
import os

class Resource:
 def __init__(self,name):
  self.name = name
 #
 
 def toS(self):
  a = utildir()+"/__resource__"
  b = open(a,"r")
  c = b.read()
  c = c.replace("@res",self.name)
  b.close()
  return c
 #
 
 def create(self):
  n = open(self.name.lower()+".res",encoding="utf_8",mode="w")
  n.write(self.toS())
  n.close()
 #
 
#

def utildir():
 a = Path(os.path.dirname(__file__))
 b = str(a)
 c = b.replace("\\","/")
 return c+"/rest"
#
 
nome = input("Resource Name: ")
k = Resource(nome)
k.create()