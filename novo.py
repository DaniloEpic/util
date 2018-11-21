import os

template_dir = os.path.dirname(__file__)+"/novo";

print ("")
print ("Novo arquivo: ")
print ("    (0) - Sair do programa\n"+
       "    (1) - HTML\n"+
       "    (2) - PHP\n"+
	   "    (3) - XML\n"+
	   "    (4) - XSL\n"+
	   "    (5) - Javascript\n"+
	   "    (6) - CSS\n"+
	   "    (7) - SVG\n"+
	   "    (8) - C")
tipo = input()
arquivo = ""
a = ""
print ("Nome do arquivo:\n")
nomearquivo = input()
if tipo == "1":
 arquivo = open(nomearquivo+".html",encoding="utf_8",mode="w");
 a = open(template_dir+"/index.html","r")
elif tipo == "2":
 arquivo = open(nomearquivo+".php",encoding="utf_8",mode="w")
 print ("Deseja utilizar um modelo?\n")
 print ("(1) - Não\n"+
        "(2) - Sim")
 n = input()
 if n == "1":
  a = open(template_dir+"/newfile.php","r")
 elif n == "2":
  print ("Modelo:\n")
  f = input()
  a = open(f,encoding="utf_8",mode="r")
elif tipo == "3":
 arquivo = open(nomearquivo+".xml",encoding="utf_8",mode="w");
 a = open(template_dir+"/NewFile.xml","r")
elif tipo == "4":
 arquivo = open(nomearquivo+".xsl",mode="w");
 a = open(template_dir+"/NewStylesheet.xsl","r")
elif tipo == "5":
 arquivo = open(nomearquivo+".js",mode="w");
 a = open(template_dir+"/new_file.js","r")
elif tipo == "6":
 arquivo = open(nomearquivo+".css",mode="w");
 a = open(template_dir+"/new_file.css","r")
elif tipo == "7":
 arquivo = open(nomearquivo+".svg",mode="w");
 a = open(template_dir+"/new_file.svg","r")
elif tipo == "8":
 arquivo = open(nomearquivo+".c",mode="w")
 a = open(template_dir+"/novo.c","r")

arquivo.write(a.read())
a.close()
arquivo.close()