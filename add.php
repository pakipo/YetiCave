<?php 
require('helpers.php');
require('data.php');
require('validators_lot_form.php');

$category = get_category();
$title = $lot['title'];
$errors = [];
$form = [];
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $form = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    $ids_arr = [];
    foreach($category as $c){
        $ids_arr[]=$c['id'];
    } 

    $errors = validate_add_lot_form($form, $ids_arr);
    if(empty($errors)){
        $lot_id = add_lot($form);
       if(!empty($lot_id)){
        header("Location: /lot.php?id=" .$lot_id);
       }else{
        $errors['err'] = 'Что-то пошло не так, попробуйте позже';
        renderer_page();
       } 
    }else{
        renderer_page();
    }
}else{
    renderer_page();
}

function renderer_page(){
    global $errors,$category, $title,$is_auth,$user_name,$form;
  // RENDERER
if(isset($errors)){
    $form_page = include_template('add_lot.php',
 ['category'=>$category,
 'errors' => !empty($errors)?$errors:null,
 'form'=>$form
 ]
 );  
 
 $layout = include_template('layout.php',[
 'main'=>$form_page,
 'title' => $title,
 'category'=>$category,
 'is_auth' => $is_auth,
 'user_name' => $user_name
 ]
 );
 print($layout);
 }else{
 
 }  
}



