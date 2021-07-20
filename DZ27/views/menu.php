<?php if ($isAuth): ?>
Welcome <?=$username?>  <a href="/?c=auth&a=logout">Exit</a> <?=''?>
<?php elseif (! $isReg): ?>
<form action="/?c=auth&a=login" method='post'>
    <p>Login<input type="text" name="name" autofocus placeholder="Логин"></p>
    <p>Password<input type="password" name="pass">
    Save? <input type='checkbox' name='save'>
    <input type="submit" name="submit" value="Вход">
        <button><a href="/?c=auth&a=guest">Гость</a></button></p>
    <p><button><a href="/?c=auth&a=registrationform">Регистрация</a></button></p>
</form>
<?php else: ?>
<form action="/?c=auth&a=registration" method='post'>
    <p>Login<input type="text" name="name" autofocus ></p>
    <p>Password<input type="password" name="pass"></p>
    <p>Password repeat<input type="password" name="pass_repeat"></p>
    <p>Save? <input type='checkbox' name='save'>
    <input type="submit" name="submit"></p>
    <p>Имя пользователя не должно быть пустым и начинаться с GUEST.Пароли в указанных полях должны совпадать</p>
    
</form>
<?php endif; ?><br>
 
<a href="/">Главная</a>
<a href="/?c=product&a=catalog">Каталог</a>
<a href="/?c=basket">Корзина (<span id="count"><?=$count ?? 0?></span>) (<span id="sum"><?=$sum ?? 0 ?></span>)</a><br>


