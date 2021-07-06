<?php if ($isAuth): ?>
Welcome <?=$username?><a href="/?c=auth&a=logout">Exit</a>
<?php else: ?>
<form action="/?c=auth&a=login" method='post'>
    <input type="text" name="name" placeholder="login">
    <input type="password" name="pass" placeholder="pass">
    <input type="submit" name="submit" placeholder="submit">
</form>
<?php endif; ?><br>
 
<a href="/">Главная</a>
<a href="/?c=product&a=catalog">Каталог</a>
<a href="/?c=basket">Корзина (<span id="count"><?=$count ?? 0?></span>) (<span id="sum"><?=$sum ?? 0 ?></span>)</a><br>