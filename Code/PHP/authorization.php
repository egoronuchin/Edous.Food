<?php
class Authorization{
    public function __construct(){
        $authСode = filter_input(0, 'authСode'); //Код авторизации клиента
        $login = filter_input(0, 'login'); 
        $password = md5('payforme'.filter_input(0,'password'));
        $tt = filter_input(0,'tt');
        
        include_once 'db_connect.php'; //Подключение к БД
        
        if($login AND $password){ //Авторизация для персонала
            $this->ReturnError();
            //$this->EmployAuthorization($login, $password);
        }elseif ($authСode AND $tt) { //Авторизация для клиента
            if($authСode=='00000'){
                echo json_encode(array('link'=>'PHP/menu.php'));
            }else{
                $this->ReturnError();
            }
            $this->ClientAutorization($authСode,$tt);
        }else{
            $this->ReturnError();
        }
    }
    
    private function ClientAutorization($authСode, $tt){//Авторизация для клиента
        $res = $pdo->query("SELECT COUNT(*) FROM `AUTHORIZATION` "
                . "WHERE "
                . "`ENTER_CODE` = '$authСode'"
                . "AND `END` IS NULL"
                . "AND `ID_tt` = '$tt'");
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $row=$res->fetch();
        $numrows=$row['count'];
        if($numrows==1){
            session_start();
            echo json_encode(array('link'=>'PHP/menu.php'));
        }else{
            $this->ReturnError();
        }
    }
    
    private function EmployAuthorization($login, $password){//Авторизация для персонала
        $res = $pdo->query("SELECT COUNT(ID_CONTACT),* FROM `CONTACT` "
                . "WHERE "
                . "`LOGIN` = '$login'"
                . "AND `PASSWORD` = '$password'");
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $row=$res->fetch();
        $numrows=$row['count'];
        if($numrows==1){
            $_SESSION['ID_CONTACT']=$row['ID_CONTACT'];
            session_start();
            if($row['ROLE']=='WAITER'){
                echo json_encode(array('link'=>'PHP/waiter.php'));
            }else{
                echo json_encode(array('link'=>'PHP/admin.php'));
            }
        }else{
            $this->ReturnError();
        }
    }

    private function ReturnError(){
        echo json_encode(array('error_code'=>1, 'error_text'=>'Ошибка авторизации'));
        exit();
    }
}

$obj = new Authorization;
?>