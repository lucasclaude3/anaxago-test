Anaxago API
===================

## Installation du projet en local

S'assurer d'avoir installé docker sur son ordinateur, puis effectuer les commandes suivantes dans cet ordre :

- ```make up``` pour builder les images docker et lancer les containers
- ```make init-db``` pour setup le container mysql et (ré)initialiser la base de données
- ```make composer-install```  pour installer les dépendances du projet
- ```make start``` pour lancer le serveur sur le container php en local

Une fois ces instructions suivies, l'application est accessible sur http://localhost:8020.

On peut également accéder à une interface PhpMyAdmin sur http://localhost:8080 pour regarder l'état de la base de données. 
- serveur : mysqldb
- utilisateur : lucas
- mot de passe : claude

## Test des fonctionnalités demandées

1. Lister les projets -> requête GET sur http://localhost:8020/api/projects
2. Créer une marque d'intérêt en tant que user -> requête POST sur http://localhost:8020/api/interests depuis POSTMAN. Attention, si on n'est pas connecté, l'API renvoie une erreur 401 Unauthorized. Pour pouvoir faire la requête, le plus simple est de se connecter sur l'application via le login, récupérer le cookie PHPSESSID, l'ajouter dans POSTMAN sur localhost, puis seulement faire la requête. Le body de la requête doit être de la forme suivante : 

```
{
    "project_id": 1,
    "amount": 100
}
```

3. Lister les projets auxquels on a apposé une marque d'intérêt en tant que user -> requête GET sur http://localhost:8020/api/interests. Même remarque que la route précédente, il faut s'identifier pour espérer voir un résultat.

## Bundles ajoutés

- HautelookAliceBundle pour pouvoir créer facilement des entités nestées à partir de fixtures
