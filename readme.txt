--------------------- README --------------------

Ceci est un guide sur le contenu du site et de la base de donn�es.

1- Les utilisateurs :
Il y a 7 utilisateurs dans la base de donn�es : 
	* l'admin : email -> admin@gmail.com    mot de passe -> admin
	* 6 utilisateurs qui repr�sentent les membres de l'�quipe. Leurs noms et pr�nom sont les noms et pr�noms des membres du groupe.
	Leurs mails sont de la forme nomprenom@gmail.com
	Leurs mots de passe sont de la forme nomprenom
Une fois connect� en tant qu'admin, la barre de menu en haut � droite permet d'acc�der � la liste d'utilisateurs pour consulter leurs informations, les bloquer ou
les supprimer.
Il est possible d'inscrire un nouvel utilisateur gr�ce � l'option " Inscription " dans le menu en haut � droite.
Si l'admin supprime un utilisateur, toutes les recettes et les commentaires de cet utilisateurs sont supprim�es. Les notes qu'a donn� l'utilisateur sur les recettes
ne sont plus prises en compte.

2- Utilisateur bloqu� :
Lorsqu'un utilisateur est bloqu�, on le lui annonce � sa connexion qu'il a �t� bloqu� par un administrateur. Un utilisateur bloqu� peut quand m�me consulter des 
recettes (en mettant comme lien index.php) et modifier ses informations. Il ne peut pas noter, modifier, cr�er ou commenter une recette.
Un utilisateur ne peut pas commenter une recette dont il est l'auteur, mais peut la noter. Cependant, un utilisateur ne peut noter une recette qu'une seule fois.

3- Recettes :
La liste des recettes est disponible dans une section � droite de la page d'acceuil et dans toutes les pages de recettes : elles sont accessibles depuis partout
dans le site. Elle offre aussi l'option, � des membres connect�s et non bloqu�s, de cr�er une nouvelle recette.

4- Le code (les pages .php) :
Nous avons trois types de pages php :
	* Page d'affichage : son nom est de la forme "page.php"
	* Page de traitement : son nom est de la forme "page.php"
	* Page qui n�cessite un traitement et un affichage : est divis�e en deux pages -> une page "page.php" qui affiche et une page "page - Copie.php"
	qui effectue le traitement
Toutes les pages d'affichage sont modularis�es en utilisant des include pour le header et la banni�re de la page. Elles diff�rent par l'include de pages diff�rentes
dans la section du contenu.
Le style css est un template.	

5- le code est dans le dossier assembled/user

6-la base de donn�es est dans le fichier /our_bdd.sql			