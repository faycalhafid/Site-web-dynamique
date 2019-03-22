-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 16 déc. 2018 à 23:25
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `our_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(255) NOT NULL,
  `id_recette` int(255) DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `date_commentaire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `id_recette`, `id_user`, `commentaire`, `date_commentaire`) VALUES
(7, 18, 25, 'Perso, j\'ai pas pu rÃ©ussir la recette...', '2018-12-16'),
(8, 19, 25, 'Pas assez Ã©pissÃ© pour moi ! Ceci dit Ã§a reste bon :) ', '2018-12-16'),
(9, 20, 25, 'IdÃ©al pour les apÃ©ros ;) ', '2018-12-16'),
(10, 21, 26, 'The best of the best, j\'aurais rajoutÃ© plus d\'Harissa moi :D', '2018-12-16'),
(11, 18, 27, 'j\'aime beaucoup , merci :) ', '2018-12-16'),
(12, 20, 27, 'Mes enfants adorent, merci :) ', '2018-12-16'),
(13, 21, 27, 'Quelle saveur !!', '2018-12-16'),
(14, 22, 27, 'un gout d\'enfer pour un smoothie du paradis ! Merci', '2018-12-16'),
(15, 21, 28, 'j\'aime pas du tout !!', '2018-12-16'),
(16, 22, 28, 't\'as osÃ© appeler Ã§a une recette ?', '2018-12-16'),
(17, 22, 24, '', '2018-12-16'),
(18, 22, 24, 'dixit la personne qui a jamais Ã©crit une recette :)  @marouane\r\nJ\'ai adorÃ© moi ', '2018-12-16'),
(19, 24, 28, 'J\'ai adorÃ© le thÃ© Ã  la menthe...', '2018-12-16'),
(20, 24, 23, 'On devrait la mettre dans la catÃ©gorie plat tellement j\'en raffole ! *-*', '2018-12-16');

-- --------------------------------------------------------

--
-- Structure de la table `listeetapes`
--

