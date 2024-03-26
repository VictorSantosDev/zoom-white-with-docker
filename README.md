## RUN PROJECT

```bash

- docker-compose up -d

- docker container exec app-zoom-white composer install

- docker container exec app-zoom-white php artisan migrate

- docker container exec app-zoom-white php artisan jwt:secret

- docker exec -it --user=root container-name chmod -R 777 /var/www
```

---

### RABBITMQ

```info
    URL: http://localhost:15672/

    USER: root

    PASSWORD: 12345
```

---

### INFO

```info

    VERSION PHP: 8.1
    VERSION MYSQL: 8.1
    VERSION LARAVEL: 10
    VERSION RABBITMQ: 3

```
