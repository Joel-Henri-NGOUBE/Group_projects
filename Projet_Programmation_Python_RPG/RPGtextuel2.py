G = []
H = []
#Le code qui fonctionne
from random import randint
import time

M1 = []  
M1.append([" Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "])
M1.append([" Arbre ","   0   ","   0   ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre ","   0   ","   0   ","monster"," Arbre "," Arbre "])
M1.append([" Arbre ","   0   "," Arbre ","   0   ","   0   "," Arbre ","   0   ","   0   ","   0   ","Coffret","   0   ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","Coffret","   0   ","   0   ","   0   "," Arbre ","Coffret","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","   0   "," Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","Coffret","   0   ","   0   ","monster","   0   ","   0   ","   0   "," Arbre ","   0   ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre ","   0   ","   0   ","Coffret","   0   ","monster","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","  BOY  ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","monster","   0   ","   0   ","   0   ","   0   "," Arbre ","   0   ","   0   ","monster","   0   ","   0   "," Arbre ","Coffret"," Arbre "])
M1.append([" Arbre ","   0   "," Arbre "," Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   "," Arbre "," Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","Coffret","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","Coffret","   0   ","   0   ","monster","   0   ","Coffret","   0   "," Arbre ","   0   ","   0   ","   0   ","   0   "," Arbre "])
M1.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","monster","   0   ","   0   ","MONSTER"," Arbre "])
M1.append([" Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "])

M_M = []
M_M = M1

M2 = []  
M2.append([" Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "])
M2.append([" Arbre ","Coffret","   0   ","  mât  ","   0   "," Arbre ","   0   ","   0   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   "])
M2.append([" Arbre ","   0   "," Arbre ","   0   ","   0   ","   0   ","Coffret","   0   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   "])
M2.append([" Arbre ","   0   ","monster","   0   ","   0   ","   0   ","   0   ","   0   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   "])
M2.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   M   ","   ~   ","   N   ","   ~   ","   T   ","   ~   ","   R   "])
M2.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","monster","   ~   ","   O   ","   ~   ","   S   ","   ~   ","   E   ","   ~   "])
M2.append([" Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   "])
M2.append([" Arbre "," Arbre ","Coffret","   0   "," Arbre ","   0   ","   0   ","  Boy  ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   "])
M2.append([" Arbre "," Arbre ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   ","   ~   "])
M2.append([" Arbre ","   0   ","   0   ","   0   ","monster","   0   ","   0   ","   0   ","Coffret"," Arbre ","   0   "," Arbre ","monster","   0   "," Arbre "])
M2.append([" Arbre ","   0   ","   0   ","   0   ","   0   "," Arbre ","   0   ","Pagaies","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre "," Arbre "])
M2.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","Coffret","   0   ","   0   "," Arbre "])
M2.append([" Arbre ","   0   ","   0   ","   0   ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   "," Arbre "])
M2.append([" Arbre ","   0   ","Radeaux","   0   ","   0   ","   0   ","Coffret","   0   ","monster","   0   "," Arbre ","   0   ","   0   ","Coffret"," Arbre "])
M2.append([" Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "])

M3 = []  
M3.append([" Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","monster","   0   ","monster","   0   ","monster","   0   ","monster","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","  Boy  ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre ","Coffret","   0   ","   0   ","monster","   0   ","monster","   0   ","monster","   0   ","monster","   0   ","MONSTER","MONSTER","MONSTER"])
M3.append([" Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre "," Arbre ","MONSTER","MONSTER","MONSTER"])

def affichage(M):
 for i in range (0,15,1):
  k = 0
  for k in range (0,15,1):
    print(M[i][k], end = "   ")
  print("\n")


Inventory = {"Potion(s)" : [0,100], "Expertise(s)" : [0,2], "Bouclier(s)" : [0,2], "Couteau(x)" : [1,20], "Hammer" : [0,35], "Batte(s) en fer" : [0,55], "Hache(s)" : [0,90], "Harpon(s)" : [0,115], "Katana(s)" : [0,225], "Trident(s)" : [0,300], "Bazooka(s)" : [0,400]} #"super berserk gunnom" : [0,650], "ultra bouya bleeder 2.0" : [0,900]}
L = list(Inventory.values())
D = []
D = L
#Inventory_2 = {"Potion(s)" : [0,100], "Expertise(s)" : [0,2], "Bouclier(s)" : [0,2]}
#L = [[1,10],[0,35],[0,55],[0,90],[0,115],[0,225],[0,300],[0,400]]
#Couteau < Hammer < Batte < Hache < Harpons = Lance < Sabre = Katana < Trident.

