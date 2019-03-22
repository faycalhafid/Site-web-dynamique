--------------------- README --------------------

Ceci est un guide sur le contenu du site et de la base de données.

1- Les utilisateurs :
Il y a 7 utilisateurs dans la base de données : 
	* l'admin : email -> admin@gmail.com    mot de passe -> admin
	* 6 utilisateurs qui représentent les membres de l'équipe. Leurs noms et prénom sont les noms et prénoms des membres du groupe.
	Leurs mails sont de la forme nomprenom@gmail.com
	Leurs mots de passe sont de la forme nomprenom
Une fois connecté en tant qu'admin, la barre de menu en haut à droite permet d'accéder à la liste d'utilisateurs pour consulter leurs informations, les bloquer ou
les supprimer.
Il est possible d'inscrire un nouvel utilisateur grâce à l'option " Inscription " dans le menu en haut à droite.
Si l'admin supprime un utilisateur, toutes les recettes et les commentaires de cet utilisateurs sont supprimées. Les notes qu'a donné l'utilisateur sur les recettes
ne sont plus prises en compte.

2- Utilisateur bloqué :
Lorsqu'un utilisateur est bloqué, on le lui annonce à sa connexion qu'il a été bloqué par un administrateur. Un utilisateur bloqué peut quand même consulter des 
recettes (en mettant comme lien index.php) et modifier ses informations. Il ne peut pas noter, modifier, créer ou commenter une recette.
Un utilisateur ne peut pas commenter une recette dont il est l'auteur, mais peut la noter. Cependant, un utilisateur ne peut noter une recette qu'une seule fois.

3- Recettes :
La liste des recettes est disponible dans une section à droite de la page d'acceuil et dans toutes les pages de recettes : elles sont accessibles depuis partout
dans le site. Elle offre aussi l'option, à des membres connectés et non bloqués, de créer une nouvelle recette.

4- Le code (les pages .php) :
Nous avons trois types de pages php :
	* Page d'affichage : son nom est de la forme "page.php"
	* Page de traitement : son nom est de la forme "page.php"
	* Page qui nécessite un traitement et un affichage : est divisée en deux pages -> une page "page.php" qui affiche et une page "page - Copie.php"
	qui effectue le traitement
Toutes les pages d'affichage sont modularisées en utilisant des include pour le header et la bannière de la page. Elles diffèrent par l'include de pages différentes
dans la section du contenu.
Le style css est un template.	

5- le code est dans le dossier assembled/user

6-la base de données est dans le fichier /our_bdd.sql			