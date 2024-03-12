
  <main>
  <nav class="nav">
      <ul class="nav__list container">
      <?php foreach ($category as $v):?>
        <li class="nav__item">
          <a href="all-lots.html"><?= $v['name_category'] ?></a>
        </li>
        <?php  endforeach;?>
      </ul>
    </nav>
    <div class="container">
      <section class="lots">
        <h2 onclick="s()">Результаты поиска по запросу «<span><?=isset($find_string)?$find_string:''?></span>»</h2>
        <?php if(!empty($lots)):?>
        <ul class="lots__list">

            <?php foreach($lots as $v): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                    <img src="<?= $v['img']?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= htmlspecialchars($v['character_code']) ?></span>
                    <h3 class="lot__title"><a class="text-link" href="/lot.php/?id=<?= $v['id'] ?>"><?= htmlspecialchars($v['title']) ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= formatPrice($v['start_price']) ?></span>
                        </div>
                        <div class="lot__timer timer">
                           <?= date("F j, G:i",strtotime($v['date_creation']))?>
                        </div>
                    </div>
                </div>
                </li>
            <?php endforeach; ?>

        </ul>
      </section>
      <?php if(!empty($pager)):?>
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a class="<?= $pager['is_first']?'disabled':''?>" href="<?= '/search_lot.php?search='. $find_string .'&page='.($pager['curr_page']-1) .'&lots_count='.$pager['lots_count'] ?>">Назад</a></li>
        <?php
        for($i=1;$i <= $pager['pages'];$i++){
          $el = '<li class="pagination-item';
          $pager['curr_page'] == $i ? $el .= ' pagination-item-active':null;
          $el .= '"><a href="/search_lot.php?search='.$find_string.'&page='. $i.'&lots_count='.$pager['lots_count'].'">'. $i .'</a></li>';
          echo $el;
        }
        ?>
        <li class="pagination-item pagination-item-prev"><a class="<?= $pager['is_last']?'disabled':''?>" href="<?= '/search_lot.php?search='. $find_string .'&page='.($pager['curr_page']+1) .'&lots_count='.$pager['lots_count'] ?>">Вперед</a></li>
        <!-- <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li> -->
      </ul>
      <?php endif;?>
      <?php else:?>
        <h1>Ничего не найдено по вашему запросу</h1>
      <?php endif;?>
    </div>
  </main>
<script>
  function s(){
    console.log('@#$!@$!@$%')
  }
</script>
