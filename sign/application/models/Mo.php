<?php
	/**
	* 
	*/
	error_reporting(E_ALL^E_NOTICE);
	class Mo extends CI_Model
	{
		
		function __construct()
		{
			# code...
			$this->load->database();
		}
		public function request($url, $data = null)
		{
			# code...
			    $curl = curl_init();
			    curl_setopt($curl, CURLOPT_URL, $url);
			    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			    if (!empty($data)){
			        curl_setopt($curl, CURLOPT_POST, 1);
			        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			    }
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			    $output = curl_exec($curl);
			    curl_close($curl);
			    return $output;
		}
		public function blank($openid)		//判断，如果有存在openid则返回id的值，没有则返回openid
		{
			# code...
			$query=$this->db->get_where('sign',array('openid'=>$openid));	//定义看数据库的表名
			foreach ($query->result_array() as $row)
			$a=$row['id'];
			if($a)
			{
				return $a;
			}
			else
			{
				return $openid;
			}
		}
		public function counts()	//从counts表中获取报名人数
		{
			# code...
			$id=1;
			$query=$this->db->get_where('counts',array('id'=>$id));	//定义看数据库的表名
			foreach ($query->result_array() as $row)
			$a= $row['count'];
			return $a;
		}
		public function insert()
		{
			# code...
			$name=$this->input->post('name');
			$class=$this->input->post('class');
			$tel=$this->input->post('tel');
			$openid=$this->input->post('openid');
			$data=array(
				'name'=>$name,
				'class'=>$class,
				'tel'=>$tel,
				'openid'=>$openid
				);
			$this->db->insert('sign',$data);

			$query=$this->db->get_where('counts',array('id'=>1));
			foreach ($query->result_array() as $row)
			$a= $row['count'];
			$a=$a+1;
			$this->db->where('id',1);
 			$this->db->update('counts',array('id'=>1,'count'=>$a));		//每当有一个人注册时，counts表中count会+1

			$query=$this->db->get_where('sign',array('openid'=>$openid));	//定义看数据库的表名
			foreach ($query->result_array() as $row)
			$a=$row['id'];
			return $a;
		}
		public function ishow()
		{
			# code...
			$query=$this->db->get('sign');
			return $query->result_array();
		}
	}
?>