CREATE TABLE `listeetapes` (
  `id_recette` int(255) NOT NULL,
  `num_etape` int(255) NOT NULL,
  `etape` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listeetapes`
--

INSERT INTO `listeetapes` (`id_recette`, `num_etape`, `etape`) VALUES
(18, 1, 'PrÃ©chauffez le four Ã  180ÂºC.'),
(18, 2, 'Recouvrez un moule Ã  tarte de papier sulfurisÃ©.'),
(18, 3, 'DÃ©roulez la pÃ¢te feuilletÃ©e dans le moule Ã  tarte. Piquez le fond de pÃ¢te avec une fourchette.'),
(18, 4, 'DÃ©coupez les tranches de dinde en petits dÃ©s et rÃ©partissez-les sur le fond de pÃ¢te dans le moule Ã  tarte. RÃ©servez.'),
(18, 5, 'Dans un saladier, mÃ©langez au fouet les oeufs entiers et la crÃ¨me fraÃ®che Ã©paisse. Salez et poivrez Ã  votre goÃ»t.'),
(18, 6, 'Versez le mÃ©lange sur les dÃ©s de dinde dans le moule Ã  tarte.'),
(18, 7, 'Parsemez la quiche de gruyÃ¨re rÃ¢pÃ©.'),
(18, 8, 'Enfournez le moule Ã  tarte et faites cuire la quiche lorraine Ã  la volaille pendant 40 minutes, jusqu\'Ã  ce qu\'elle soit bien dorÃ©e.'),
(18, 9, 'A la sortie du four, laissez tiÃ©dir la quiche lorraine Ã  la volaille pendant quelques minutes sur une grille'),
(18, 10, 'Ensuite, dÃ©coupez-la en parts Ã©gales.'),
(18, 11, 'Servez tiÃ¨de ou froid les parts de quiche lorraine Ã  la volaille accompagnÃ©es d\'une salade verte assaisonnÃ©e.'),
(19, 1, 'PrÃ©chauffez votre four th.6/7 (180/210Â°C).'),
(19, 2, 'Dans une casserole au feu, versez le lait puis, faites-le chauffer.'),
(19, 3, 'Frottez un plat Ã  gratin avec la gousse d\'ail. Puis, beurrez-le'),
(19, 4, 'DÃ©posez les rondelles de pomme de terre au fond du plat Ã  gratin.'),
(19, 5, 'Salez et poivrez.'),
(19, 6, 'Versez les Â¾ du lait chaud sur toute la surface du plat.'),
(19, 7, 'Versez le gruyÃ¨re rÃ¢pÃ© sur le haut du plat.'),
(19, 8, 'Enfournez pendant 1 h.'),
(19, 9, 'Dans un bol, cassez puis, battez l\'oeuf Ã  la fourchette et dÃ©layez-le avec le reste du lait.'),
(19, 10, 'Versez cette prÃ©paration sur le gratin.'),
(19, 11, 'Enfournez Ã  nouveau pendant 10 min.'),
(19, 12, 'Servez ensuite.'),
(20, 1, 'Lavez, Ã©queutez et mixez 250g de fraises.'),
(20, 2, 'Dans une casserole, versez le jus du citron, la purÃ©e de fraises, le sucre et le beurre.'),
(20, 3, 'Faites chauffer tout doucement jusqu\'Ã  ce que le beurre soit fondu.'),
(20, 4, 'Ajoutez 2 Å“ufs battus en omelette. Fouettez vivement le mÃ©lange, hors du feu.'),
(20, 5, 'Remettez sur feu doux et laissez Ã©paissir le mÃ©lange.'),
(20, 6, 'Versez le curd dans 1 pot et laissez refroidir complÃ¨tement.'),
(20, 7, 'Dans un saladier, fouettez les jaunes dâ€™Å“ufs et le reste de sucre en poudre Ã  lâ€™aide dâ€™un fouet Ã©lectrique. Ajoutez le mascarpone et fouettez Ã  nouveau pendant environ 2 min.'),
(20, 8, 'Montez les blancs en neige. Quand ils sont bien fermes, incorporez le sucre glace tout en continuant Ã  fouetter.'),
(20, 9, 'mÃ©langez dÃ©licatement les deux prÃ©parations.'),
(20, 10, 'Une fois que le curd est bien refroidi, versez-le dans les verrines.'),
(20, 11, 'Puis, versez la mousse au mascarpone.'),
(20, 12, 'Dans un bol, diluez le sirop de fraise dans un peu d\'eau.'),
(20, 13, 'DÃ©coupez les biscuits. Plongez-les dans le sirop, puis dÃ©posez-les dans les verrines.'),
(20, 14, 'Lavez et Ã©queutez le reste des fraises. DÃ©coupez-les en morceaux et dÃ©posez-les dans chaque verrine.'),
(20, 15, 'Servez aussitÃ´t.'),
(21, 1, 'Mettre dans une casserole les pois chiches avec leur eau, saler.'),
(21, 2, 'Ajouter 1L d\'eau et laisser cuire une dizaine de minutes.'),
(21, 3, 'Ecraser 2 gousses d\'ail, ajouter dans la casserole, avec une bonne cc de tabel -karouia.'),
(21, 4, 'Pendant ce temps, couper du pain rassis en petits morceaux et remplir 2 grands bols.'),
(21, 5, 'Casser 2 oeufs dans la soupe, et laisser pocher quelques instants, puis Ã©teindre le feu. L\'oeuf doit rester coulant Ã  l\'intÃ©rieur.'),
(21, 6, 'DÃ©poser immÃ©diatement un oeuf sur le dessus de chaque bol, puis arroser tout autour avec la soupe et les pois chiches.'),
(21, 7, 'Sur chaque bol, ajouter une grosse cs de harissa, une cs de cumin moulu, du thon, des cÃ¢pres, des olives.'),
(21, 8, 'Passer sur le dessus un filet d\'huile d\'olive vierge et presser un quart de citron.'),
(21, 9, 'Une fois ce beau tableau obtenu, tout mÃ©langer, puis dÃ©guster Ã  la cuillÃ¨re.'),
(21, 10, 'Bon appÃ©tit!'),
(22, 1, 'Presser les mandarines afin d\'en extraire le jus.'),
(22, 2, 'Ã‰plucher et couper en morceaux les bananes et les kiwis. Les mettre dans le blender avec le jus de mandarine.'),
(22, 3, 'Mixer jusqu\'Ã  obtenir un jus homogÃ¨ne.'),
(23, 1, 'Epluchez et coupez les pommes de terre en morceaux. '),
(23, 2, 'Mettez-les Ã  cuire dans un grand volume d\'eau salÃ©e jusqu\'Ã  ce que la pointe d\'un couteau rentre facilement dans la chair. '),
(23, 3, 'Passez-les alors au moulin Ã  lÃ©gumes. '),
(23, 4, 'Ajoutez le lait pour dÃ©layez jusqu\'Ã  la consistance souhaitÃ©e, la crÃ¨me fraÃ®che pour l\'onctuositÃ© et un peu de muscade rÃ¢pÃ©e. '),
(23, 5, 'Rectifiez l\'assaisonnement et servez bien chaud. '),
(24, 1, 'mettre la semoule sur le feu '),
(24, 2, 'attendre jusqu\'Ã  ce qu\'elle devienne brune'),
(24, 3, 'incorporer le beurre dÃ©jÃ  fondu'),
(24, 4, 'ajouter le miel et laisser reposer quelques minutes'),
(24, 5, 'servez avec du thÃ© Ã  la menthe');

-- --------------------------------------------------------

--
-- Structure de la table `listeingredients`
--

CREATE TABLE `listeingredients` (
  `id_recette` int(255) NOT NULL,
  `ingredient` varchar(30) NOT NULL,
  `qte` int(255) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listeingredients`
--

INSERT INTO `listeingredients` (`id_recette`, `ingredient`, `qte`, `unit`) VALUES
(18, 'gruyÃ¨re rapÃ©', 100, 'g'),
(18, 'oeufs entiers', 3, ''),
(18, 'poivre', 1, 'quantitÃ© de'),
(18, 'rouleau de pate feuilletÃ©e', 1, ''),
(18, 'sel', 1, 'quantitÃ© de'),
(18, 'soupe de creme fraiche', 4, 'c Ã  soupe'),
(18, 'tranches de dinde', 125, 'g'),
(19, 'beurre', 50, 'g'),
(19, 'gousse d\'ail', 1, ''),
(19, 'gruyÃ¨re', 50, 'g'),
(19, 'lait', 500, 'ml'),
(19, 'oeuf', 1, ''),
(19, 'poivre', 1, 'quantitÃ© de'),
(19, 'pommes de terre', 1, 'kg'),
(19, 'sel', 1, 'quantitÃ© de'),
(20, 'beurre', 40, 'g'),
(20, 'citron', 1, ''),
(20, 'fraise', 375, 'g'),
(20, 'mascarpone', 250, 'g'),
(20, 'oeufs', 4, ''),
(20, 'sirop de fraise', 3, 'c Ã  soupe'),
(20, 'sucre cristalisÃ© ', 125, 'g'),
(20, 'sucre en poudre', 50, 'g'),
(20, 'sucre glace', 10, 'g'),
(21, 'cÃ¢pres', 50, 'g'),
(21, 'citron ', 1, ''),
(21, 'Cumin moulu', 1, 'pincÃ©e de'),
(21, 'gousse d\'ail', 1, ''),
(21, 'HARISSA ', 1, 'quantitÃ© souhaitÃ©e de'),
(21, 'huile d\'olive', 1, 'quantitÃ© de'),
(21, 'Karouia', 1, 'pincÃ©e de'),
(21, 'oeufs', 2, ''),
(21, 'olives', 50, 'g'),
(21, 'pain rassis', 1, ''),
(21, 'pois chiche en conserve', 200, 'g'),
(21, 'poivre', 1, 'quantitÃ© de'),
(21, 'sel', 1, 'quantitÃ© de'),
(22, 'bananes', 3, ''),
(22, 'kiwis', 4, ''),
(22, 'mandarines', 4, ''),
(23, 'creme fraiche', 1, 'quantitÃ© de'),
(23, 'lait', 20, 'cl'),
(23, 'muscade', 1, ' pincÃ©e de'),
(23, 'pommes de terre', 1, 'kg'),
(24, 'beurre', 100, 'g'),
(24, 'miel', 100, 'g'),
(24, 'semoule', 200, 'g');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_recette` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `note` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_recette`, `id_user`, `note`) VALUES
(18, 24, 4),
(18, 25, 3),
(18, 27, 4),
(18, 28, 4.5),
(19, 24, 5),
(19, 25, 4),
(19, 28, 5),
(20, 25, 4.5),
(20, 27, 4),
(20, 28, 5),
(21, 26, 5),
(21, 27, 4.5),
(21, 28, 1),
(22, 27, 5),
(24, 23, 5),
(24, 28, 4.5);

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id_recette` int(255) NOT NULL,
  `titre` varchar(30) DEFAULT NULL,
  `categorie` enum('entree','plat','dessert') DEFAULT NULL,
  `datecreation` date DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id_recette`, `titre`, `categorie`, `datecreation`, `id_user`) VALUES
