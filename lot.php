<?php 
require_once('helpers.php');
require_once('data/data.php');
require('services/session_service.php');

$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
   $lot = get_lot($id); 
}

$category = get_category();
$title = $lot['title'];
if(isset($_GET['out'])){
  
    end_session();
}else{
    session_init();
}
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
'user_name' =>  $user['user_name']
]
);
print($layout);