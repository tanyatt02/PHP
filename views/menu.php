<?php if ($isAuth): ?>
    Welcome <?=$username?>  <a href="/auth/logout">Exit</a> <?=''?>
<?php elseif (! $isReg): ?>
    <form action="/auth/login" method='post'>
        <p>Login<input type="text" name="name" autofocus placeholder="Логин"></p>
        <p>Password<input type="password" name="pass">
    Save? <input type='checkbox' name='save'>
        <input type="submit" name="submit" value="Вход">
        <button><a href="/auth/guest">Гость</a></button></p>
        <p><button><a href="/auth/registrationform">Регистрация</a></button></p>
    </form>
<?php else: ?>
    <form action="/auth/registration" method='post'>
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px">Ошибка <?= $error ?></div>
        <?php endif; ?>
        <p>Login<input type="text" name="name" autofocus ></p>
         
        <p>Password<input type="password" name="pass"></p>
        <p>Password repeat<input type="password" name="pass_repeat"></p>
        <p>Save? <input type='checkbox' name='save'>
        <input type="submit" name="submit"></p>
        <button><a href="/auth/cancel">Отмена</a></button>
        <p>Имя пользователя не должно быть пустым и начинаться с Guest. Пароли в указанных полях должны совпадать</p>
    
    </form>
<?php endif; ?><br>

 
<a href="/">Главная</a>
<a href="/product/catalog">Каталог</a>
<a href="/basket">Корзина (<span id="count"><?=$count ?? 0?></span>) (<span id="sum"><?=$sum ?? 0 ?></span>)</a>
<?php if ($isAdmin): ?>
<a href="/order">Orders</a>
<?php endif; ?><br>



