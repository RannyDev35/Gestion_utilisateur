# Gestion_utilisateur

## Prérequis

- PHP  version >= 8.x.x (cli)
- HTML 5
- CSS 3
- Symfony CLI version >= 8.x.x (cli)
- composer version >= 2.1.6
- PhpMyadmin

## Lance en local


Cloner le projet

```bash

git clone https://github.com/RannyDev35/Gestion_utilisateur.git

```

Change le dossier vers le projet

```bash

cd Mini_projet_test

```


Installer les dependencies

```bash

composer install

```
ou 

```bash

composer update

```
Cree un base de donne

```bash

php bin/console doctrine:database:create

```

```bash
php bin/console make:migration

```

```bash
php bin/console doctrine:migrations:migrate

```



Lance le server

```bash

symfony server:start

```

 Apres lance le navigateur et executer l'address suivant
    http://127.0.0.1:8000 

## Le projet contenant

- Registre un utilisateur
- Et liste des utilisateur limite 5 utilisateur
- Pagination de la liste superieur a 5
