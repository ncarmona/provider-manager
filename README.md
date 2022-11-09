# Providers manager

A provider manager developed with Symfony 4.4, MySQL and bootstrap.

## Download

Execute the following command in order to download repository code:

```bash
git clone https://github.com/ncarmona/provider-manager.git
```

If prefer you can download the code manually through the github page.

## Configuration
All the commands of this section must be executed in the root folder of the project.

### Install composer dependencies
```
composer install
```
### Apply migrations
```bash
php bin/console doctrine:migrations:migrate
```
### Configuring database settings
Open the .env file and edit __DATABASE_URL__ with your MySQL credentials.

### Migrate database
```
php bin/console doctrine:migrations:migrate
```
## Run
Ensure your server and MySQL service are running. Open your browser and type:
>http://<your_server_IP>/route/to/folder/project/public/index.php