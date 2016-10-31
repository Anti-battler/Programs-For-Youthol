<?php
	/**
	* 
	*/
	class Co extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->model('Mo');
		}
		public function index()
		{
			# code...
			$this->load->helper('form');
			$this->load->library('form_validation');
			$code=$_GET['code'];	//得到get值
			if(!$code){
				$this->load->view('codeFail');	//获取不到微信服务器的值就返回错误页面
			}
			else{
				//需要修改appid和密匙
				$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=  &secret=  &code=$code&grant_type=authorization_code";
				$output=$this->Mo->request($url);
				$output = json_decode($output);
				$array=get_object_vars($output);
				$openid=$array['openid'];	//获得openid

				//需要修改appid和密匙
				$Purl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=  &secret=  ";
				$pOutput=$this->Mo->request($Purl);
				$pOutput = json_decode($pOutput);
				$pArray = get_object_vars($pOutput);
				$access_token= $pArray['access_token'];		//获得网页的access_token

				$infoUrl="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
				$infoOutput= $this->Mo->request($infoUrl);
				$infoOutput = json_decode($infoOutput);
				$infoArray = get_object_vars($infoOutput);
				$subscribe= $infoArray ['subscribe'];	//输出subscribe 根据其值判断是否关注了公众号
				if($subscribe==1)
				{
					$check=$this->Mo->blank($openid);	//判断用户是否注册过
					if($check==$openid)
					{
						$counts=$this->Mo->counts();
						if($counts>=100000)
						{
							$this->load->view('full');	//如果用户大于2000则载入full页面_已取消该设置，改为100000
						}
						else
						{
							$data['openid']=$check;		//传递openid，需要用隐藏的input传递给login()
							$this->load->view('login',$data);		//载入login页面
						}
					}
					else
					{
						$data['id']=$check;
						$this->load->view('id',$data);	//返回其他值（id）则直接进入id页面
					}
				}
				else{
					echo "<script>alert('请先关注一下“i律师”的微信号哦:)');history.go(-1);</script>";
				}
			}
		}
		public function login()
		{
			# code...
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','NAME','required');
			$this->form_validation->set_rules('class','CLASS','required');
			$this->form_validation->set_rules('tel','TEL','required');
			$openid=$this->input->post('openid');
			$check=$this->Mo->blank($openid);
			if($this->form_validation->run()===FALSE)
			{
				echo "<script>alert('表单提交错误，请检查信息是否填全');history.go(-1);</script>";
			}
			else if($check!=$openid){
				$data['id']=$check;
				$this->load->view('id',$data);
			}
			else
			{
				$id=$this->Mo->insert();	//表单没问题则输入数据
				$data['id']=$id;
				$this->load->view('id',$data);
			}
		}
		public function show()
		{
			# code...
			$data['list']=$this->Mo->ishow();
			$this->load->view('show',$data);
		}
	}
?>