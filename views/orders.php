
<h2>Orders</h2>


<?php if (!empty($orders)): ?>
    <?php foreach ($orders as $item): ?>
        <div id="<?= $item['currentBasket'] ?>">
            <h2><?= $item['user_name'] ?></h2>
            <p>Телефон: <?= $item['tel'] ?></p>
            <p>Стоимость:<?= $item['sum'] ?></p>
                        
            <select class="selectStatus" data-id="<?= $item['currentBasket'] ?>">
 
                <option <?php if($item['statusOrder'] == 'new'): ?>selected<?php endif; ?> value='new'>new</option>
 
                <option <?php if($item['statusOrder'] == 'paid'): ?>selected<?php endif; ?> value='paid'>paid</option>
 
                <option <?php if($item['statusOrder'] == 'close'): ?>selected<?php endif; ?> value='close'>close</option>
 
            </select>
            <button data-id="<?= $item['currentBasket'] ?>"  class="basket"><a href="/basket/current/?currentBasket=<?=$item['currentBasket']?>">Details</a>
                </button>
        </div>
    
    <?php endforeach; ?>
    <br>
    
<?php else: ?>
    Нет заказов
<?php endif; ?>

<script>
    let status = document.querySelectorAll('.selectStatus');
    status.forEach((elem) => {
        elem.addEventListener('change', () => {
            let currentBasket = elem.getAttribute('data-id');
            let status = elem.value;
            (
                async () => {
                    const response = await fetch('/order/setStatus', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json;charset=utf-8'},
                        body: JSON.stringify({
                        currentBasket: currentBasket,
                        status: status
                        })
                    });
                    const answer = await response.json();
                   
                }
            )();
        })
    });
</script>


