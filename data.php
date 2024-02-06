<?php
$db_con = null;
function init(){
    $count = 0;
    function connect(){
        global $count,$db_con;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
         $db_con = mysqli_connect('127.0.0.1','root','','yeticave');
         $count+=1;
    };
   connect();
    if(empty($db_con)&& $count < 3){
      
        connect();
    }else if(empty($db_con)){
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
          print('Ошибка БД:  '.$msg);
        }else{
           return mysqli_fetch_all($r, MYSQLI_ASSOC);
        }
    }
}

function get_lots($id = null)
{
    global $db_con;
    $date = time();
    if (empty($db_con)) {
        init();
    }
    if (isset($db_con)) {
        $sql = "SELECT c.*,c.id as cat_id, l.* FROM lots l
        JOIN categories c
        ON c.id = l.category_id
        WHERE l.date_finish > NOW()
        ORDER BY l.date_creation DESC
      ";
       
        $r = mysqli_query($db_con, $sql);
        if (!$r) {
            $msg = mysqli_error($db_con);
            print('Ошибка БД: ' . $msg);
        } else {
            return mysqli_fetch_all($r, MYSQLI_ASSOC);
        }
    }
}
function add_lot($lot){
    global $db_con,$user_name;
    if (empty($db_con)) {
        init();
    }
     if (isset($db_con)) {
    $sql = "INSERT INTO lots (
        date_creation,
        title,
        lot_description,
        img,
        start_price,
        date_finish,
        step,
        user_id,
        category_id
  ) values (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($db_con, $sql);
        //var-start--------------
        $title = $lot["lot-name"];
        $title = htmlspecialchars($title);
        $now = date("Y-m-d H:i:s");
        $decr = $lot ["message"];
        $decr = htmlspecialchars($decr);
        $img = $lot["path"];
        $img = htmlspecialchars($img);
        $price = (int)$lot["lot-rate"];
        $finish = $lot ["lot-date"];
        $finish = htmlspecialchars($finish);
        $step = (int)$lot["lot-step"];
        $cat =(int)$lot["category"];
        $u_id = 1;
         //var-end--------------

        mysqli_stmt_bind_param($stmt, 'ssssisiii',
        $now, $title, $decr, $img,$price,$finish,$step,$u_id,$cat);
       $ex = mysqli_stmt_execute($stmt);
       if($ex){
return mysqli_insert_id($db_con);
       }else{
        return null;
       }
 }
}
function get_lot($id)
{
    global $db_con;
    if (empty($db_con)) {
        init();
    }
    if (isset($db_con)) {
        $sql = "SELECT c.*,c.id as cat_id, l.* FROM lots l
        JOIN categories c
        ON c.id = l.category_id
        WHERE l.id = $id
        ";
        $r = mysqli_query($db_con, $sql);
        if (!$r) {
            $msg = mysqli_error($db_con);
            print('Ошибка БД: ' . $msg);
        } else {
            
            return  mysqli_fetch_assoc($r);
        }
    }
}

$is_auth = true;
$user_name = 'DM';
