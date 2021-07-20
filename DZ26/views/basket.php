<h2>Корзина</h2>

<?php foreach ($basket as $id => $item):?>
    <div>
        <h3><?=$item?></h3>
        <button data-id="<?=$id?>" class="del">Удалить</button>

        
    </div>
<?php endforeach;?>



<script>
    let buttons = document.querySelectorAll('.del');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/?c=basket&a=delete', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json;charset=utf-8'},
                        body: JSON.stringify({
                        id: id
                        })
                    });
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                    document.getElementById('sum').innerText = answer.sum;
                }
            )();
            window.location.reload();
        })
    });
    
</script>