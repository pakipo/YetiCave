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
    $errors = validate_form($form);
}

if(empty($errors)&&isset($form)){
    $user = get_user($form['email']);
    if(!empty($user)&& password_verify($form['password'],$user['user_password'])){
          start_session();
          set_user($user);
    header("Location: /");
    }else{
        $errors['form'] = 'Неверные почта или пароль';
    }
  
}

if(!empty($errors)|| $_SERVER['REQUEST_METHOD'] !== 'POST'){
    $main = include_template('registration.php',[
        'category'=>$category,
        'errors'=> !empty($errors)?$errors:null,
        'form' => $form,
        'is_sign_in' => 1
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
