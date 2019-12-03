# math-98/parrains

Une application web pour le parrainage en université

## Installation
 1. Clonez le dépôt sur votre serveur (`git clone git@github.com:math-98/parrains.git`), ou uploadez le manuellement en FTP
 1. Configurer votre serveur web pour pointer sur `/public`
 1. Dupliquer le fichier `.env.example` en `.env` et remplir les variables
 1. Installer les dépendances avec `composer install` et `npm install`
 1. Lancer la commande `php artisan migrate`
 
Vous pouvez créer un premier manager en vous rendant sur la route `/register`

## Todo
 * Liaison LDAP : Permettre aux managers d'importer les listes depuis un serveur LDAP
