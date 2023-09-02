import pickle

def save_data(data, file_name):
    with open(file_name, 'wb') as file:
        pickle.dump(data, file)

def load_data(file_name):
    with open(file_name, 'rb') as file:
        data = pickle.load(file)
    return data

# Create some data to save
data = {'name': 'John Smith', 'age': 35, 'is_employee': True}

# Save the data to a file
save_data(data, "benoit")

# Load the data from the file
loaded_data = load_data("benoit")

print(loaded_data)
# Output: {'name': 'John Smith', 'age': 35, 'is_employee': True}


def nom_du_joueur():
  print("Comment t'appelles-tu jeune aventurier ?")
  a = str(input())
  print("Es-tu sûr de ton nom ? \n 1- Oui \n 2- Non")
  b = str(input())
  if b == "1":
    print("enchanté " + a + " es-tu prêt à commencer  \n entre la commande que tu souhaites pour commencer")
    c = str(input())
    while c == "102643643547886":
      c = str(input())
    else:
      premier_monde()
    return
  elif b == "2":
    nom_du_joueur()
  else:
    print("je ne comprend pas ta requête :(, je vais donc réitérer ma question")
    nom_du_joueur()

def menu_principal():
  a = "MENU PRINCIPAL : \n \n 1. Nouvelle partie \n 2. Parties sauvegardées \n 3. A propos du jeu \n 4. Quitter"
  print(a)
  b = str(input())
  if b == "1": 
    nom_du_joueur()
  elif b == "2":
    print("partie sauvegardé")
  elif b =="3":
    print("Crée par Emmanuel, Joel, Léo et Hemmy-Lola, ce RPG a pour but de mettre en application les connaissances apprises de manières ludiques. \n date de publication: 15/01/2023 \n langage utilisé: Python")
    menu_principal()
  elif b == "4":
     debut_du_jeu()

from random import randint

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


def affichage(M):
 for i in range (0,15,1):
  k = 0
  for k in range (0,15,1):
    print(M[i][k], end = "   ")
  print("\n")


Inventory = {"couteaux" : [1,10], "machettes" : [0,35], "sabres" : [0,55], "fusils" : [0,90], "grenades" : [0,100], "bazooka" : [0,225], "super berserk gunnom" : [0,300], "ultra bouya bleeder 2.0" : [0,500]}
L = list(Inventory.values())
#L = [[1,10],[0,35],[0,55],[0,90],[0,100],[0,225],[0,300],[0,500]]

def coffret_content(Liste):
  price = randint(1,30)
  if price == 1 or price == 2 or price == 4 or price == 6 or price == 8 or price == 10 or price == 12 or price == 14 or price == 16 or price == 18 or price == 20 or price == 22 or price == 24 or price == 26 or price == 28:
    Liste[0][0] = Liste[0][0] + 5
    Inventory.update({"couteaux" : L[0][0]})
    print("Vous avez obtenu ",5, " couteaux supplémentaires")
  elif price == 3 or price == 7 or price == 9 or price == 13:
    Liste[1][0] = Liste[1][0] + 3
    Inventory.update({"machettes" : L[1][0]})
    print("Vous avez obtenu ",3, " machettes")
  elif price == 11 or price == 19 or price == 21:
    Liste[2][0] = Liste[2][0] + 3
    Inventory.update({"sabres" : L[2][0]})
    print("Vous avez obtenu ",3, " sabres")
  elif price == 17 or price == 27:
    Liste[3][0] = Liste[3][0] + 2
    Inventory.update({"fusils" : L[3][0]})
    print("Vous avez obtenu ",2, " fusils")
  elif price == 25 or price == 30 :
    Liste[4][0] = Liste[4][0] + 2
    Inventory.update({"grenades" : L[4][0]})
    print("Vous avez obtenu ",2, " grenades")
  elif price == 5 or price == 29:
    Liste[5][0] = Liste[5][0] + 1
    Inventory.update({"bazooka" : L[5][0]})
    print("Vous avez obtenu ",1, " bazooka")
  elif price == 15:
    Liste[6][0] = Liste[6][0] + 1
    Inventory.update({"super berserk gunnom" : L[6][0]})
    print("Vous avez obtenu ",1, "super berserk gunnom")
  elif price == 23:
    Liste[7][0] = Liste[7][0] + 1
    Inventory.update({"ultra bouya bleeder 2.0" : L[7][0]})
    print("Vous avez obtenu ",1, "ultra bouya bleeder 2.0")
  #L = list(Inventory.values())
  return(Liste)

C = []
#D = L
E = list(Inventory.keys())

def inventaire(E,D):
  print("Vous possédez dans l'artillerie de vos armes:")
  for i in range (0,8,1):
    print(D[i][0],E[i],"infligeant",D[i][1],"points de dégâts")

