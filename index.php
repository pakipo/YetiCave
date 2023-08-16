<?php

require_once('helpers.php');
require_once('data.php');


$title = 'Главная';
$is_auth = rand(0, 1);
$user_name = 'DIMA'; // укажите здесь ваше имя
?>

<?php
$main = include_template('main.php',[
    'category'=>$category,
    'lots' =>$lots]);
$layout = include_template('layout.php',[
    'category'=>$category,'lots' =>$lots,
    'main' => $main,
    'title' => $title]);

print($layout);
?>


