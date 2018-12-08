from mvc.MVCProject import *

print("Qual o nome do Projeto?");
p = input();
project = MVCProject(p)
menu_mvc(project)