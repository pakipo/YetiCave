<?php
$title = 'Главная';
require('helpers.php');
function formatPrice($price):string{
$price = ceil($price);
if($price > 1000){
    $price = number_format($price,0,"."," " );
}

return $price . ' ₽';
}

$is_auth = rand(0, 1);
$category = [
    'boards'=>'Доски и лыжи',
     'attachment'=>'Крепления',
     'boots'=>'Ботинки',
     'clothing'=>'Одежда',
     'tools'=>'Инструменты',
     'other'=>'Разное'];
    $lots = [
['name'=>'2014 Rossignol District Snowboard',
 'categoty' => $category['boards'],
 'price' => '10999',
 'img' => 'img/lot-1.jpg'
    ],
    ['name'=>'DC Ply Mens 2016/2017 Snowboard',
 'categoty' => $category['boards'],
 'price' => '159999',
 'img' => 'img/lot-2.jpg'
],
['name'=>'Крепления Union Contact Pro 2015 года размер L/XL',
 'categoty' => $category['attachment'],
 'price' => '8000',
 'img' => 'img/lot-3.jpg'
],
['name'=>'Ботинки для сноуборда DC Mutiny Charocal',
'categoty' =>$category['boots'],
'price' => '10999',
'img' => 'img/lot-4.jpg'
],
['name'=>'Куртка для сноуборда DC Mutiny Charocal',
 'categoty' =>$category['clothing'] ,
 'price' => '7500',
 'img' => 'img/lot-5.jpg'
],
['name'=>'Маска Oakley Canopy',
 'categoty' => $category['other'],
 'price' => '5400',
 'img' => 'img/lot-6.jpg'
]

    ];

$user_name = 'DIMA'; // укажите здесь ваше имя
?>

<?php
$main = include_template('main.php',['category'=>$category,'lots' =>$lots]);
$layout = include_template('layout.php',['category'=>$category,'lots' =>$lots,'main' => $main,'title' => $title]);

print($layout);
?>


