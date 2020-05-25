<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\View;
class Member
{
    public function Login()
    {

      $email = $_POST['email'];
      $password = $_POST['password'];


      $member = Db::table('member')->where("email = '".$email."'")->select();

      //dump($member[0]['password']);
      if($password == $member[0]['password']){

        //$_SESSION['member'] = $member;
        Session::set('member',$member);
        dump($_SESSION);
        return '200';
        

      }else{

        return 'error';

      }
      
/*
      $email = $_POST['email'];
      $password = $_POST['password'];
      if($email == '123'){
        
        return '200';

      }else{

        return 'error';

      }

      */
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
