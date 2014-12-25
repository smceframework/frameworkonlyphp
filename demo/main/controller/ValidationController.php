<?php

use Smce\Core\SmController;

class ValidationController extends SmController
{
	
    public $layout='//layouts/column1';
	
	
	public function actionIndex(){
		
		$rules = array(
			'missing'   	=> 'required',
			'email'     	=> 'valid_email',
			'max_len'   	=> 'max_len,1',
			'min_len'   	=> 'min_len,4',
			'exact_len' 	=> 'exact_len,10',
			'alpha'	       	=> 'alpha',
			'alpha_numeric' => 'alpha_numeric',
			'numeric'		=> 'numeric',
			'integer'		=> 'integer',
			'boolean'		=> 'boolean',
			'float'			=> 'float',
			'valid_url'		=> 'valid_url',
			'valid_ip'		=> 'valid_ip',
			'valid_ipv4'	=> 'valid_ipv4',
			'valid_ipv6'	=> 'valid_ipv6',
			'valid_name'    => 'valid_name',
			'contains'		=> 'contains,free pro basic'
		);
		
		
		$invalid_data = array(
			'missing'   	=> '',
			'email'     	=> "not a valid email\r\n",
			'max_len'   	=> "1234567890",
			'min_len'   	=> "1",
			'exact_len' 	=> "123456",
			'alpha'	       	=> "*(^*^*&",
			'alpha_numeric' => "abcdefg12345+\r\n\r\n\r\n",
			'numeric'		=> "one, two\r\n",
			'integer'		=> "Haa3ws",
			'boolean'		=> "this is not a boolean\r\n\r\n\r\n\r\n",
			'float'			=> "not a float\r\n",
			'valid_url'		=> "\r\n\r\nhttp://add",
			'valid_ip'		=> "google.com",
			'valid_ipv4'    => "google.com",
			'valid_ipv6'    => "google.com",
			'valid_name' 	=> '*&((*S))(*09890uiadaiusyd)',
			'contains'		=> 'premium'
		);
		
		$valid_data = array(
			'missing'   	=> 'This is not missing',
			'email'     	=> 'sean@wixel.net',
			'max_len'   	=> '1',
			'min_len'   	=> '1234',
			'exact_len' 	=> '1234567890',
			'alpha'	       	=> 'ÈÉÊËÌÍÎÏÒÓÔasdasdasd',
			'alpha_numeric' => 'abcdefg12345',
			'numeric'		=> 2.00,
			'integer'		=> 3,
			'boolean'		=> FALSE,
			'float'			=> 10.10,
			'valid_url'		=> 'http://wixel.net',
			'valid_ip'		=> '69.163.138.23',
			'valid_ipv4'    => "255.255.255.255",
			'valid_ipv6'    => "2001:0db8:85a3:08d3:1319:8a2e:0370:7334",
			'valid_name' 	=> 'Sean Nieuwoudt',
			'contains'		=> 'free'
		);
		
		$this->render("index",array(
			"rules"=>$rules,
			"invalid_data"=>$invalid_data,
			"valid_data"=>$valid_data,
		));
	}
}