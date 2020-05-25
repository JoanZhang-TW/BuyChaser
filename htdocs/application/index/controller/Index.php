<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\View;
class Index extends PublicController
{
    public function index()
    {
        return view('index');
    }

    public function fb()
    {
        return view('fb');
    }

    public function list_mod()
    {
        $this->ck_login();

        $mod =  $_POST['mod'];
        $goods = Db::table('pur_goods')->where('id',$mod)->select();
        $this->assign('goods', $goods);

        return view('list_customer_2');
    }

    public function do_search()
    {
        $this->ck_login();

        $good_name =  $_POST['good_name'];
        $good_size =  $_POST['good_size'];
        $good_price =  $_POST['good_price'];
        $good_num =  $_POST['good_num'];
        $good_date =  $_POST['good_date'];

        if($good_name!="")
        {
            $goods = Db::table('pur_goods')->where('goods_name',$good_name)->select();
        }

        if($good_size!="")
        {
            $goods = Db::table('pur_goods')->where('goods_size',$good_size)->select();
        }
        
        if($good_price!="")
        {
            $goods = Db::table('pur_goods')->where('goods_price',$good_price)->select();
        }

        if($good_num!=""){
            $goods = Db::table('pur_goods')->where('goods_num',$good_num)->select();
        }
        
        if($good_date!="")
        {
            $goods = Db::table('pur_goods')->where('goods_date',$good_date)->select();
        }

        $this->assign('goods', $goods);

        return view('list_customer');
    }

    public function list_customer()
    {   
        $this->ck_login();

        $member = Session::get('member');

        $goods = Db::table('pur_goods')->where("member_id='".$member['id']."'")->select();

        $this->assign('goods', $goods);

        $error = 0;
        if(count($_POST) != 0){
            foreach($_POST as $v=>$k){
                if($k==""){
                    $error = 1;
                }

            }
			
			
			
			
			
			if($error == 0){
			   // dump($_POST);
				$data = $_POST;
				$data['member_id'] = $member['id'];
				
				$file = request()->file('image');

				//dump($file);

				$path = ROOT_PATH . 'public' . DS . 'upload';

				if($file){
					
					$info = $file->move($path);
					if($info){
						// 成功上传后 获取上传信息
					   
						echo $info->getExtension().'<br>';// 输出 jpg
						
						echo $info->getSaveName().'<br>';// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
					   
						echo $info->getFilename().'<br>'; // 输出 42a79759f284b767dfcb2a0197904287.jpg

						$data['goods_img'] = '\upload'. DS .$info->getSaveName();

						if(Db::table('pur_goods')->insert($data)){
							echo "<script type='text/javascript'>";
							echo "alert('新增完成');";
							//echo "window.location.href='/public/index/index/index'";
							echo "</script>"; 
							$this->redirect('Index/list_customer');

						}else{
							echo "<script type='text/javascript'>";
							echo "alert('資料庫錯誤');";
							//echo "window.location.href='/public/index/index/index'";
							echo "</script>"; 
						}
						

					}else{
						// 上传失败获取错误信息
						echo $file->getError();
					}
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('缺少商品照片');";
					//echo "window.location.href='/public/index/index/index'";
					echo "</script>"; 
				}
				
			}else{
				echo "<script type='text/javascript'>";
				echo "alert('缺少資料');";
				//echo "window.location.href='/public/index/index/index'";
				echo "</script>"; 
			}	
						
			
        }


        $this->jquery_country();
        $this->jquery_brand();
        
       
        return view('list_customer');

    }//代購清單
	
	public function order_seller()
	{
		return view('order_seller');
	}//代購者訂單管理
	
	public function order_seller_2()
	{
		return view('order_seller_2');
	}//代購者訂單管理2
	
