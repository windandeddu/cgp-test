## Requirements
```
1. composer
2. npm
3. docker
```
## Quick Start
1. Install packages from composer
```bash
composer install
```
2. Install packages from node
```bash
npm install
```
3. Start docker containers
```bash
. vendor/bin/sail up -d
```
4. Configure your .env file
```bash
APP_URL=http://example-app.test

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cgp_test
DB_USERNAME=root
DB_PASSWORD=password
```
If you have errors:
```
SQLSTATE[HY000] [2002] No such file or directory
SQLSTATE[HY000] [2002] Connection refused
```
Please run 
```bash
docker ps
```
And past mysql docker container name to DB_HOST

5. Add APP_URL to you hosts file (without http://)

7. Run npm
```bash
npm run build
```
7. Migrate database
```bash
php artisan migrate
```
8. Generate fake data to database. This may take a long time. Оn my laptop it takes about 30 seconds(it generates about 130k records)
```bash
php artisan db:seed
```

## Задачи

Необходимо реализовать простую црм систему:

0. Необходимо использовать AdminLTE.
1. вход в црм осуществляется с помощью логина и пароль
2. в црм должен быть список компаний. (возможность создать, изменить, удалить).
   (должны быть валидаторы входящих данных)
3. должен быть список клиентов компаний (возможность создать, изменить, удалить) (должны быть валидаторы входящих данных).
4. клиенты в базе данных должны быть связаны с компаниями.
5. таблицы должны быть описаны с помощь миграций.
6. таблицы должны наполняться тестовыми данными. (сгенерировать больше 10 тысяч значений в каждой базе)
7. реализовать три rest api метода
   - get companies - должен возвращать список компаний в формате json с возможностью пагинации
   - get clients - принимает айди компании, возвращает список клиентов в json с возможностью пагинации.
   - get client_companies - принимает айди клиента, возвращает список компаний связанных с клиентом.
8. при доступе к апи должна происходить bearer авторизация.


## API 
Для получения bearer токена, зарегистрируйте пользователя и используя Post запрос вписав в body Email и пароль, получите токен. 

Url: http://example-app.test/api/bearer/token

Body:
```
{
  "email": "example-user@example.com",
  "password": "example_password"
}
```

## Tests

```bash
php artisan test --env=local
```
