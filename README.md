# Classix - Petites annonces

Site pour des petites annonces locales

## Getting Started

Ces instructions vous permettront d'obtenir une copie du 
projet opérationnel sur votre machine locale à des fins de 
développement et de test. Voir déploiement pour les notes 
sur la façon de déployer le projet sur un système actif.

### Prérequis

Ce dont vous avez besoin pour deployer le projet dans un environnement local.

```
Php 7+, MySql Server 5+/MariaDb, Apache 2, PhpMyAdmin
```
Vous pourrez utiliser Mamp(MacOS), Lamp(Linux/Unix) ou Wamp/Xampp(Windows) pour déployer un environement serveur.

### Installation

Télécharger ou cloner le projet sur votre serveur.

```
https://github.com/nomoserges/classix.git
```

### Configuration
1 - Editer le fichier  classes/Crud.php
```
define('TBL_Regions', 'regions');
define('TBL_Cities', 'cities');
define('TBL_Adverts', 'adverts');
define('TBL_Categories', 'categories');
define('TBL_Images', 'images');
define('TBL_Settings', 'settings');
define('TBL_Settings_Prices', 'settings_prices');
define('TBL_Users', 'users');

...

class Crud {

  private $_host = "localhost";
  private $_username = "advertize";
  private $_password = "*c218*";
  private $_database = "advertize";
  
  ....
  
```

2 - lib/Functions.php pour spécifier l'adresse du server (VirtualHost)

```
$this->server_host = 'http://'.$_SERVER['SERVER_NAME'].'/classix/';
```

3 - Importer le dump de la base de données

```
database.sql
```

4 -  Création des comptes admin
Se connecter sur 
```
http://localhost/classix/login.php
```
avec les paramètres :
pseudo : admin
Motde passe : 123456

## Construit avec

* [Twitter Bootstrap](http://www.getboostrap.org/) - Une librairie Css
* [PhpStorm](https://jetbrains.org/) - Editeur de code Php

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Machoudi Gbadamassi** - *Initial work* - [machoudi.gbadamassi@yahoo.fr](mailto:machoudi.gbadamassi@yahoo.fr)

* **Serge Mvilongo Nomo** - *Initial work* - [nomoserges@gmail.com](mailto:nomoserges@gmail.com)

## License

Ce projet est conçu dans le cadre d'étude du master I - Miage
