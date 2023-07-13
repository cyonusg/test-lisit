# Test todo list para lisit

## Para iniciar el pro

Prr requires [laravel](), [Vue]() and [docker]() to run.

configuration and run ours virtual enviroment
```sh
cd test-lisit
docker-compose up -d
```
Ingresamos al contenedor del api y corremos el comando de la migracion
```sh
docker exec -it test-lisit-api-1 /bin/bash
php artisan migrate --seed
```
Ahora podemos ingregsar al front a traves del navegador con
## http://localhost:8080/login


## License

MIT

> The well-being of humanity, its peace and security are unattainable, unless its unity is firmly established.
> Bahá’u’lláh
**Free Software is a big step.**