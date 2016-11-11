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
/**
 * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
 * param  $number Integer Число на основе которого нужно сформировать окончание
 * param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
 *         например array('яблоко', 'яблока', 'яблок')
 * return String
 */
function getNumEnding($number, $endingArray)
{
    $number = $number % 100;
    if ($number>=11 && $number<=19) {
        $ending=$endingArray[2];
    }
    else {
        $i = $number % 10;
        switch ($i)
        {
            case (1): $ending = $endingArray[0]; break;
            case (2):
            case (3):
            case (4): $ending = $endingArray[1]; break;
            default: $ending=$endingArray[2];
        }
    }
    return $ending;
}



function JModulePosition( $position, $style=-2 )
	{
		$document    = JFactory::getDocument();
		$renderer    = $document->loadRenderer('module');
		$params        = array('style'=>$style);
		
		$contents = '';
		
		foreach (JModuleHelper::getModules($position) as $mod)
			{
				$contents .= $renderer->render($mod, $params);
			}
		return $contents;
	}
?>