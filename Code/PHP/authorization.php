<?php
class Authorization{
    public function __construct(){
        $auth_code = filter_input(0, 'auth_code'); //Код авторизации клиента
        $login = filter_input(0, 'login'); 
        $password = md5('payforme'.filter_input(0,'password'));
        $TT = filter_input(0,'TT');
        include_once 'db_connect.php'; //Подключение к БД
        
        
        if($login AND $password){ //Авторизация для персонала
            $this.Employ_Authorization($login, $password);
        }elseif ($auth_code AND $TT) { //Авторизация для клиента
            if($auth_code=='00000'){
                echo json_encode(array('link'=>'PHP/menu.php'));
            }else{
                $this.return_error();
            }
            //$this.Client_Autorization($auth_code,$TT);
        }else{
            $this->return_error();
        }
    }
    
    private function Client_Autorization($auth_code, $TT){//Авторизация для клиента
        $res = $pdo->query("SELECT COUNT(*) FROM `AUTHORIZAION` "
                . "WHERE "
                . "`ENTER_CODE` = '$auth_code'"
                . "AND `END` IS NULL"
                . "AND `ID_TT` = '$TT'");
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $row=$res->fetch();
        $numrows=$row['count'];
        if($numrows==1){
            session_start();
            echo json_encode(array('link'=>'PHP/menu.php'));
        }else{
            $this->return_error();
        }
    }
    
    private function Employ_Authorization($login, $password){//Авторизация для персонала
        $res = $pdo->query("SELECT COUNT(ID_CONTACT),* FROM `CONTACT` "
                . "WHERE "
                . "`LOGIN` = '$login'"
                . "AND `PASSWORD` = '$password'");
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $row=$res->fetch();
        $numrows=$row['count'];
        if($numrows==1){
            session_start();
            if($row['role']=='WAITER'){
                echo json_encode(array('link'=>'PHP/waiter.php'));
            }else{
                echo json_encode(array('link'=>'PHP/admin.php'));
            }
        }else{
            $this->return_error();
        }
    }

    private function return_error(){
        echo json_encode(array('error_code'=>1, 'error_text'=>'Ошибка авторизации'));
        exit();
    }
}

$obj = new Authorization;
?>