# SLAM-AP1-Estheticienne

### Voici le site
- **Accueil**
- **Connexion et Inscription**
- **Présentation**
- **Prestations**
- **Avis**
- **Contact**
### voici les accès utilisateurs
## Identifiant | mot de passe 
- **user1@gmail.com | User123 - Admin**
- **user2@gmail.com | User123**

### Prérequis
- PHP 8.x
- Symfony 7.x
- MySQL 8.x
- VSCode

### Installation
    ```bash
    composer install
    ```
    ```bash
    php bin/console doctrine:database:create
    ```
    ```bash
    php bin/console doctrine:migrations:migrate
    ```
    ```bash
    symfony server:start
    ```
    