'''
def coffret_action():
  for i in range (0,15,1):
   for k in range (0,15,1):
     if "  BOY  " in M[i][k]:
       i1 = i
       k1 = k
  if d == "z": #and M[i1-1][k1] != " Arbre " and M[i1-1][k1] != "Coffret":
    M[i1-1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
    C = coffret_content()
    return C
  if d == "q": #and M[i1-1][k1] != " Arbre " and M[i1-1][k1] != "Coffret":
    M[i1][k1-1] = "  BOY  "
    M[i1][k1] = "   0   "
    C = coffret_content()
    return C
  if d == "d": #and M[i1-1][k1] != " Arbre " and M[i1-1][k1] != "Coffret":
    M[i1][k1+1] = "  BOY  "
    M[i1][k1] = "   0   "
    C = coffret_content()
    return C
  if d == "s": #and M[i1-1][k1] != " Arbre " and M[i1-1][k1] != "Coffret":
    M[i1+1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
    C = coffret_content()
    return C
'''

def options(M):
  print(" 1- Map \n 2- Inventaire \n 3- monstres \n 4- Quitter")
  a = str(input())
  if a == "1": 
    affichage(M)
    move(M)
  elif a == "2":
    inventaire(E,D)
    move(M)
  elif a == "3":
    print("monstres_greenland")
    move(M)
  elif a == "4":
    print("Es-tu sûr de vouloir quitter ta partie ? \n A- oui \n B- non")
    b = str(input())
    if b == "A":
      menu_principal()
    if b == "B":
      return

D = L
def move(M):
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

  if direction == "z" and M[i1-1][k1] != " Arbre " and M[i1-1][k1] != "Coffret":
    M[i1-1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1-1][k1] == "Coffret":
    M[i1-1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
    D = coffret_content(L)  
  elif M[i1-1][k1] == " Arbre " and direction != "q" and direction != "d" and direction != "s" and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "q" and M[i1][k1-1] != " Arbre " and M[i1][k1-1] != "Coffret":
    M[i1][k1-1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1][k1-1] == "Coffret":
    M[i1][k1-1] = "  BOY  "
    M[i1][k1] = "   0   "
    D = coffret_content(L) 
  elif M[i1][k1-1] == " Arbre " and direction != "d" and direction != "s" and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "d" and M[i1][k1+1] != " Arbre " and M[i1][k1+1] != "Coffret":
    M[i1][k1+1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1][k1+1] == "Coffret":
    M[i1][k1+1] = "  BOY  "
    M[i1][k1] = "   0   "
    D = coffret_content(L) 
  elif M[i1][k1+1] == " Arbre " and direction != "s" and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "s" and M[i1+1][k1] != " Arbre " and M[i1+1][k1] != "Coffret":
    M[i1+1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
  elif M[i1+1][k1] == "Coffret":
    M[i1+1][k1] = "  BOY  "
    M[i1][k1] = "   0   "
    D = coffret_content(L) 
  elif M[i1+1][k1] == " Arbre " and direction != "1":
    print("Tu fonces dans un arbre")
  elif direction == "1":
    options(M)
    '''
    def options():
  print(" 1- Map \n 2- Inventaire \n 3- monstres \n 4- Sauvergarder \n 5- Quitter")
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
    file_name = str(input(print("Donnez un nom a votre sauvegarde")))
    save_data(data, file_name)
  elif a == "5":
    print("Es-tu sûr de vouloir quitter ta partie ? \n A- oui \n B- non")
    b = str(input())
    if b == "A":
      menu_principal()
    if b == "B":
      return
    '''
  
  move(M1)


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

def premier_monde():
  print(" Te voici arrivé à ton point de départ : Greenland ! Le chemin chemin vers le boss risque d'être long...essaie de te ravitailler sur ton chemin ! \n Attention aux petites rencontres que tu risques de faire... \n Objectif sur Greenland : PRENDRE DES FORCES !")
  move(M1)

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

def deuxieme_monde():
  print("Nous voici à présent à Aqualand ! Là où humain et animaux aquatique sont en parfaite symbiose")
  move(M2)

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

def troisieme_monde():
  print("Voici notre point final...TestLand !\n Ton objectif: \n BATTRE LE BOSS FINAL !!!")
  move(M3)


def debut_du_jeu():
  print("RPG LAND \n Seras-tu trouver le trésor ? Le but est simple: Traverse les différentes terres inconnus afin d'atteindre la fameuse île au trésor... \n 1- Entrée \n 2- Quitter")
  a = str(input())
  if a == "1":
    menu_principal()
  if a == "2":
    return

debut_du_jeu()