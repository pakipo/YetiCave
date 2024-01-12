

    <main>
        <nav class="nav">
            <ul class="nav__list container">
            <!--заполните этот список из массива категорий-->
            <?php foreach ($category as $key => $value): ?>
                <li class="nav__item">
                <a href="/"><?= $value['name_category'] ?></a>
             </li>
             <?php endforeach;?>
         
        </ul>
        <section class="lot-item container">
            <h2>404 Страница не найдена</h2>
            <p>Данной страницы не существует на сайте.</p>
        </section>
    </main>

