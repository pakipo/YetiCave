<?php 
require_once('helpers.php');
require_once('data/data.php');
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$lot = get_lot($id);
$category = get_category();
$title = $lot['title'];
if(isset($lot)){
   $lot_page = include_template('lot_tmpl.php',[
    'lot'=>$lot,
    'category'=>$category
]); 
}else{
    $lot_page = include_template('404.php',[
        'category'=>$category
    ]); 
}

$layout = include_template('layout.php',[
'main'=>$lot_page,
'title' => $title,
'category'=>$category,
'is_auth' => $is_auth,
'user_name' => $user_name
]
);
print($layout);