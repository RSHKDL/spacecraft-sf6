### Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

### Stack

- PHP 8.1
- NGINX
- MySQL 8
- Symfony 6.4

The images are build upon [Alpine Linux](https://www.alpinelinux.org/). If you want to update the Dockerfiles,
you need to refer to the Alpine Linux documentation.

### Installation

1. Clone this repository.
2. Create your local config files:
    ```
    cp docker-env.dist docker-en
    cp docker-compose.yml.dist docker-compose.yml
    cp .env .env.local
    ```
3. Update these files and replace the `<variables>` with your data.
4. Build, start and install the project with make:
   ```
    make project-build
    make composer-install
    make init-database
    ```
5. In the `docker\nginx\symfony.conf`, update the `server_name` keys to fit your needs.
6. Report these changes in your `/etc/hosts` file.
7. Done, go to your `localhost:<port_defined_in_docker_compose>` or your configured domain:
    ```
    Exemples: 
      https://localhost:4433
      https://dev.mycustomdomain:4433 (if custom port)
      https://dev.mycustomdomain (if default 443 port)
    ```

### Troubleshooting
🤕 When installing/updating the database , if you have an error like this
`SQLSTATE[HY000] [1045] Access denied for user 'symfony'@'172.24.0.3' (using password: YES)`
make a backup of the data, remove everything under data/mysql, then rebuild the project.