(18, 'Quiche lorraine Ã  la volaille', 'entree', '2018-12-16', 23),
(19, 'gratin dauphinois', 'plat', '2018-12-16', 23),
(20, 'Tiramisu Ã  la fraise', 'dessert', '2018-12-16', 24),
(21, 'Lablabi tunisien', 'plat', '2018-12-16', 25),
(22, 'Smoothie du paradis', 'dessert', '2018-12-16', 26),
(23, 'purÃ©e de pomme de terre maiso', 'plat', '2018-12-16', 27),
(24, 'Tamina', 'dessert', '2018-12-16', 24);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `email` varchar(30) DEFAULT NULL,
  `id_user` int(255) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `pword` varchar(255) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `statut` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`email`, `id_user`, `nom`, `pword`, `prenom`, `statut`) VALUES
('admin@gmail.com', 1, 'admin', 'adminadmin', 'prenom_admin', 'admin'),
('hafidfaycal@gmail.com', 23, 'hafid', 'cd1d78d1c79a5d7b194d5c22211442f4', 'faycal', 'membre'),
('makourkaci@gmail.com', 24, 'makour', 'b2c7acf735caea968daa2f704c2ae43c', 'kaci', 'membre'),
('bouchairakatrennada@gmail.com', 25, 'bouchaira', '636c5a41e619c47f7557c61d71ae4685', 'katrennada', 'membre'),
('aroussiamal@gmail.com', 26, 'aroussi', '3e344482bedfdc7b136e4c45d4f56c96', 'amal', 'membre'),
('majdoubiimen@gmail.com', 27, 'majdoubi', 'a5280995b7509ff55357046f29d8956d', 'imen', 'membre'),
('maachoumarouane@gmail.com', 28, 'maachou', '42984d90a6749df4b687ad24670d5cf6', 'marouane', 'membre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_recette` (`id_recette`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `listeetapes`
--
ALTER TABLE `listeetapes`
  ADD PRIMARY KEY (`id_recette`,`num_etape`);

--
-- Index pour la table `listeingredients`
--
ALTER TABLE `listeingredients`
  ADD PRIMARY KEY (`id_recette`,`ingredient`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_recette`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id_recette`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id_recette` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `listeetapes`
--
ALTER TABLE `listeetapes`
  ADD CONSTRAINT `listeetapes_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`);

--
-- Contraintes pour la table `listeingredients`
--
ALTER TABLE `listeingredients`
  ADD CONSTRAINT `listeingredients_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
