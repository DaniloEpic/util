from mvc.Model import *
from mvc.Controller import *
from mvc.View import *
from pathlib import Path
import os
import shutil

class MVCProject:
 
 def __init__(self,name):
  self.name = name
 #
 
 def diretorios(self):
  "Cria as pastas do projeto"
  src = utildir()+"/app"
  dst = self.name+"/app"
  shutil.copytree(src,dst)
  os.mkdir(self.name+"/app/models")
  os.mkdir(self.name+"/app/views")
  os.mkdir(self.name+"/app/controllers")
  os.mkdir(self.name+"/app/db")
  os.mkdir(self.name+"/public")
  os.mkdir(self.name+"/public/images")
  os.mkdir(self.name+"/public/stylesheets")
 #
 
 def lib(self):
  "Adiciona as bibliotecas do projeto"
  m = utildir()+"/lib"
  n = self.name+"/lib"
  shutil.copytree(m,n)
  o = utildir()+"/javascripts"
  p = self.name+"/public/javascripts"
  shutil.copytree(o,p)
 #
 
#

def novo_modelo(p):
 print("Qual o nome do modelo?")
 n = input()
 m = Model(n)
 m.project = p.name
 o = Path(m.get_file()).exists()
 if o:
  print("O modelo '"+n+"' já existe.\n")
 #
 else:
  print("Quais são os atributos do modelo?")
  s = input()
  m.set_attributes(s)
  m.create()
 #
 return m
#

def novo_controlador(q):
 print("\nCriando o controller...")
 c = Controller(q)
 c.create()
 return c
#

def nova_visao(c):
 print("\nCriando a view...")
 v = View(c)
 v.create()
#

def menu_mvc(p):
 print("\n-----------------------")
 print("Model, View, Controller")
 print("(1) - Novo Modelo")
 print("(2) - Sair")
 o = input()
 if o == "1":
  x = novo_modelo(p)
  if x.created:
   print("\nModelo criado com sucesso!");
   y = novo_controlador(x)
   nova_visao(y)   
  #
  menu_mvc(p)
 elif o == "2":
  print("Adeus...")
 else:
  menu_mvc(p)
#

def utildir():
 a = Path(os.path.dirname(__file__))
 b = str(a.parent)
 c = b.replace("\\","/")
 return c
#