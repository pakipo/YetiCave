<main>
    <nav class="nav">
      <ul class="nav__list container">
        <li class="nav__item">
          <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Разное</a>
        </li>
      </ul>
    </nav>
    <form class="form container  <?= !empty($errors)?'form--invalid':''?>" action="sign_up.php" method="post" autocomplete="off"> <!-- form
    --invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <!-- email -->
      <?php $err = isset($errors)&&isset($errors['email'])?$errors['email']:null; ?>
      <div class="form__item <?= isset($err)?'form__item--invalid':'' ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input 
        id="email"
        value="<?= isset($form)&&isset($form['email'])?$form['email']:''?>"
        type="text"
        name="email"
        placeholder="Введите e-mail">
        <span class="form__error"><?= $err ?></span>
      </div>
      <!-- password -->
      <?php $err = isset($errors)&&isset($errors['password'])?$errors['password']:null ?>
      <div class="form__item <?= isset($err)?'form__item--invalid':''?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" value="<?=  isset($form)&&isset($form['password'])?$form['password']:'' ?>"  placeholder="Введите пароль">
        <span class="form__error"><?= $err?></span>
      </div>
      <!-- name -->
      <?php $err = isset($errors)&&isset($errors['name']) ? $errors['name'] : null ?>
      <div class="form__item <?= isset($err)?'form__item--invalid':''?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" value="<?= isset($form)&&isset($form['name'])?$form['name']:'' ?>" type="text" name="name" placeholder="Введите имя">
        <span class="form__error"><?=$err?></span>
      </div>
      <!-- massege -->
      <div class="form__item">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=  isset($form)&&isset($form['message'])?$form['message']:'' ?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
      </div>
      <span class="form__error form__error--bottom" >Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>

      <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
  </main> 