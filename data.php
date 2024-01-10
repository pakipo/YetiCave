<?php
$db_con = null;
function init(){
    $count = 0;
    function connect(){
        global $count,$db_con;
         $db_con = mysqli_connect('127.0.0.1','root','','yeticave');
         $count+=1;
    };
   connect();
    if(empty($db_con)&& $count < 3){
      
        connect();
    }else if(empty($db_con)){
        var_dump('Нет подключения к БД');die;
    }else if($db_con !== false){
        mysqli_set_charset($db_con,'utf-8');
    }
}

function get_category(){
    global $db_con;
    if(empty($db_con)){
        init();
    }
    if(isset($db_con)){
        $sql = 'SELECT * FROM categories';
        $r = mysqli_query($db_con,$sql);
        if(!$r){
          $msg = mysqli_error($db_con);
          print('Ошибка БД'.$msg);
        }else{
           return mysqli_fetch_all($r, MYSQLI_ASSOC);
        }
    }
}

function get_lots(){
    global $db_con;
    if(empty($db_con)){
        init();
    }
    if(isset($db_con)){
        $sql = 'SELECT * FROM lots l
        JOIN categories c
        ON c.id = l.category_id';
        $r = mysqli_query($db_con,$sql);
        if(!$r){
          $msg = mysqli_error($db_con);
          print('Ошибка БД'.$msg);
        }else{
           return mysqli_fetch_all($r, MYSQLI_ASSOC);
        }
    }
}
    ?>