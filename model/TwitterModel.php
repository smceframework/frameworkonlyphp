<?PHP

class TwitterModel{

	
	public function getPhoto($twitterUrl,$id,$params=""){
		
		if($params!="journalists"){
			return array("result"=>false,'message'=>'Parametreyi boş bıraktınız.');
			exit;
		}elseif(empty($id)){
			return array("result"=>false,'message'=>'ID boş bıraktınız.');
			exit;
		}elseif(empty($twitterUrl)){
			return array("result"=>false,'message'=>'Url boş bıraktınız.');
			exit;
		}
	
		$settings = array(
			'oauth_access_token' => trim(twitter_oauth_access_token),
			'oauth_access_token_secret' => trim(twitter_oauth_access_token_secret),
			'consumer_key' => trim(twitter_consumer_key),
			'consumer_secret' => trim(twitter_consumer_secret)
		);
		
		$url = 'https://api.twitter.com/1.1/users/show.json';
		
		$str="";
		if(strpos($twitterUrl, "https://twitter.com/")==0)
			$str=str_replace ("https://twitter.com/" , "" ,$twitterUrl);
		elseif(strpos($twitterUrl, "http://twitter.com/")==0)
			$str=str_replace ("http://twitter.com/" , "" ,$twitterUrl);
		elseif(strpos($twitterUrl, "twitter.com/")==0)
			$str=str_replace ("twitter.com/" , "" ,$twitterUrl);

		$getfield = '?screen_name='.$str;
		$requestMethod = 'GET';
			
		$twitter = new TwitterAPIExchange($settings);
		
		$json=$twitter->setGetfield($getfield)
					 ->buildOauth($url, $requestMethod)
					 ->performRequest();
		$result = json_decode($json);
		
		$ph2=str_replace ("normal" , "400x400" ,$result->profile_image_url);
		
		
		if (is_dir(BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id) === false)
			mkdir(BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id, 0777);
			chmod ( BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id, 0777);
			if(file_put_contents(BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id.'/'.$id.'_400x400.jpg', file_get_contents($ph2))){
				
				$resize = new ResizeImage(BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id.'/'.$id.'_400x400.jpg');
$resize->resizeTo(100, 100, 'maxWidth');
$resize->saveImage(BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id.'/'.$id.'_100x100.jpg');
				chmod ( BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id.'/'.$id.'_100x100.jpg', 0777);
				chmod ( BASE_ROOT_PATH.'/resimler/'.$params.'/'.$id.'/'.$id.'_400x400.jpg', 0777);
				/* SQL tablosu ismi ve gazeteci_id değişecek */
				if($query=DB::update('gazeteci', array(
					"imagesnormal"=>'/resimler/'.$params.'/'.$id.'/'.$id.'_100x100.jpg',
					"imagesbigger"=>'/resimler/'.$params.'/'.$id.'/'.$id.'_400x400.jpg'), "gazeteci_id=%s", $id
				))
					return array("result"=>true,'message'=>'Resim kaydedildi.','images'=>array(
					"normal"=>BASE_PATH."/".'/resimler/'.$params.'/'.$id.'/'.$id.'_100x100.jpg'
					
					));
				else
					return array("result"=>false,'message'=>'Resim kaydedilemedi.');
					
			}else
				return array("result"=>false,'message'=>'Resim yükleme işlemi başarısız.');
		
		
	}
	

}
?>