def legende():
  print("` Arbre `: Désigne l'emplacement d'un arbre, il s'agit d'un obstacle.")
  print("`monster`: Désigne l'emplacement d'un monstre à combattre.")
  print("`Coffret`: Désigne l'emplacement d'un coffret pour avoir de nouvelles armes ou de nouveaux booss.")
  print("`   0   `: Désigne un emplacement libre sur lequel on peut se déplacer.")
  print("`  BOY  `: Désigne votre emplacement.")


def coffret_content(Liste,XP):
  price = randint(1,30)
  if price == 1 or price == 2 or price == 4 or price == 6 or price == 8 or price == 12 or price == 14 or price == 16 or price == 18 or price == 20 or price == 22:
    Liste[3][0] = Liste[3][0] + 5
    Inventory.update({"Couteau(x)" : L[3][0]})
    print("Vous avez obtenu ",5, " couteau(x) supplémentaire(s)")
    XP = XP + 20
    print("Vous avez obtenu ",20, " points d'XP")
  elif price == 3 or price == 7 or price == 9 or price == 13:
    Liste[4][0] = Liste[4][0] + 3
    Inventory.update({"Hammer" : L[4][0]})
    print("Vous avez obtenu ",3, " hammer")
    XP = XP + 35
    print("Vous avez obtenu ",35, " points d'XP")
  elif price == 11 or price == 19 or price == 21 or price == 24:
    Liste[5][0] = Liste[5][0] + 3
    Inventory.update({"Batte(s) en fer" : L[5][0]})
    print("Vous avez obtenu ",3, " batte(s) en fer")
    XP = XP + 50
    print("Vous avez obtenu ",50, " points d'XP")
  elif price == 17 or price == 27 or price == 26:
    Liste[6][0] = Liste[6][0] + 2
    Inventory.update({"Hache(s)" : L[6][0]})
    print("Vous avez obtenu ",2, " hache(s)")
    XP = XP + 80
    print("Vous avez obtenu ",80, " points d'XP")
  elif price == 25 or price == 30 or price == 10:
    Liste[7][0] = Liste[7][0] + 2
    Inventory.update({"Harpon(s)" : L[7][0]})
    print("Vous avez obtenu ",2, " harpon(s)")
    XP = XP + 100
    print("Vous avez obtenu ",100, " points d'XP")
  elif price == 5 or price == 29:
    Liste[8][0] = Liste[8][0] + 1
    Inventory.update({"Katana(s)" : L[8][0]})
    print("Vous avez obtenu ",1, " katana(s)")
    XP = XP + 150
    print("Vous avez obtenu ",150, " points d'XP")
  elif price == 15 or price == 28:
    Liste[9][0] = Liste[9][0] + 1
    Inventory.update({"Trident(s)" : L[9][0]})
    print("Vous avez obtenu ",1, "trident")
    XP = XP + 170
    print("Vous avez obtenu ",170, " points d'XP")
  elif price == 23:
    Liste[10][0] = Liste[10][0] + 1
    Inventory.update({"Bazooka(s)" : L[10][0]})
    print("Vous avez obtenu ",1, "bazooka")
    XP = XP + 200
    print("Vous avez obtenu ",200, " points d'XP")
  price_2 = randint(0,20)
  if price >= 0 and price <= 10:
    price_2 = price_2
  elif price == 11 or price == 12 or price == 13 or price == 14:
    Liste[0][0] = Liste[0][0] + 1
    Inventory.update({"Potion(s)" : L[0][0]})
    print("Vous avez obtenu ",1, "Potion(s)")
    XP = XP + 50
    print("Vous avez obtenu ",50, " points d'XP")
  elif price == 15 or price == 16 or price == 17:
    Liste[1][0] = Liste[1][0] + 1
    Inventory.update({"Expertise(s)" : L[1][0]})
    print("Vous pouvez désormais doubler vos points d'impacts pour une attaque")
    XP = XP + 50
    print("Vous avez obtenu ",50, " points d'XP")
  elif price == 18 or price == 19 or price == 20:
    Liste[2][0] = Liste[2][0] + 1
    Inventory.update({"Potion(s)" : L[2][0]})
    print("Vous avez obtenu ",1, "Potion(s)")
    XP = XP + 50
    print("Vous avez obtenu ",50, " points d'XP")
  #L = list(Inventory.values())
  return(Liste)

