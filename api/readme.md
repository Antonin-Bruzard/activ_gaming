
# Bienvenue sur Activ Gaming
# Installation
## Pré-requis

Le fonctionnement de l'application web Activ Gaming nécessite quelques composants clés pour fonctionner.

- Environnement [NodeJS](https://nodejs.org/en/download/)
- Environnement web de base contenant: Apache2, PHP>7.0, MySQL ([Laragon](https://laragon.org/download/index.html), [Wamp](http://www.wampserver.com/en/download-wampserver-64bits/) ou autre).
- [Composer](https://getcomposer.org/download/)
- [GIT](https://git-scm.com/downloads)

## Clone et installation de base

- Cloner dans le répertoire xxx/**www**/
`git clone https://USERNAME@bitbucket.org/AntoninBru/activ_gaming.git`
- Ouvrir un terminal (Windows, Commander, Git Bash) dans le répertoire
- Taper la commande suivante dans le terminal de votre choix pour lancer l'installation **composer** 
> **Répertoire**:  xxx/www/**activ_gaming**/
`composer install`
- Taper la commande suivante pour lancer l'installation **NodeJS**
> **Répertoire**:  xxx/www/**activ_gaming**/web/
`npm install`

## Configuration

L'application nécessite la présence d'une base de données à jours pour fonctionner.
Vous devrez créer une nouvelle table et effectuer les migrations nécessaires.
- Créer une table **activ_gaming**
- Editer le fichier .ENV
 `DB_HOST=127.0.0.1`
 `DB_PORT=3306`
 `DB_DATABASE=activ_gaming`
 `DB_USERNAME=root`
 `DB_PASSWORD=`
- Mettre à jour la table activ_gaming *via les migration*
> **Astuce:** Ouvrir une console dans le répertoire activ_gaming puis exécuter la commande: `php artisan migrate`.

## Premier lancement

Activ Gaming utilise la fonction **SSR** de VueJS.
Afin que l'application puisse fonctionner correctement, vous devez **lancer cet environnement**.

    npm run dev
ou

    ./server_start.sh dev start
**C'est partie !**

# Développer (GIT)
### Mettre à jour le projet local
**Avant chaque étape de développement et l'envoi en production**, il est fortement conseillé de **mettre à niveau votre version de l'application web**.

    git pull --rebase
## Travailler dans un milieu clôt
Afin de ne pas interférer avec la branche master, il est nécessaire de procéder à la création d'une branche ou va s'y trouver le résultat de tout votre développement.

    git checkout -b nom_de_la_branche
    git checkout -b hotfix/nom_de_la_branche
## Ajouter vos modifications
### Git add 
Fichier spécifique:

    git add <file>
Toutes le modifications:

    git add .
> **Remarque**: Git add permet d'ajouter vos modification au suivis avant de faire un commit.
### Git commit

    git commit -m "Explication des modifications"

> **Remarque**: Git commit permet d'assurer le suivis de vos modification en leurs donnant un nom facilement identifiable par tous et dans le temps.
### Emballé c'est pesé !

    git push origin nom_de_la_branche

> **Remarque**: Pour des raisons de sécurité. Le **push** est **bloqué** sur la branche principale (**master**).

> **Astuce**: `git stash` et `git stash pop` permettent de copier/ coller votre travail avant un git pull --rebase.
# Work Pattern
Afin d'améliorer la coordination entre les développeurs de l'équipe. Il est obligatoire de garder un logique commune entre tous.
C'est pourquoi,  bon nombre de choses auront un calque de base que chacun devra respecter.
## Git
### Structure des branches
A définir
### Strucuture des commits
A définir
## Migration
### Structure d'une migration
A définir

    create_NomTable_table
    update_NomTable
