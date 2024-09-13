# test_1

## Запуск
```bash
docker-compose up -d \
&& docker exec -it test_1_app composer install \
&& docker exec -it test_1_app symfony server:start -d
```

## Применить migrations
```bash
docker exec -it test_1_app bin/console doctrine:migrations:migrate
```

## Загрузить fixtures
```bash
docker exec -it test_1_app bin/console doctrine:fixtures:load
```

## Привести код к PSR12
```bash
docker exec -it test_1_app vendor/bin/phpcbf
```