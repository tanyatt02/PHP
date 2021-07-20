<h2>Корзина</h2>

<?php foreach ($basket as $id => $item):?>
    <div>
        <h3><?=$item?></h3>
        <form action="/?c=basket&a=delete" method='post'>
            <input type="text" name="id" hidden value="<?=$id?>">
            <button type="submit">Удалить</button>
        </form>
        
    </div>
<?php endforeach;?>

