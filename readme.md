Интеграционные тесты покарывающие 2 тесткейса, успешная транзакция и превышение суммы перевода.

##### Запуск
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate
- php bin/console make:fixtures
- php bin/console doctrine:fixtures:load
- bin/phpunit tests/TestTransaction.php

##### В проекте 3 таблицы:

- users (список пользователей)
- transaction (список транзакиций)
- bill (счета пользователей)

Отправляем GET запрос на http://domain/transactions с параметрами email_from=bettye16@p-response.com, 
email_to=meagan08@gogreenon.com, amount=100