E = list(Inventory.keys())

def inventaire(G,H):
  print("Vous possédez comme boosts:")
  print(G[0][0],H[0],"procurant",G[0][1],"points de vie supplémentaires")
  print(G[1][0],H[1],"multipliant par",G[1][1],"vos points d'attaque")
  print(G[2][0],H[2],"divisant par",G[2][1],"les points d'attaque de l'ennemi")
  
  print("Vous possédez dans l'artillerie de vos armes:")
  for i in range (3,len(G),1):
    print(G[i][0],H[i],"infligeant",G[i][1],"points de dégâts")


n = 1
A = []
XP = 0
HP = [250,500,2000]
G = []
H = []
def choice_weapon(G,H,g,r,M):
    print("Choisissez une arme ou un boost de l'inventaire")
    for i in range (0,len(G),1):
     print(i + 1,"-",E[i])
    print(len(G) + 1,"- Quitter")
    r = int(input())
    while r <= 0 or r > len(G) + 1:
     r = int(input())
    if r == len(G) + 1:
      fight(G,H,g,r,M)
    elif G[r-1][0] == 0 and r != len(G) + 1:
      print("Vous ne pouvez pas utiliser ni une arme ni un boost que vous n'avez pas en votre possession. Faites un autre choix.")
      choice_weapon(G,H,g,r,M)
    else:
      t = player_attack(g,r,G,H,M)
      #player_attack(n,r,G)


HP_MONSTER = [200,1000,5000]
HP_MONSTER_2 = [200,1000,5000]
AT_MONSTER = [50,100,200]
HP_monster = [100,200,500]
HP_monster_2 = [100,200,500]
AT_monster = [20,40,80]

'''
def monster_attack(g,r,G,b):
  p = randint(0,10)
  if p == 0:
    print("Il t'a manqué")
  if p != 0:
    HP = HP - AT_monster[g-1]
    print("Vous avez subi",AT_monster[g-1],"points de dégâts.","Il vous reste",HP,"points de vie")
    choice_weapon(G,H,g,r)
'''
def monster_attack(g,r,G,M):
  p = randint(0,10)
  if p == 0:
    print("Il t'a manqué")
  if p != 0:
    HP[g-1] = HP[g-1] - AT_monster[g-1]
    time.sleep(1)
    if HP[g-1] <= 0:
      print("Dommage,un bébé monstre t'a vaincu. Tu as perdu.")
      M = M_M
      move(M,G,H,g)
    else:
     print("Vous avez subi",AT_monster[g-1],"points de dégâts.","Il vous reste",HP[g-1],"points de vie")
  fight(G,H,g,r,M)



def player_attack(g,r,G,H,M):
  #HP_monster = HP_monster
  p = randint(0,10)
  if p == 0 and HP_monster[g-1] > 0:
    print("Tu l'as loupé")
  elif p != 0 and HP_monster[g-1] > 0:
    HP_monster[g-1] = HP_monster[g-1] - G[r-1][1]
    D[r-1][0] = D[r-1][0] - 1
    #D[r-1][1] = D[r-1][1] - 1
    if HP_monster[g-1] <= 0:
     print("Vous avez infligé",D[r-1][1],"points de dégâts.","Il ne lui reste plus de points de vie")
    else:
     print("Vous avez infligé",D[r-1][1],"points de dégâts.","Il lui reste",HP_monster[g-1],"points de vie")
  if HP_monster[g-1] <= 0:
      s = randint(1,4)
      if s == 1:
        print("Tu as gagné le combat")
      if s == 2:
        print("Bravo, tu l'as battu")
      if s == 3:
        print("Super, tu l'as vaincu")
      if s == 4:
        print("Waouh, tu es si fort")
      HP_monster[g-1] = HP_monster_2[g-1]
      f = 0
      return f
  monster_attack(g,r,G,M)


