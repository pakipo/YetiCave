<?php

require('helpers.php');
require('data/data.php');
require('validators/validator_reg_form.php');
require('services/session_service.php');
$category = get_category();
$title = 'Регистрация';
$form = null;
$errors = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $form = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    $errors = validate_form($form,true);
}

if(empty($errors)&&isset($form)){
    $form['password'] = password_hash($form['password'],PASSWORD_DEFAULT);

    $user_id = add_user($form);
    if(!empty( $user_id )){
      //  var_dump($user_id);die;
          start_session();
          set_user( $user_id );
    header("Location: /");
    }
  
}else{
    $main = include_template('registration.php',[
        'category'=>$category,
        'errors'=> !empty($errors)?$errors:null,
        'form' => $form
        ]);
    $layout = include_template('layout.php',[
        'category'=>$category,'lots' =>$lots,
        'main' => $main,
        'title' => $title,
        'is_auth'=>$is_auth,
        'user_name' => $user['user_name']
    ]);
    
    print($layout);
    
}

 
