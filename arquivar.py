import os.path
import datetime
import shutil

print("Qual a pasta deseja arquivar?")
p = input()
if os.path.isdir(p) :
 dt = datetime.date.today()
 str = p+"_"+dt.isoformat();
 shutil.move(p,str+"\\"+p)
 shutil.make_archive(str,"zip",str)
 shutil.move(str+"\\"+p,p)
 shutil.rmtree(str);
else :
 print("Pasta \""+p+"\" não localizada!")