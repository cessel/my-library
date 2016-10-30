 <?
function preparing_email($content)
	{
		
		$preg_pattern='/[\+=\\\|}{\]\["\';:?\/,><)(*&\^%$#!~` ]/';
		$content=trim($content);
		$content=preg_replace($preg_pattern, '', $content);
		$content=mb_strtolower($content);
		$content=trim($content);
		
		return $content;
	}
function recaptcha_test($g_recaptcha_response)
	{
		$secret = '6LflrgcUAAAAAHvCjUW3dOcAVai8_0hgEpTYNCeX';
		
		$myCurl = curl_init();
		curl_setopt_array($myCurl, array(
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query(array('secret'=>$secret,'response'=>$g_recaptcha_response))
		));
		$response = curl_exec($myCurl);
		curl_close($myCurl);
		$answer = json_decode($response, true);
		
			if($answer->success)
				{
					return true;
				}
			else
				{
					return $answer;
				}
		}
?>