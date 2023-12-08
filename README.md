# Système de Gestion des Ressources Humaines DataWare

Bienvenue dans le projet du Système de Gestion des Ressources Humaines (GRH) de DataWare ! Ce système a pour objectif de révolutionner la gestion du personnel pour DataWare, en fournissant une interface conviviale et des fonctionnalités robustes. Le projet implique l'utilisation des langages PHP et SQL pour les opérations côté serveur, ainsi que HTML, CSS et des frameworks CSS pour le développement côté client. Et puis développer une section communautaire similaire à 'Stack Overflow' pour favoriser l'échange et l'entraide entre les membres de l'équipe de DataWare.

## Aperçu du Projet

### Mission

Votre mission, si vous choisissez de l'accepter, consiste à créer un système complet de gestion des ressources humaines qui réponde aux exigences spécifiques de DataWare. Cela inclut la conception de diagrammes UML, la rédaction de requêtes SQL, la mise en œuvre de pratiques sécurisées et le développement d'une interface visuellement attrayante.

## Composants du Projet

1. **Diagrammes UML :**
   - Diagramme de Cas d'Utilisation : Illustre les interactions entre les utilisateurs et le système(DataWare).
   - Diagramme de Classe : Représente la structure des classes du système et leurs relations.
   - Diagramme de Séquence : Dépeint la séquence des actions dans différentes situations.

2. **Requêtes SQL :**
   - Créer, modifier et supprimer des projets.
   - Assigner des Scrum Masters à des projets avec des rôles définis.
   - Gérer la création, la modification et la suppression d'équipes.
   - Ajouter ou supprimer des membres d'équipe selon les besoins.
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
   -  Implémentation de la recherche des questions par titre, tags, et contenu (bonus).
   -  Mise en place de la possibilité pour les utilisateurs d'évaluer une question ou une réponse (j'aime ou je n'aime pas).
   - Affichage du nombre de j'aimes ou je n'aime pas de chaque réponse.
   - Affichage des statistiques de la section, incluant les questions les plus populaires et les utilisateurs les plus actifs.


3. **Mesures de Sécurité :**
   - Sécuriser les requêtes SQL pour éviter les injections SQL.
   - Garantir la robustesse et la sécurité du système.

4. **Conception de l'Interface :**
   - Utiliser HTML et CSS pour créer une interface utilisateur intuitive et visuellement attrayante.
   - Incorporer des frameworks CSS pour une expérience utilisateur améliorée.
   - Mise en place de la pagination pour visualiser 10 questions par page, en utilisant AJAX.
   - Utiliser les frameworks.

5. **Implémentation PHP :**
   - Développer du code PHP pour intégrer les fonctionnalités requises dans l'interface.

## Histoires d'Utilisateurs

1. **Authentification de l'Utilisateur :**
   - En tant qu'utilisateur, je souhaite m'inscrire et m'authentifier en utilisant un identifiant et un mot de passe pour accéder à la plateforme.

2. **Aperçu des Projets et des Équipes :**
   - En tant qu'utilisateur, je souhaite consulter mes projets et mes équipes.

3. **Gestion de Projets :**
   - En tant que Product Owner, je souhaite créer, modifier et supprimer des projets pour répondre aux évolutions des besoins de l'entreprise.

4. **Responsabilités du Scrum Master :**
   - En tant que Product Owner, je veux assigner des Scrum Masters à des projets spécifiques et définir leurs rôles.

5. **Gestion des Équipes :**
   - En tant que Scrum Master, je veux pouvoir gérer la création, la modification et la suppression d'équipes pour garantir une organisation efficace.

6. **Gestion des Membres de l'Équipe :**
   - En tant que Scrum Master, j'ai besoin d'ajouter ou supprimer des membres de l'équipe pour ajuster les effectifs selon les besoins.

7. **Allocation des Ressources :**
   - En tant que Scrum Master, je désire affecter des équipes à des projets spécifiques pour une répartition optimale des ressources.
8. **procédure Stockée "AddAnswer" :**
   - Créer une procédure stockée "AjouterReponse" prenant en compte les paramètres nécessaires pour ajouter une réponse à une question spécifique.

9. **Vue SQL "ListeQuestions" :**
   - Créer une vue SQL "ListeQuestions" combinant les informations nécessaires pour afficher la liste des questions, y compris les détails des réponses associées et le nombre de vues.


## Mise en Route

Pour configurer et exécuter le Système de Gestion des Ressources Humaines DataWare, suivez ces étapes :

1. Clonez le dépôt sur votre machine locale.
2. Configurez un environnement serveur local (par exemple, XAMPP, WAMP) pour PHP et MySQL.
3. Importez le schéma de la base de données fourni dans le fichier `dataware_v3.sql`.
4. Configurez la connexion à la base de données dans les fichiers PHP.
5. Exécutez l'application sur votre serveur local.


Merci de faire partie de ce projet passionnant !
