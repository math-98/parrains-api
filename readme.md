# math-98/parrains

Une application web pour le parrainage en université

## Installation
 1. Clonez le dépôt sur votre serveur (`git clone git@github.com:math-98/parrains.git`), ou uploadez le manuellement en FTP
 1. Configurer votre serveur web pour pointer sur `/public`
 1. Dupliquer le fichier `.env.example` en `.env` et remplir les variables
 1. Installer les dépendances avec `composer install` et `npm install`
 1. Lancer la commande `php artisan migrate`
 
Vous pouvez créer un premier manager en vous rendant sur la route `/register`

## Développement et déploiement
Si vous souhaitez effectuer des modifications à ce projet:

 1. Téléchargez l'outil Deployer sur votre machine ([Installation](https://deployer.org/docs/installation.html))
 1. Faites un fork du projet et clonez le localement
 1. Dans le fichier `deploy.php` modifiez la valeur `repository` pour correspondre à votre dépôt
 1. Créez un fichier `hosts.yml` contenant la configuration pour se connecter à votre/vos machine(s) ([Hosts](https://deployer.org/docs/hosts.html))
 1. Pour envoyer vos modifications en ligne (Après les avoir push sur la branche `master`): `dep deploy production`

Si vous souhaitez simplement déployer les mises à jour sans faire de modification vous suivez les même étapes à l'exception que
 * Vous n'avez besoin de télécharger que le fichier [deploy.php](https://github.com/math-98/parrains/raw/master/deploy.php) dans un dossier dédié (Mettre avec le `hosts.yml`)
 * Vous n'avez pas besoin de fork le dépôt et donc pas besoin de modifier deploy.php (Juste à re-télécharger si il est mit à jour)

## Todo
 * Liaison LDAP : Permettre aux managers d'importer les listes depuis un serveur LDAP
 * Routage sous-domaine : Permettre l'hébergement de plusieurs instances sur la même version
