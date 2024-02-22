<?php
$user_name = null;
$is_auth = 0;
function start_session(){
    ini_set('session.cookie_lifetime', 86400);
    ini_set('session.gc_maxlifetime', 86400);
    session_start();
}
function end_session(){
    $_SESSION = [];
} 
function set_user($name = false){
    global $user_name,$is_auth;
   
    if(!empty($name)){
        $_SESSION['username'] = $name;
        $user_name = $name;
        $is_auth = 1;
        return;
    }else{
        if(!empty($_SESSION['username'])){
            $user_name = $_SESSION['username'];
            $is_auth = 1;
        }
    }

}

function session_init(){
    start_session();
    set_user();
}