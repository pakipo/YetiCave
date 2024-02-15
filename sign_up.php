<?php

require_once('helpers.php');
require_once('data.php');
$category = get_category();
$title = 'Регистрация';
?>

<?php
$main = include_template('sign-up.php',[
    'category'=>$category,
    'lots' =>$lots]);
$layout = include_template('layout.php',[
    'category'=>$category,'lots' =>$lots,
    'main' => $main,
    'title' => $title,
    'is_auth'=>$is_auth,
    'user_name' => $user_name
]);

print($layout);
?>
