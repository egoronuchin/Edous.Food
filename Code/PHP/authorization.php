<?php
session_start();
$_POST['auth_code']=1;
if(isset($_POST['auth_code'])){ //Авторизация клиента
  echo json_encode($arr=array('session_id'=> session_id(), 'array'=>array('a'=>1,'b'=>2)));
}elseif(isset($_POST['login']) AND isset($_POST['password'])){ //Авторизация оффика
  
}


?>
