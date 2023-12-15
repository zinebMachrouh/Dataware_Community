# Système de Gestion de Communauté en Ligne pour Projets Collaboratifs

Ce projet vise à développer une plateforme en ligne destinée à faciliter la communication et la collaboration entre les membres d'une communauté travaillant sur différents projets. La plateforme permettra aux utilisateurs de poser des questions, partager des réponses et interagir de manière efficace autour des projets, favorisant ainsi un environnement collaboratif et informatif.

# Objectifs Principaux:

1. Facilitation de la Communication: Fournir un espace où les membres peuvent communiquer de manière transparente et efficace pour résoudre des problèmes, partager des connaissances et collaborer sur des projets.
2. Gestion Intuitive des Projets: Permettre aux utilisateurs de lier des questions et des réponses à des projets spécifiques, simplifiant ainsi la gestion de l'information liée à chaque projet.
3. Personnalisation de l'Expérience Utilisateur: Offrir des fonctionnalités telles que la modification et la suppression de questions et réponses, l'ajout de tags en masse, et la possibilité de marquer des réponses comme solutions pour personnaliser l'expérience de chaque utilisateur.
4. Évaluation et Modération Collaboratives: Permettre aux utilisateurs d'évaluer les questions et réponses, tout en offrant aux responsables de projet (Scrum master) des outils de modération pour assurer un contenu approprié.
5. Analyse Statistique pour la Gestion de Projet: Fournir des informations statistiques pertinentes au Product Owner, telles que le nombre de questions par projet, les projets les plus actifs, les utilisateurs les plus impliqués, etc., pour une gestion efficace des ressources.


### Mission
Une plateforme web intuitive avec des fonctionnalités robustes pour la gestion de la communauté.
Une base de données sécurisée pour stocker les questions, réponses, projets, utilisateurs, et évaluations.
Une expérience utilisateur optimisée avec une interface conviviale et réactive.
Des mécanismes de sécurité solides pour protéger les données des utilisateurs et prévenir les abus.
Un système de modération efficace pour assurer la qualité du contenu.

## Composants du Projet

1. **Diagrammes UML :**
   - Diagramme de Cas d'Utilisation : Illustre les interactions entre les utilisateurs et notre système(DataWare).
   - Diagramme de Classe : Représente la structure des classes du système et leurs relations.
   - Diagramme de Séquence : Dépeint la séquence des actions dans différentes situations.

2. **Requêtes SQL :**
   - Affecter des équipes à des projets spécifiques pour une allocation optimale des ressources.
   - Affichage des questions et réponses triées par date.
   - Mise en place de la navigation pour cliquer sur un projet et afficher les questions et réponses associées.
   - Implémentation de la fonctionnalité permettant aux utilisateurs de poser des questions liées à un projet spécifique.
   - Possibilité d'ajouter plusieurs tags à la fois pour une recherche facilitée (insertion en masse).
   - Implémentation de la modification des questions par les utilisateurs.
   - Suppression en cascade des questions et réponses par l'utilisateur.
   - Mise en place de la possibilité pour les utilisateurs de répondre à une question existante.
   - Permettre au Scrum Master d'archiver une question ou une réponse inappropriée.
   -  Mise en place de la fonctionnalité pour permettre aux utilisateurs de marquer une réponse comme solution à leur question.
   -  Implémentation de la recherche des questions par titre, tags, et contenu (bonus).
   -  Affichage du nombre de j'aimes ou je n'aime pas de chaque réponse.
   -  Permettre au Product Owner de consulter le nombre de questions par projet.
   -  Affichage des projets avec le plus de questions.
   -  Affichage du projet avec le moins de réponses.
   -  Affichage de l'utilisateur avec le plus de réponses.
   -  Permettre au Scrum Master d'archiver une question ou une réponse inappropriée.
   -  Mise en place de la fonctionnalité pour permettre aux utilisateurs de marquer une réponse comme solution à leur question.
   -  Mise en place de la possibilité pour les utilisateurs d'évaluer une question ou une réponse (j'aime ou je n'aime pas).
   - Affichage du nombre de j'aimes ou je n'aime pas de chaque réponse.
   - Affichage des statistiques de la section, incluant les questions les plus populaires et les utilisateurs les plus actifs.


