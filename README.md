## RUN PROJECT

```bash

- docker compose up -d

- docker compose exec app_stepcar composer install

- docker compose exec app_stepcar php artisan migrate

- docker compose exec app_stepcar php artisan jwt:secret

- docker exec -it --user=root app_stepcar chmod -R 777 /var/www

#seed

- docker compose exec app_stepcar php artisan db:seed

# Atribuir permissão de acesso para o usuário

# Comando
- docker compose exec php artisan user:assign-permission-to-user-command {email} {typeUser}

# Descrição
# {email} example@example.com
# {typeUser} ADMIN, USER ou EMPLOYEE  

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
