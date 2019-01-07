import os
from pathlib import Path

template_dir = os.path.dirname(__file__)+"/novo";
extensoes = ['','html','php','xml','js','css','svg','c']

def novo_arquivo(e):
 n = input("Nome do arquivo ."+e+": ")
 nome = n+"."+e;
 v = Path(nome).exists()
 if v:
  print("O arquivo \""+nome+"\" já existe na pasta selecionada.\nOperação abortada.")
 else:
  template = open(template_dir+"/novo."+e,"r")
  novoarquivo = open(nome,mode="w")
  novoarquivo.write(template.read())
  novoarquivo.close()
  template.close()
  print("Arquivo \""+nome+"\" criado com sucesso!")
#

def menu_tipo_arquivo():
 print(" ")
 print("CRIAR NOVO ARQUIVO")
 print("")
 print("Selecione a extensão do arquivo: ")
 print("    (0) - Sair do programa\n"+
       "    (1) - .html\n"+
       "    (2) - .php\n"+
	   "    (3) - .xml\n"+
	   "    (4) - .js\n"+
	   "    (5) - .css\n"+
	   "    (6) - .svg\n"+
	   "    (7) - .c")
 i = input()
 j = int(i)
 if (j >= 0) and (j <= 7):
  if (j > 0):
   novo_arquivo(extensoes[j])
  else:
   print("Adeus...")
  #
 else:
  menu_tipo_arquivo()
 #
#

menu_tipo_arquivo()