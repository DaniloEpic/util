from mvc.MVCProject import *

print("Qual o nome do Projeto?");
p = input();
pro = MVCProject(p)
pro.diretorios()
pro.lib()
menu_mvc(pro)