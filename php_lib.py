from pathlib import Path
import os
import shutil

def util_dir():
 a = Path(os.path.dirname(__file__))
 b = str(a)
 c = b.replace("\\","/")
 c += "/lib"
 return c
#


print("Copiando arquivos PHP...")
shutil.copytree(util_dir(),"lib")
print("Arquivos copiados com sucesso")