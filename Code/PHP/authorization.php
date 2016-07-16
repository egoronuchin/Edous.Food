<?php
session_start();
$auth_code = $_POST['auth_code'];
if(isset($auth_code)){ //Авторизация клиента
  if($auth_code=='00000'){
    echo json_encode($arr=array('session_id'=> session_id(),'link'=>'PHP/menu.php'));
  }else{
    return_error();
  }
}elseif(isset($_POST['login']) AND isset($_POST['password'])){ //Авторизация оффика
  
}else{
  return_error();
}

function return_error(){
  echo json_encode($arr=array('session_id'=> session_id(), 'error_code'=>1, 'error_text'=>'Ошибка авторизации'));
}
?>
