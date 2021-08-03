Миграция данных(phinx):config настроен на базу newshop, необходимо запускать vendor\bin\phinx migrate -e development и vendor\bin\phinx seed:run -e development
Только сначала создать базу newshop


Спагетти код
Использование глобальных переменных:

В Controllers/AuthController устанавливаются и используются 
Session['mode'] (user, admin, guest, registration)(строки 16,23,66,74,89,103,120)
В принципе от этого можно избавиться, отрисовывая отдельную форму регистрации(а не в views/menu), как сейчас. 
Это антипаттерн?


Фактор невероятности
В Controllers/AuthController  ActionLogout(строки 122 и 134 )
нужна проверка, существует ли еще пользователь с таким Id.
Если почистить базу, не закрыв приложение, потом долго мучаемся с Exit







