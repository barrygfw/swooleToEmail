<?php
require("Email.php");
class Server{
	/**
	 * @Author: barry
	 * @Date:   2018-11-08 21:47:05
	 * @Last Modified by:   barry
	 * @Last Modified time: 2018-11-09 12:44:58
	 */
	public $serv = null;

	public function __construct(){

		//创建server对象，监听127.0.0.1:9812端口
		$this->serv=new swoole_server("127.0.0.1",9812);

		//基本配置
		$this->serv->set(array('task_worker_num' => 4));

		//注册回调函数
		$this->serv->on('receive',[$this,'onReceive']);
		$this->serv->on('task',[$this,'onTask']);
		$this->serv->on('finish',[$this,'onFinish']);

		$this->serv->start();
	}

	public function onReceive($serv,$fd,$from_id,$data){
		$task_id=$this->serv->task($data);
	}

	public function onTask($serv,$task_id,$from_id,$data){
		Email::sentMail($data,"this is a test demo!");
	}

	public function onFinish($serv,$task_id,$data){

	}
}

$abc = new Server();