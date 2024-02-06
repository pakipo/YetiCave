 <!--var:
(Array) category -- список категорий;
-->
  <main>
    <nav class="nav">
      <ul class="nav__list container">
        <?php foreach($category as $c):?>
        <li class="nav__item">
          <a href="all-lots.html"><?= $c['name_category']?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>

                                           <!-- FORM START -->
    <form class="form form--add-lot container form--invalid" action="add.php" method="POST" enctype="multipart/form-data"> 
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <!-- NAME -->
        <?php $err = isset($errors)&&isset($errors['lot-name'])? $errors['lot-name'] : '' ?>
        <div class="form__item <?= $err!=='' ?'form__item--invalid':''  ?>"> <!-- form__item--invalid -->
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input id="lot-name" type="text" name="lot-name" value="<?=$form['lot-name']?>" placeholder="Введите наименование лота">
          <span class="form__error"><?=$err?></span>
        </div>
        <!-- CATEGORY -->
        <?php $err = isset($errors)&&isset($errors['category'])? $errors['category'] : '' ?>
        <div class="form__item <?= $err !== ''?'form__item--invalid':''?>"
          <label for="category">Категория <sup>*</sup></label>
          <select id="category"  name="category">
            <option value="">Выберите категорию</option>
            <?php foreach($category as $cat):?>
            <option value="<?=$cat['id'] ?>" <?= isset($form['category']) && $cat['id'] == $form['category']?'selected':''?> ><?= $cat['name_category']?></option>
            <?php endforeach;?>
          </select>
          <span class="form__error"><?= $err?></span>
        </div>
      </div>
<!-- DISCRIPTION -->
<?php $err = isset($errors)&&isset($errors['message'])? $errors['message'] : '' ?>
      <div class="form__item form__item--wide <?= $err !== ''?'form__item--invalid':''?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message"  placeholder="Напишите описание лота"><?=$form['message']?></textarea>
        <span class="form__error"><?= $err?></span>
      </div>
<!-- IMG -->
<?php $err = isset($errors)&&isset($errors['lot-img'])? $errors['lot-img'] : '' ?>
      <?php $err = isset($errors)&&isset($errors['lot-img'])? $errors['lot-img'] : '' ?>
      <div class="form__item form__item--file <?= $err !== ''?'form__item--invalid':''?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <input  name="lot-img" type="file" id="lot-img" value="<?=$form['path']?>">
          <label for="lot-img">
            Добавить
          </label>
            <span class="form__error"><?= $err?></span>
        </div>
      </div>
      <!--RATE -->
      <?php $err = isset($errors)&&isset($errors['lot-rate'])? $errors['lot-rate'] : '' ?>
      <div class="form__container-three">
        <div class="form__item form__item--small <?= $err !== ''?'form__item--invalid':''?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input id="lot-rate" type="text" value="<?=$form['lot-rate']?>" name="lot-rate" placeholder="0">
          <span class="form__error"><?= $err?></span>
        </div>
        <!-- STEP -->
        <?php $err = isset($errors)&&isset($errors['lot-step'])? $errors['lot-step'] : '' ?>
        <div class="form__item form__item--small <?= $err !== ''?'form__item--invalid':''?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input id="lot-step" value="<?=$form['lot-step']?>" type="text" name="lot-step" placeholder="0">
          <span class="form__error"><?= $err?></span>
        </div>
        <!-- DATE -->
        <?php $err = isset($errors)&&isset($errors['lot-date'])? $errors['lot-date'] : '' ?>
        <div class="form__item <?= $err !== ''?'form__item--invalid':''?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot-date" value="<?=$form['lot-date']?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
          <span class="form__error"><?= $err?></span>
        </div>
      </div>
      <?php if(isset($errors)&& empty($errors['err'])):?>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <?endif;?>
      <?php if(isset($errors)&& isset($errors['err'])):?>
      <span class="form__error form__error--bottom"><?= $errors['err']?></span>
      <?endif;?>
      <button type="submit" class="button" >Добавить лот</button>
    </form>
                                      <!-- FORM END -->
  </main>