#print("Oh non! Un monstre vous attaque. Vous devez riposter\nQu'allez vous faire?")
XP = 0
def fight(G,H,p,q,M): #ajouter une option fight avec monster
  print("1- Utiliser une arme\n2- Utiliser vos poings\n3- Fuir")
  m = int(input())
  while m < 0 or m > 4:
   m = int(input())
  if m == 1:
    choice_weapon(G,H,p,q,M) 
  if m == 2:
   e = randint(0,10)
   if e == 0 and HP_monster[p-1] > 0:
    print("Tu l'as loupé")
   elif e != 0 and HP_monster[p-1] > 0:
    HP_monster[p-1] = HP_monster[p-1] - 15
    if HP_monster[p-1] <= 0:
     print("Vous avez infligé 15 points de dégâts.","Il ne lui reste plus de points de vie")
    else:
     print("Vous avez infligé 15 points de dégâts.","Il lui reste",HP_monster[p-1],"points de vie")
   if HP_monster[p-1] <= 0:
      s = randint(1,4)
      if s == 1:
        print("Tu as gagné le combat")
      if s == 2:
        print("Bravo, tu l'as battu")
      if s == 3:
        print("Super, tu l'as vaincu")
      if s == 4:
        print("Waouh, tu es si fort")
      HP_monster[p-1] = HP_monster_2[p-1]
      f = 0
      return f
   monster_attack(p,q,G,M)
  if m == 3:
    f = 1
    return f

def choice_weapon_MONSTER(G,H,g,r,M):
    print("Choisissez une arme ou un boost de l'inventaire")
    for i in range (0,len(G),1):
     print(i + 1,"-",E[i])
    print(len(G) + 1,"- Quitter")
    r = int(input())
    while r <= 0 or r > len(G) + 1:
     r = int(input())
    if r == len(G) + 1:
      fight(G,H,g,r,M)
    elif G[r-1][0] == 0 and r != len(G) + 1:
      print("Vous ne pouvez pas utiliser ni une arme ni un boost que vous n'avez pas en votre possession. Faites un autre choix.")
      choice_weapon_MONSTER(G,H,g,r,M)
    else:
      t = player_attack_MONSTER(g,r,G,H,M)
      #if t == 0:
        #return t

def MONSTER_attack(g,r,G,M):
  p = randint(0,15)
  if p == 0:
    print("Il t'a manqué")
  if p != 0:
    HP[g-1] = HP[g-1] - AT_MONSTER[g-1]
    time.sleep(1)
    if HP[g-1] <= 0:
      print("Le BOSS t'a ratatiné. Tu as perdu")
      M = M_M
      #menu_principal() #move(M,G,H,g)
    else:
     print("Vous avez subi",AT_MONSTER[g-1],"points de dégâts.","Il te reste",HP[g-1],"points de vie")
  fight_MONSTER(G,H,g,r,M)

def player_attack_MONSTER(g,r,G,H,M):
  #HP_monster = HP_monster
  p = randint(0,12)
  if p == 0 and HP_MONSTER[g-1] > 0:
    print("Tu l'as loupé")
  elif p != 0 and HP_MONSTER[g-1] > 0:
    HP_MONSTER[g-1] = HP_MONSTER[g-1] - G[r-1][1]
    D[r-1][0] = D[r-1][0] - 1
    #D[r-1][1] = D[r-1][1] - 1
    if HP_MONSTER[g-1] <= 0:
     print("Vous avez infligé",D[r-1][1],"points de dégâts.","Il ne lui reste plus de points de vie")
    else:
     print("Vous avez infligé",D[r-1][1],"points de dégâts.","Il lui reste",HP_MONSTER[g-1],"points de vie")
  if HP_MONSTER[g-1] <= 0:
    print("Incroyable!!! Tu es venu à bout du BOSS")
    #k = 0
    #return k
  MONSTER_attack(g,r,G,M)

