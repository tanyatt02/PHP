<h2>Товар</h2>

<div>
    <h3><?=$good->name?></h3>
    <p><?=$good->description?></p>
    <p>price: <?=$good->price?></p>
            <button data-id="<?=$good->id?>" class="buy">Купить</button>

</div>


<script>
    let buttons = document.querySelectorAll('.buy');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/add', {
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
        })
    });
</script>