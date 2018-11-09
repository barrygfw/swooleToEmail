<?php
require 'smtp.php';
/**
 * @Author: barry
 * @Date:   2018-07-12 14:29:30
 * @Last Modified by:   barry
 * @Last Modified time: 2018-11-09 12:49:10
 */
class Email
{
	/**
	 * [sentMail 发送邮件]
	 * @param  [type] $get_email      [邮件接收者邮箱]
	 * @param  [type] $mail_content   [邮件内容]
	 * @return [type]                 [description]
	 */
	public static function sentMail($get_email,$mail_content){
		
		// 邮件标题
		$mailsubject="*******";
		//设置发件人名称，名称用户可以自定义填写。
		$sender  = "*******";
		//可选，设置回信地址
		$smtpreplyto    = "";


		// 发件人的账号，填写控制台配置的发信地址,比如xxx@xxx.com
		$smtpusermail   = "**************";//发件地址
		$smtpuser       = "**************";//发件人账号

		// 访问SMTP服务时需要提供的密码(在控制台选择发信地址进行设置)
		$smtppass       = "**************";


		$smtpserver     = "smtpdm.aliyun.com";
		$smtpserverport = 25;
		$mailsubject    = "=?UTF-8?B?" . base64_encode($mailsubject) . "?=";
		$mailtype       = "HTML";


		$smtp           = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
		$smtp->debug    = false;
		$cc   ="";
		$bcc  = "";
		$additional_headers = "";

		
		//发送
		$result = $smtp->sendmail($get_email,$smtpusermail, $mailsubject, $mail_content, $mailtype, $cc, $bcc, $additional_headers, $sender, $smtpreplyto);
		if (!$result){
			$infomation['status'] = 500;
			$infomation['info'] = "邮件发送失败";
		    return $infomation;
		} else {
		    $infomation['status'] = 200;
		    $infomation['info'] = "邮件发送成功";
		    return $infomation;
		}

	}
}
