<?php 
$form = null;
$errors = [];
const PASS_MIN_LEN = 5;
const PASS_MAX_LEN = 10;
const NAME_MIN_LEN = 2;
const NAME_MAX_LEN = 10;
function validate_form(&$f){
    global $form,$rules,$errors,$required;
if(isset($f)){
$form = $f;
}
foreach($form as $k=>$v){
$rule = $rules[$k];
if(!empty($rule)){
    $errors[$k] = $rule($v, in_array($k, $required));
}
}
$errors = array_filter($errors);
return $errors;
}

$rules = [
    'email'=> function($val,$isRauired){
        global $err_msg;
         if($isRauired && empty($val)){
            return $err_msg['email']['required'];
         }

         if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
           return $err_msg['email']['format'];
         }
         
         if(isDublicateEmail($val)){
            return $err_msg['email']['dublicate'];
         }
    },
    'password' => function ($val,$isRauired){
        global $err_msg;
        if($isRauired && empty($val)){
            return $err_msg['password']['required'];
         }
         if(strlen($val)<PASS_MIN_LEN){
            return $err_msg['password']['minLength'];
         }
         if(strlen($val)>PASS_MAX_LEN){
            return $err_msg['password']['maxLength'];
         }
    },
    'name' => function($val,$isRauired){
        global $err_msg;
        if($isRauired && empty($val)){
            return $err_msg['name']['required'];
         }
         if(strlen($val)<NAME_MIN_LEN){
            return $err_msg['name']['minLength'];
         }
         if(strlen($val)>NAME_MAX_LEN){
            return $err_msg['name']['maxLength'];
         }
         if(isDublicateName($val)){
            return $err_msg['name']['dublicate'];
         }
    }
];

$err_msg = [
'email'=>[
    'required'=>'Введите эл. почту',
    'format' => 'Неверный формат эл. почты',
    'dublicate'=>'Аккаунт с такой эл. почтой уже существует'
],
'password'=>[
    'required'=>'Введите пароль',
    'minLength' => 'Пароль должен быть не менее '.PASS_MIN_LEN. get_noun_plural_form(PASS_MIN_LEN,' символа',' символов',' символов'),
    'maxLength' => 'Пароль должен быть не более '.PASS_MAX_LEN. get_noun_plural_form(PASS_MAX_LEN,' символа',' символов',' символов'),
],
'name'=>[
    'required'=>'Введите имя аккаунта',
    'minLength' => 'Имя должно быть не менее '.NAME_MIN_LEN. get_noun_plural_form(NAME_MIN_LEN,' символа',' символов',' символов'),
    'maxLength' => 'Имя должно быть не более '.NAME_MAX_LEN. get_noun_plural_form(NAME_MAX_LEN,' символа',' символов',' символов'),
    'dublicate'=>'Аккаунт с таким именем уже существует'
]
];

$required = [
    'email',
    'password',
    'name'
];