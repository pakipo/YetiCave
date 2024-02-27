<?php
$user = null;
$is_auth = 0;
function start_session(){
    ini_set('session.cookie_lifetime', 86400);
    ini_set('session.gc_maxlifetime', 86400);
    session_start();
}
function end_session(){
    $_SESSION = [];
}
function set_user($u = false){
    global $user,$is_auth;
    if(!empty($u)&&is_numeric($u)){
        $usr = get_user($u);
        if(!empty($usr)){
            $_SESSION['username'] = $usr['id'];
            $user = $usr;
            $is_auth = 1;
            return;
        }
       
    }else if(!empty($u)){
            $user = $u;
            $_SESSION['username'] = $u['id'];
            $is_auth = 1;
       
    }else{
          if(!empty($_SESSION['username'])){
            $usr = get_user($_SESSION['username']);
            $user = $usr;
            $is_auth = 1;
        }
    }
}

function session_init(){
    start_session();
    set_user();
}