    public function c()
    {
        $this->ck_login();

        $member = Session::get('member');
 
        $pur_name = Db::table('pur_goods')->field('goods_name')->where('id','3')->select();
      
        $chat_type = Db::table('chatbot_orders')->field('order_type')->where('id','3')->select();

        $pur_size = Db::table('pur_goods')->field('goods_size')->where('id','3')->select();
      
        $chat_size = Db::table('chatbot_orders')->field('order_size')->where('id','3')->select();

        $pur_price = Db::table('pur_goods')->field('goods_price')->where('id','3')->select();
    
        $chat_price = Db::table('chatbot_orders')->field('order_price')->where('id','3')->select();

        if((($pur_name = $chat_type) && ($pur_size != $chat_size) && ($pur_price != $chat_price)) ||
        (($pur_name != $chat_type) && ($pur_size = $chat_size) && ($pur_price != $chat_price)) ||
        (($pur_name != $chat_type) && ($pur_size != $chat_size) && ($pur_price = $chat_price)))
        {
            Db::table('pur_goods')->where('id', '3')->setField('goods_ratio','33.33%');
        }

        if((($pur_name = $chat_type) && ($pur_size = $chat_size) && ($pur_price != $chat_price)) ||
        (($pur_name = $chat_type) && ($pur_size != $chat_size) && ($pur_price = $chat_price)) ||
        (($pur_name != $chat_type) && ($pur_size = $chat_size) && ($pur_price = $chat_price)))
        {
            Db::table('pur_goods')->where('id', '3')->setField('goods_ratio','66.67%');
        }

        if(($pur_name = $chat_type) && ($pur_size = $chat_size) && ($pur_price = $chat_price))
        {
            Db::table('pur_goods')->where('id', '3')->setField('goods_ratio','100%');
        }

        if(($pur_name != $chat_type) && ($pur_size != $chat_size) && ($pur_price != $chat_price))
        {
            Db::table('pur_goods')->where('id', '3')->setField('goods_ratio','0%');
        }

        // else if(($pur_name != $chat_type && $pur_size != $chat_size && $pur_price != $chat_price) || 
        // ($pur_name != $chat_type && $pur_size != $chat_size && $pur_price != $chat_price) || 
        // ($pur_name != $chat_type && $pur_size != $chat_size && $pur_price != $chat_price))
        // {
        //     Db::table('pur_goods')->where('id', '3')->setField('goods_ratio','0%');
        // }
 
        $pur_brand = Db::table('pur_goods')->field('goods_name')->where('id',2)->select();
      
        $chat_name = Db::table('chatbot_orders')->field('order_type')->where('id',2)->select();

        $member_name = Db::table('member')->where("id='".$member['id']."'")->select();

        $goods = Db::table('pur_goods')->select();

        $this->assign('member_name', $member_name);

        $this->assign('goods', $goods);
    }

    public function compare_seller()
    {
        $this->ck_login();

        $member = Session::get('member');
        
        return view('compare_seller');
    }

    public function seller()
    {
        $this->ck_login();

        $member = Session::get('member');

        
        return view('compare_seller');
    }
	
	public function good_customer()
	{
        $this->ck_login();

        $member = Session::get('member');

        $goods = Db::table('pur_goods')->where("member_id='".$member['id']."'")->select();

        $this->assign('goods', $goods);

		return view('good_customer');
    }//消費者商品管理
    
    public function good_seller()
	{
        $this->ck_login();

        $member = Session::get('member');

        $goods = Db::table('pur_goods')->where("member_id='".$member['id']."'")->select();

        $this->assign('goods', $goods);

		return view('good_seller');
	}//代購者商品管理
	
	public function item_customer()
	{   
        $this->ck_login();

        $member = Session::get('member');

        $orders = Db::table('chatbot_orders')->where("m_id='".$member['id']."'")->select();

        $this->assign('orders', $orders);

		return view('item_customer');
	}//消費者必買清單管理
	
	public function order_customer()
	{   
        $this->ck_login();

        $member = Session::get('member');

        $orders = Db::table('chatbot_orders')->where("id=1")->select();

        $this->assign('orders', $orders);

		return view('order_customer');
	}//消費者訂單管理
	
	public function compare_customer()
	{
		return view('compare_customer');
    }//消費者代看直播比對
    
    public function compare_customer_2()
	{   
        $this->ck_login();

        $member = Session::get('member');

        $jieba = Db::table('jieba')->where("id='".$member['id']."'")->select();

        $this->assign('jieba', $jieba);

        $goods = Db::table('chatbot_orders')
        ->where("m_id='".$member['id']."'")
        ->where("id=1")
        ->select();

        $this->assign('goods', $goods);

		return view('compare_customer_2');
	}//消費者代看直播比對_個人

    public function view()
    {
        $goods = Db::table('pur_goods')->limit(4)->select();

        $this->assign('goods', $goods);

        return view('view');
    }
    public function p_delete()
    {
        $this->ck_login();

        $member = Session::get('member');

        $c = Db::table('pur_goods')->where("member_id='".$member['id']."' and id ='".$_POST['id']."'")->delete();

        if($c){
            return '200';
        }else{
            return '404';
        }

    }
    public function management_buy()
    {
        $this->ck_login();

        $member = Session::get('member');

        $goods = Db::table('pur_goods')->where("member_id='".$member['id']."'")->select();

        $this->assign('goods', $goods);

        return view('m_buy');
    }

