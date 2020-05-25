<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\View;
class Save
{
    public function login()
    {
		/*
		$email = $_POST['email'];
		$password = $_POST['password'];
		if($email == '123'){
			
			return '200';
		}else{
			return 'error';
		}*/
		
		//$_GET['userid'];
		//$sempilot_fat = Db::table('logintest')->where("id = '".$_GET['userid']."'")->select();
		
		return 'OK';
    }

    public function getJSON()
    {

		$sempilot_fat = Db::table('addlist')->where("sUserName = '".$_GET['sUserName']."'")->select();
		
		return json_encode($sempilot_fat);
    }
	
    public function addlist()
    {
		$addinfo_count = Db::table('addlist')->where("sUserName = '".$_GET['sUserName']."'")->count();
		$addinfo_count  = str_pad($addinfo_count,3,'0',STR_PAD_LEFT);
		$_GET['sDate'] = date("Y-m-d H:i:s");
		
		$_GET['listID'] = $_GET['sUserName'].$addinfo_count;
		$sempilot_fat = Db::table('addlist')->insert($_GET);
		

    }
    public function addinfo()
    {
		$addinfo_count = Db::table('addlist')->where("sUserName = '".$_GET['sUserName']."'")->count();
		
		if(!$addinfo_count)$addinfo_count=1;
		
		$addinfo_count  = str_pad($addinfo_count,3,'0',STR_PAD_LEFT);

		$_GET['listID'] = $_GET['sUserName'].$addinfo_count;
		unset($_GET['sUserName']);
		
		$sempilot_fat = Db::table('addinfo')->insert($_GET);
		

    }
    public function tabbase()
    {
		$sempilot_fat = Db::table('addinfo')->where("listID = '".$_GET['id']."'")->select();
		
		return json_encode($sempilot_fat);
    }
	
    public function tab3()
    {
		$sempilot_fat = Db::table('addinfo')->where("listID = '".$_GET['id']."'")->select();
		
		return json_encode($sempilot_fat);
    }
	
    public function search()
    {
		$sempilot_fat = Db::table('addlist')->where("sName = '".$_GET['key']."' and sUserName='".$_GET['sUserName']."'")->select();
		
		return json_encode($sempilot_fat);
    }
	
    public function logintest()
    {

		dump($_GET);
    }
    public function countneedle()
    {

		dump($_GET);
    }
}
