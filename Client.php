<?php
class Client{
/**
 * @Author: barry
 * @Date:   2018-11-09 00:37:40
 * @Last Modified by:   barry
 * @Last Modified time: 2018-11-09 12:47:44
 */
	public $client=null;

	public function __construct(){

		//实例化客户端对象
		$this->client=new swoole_client(SWOOLE_SOCK_TCP);

		//连接服务端
		$res = $this->client->connect('127.0.0.1',9812,1);
		if(empty($res)){
			echo 'error!connect to swoole_server failed';
			die;
		}
	}

	public function sendData($data){
		$this->client->send($data);
	}
}

$aaa = new Client();
$aaa->sendData("barry_g@163.com");