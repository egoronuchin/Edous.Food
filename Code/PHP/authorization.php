<?php
Header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
class Authorization{
    public function __construct(){
		session_start();
        $authСode = filter_input(0, 'authСode'); //Код авторизации клиента
        $login = filter_input(0, 'login'); //Логин 
        $password = md5('payforme'.filter_input(0,'password')); //Пароль
        $tt = filter_input(0,'tt'); //Код торговой точки
		
        if($login AND $password){ //Авторизация для персонала
            $this->ReturnError();
            //$this->EmployAuthorization($login, $password);
        }elseif ($authСode AND $tt) { //Авторизация для клиента
            if($authСode=='00000'){
                echo json_encode(array('link'=>'PHP/menu.php'));
            }else{
                $this->ReturnError();
            }
            //$this->ClientAutorization($authСode,$tt);
        }else{
            $this->ReturnError();
        }
    }
    
    private function ClientAutorization($authСode, $tt){//Авторизация для клиента
        if($numrows==1){
            session_start();
            echo json_encode(array('link'=>'PHP/menu.php'));
        }else{
            $this->ReturnError();
        }
    }
    private function EmployAuthorization($login, $password){//Авторизация для персонала
		switch($row['ROLE']){
			case "WAITER": print json_encode(array('link'=>'PHP/waiter.php')); break;
			case "ADMINTT": print json_encode(array('link'=>'PHP/admin.php')); break;
			case "ADMINTO": print json_encode(array('link'=>'PHP/admin.php')); break;
			case "ADMIN": print json_encode(array('link'=>'PHP/admin.php')); break;
			default: $this->ReturnError(); break;
    }
    private function ReturnError($errorText=NULL){
		if($errorText==NULL)
			$errorText = 'Ошибка авторизации';
		print json_encode(array('error_code'=>1, 'error_text'=>$errorText));
        exit();
    }
}

$obj = new Authorization;
?>