<?php 

$PE_LOT_INSERT;
$PE_USER_INSERT;

function set_pe_lot_insert($db_con){
    global $PE_LOT_INSERT;
    if(isset($PE_LOT_INSERT)) return;
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
        $PE_LOT_INSERT = mysqli_prepare($db_con, $sql);
}

function set_pe_user_insert($db_con){
    global $PE_USER_INSERT;
   
    $sql = "INSERT INTO users (
        email,
        user_name,
        user_password,
        contacts
  ) values (?,?,?,?)";
        $PE_USER_INSERT = mysqli_prepare($db_con, $sql);
}
