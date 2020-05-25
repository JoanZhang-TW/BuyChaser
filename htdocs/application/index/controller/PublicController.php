<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

use pattern\recursiveCorrdination\cartRC\Proposal;
use pattern\recursiveCorrdination\cartRC\MemberFactory;

class PublicController extends Controller
{

	public function _initialize()
    {

		$member = Session::get('member');
/*
		dump($member);
		if(!$member){
			
		}
		*/
		$this->assign('member', $member);

	}
	/*
	
	public function js_location(href)
    {

        echo "<script type='text/javascript'>";
        //echo "alert('error');";
        echo "window.location.href='/public/index/index/index'";
        echo "</script>"; 
		
		$this->assign('member', $member);

	}
	*/



}