    public function management_insert()
    {
        $this->ck_login();

        $member = Session::get('member');


        $error = 0;
        if(count($_POST) != 0){
            foreach($_POST as $v=>$k){
                if($k==""){
                    $error = 1;
                }

            }
			
			
			
			
			
			if($error == 0){
			   // dump($_POST);
				$data = $_POST;
				$data['member_id'] = $member['id'];
				
				$file = request()->file('image');

				//dump($file);

				$path = ROOT_PATH . 'public' . DS . 'upload';

				if($file){
					
					$info = $file->move($path);
					if($info){
						// 成功上传后 获取上传信息
					   
						echo $info->getExtension().'<br>';// 输出 jpg
						
						echo $info->getSaveName().'<br>';// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
					   
						echo $info->getFilename().'<br>'; // 输出 42a79759f284b767dfcb2a0197904287.jpg

						$data['goods_img'] = '\upload'. DS .$info->getSaveName();

						if(Db::table('pur_goods')->insert($data)){
							echo "<script type='text/javascript'>";
							echo "alert('新增完成');";
							//echo "window.location.href='/public/index/index/index'";
							echo "</script>"; 
							$this->redirect('Index/management_buy');

						}else{
							echo "<script type='text/javascript'>";
							echo "alert('資料庫錯誤');";
							//echo "window.location.href='/public/index/index/index'";
							echo "</script>"; 
						}
						

					}else{
						// 上传失败获取错误信息
						echo $file->getError();
					}
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('缺少商品照片');";
					//echo "window.location.href='/public/index/index/index'";
					echo "</script>"; 
				}
				
			}else{
				echo "<script type='text/javascript'>";
				echo "alert('缺少資料');";
				//echo "window.location.href='/public/index/index/index'";
				echo "</script>"; 
			}	
			
			
			
			
			
			
			
        }


        $this->jquery_country();
        $this->jquery_brand();
        
        return view('m_insert');
    }
    public function management_modify()
    {
        $this->ck_login();

        $param= Request::instance()->param('id');

        $goods = Db::table('pur_goods')->where("id='".$param."'")->select();

        $this->assign('goods', $goods);
       

        $order_record = Db::table('order_record')->where("g_id='".$param."'")->select();

        $this->assign('order_record', $order_record);


        $this->jquery_country();
        $this->jquery_brand();

        return view('m_modify');
    }

    public function do_modify()
    {
        $this->ck_login();

        if(isset($_POST)){
            $ud_id =  $_POST['ud_id'];

            unset($_POST['ud_id']);

            $data = $_POST;

            Db::table('pur_goods')->where('id',$ud_id)->update($data);
        }

            
        $file = request()->file('image');

        //dump($file);

        $path = ROOT_PATH . 'public' . DS . 'upload';

        if($file){
            
            $info = $file->move($path);
            if($info){
                // 成功上传后 获取上传信息
               
                echo $info->getExtension().'<br>';// 输出 jpg
                
                echo $info->getSaveName().'<br>';// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
               
                echo $info->getFilename().'<br>'; // 输出 42a79759f284b767dfcb2a0197904287.jpg

                $img['goods_img'] = '\upload'. DS .$info->getSaveName();

                Db::table('pur_goods')->where('id',$ud_id)->update($img);
             

            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }

            $this->redirect('Index/list_customer', ['id' => $ud_id ]);

    }

    public function management_list()
    {

        $country = $this->jquery_country();
        
        $country = $this->jquery_brand();

        $goods = Db::table('pur_goods')->select();

        $this->assign('goods', $goods);

        return view('m_list');

    }

    public function speech_search()
    {
        

        $goods = Db::table('pur_goods')->where("goods_lo like '".$_POST['text']."'  or goods_brand like '".$_POST['text']."' ")->select();

        $this->assign('goods', $goods);

        return view('speech_search');

    }


    public function Login()
    {

      $email = $_POST['email'];
      $password = $_POST['password'];


      $member = Db::table('member')->where("email = '".$email."'")->select();

      //dump($member[0]['password']);
      if($password == $member[0]['password']){

        $_SESSION['member'] = $member[0];

        Session::set('member',$_SESSION['member']);

    //exit;
        echo "<script type='text/javascript'>";
        echo "window.location.href='/public/index/index/view'";
        echo "</script>"; 

      }else{

        echo "<script type='text/javascript'>";
        echo "alert('error');";
        echo "window.location.href='/public/index/index/index'";
        echo "</script>"; 


      }
    }



    public function order()
    {

        $this->ck_login();
        //dump($_POST);exit;

        Db::table('pur_goods')->where('id',$_POST['g_id'])->setInc('goods_num');

        Db::table('order_record')->insert($_POST);

        return 'ok';

    }

    public function api_order()
    {

        //$this->ck_login();
        //dump($_POST);exit;

        Db::table('pur_goods')->where('id',$_GET['g_id'])->setInc('goods_num');

        Db::table('order_record')->insert($_GET);

        return 'ok';

    }


    public function Logout()
    {

        Session::clear();
        echo "<script type='text/javascript'>";
        //echo "alert('error');";
        echo "window.location.href='/public/index/index/index'";
        echo "</script>"; 


    }

    function ck_login(){

        $member = Session::get('member');
        
        if($member == null){
            echo "<script type='text/javascript'>";
            echo "alert('請先登入');";
            echo "window.location.href='/public/index/index/index';";
            echo "</script>"; 
            exit;
        }
    }

    function jquery_country(){

        $country = Db::table('country')->select();

        $this->assign('country', $country);

    }

    function jquery_brand(){

        $brand = Db::table('brand')->select();

        $this->assign('brand', $brand);

    }

}