4. **Mesures de Sécurité :**
   - Sécuriser les requêtes SQL pour éviter les injections SQL.
   - Garantir la robustesse et la sécurité du système.

5. **Conception de l'Interface :**
   - Utiliser HTML et CSS et framework(Tailwind) pour créer une interface utilisateur intuitive et visuellement attrayante.
   - Incorporer des frameworks CSS pour une expérience utilisateur améliorée.
   - Utiliser JS permet de mise en place de la pagination pour visualiser 10 questions par page, filtration et recherche en utilisant AJAX. et n'oublions pas JQuery.

6. **Implémentation PHP :**
   - Développer du code PHP pour intégrer les fonctionnalités requises dans l'interface.

## Histoires d'Utilisateurs

1. **Authentification :**
   - Les utilisateurs doivent s'authentifier pour accéder à la section communautaire.
2. **Parcourir les Questions et Réponses:**
   - Une interface utilisateur affiche les questions et réponses triées par date.

3. **Afficher les Questions liées à un Projet:**
   - Les utilisateurs peuvent cliquer sur un projet pour afficher les questions et réponses associées.

4. **Pagination avec AJAX:**
   - Affichage de 10 questions par page avec une pagination pour une navigation facile.

5. **Poser une Question liée à un Projet:**
   - Les utilisateurs peuvent poser des questions liées à leurs projets.

6. **Modifier ou Supprimer ses Propres Questions:**
   - Les utilisateurs peuvent modifier ou supprimer leurs propres questions avec suppression en cascade.
  
7. **Insertion en Masse de Tags:**
   - Les utilisateurs peuvent ajouter plusieurs tags à la fois à leurs questions pour faciliter la recherche.
     
8. **Répondre à une Question Existante:**
    - Les utilisateurs peuvent répondre aux questions existantes.

 9. **Modifier ou Supprimer ses Propres Réponses:**
   - Les utilisateurs peuvent modifier ou supprimer leurs propres réponses avec suppression en cascade.
     
10. **Archiver une Question ou une Réponse Inappropriée:**
    - Le Scrum master peut archiver des questions ou réponses inappropriées.

11. **Marquer une Réponse comme Solution:**
    - Les utilisateurs peuvent marquer une réponse comme solution à leur question.
      
12. **Recherche par Titre, Tags ou Contenu:**
    - Les utilisateurs peuvent rechercher des questions par titre, tags, ou contenu (bonus).
       
13. **Évaluation des Questions et Réponses:**
     - Les utilisateurs peuvent évaluer les questions ou réponses (j'aime ou je n'aime pas).
     
14. **Consultation des J'aimes et Je n'aime pas:**
     - Les utilisateurs peuvent consulter le nombre de j'aimes ou je n'aime pas pour chaque réponse.**
       
15. **Statistiques pour le Product Owner:**
     - Le Product Owner peut consulter le nombre de questions par projet, les projets avec le plus de questions, le projet avec le moins de réponses, et l'utilisateur avec le plus de réponses.


     
11. **Commit Push et Pull :**

    git add .   /*add all untracked files*/
    git commit -m "Rafactore code or use your message"
    git push origin feature-branch
    git pull origin feature-branch
    
   

## Liens utilisable
https://app.diagrams.net/#G16aHGiajIsh2_Y6-TbcnDYRpVtUJM_cSA
https://zinebmac.atlassian.net/jira/software/projects/DAT/boards/5/backlog
https://themacproject.000webhostapp.com/
https://github.com/zinebMachrouh/brief-07


## Mise en Route

Pour configurer et exécuter le Système de Gestion des Ressources Humaines DataWare, suivez ces étapes :

1. Clonez le dépôt sur votre machine locale.
2. Configurez un environnement serveur local (par exemple, XAMPP, WAMP) pour PHP et MySQL.
3. Importez le schéma de la base de données fourni dans le fichier `dataware_v3.sql`.
4. Configurez la connexion à la base de données dans les fichiers PHP.
5. Exécutez l'application sur votre serveur local.


Merci de faire partie de ce projet passionnant !
