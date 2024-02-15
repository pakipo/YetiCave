<?php

$errors = [];
$ids_arr = [];
$lot = null;
const ERR_MSG_MIN_LEN = 20;
const ERR_MSG_MAX_LEN = 250;
function validate_add_lot_form(&$form, $ids)
{
    global $errors, $ids_arr, $lot, $rules, $required;
  
    if (isset($ids)) {
        $ids_arr = $ids;
    }
    if (isset($form)) {
       $lot = &$form;
    }
    foreach ($lot as $k => $v) {
        $rule = $rules[$k];
        if(isset($rule)){
             $errors[$k] = $rule($v, in_array($k, $required));  
        }
     
    }
    $errors = array_filter($errors);
    
    $file_err = file_rule($lot);
    if(isset($file_err)){
        $errors['lot-img'] = $file_err;
    }
    return $errors;
}

$rules = [
    'lot-name' => function ($val, $isRequired=false) {
        global $err_msg;
        if (isset($isRequired) && empty($val)) {
            return $err_msg['lot-name']['required'];
        }
    },
    'category' => function ($val, $isRequired=false) {
        global $err_msg,$ids_arr;
        if (isset($isRequired) && empty($val)) {
            return $err_msg['category']['required'];
        }
        if(!in_array($val,$ids_arr)){
            return $err_msg['category']['not_exist'];
        }

    },
    'message' => function ($val, $isRequired=false) {
        global $err_msg;
        if (isset($isRequired) && empty($val)) {
            return $err_msg['message']['required'];
        }
        if(mb_strlen(str_replace(array(" "), '', $val),'utf-8') < ERR_MSG_MIN_LEN ){
            return $err_msg['message']['minLength'];
        }

        if(mb_strlen(str_replace(array(" "), '', $val),'utf-8') > ERR_MSG_MAX_LEN) {
            return $err_msg['message']['maxLength'];
        }

    },
    'lot-rate' => function ($val, $isRequired=false) {
        global $err_msg;
        if (isset($isRequired) && empty($val)) {
            return $err_msg['lot-rate']['required'];
        }
        if(!is_numeric($val)){
            return $err_msg['lot-rate']['is_numeric'];
        }
    },
    'lot-step' => function ($val, $isRequired=false) {
        global $err_msg,$lot;
        function min_num($v){
            return $v*0.05;
        };
        function max_num($v){
            return $v*0.15;
        };
        if (isset($isRequired) && empty($val)) {
            return $err_msg['lot-step']['required'];
        }
        if(!is_numeric($val)){
            return $err_msg['lot-step']['is_numeric'];
        }
        if(isset($lot['lot-rate'])&&$lot['lot-rate']>0){
            if($val < min_num($lot['lot-rate'])){
                return $err_msg['lot-step']['min_step'];
        }
             if($val > max_num($lot['lot-rate'])){
                return $err_msg['lot-step']['max_step'];
        }
        }
      
    },
    'lot-date'=> function ($val, $isRequired=false) {
        global $err_msg;
        $date = DateTimeImmutable::createFromFormat('Y-m-d',$val);
        $currDate = new DateTimeImmutable();
        if (isset($isRequired) && empty($val)) {
            return $err_msg['lot-date']['required'];
        }
        if($date <  $currDate->add(new DateInterval('P3D'))){
            return $err_msg['lot-date']['min_date'];
        }
        if($date >  $currDate->add(new DateInterval('P1M'))){
            return $err_msg['lot-date']['max_date'];
        }
    },
    'lot-img'=>function ($val, $isRequired=false) {
        global $err_msg;
        if (isset($isRequired) && empty($val)) {
            return $err_msg['lot-img']['required'];
        }
    }
];

function save_file($file,$type){
$name = uniqid().$type;
$path = 'uploads/'.$name;
move_uploaded_file($file["tmp_name"], $path);
return $path;
}
function file_rule(&$lot){
    global $required,$err_msg;
$type_txt = null;
    if(in_array('lot-img', $required)&&(empty($_FILES)||empty($_FILES['lot-img'])|| (isset($_FILES['lot-img']["error"])&&$_FILES['lot-img']["error"]==4))){
        return $err_msg['lot-img']['required'];
    }else{
        
        switch($_FILES['lot-img']['type']){
            
            case  "image/png" : 
                $type_txt = '.png';
                break;
            case  "image/jpeg" : 
                 $type_txt = '.jpeg';
                break;
            case  "image/jpg" : 
                     $type_txt = '.jpg';
                     break;
        }

        if(empty($type_txt)){
           return $err_msg['lot-img']['incorrect_type'];
        }
    }
if(empty($_FILES['lot-img']["error"])){
   $lot['path'] = save_file($_FILES['lot-img'],$type_txt);
}
    return null;
}

$err_msg = [
    'lot-name' => [
        'required' => 'Поле "Наименование лота" обязательно к заполнению'
    ],
    'category' => [
        'required' => 'Выберите категорию',
        'not_exist' => 'Такой категории не существует'
    ],
    'message'=>[
        'required' => 'Добавте описание лота',
        'minLength' => 'Минимальная длина описания '.ERR_MSG_MIN_LEN.' '.get_noun_plural_form(ERR_MSG_MIN_LEN,'символ','символа','символов'),
        'maxLength' => 'Максимальная длина описания '.ERR_MSG_MAX_LEN.' '.get_noun_plural_form(ERR_MSG_MAX_LEN,'символ','символа','символов'),
    ],
    'lot-rate'=>[
        'required' => 'Добавьте начальную цену лота',
        'is_numeric'=> 'Введите число'
    ],
    'lot-step'=>[
        'required' => 'Добавьте шаг ставки',
        'is_numeric'=> 'Введите число',
        'min_step' => 'Мин. шаг ставки 5% от цены',
        'max_step' => 'Макс. шаг ставки 15% от цены'
    ],
    'lot-date'=>[
        'required' => 'Добавьте дату окончания торгов',
        'min_date' => 'Минимальная дата окончания торгов - 3 дня с момента создания лота',
        'max_date' => 'Торги длятся не более 1 месяца с момента создания лота',
    ],
    'lot-img' => [
        'required' => 'Добавьте изображение для лота',
        'incorrect_type' => 'Файл может иметь только расширениz .png, .jpg, .jpeg'
    ]

];
$required = [
    'lot-name',
    'category',
    'message',
    'lot-rate',
    'lot-step',
    'lot-date',
    'lot-img'
];
