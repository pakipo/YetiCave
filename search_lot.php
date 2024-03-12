<?php
require_once('helpers.php');
require_once('data/data.php');
require('services/session_service.php');
const PER_PAGE = 2;

$category = get_category();
$title = 'FIND';
$find_string='';
$lots_count = -1;
$curr_page = null;
$page_count = null;
$pager = null;
if(isset($_GET['out'])){
    end_session();
}else{
    session_init();
}
if(!empty($_GET['search'])){
    $find_string = trim(htmlspecialchars($_GET['search']));
}else{
    header("Location: ".$_SERVER['HTTP_REFERER']);
}

//ПАГИНАЦИЯ
$lots_count = (int)$_GET['lots_count'];
if(empty($lots_count)){
   $lots_count =  get_count_search_lot($find_string);
}
if(!empty($lots_count)&&$lots_count > PER_PAGE){
    $curr_page = (int)$_GET['page'];
if(empty($curr_page)||$curr_page<1||$curr_page > ceil($lots_count/PER_PAGE)){
    $curr_page = 1;
}
$offset = ($curr_page -1)*PER_PAGE;
$lots = search_lot($find_string,PER_PAGE,$offset);
$pager = [
    'curr_page'=>$curr_page,
    'lots_count'=>$lots_count,
    'pages' => ceil($lots_count/PER_PAGE),
    'is_first'=> $curr_page == 1,
    'is_last' => $curr_page == ceil($lots_count/PER_PAGE)
];
}else if(!empty($lots_count)&&$lots_count < PER_PAGE){
   $lots = search_lot($find_string);
}

//var_dump($_GET);die;

    




$main = include_template('search_lot.php',[
    'category'=>$category,
    'lots'=>$lots,
    'find_string'=>$find_string,
    'pager' => $pager
]);

$page = include_template('layout.php',
[
    'category'=>$category,
    'main' => $main,
    'title' => $title,
    'find_string'=>$find_string
]
);
print($page);