def fight_MONSTER(G,H,p,q,M): #ajouter une option fight avec monster
  print("1- Utiliser une arme\n2- Utiliser vos poings\n3- Fuir")
  m = int(input())
  while m < 1 or m > 3:
   m = int(input())
  if m == 1:
    c = choice_weapon_MONSTER(G,H,p,q,M)
    if c == 0:
     return c
  if m == 2:
   e = randint(0,12)
   if e == 0 and HP_MONSTER[p-1] > 0:
    print("Tu l'as loupé")
   elif e != 0 and HP_MONSTER[p-1] > 0:
    HP_MONSTER[p-1] = HP_MONSTER[p-1] - 15
    if HP_MONSTER[p-1] <= 0:
     print("Vous avez infligé 15 points de dégâts.","Il ne lui reste plus de points de vie")
    else:
     print("Vous avez infligé 15 points de dégâts.","Il lui reste",HP_MONSTER[p-1],"points de vie")
   if HP_MONSTER[p-1] <= 0:
    print("Incroyable!!! Tu es venu à bout du BOSS")
    return 0
   MONSTER_attack(p,q,G,M)
  if m == 3:
    print("Désolé,le boss est trop fort et stratège pour que tu puisses lui échapper")
    fight_MONSTER(G,H,p,q,M)

def options(M,G,H,g):
  print(" 1- Map \n 2- Inventaire \n 3- Légende \n 4- Quitter")
  a = str(input())
  if a == "1": 
    affichage(M)
    move(M,G,H,g)
  elif a == "2":
    inventaire(G,H)
    move(M,G,H,g)
  elif a == "3":
    legende()
    move(M,G,H,g)
  elif a == "4":
    print("Es-tu sûr de vouloir quitter ta partie ? \n A- oui \n B- non")
    b = str(input())
    if b == "A":
      #menu_principal()
      pass
    if b == "B":
      return

