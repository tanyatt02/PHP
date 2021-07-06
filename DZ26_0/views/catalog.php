<h2>Каталог</h2>

<?php foreach ($catalog as $item):?>
    <div> 
        <h3><a href="/?c=product&a=card&id=<?=$item['id']?>"><?=$item['name']?></a></h3>
        <p>price: <?=$item['price']?></p>
        <form action="/?c=basket&a=add" method='post'>
            <input type="text" name="id" hidden value="<?=$item['id']?>">
            <button type="submit">Купить</button>
        </form>
            
    </div>
<?php endforeach;?>

<a href="/?c=product&a=catalog&page=<?=$page?>">Еще</a>
