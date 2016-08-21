<?php
session_start();
class Controller{
	public function __construct(){
		$operation = filter_input(0, 'operation'); //полчение параметров операции от клиента
		$operation = json_decode($operation, true); // Распарсим JSON в ассоциативный массив
		switch($command['nameOperation']){
			case "returnMenu": $this->ReturnMenu(); break; //Запрос актуального меню
			case "callWaiter": $this->CallWaiter(); break; // Вызов официанта
			case "changeOrder": $this->ChangeOrder(); break; // Изменить заказ
			default: $this->ReturnError(); break; // Вернуть ошибку в случае, если указанная операция не найдена
		}
	}
	private function ReturnMenu(){
		include('models/menu.php'); 
	}
	private function CallWaiter(){
		include('models/waiter.php');
	}
	private function ChangeOrder(){
		include('models/order.php');
	}
	private function ReturnError(){ print json_encode(array('error_code'=>1, 'error_text'=>'Не верный идентификатор операции')); exit(); }
}

$obj = new Controller;
?>