fuir = 0
r = 0
def move(M,G,H,g):
  for i in range (0,15,1):
   for k in range (0,15,1):
     if "  BOY  " in M[i][k]:
       i1 = i
       k1 = k
  print("z --- haut\nq --- gauche\nd --- droite\ns --- bas\n1 --- option")
  direction = input()
  while direction != "z" and direction != "q" and direction != "d" and direction != "s" and direction != "1":
   print("Erreur de saisie")
   direction = input()

  if direction == "z" and M[i1-1][k1] != " Arbre " and M[i1-1][k1] != "Coffret" and M[i1-1][k1] != "monster" and M[i1-1][k1] != "MONSTER":
    M[i1-1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1-1][k1] == "Coffret" and direction == "z":
    M[i1-1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
    A = coffret_content(L,XP)
  elif M[i1-1][k1] == "monster" and direction == "z":
    print("Oh non! Un monstre vous attaque. Vous devez riposter\nQu'allez vous faire?")
    fuir = fight(G,H,g,r,M)
    if fuir == 1:
      fuir == 0
      move(M,G,H,g)
    else:
      M[i1-1][k1] = "  BOY  "
      M[i1][k1] = "   0   "
      move(M,G,H,g)
  elif M[i1-1][k1] == "MONSTER" and direction == "z":
    print("MINCE!!!! Le BOSS veut ta peau!!!")
    k = fight_MONSTER(G,H,g,r,M)
    #menu_principal()
    #if k == 0:
      #return
  elif M[i1-1][k1] == " Arbre " and direction != "q" and direction != "d" and direction != "s" and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "q" and M[i1][k1-1] != " Arbre " and M[i1][k1-1] != "Coffret" and M[i1][k1-1] != "monster" and M[i1][k1-1] != "MONSTER":
    M[i1][k1-1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1][k1-1] == "Coffret" and direction == "q":
    M[i1][k1-1] = "  BOY  "
    M[i1][k1] = "   0   "
    A = coffret_content(L,XP)
  elif M[i1][k1-1] == "monster" and direction == "q":
    #fuir = 0
    print("Oh non! Un monstre vous attaque. Vous devez riposter\nQu'allez vous faire?")
    fuir = fight(G,H,g,r,M)
    if fuir == 1:
      fuir == 0
      move(M,G,H,g)
    else:
      M[i1][k1-1] = "  BOY  "
      M[i1][k1] = "   0   "
      move(M,G,H,g)
  elif M[i1][k1-1] == "MONSTER" and direction == "q":
    print("MINCE!!!! Le BOSS veut ta peau!!!")
    k = fight_MONSTER(G,H,g,r,M)
    #menu_principal()
    #if k == 0:
      #return
  elif M[i1][k1-1] == " Arbre " and direction != "d" and direction != "s" and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "d" and M[i1][k1+1] != " Arbre " and M[i1][k1+1] != "Coffret" and M[i1][k1+1] != "monster" and M[i1][k1+1] != "MONSTER":
    M[i1][k1+1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1][k1+1] == "Coffret" and direction == "d":
    M[i1][k1+1] = "  BOY  "
    M[i1][k1] = "   0   "
    A = coffret_content(L,XP)
  elif M[i1][k1+1] == "monster" and direction == "d":
    #fuir = 0
    print("Oh non! Un monstre vous attaque. Vous devez riposter\nQu'allez vous faire?")
    fuir = fight(G,H,g,r,M)
    if fuir == 1:
      fuir == 0
      move(M,G,H,g)
    else:
      M[i1][k1+1] = "  BOY  "
      M[i1][k1] = "   0   "
      move(M,G,H,g) 
  elif M[i1][k1+1] == "MONSTER" and direction == "d":
    print("MINCE!!!! Le BOSS veut ta peau!!!")
    k = fight_MONSTER(G,H,g,r,M)
    #menu_principal()
    #if k == 0:
      #return
  elif M[i1][k1+1] == " Arbre " and direction != "s" and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "s" and M[i1+1][k1] != " Arbre " and M[i1+1][k1] != "Coffret" and M[i1+1][k1] != "monster" and M[i1+1][k1] != "MONSTER":
    M[i1+1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1+1][k1] == "Coffret" and direction == "s":
    M[i1+1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
    A = coffret_content(L,XP)
  elif M[i1+1][k1] == "monster" and direction == "s":
    #fuir = 0
    print("Oh non! Un monstre vous attaque. Vous devez riposter\nQu'allez vous faire?")
    fuir = fight(G,H,g,r,M)
    if fuir == 1:
      fuir == 0
      move(M,G,H,g)
    else:
      M[i1+1][k1] = "  BOY  "
      M[i1][k1] = "   0   "
      move(M,G,H,g) 
  elif M[i1+1][k1] == "MONSTER" and direction == "s":
    print("MINCE!!!! Le BOSS veut ta peau!!!")
    k = fight_MONSTER(G,H,g,r,M)
    #if k == 0:
      #return
  elif M[i1+1][k1] == " Arbre " and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "1":
    options(M,G,H,g)
    '''
    def options():
  print(" 1- Map \n 2- Inventaire \n 3- monstres \n 4- Quitter")
  a = str(input())
  if a == "1": 
    affichage()
    move()
  elif a == "2":
    inventaire(D,E)
    move()
  elif a == "3":
    print(monstres_greenland)
    move()
  elif a == "4":
    print("Es-tu sûr de vouloir quitter ta partie ? \n A- oui \n B- non")
    b = str(input())
    if b == "A":
      #menu_principal()
    if b == "B":
      return
    '''
  affichage(M)
  move(M,G,H,g)

n = 1
move(M1,D,E,n)
n = 2
print("Vous êtes niveau 2")
move(M2,D,E,n)
n = 3
print("Vous êtes niveau 3")
move(M3,D,E,n)

# monster: 1 MONSTER: 5 Niveau 1
# monster: 3 MONSTER: 15 Niveau 2
# monster: 5 MONSTER: 30 Niveau 3


'''
d = move()
e = 0
while e == 0:
 for i in range (0,15,1):
   for k in range (0,15,1):
     if "Coffret" in M[i][k]:
      e = "Coffret"
      break
 E = coffret_action()
 d = move()
move()
'''