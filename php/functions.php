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
	
function rus_date() {
// Перевод
 $translate = array(
 "am" => "дп",
 "pm" => "пп",
 "AM" => "ДП",
 "PM" => "ПП",
 "Monday" => "Понедельник",
 "Mon" => "Пн",
 "Tuesday" => "Вторник",
 "Tue" => "Вт",
 "Wednesday" => "Среда",
 "Wed" => "Ср",
 "Thursday" => "Четверг",
 "Thu" => "Чт",
 "Friday" => "Пятница",
 "Fri" => "Пт",
 "Saturday" => "Суббота",
 "Sat" => "Сб",
 "Sunday" => "Воскресенье",
 "Sun" => "Вс",
 "January" => "Января",
 "Jan" => "Янв",
 "February" => "Февраля",
 "Feb" => "Фев",
 "March" => "Марта",
 "Mar" => "Мар",
 "April" => "Апреля",
 "Apr" => "Апр",
 "May" => "Мая",
 "May" => "Мая",
 "June" => "Июня",
 "Jun" => "Июн",
 "July" => "Июля",
 "Jul" => "Июл",
 "August" => "Августа",
 "Aug" => "Авг",
 "September" => "Сентября",
 "Sep" => "Сен",
 "October" => "Октября",
 "Oct" => "Окт",
 "November" => "Ноября",
 "Nov" => "Ноя",
 "December" => "Декабря",
 "Dec" => "Дек",
 "st" => "ое",
 "nd" => "ое",
 "rd" => "е",
 "th" => "ое"
 );
 // если передали дату, то переводим ее
 if (func_num_args() > 1) {
 $timestamp = func_get_arg(1);
 return strtr(date(func_get_arg(0), $timestamp), $translate);
 } else {
// иначе текущую дату
 return strtr(date(func_get_arg(0)), $translate);
 }
 }
 
 /* Функция создания постраницной навигации 
 $max_p - максимальное количество страниц
 $curr_p - текущая страинца
 $link - базовая ссылка, ссылка на страницу категории без номеров страниц
 $format - формат добавления номеров страниц в ссылку (ex. ?page=1)
 */
function cessel_corenavi($max_p,$curr_p,$link,$format = '%s') 
	{
		$link_sep = '';
		$prev_p = $curr_p-1;
		$next_p = $curr_p+1;
		$link = $link.$link_sep;
		
		/* Блок кнопок НАЗАД */
		$prev_text = '<span aria-hidden="true">&laquo;</span>';
		if($curr_p==1)
			{
				$prev_block="<li class='disabled'><a href='#0'>".$prev_text."</a></li>";
			}
		else
			{
				
				$prev_block = "<li><a href='".$link.sprintf ($format,$prev_p)."/' title='".$prev_text."'>".$prev_text."</a></li>";
			}
		/* Блок кнопок начальной пагинации*/
		$max_s = $curr_p - 2;
		if($max_s>=3)
			{
				$max_s=2;
			}
		if(($max_s > 2) && ($max_s < 1))
			{
				$start_block = '';
			}
		else
			{
				for($i=1;$i<=$max_s;$i++)
					{
						$start_block .= "<li><a href='".$link.sprintf ($format,$i)."/' title='Страница ".$i."'>".$i."</a></li>";
					}
			}
		/* Блок кнопок слева от текущей страницы*/
		$l_cp = $curr_p-1;
		if($l_cp<1)
			{
				$left_cp_block='';
			}
		else
			{
				$left_cp_block = "<li><a href='".$link.sprintf ($format,$l_cp)."/' title='Страница ".$l_cp."'>".$l_cp."</a></li>";
			}
		/* Блок кнопки текущей страницы*/
		$curr_block = "<li class='active'><a href='".$link.sprintf ($format,$curr_p)."/' title='Страница ".$curr_p."'>".$curr_p."</a></li>";
			
		/* Блок кнопок справа от текущей страницы*/
		$r_cp =	$curr_p+1;
		if($r_cp>$max_p)
			{
				$right_cp_block='';
			}
		else
			{
				$right_cp_block = "<li><a href='".$link.sprintf ($format,$r_cp)."/' title='Страница ".$r_cp."'>".$r_cp."</a></li>";
			}
		/* Блок кнопок конечной пагинации*/
		$min_e = $curr_p + 2;
		if($min_e <= ($max_p - 2))
			{
				$min_e = $max_p - 1;
			}
		if(($min_e < ($max_p - 1)) && ($min_e > $max_p))
			{
				$end_block = '';
			}
		else
			{
				$end_block = '';
				for($i=$min_e;$i<=$max_p;$i++)
					{
						$end_block .= "<li><a href='".$link.sprintf ($format,$i)."/' title='Страница ".$i."'>".$i."</a></li>";
					}
			}

			/* Блок кнопок ДАЛЕЕ */
		$next_text = '<span aria-hidden="true">&raquo;</span>';
		if($next_p>=($max_p-1))
			{
				$next_block = "<li class='disabled'><a href='#0'>".$next_text."</a></li>";
			}
		else
			{
				$next_block = "<li><a href='".$link.sprintf ($format,$next_p)."/' title='".$next_text."'>".$next_text."</a></li>";
			}
		/* Блок троеточие между началом и блоком кнопок слева */
		if(($max_s<($l_cp-1)))
			{
				$spaces_l = "<li><a href='#...' title=''>...</a></li>";
			}
		/* Блок троеточие между концом и блоком кнопок справа */
		if(($min_e>($r_cp+1)))
			{
				$spaces_r = "<li><a href='#...' title=''>...</a></li>";
			}

		$pagination = "<div><ul class='pagination'>";
		$pagination .= $prev_block;
		$pagination .= $start_block;
		$pagination .= $spaces_l;
		$pagination .= $left_cp_block;
		$pagination .= $curr_block;
		$pagination .= $right_cp_block;
		$pagination .= $spaces_r;
		$pagination .= $end_block;
		$pagination .= $next_block;
		$pagination .= "</ul></div>";
		return $pagination;
	}

    /**
     * mb_ucfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
	function mb_ucfirst($str, $encoding='UTF-8')
		{
			$str = mb_strtolower($str, $encoding);
			$str = mb_ereg_replace('^[\ ]+', '', $str);
			$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
				   mb_substr($str, 1, mb_strlen($str), $encoding);
			return $str;
		}

		
		
/*
 * Функция создает дубликат поста в виде черновика и редиректит на его страницу редактирования
 */
function true_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'true_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('Нечего дублировать!');
	}
 
	/*
	 * получаем ID оригинального поста
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * а затем и все его данные
	 */
	$post = get_post( $post_id );
 
	/*
	 * если вы не хотите, чтобы текущий автор был автором нового поста
	 * тогда замените следующие две строчки на: $new_post_author = $post->post_author;
	 * при замене этих строк автор будет копироваться из оригинального поста
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * если пост существует, создаем его дубликат
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * массив данных нового поста
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft', // черновик, если хотите сразу публиковать - замените на publish
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * создаем пост при помощи функции wp_insert_post()
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * дублируем все произвольные поля
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * и наконец, перенаправляем пользователя на страницу редактирования нового поста
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Ошибка создания поста, не могу найти оригинальный пост с ID=: ' . $post_id);
	}
}
add_action( 'admin_action_true_duplicate_post_as_draft', 'true_duplicate_post_as_draft' );
 
/*
 * Добавляем ссылку дублирования поста для post_row_actions
 */
function true_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=true_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Дублировать этот пост" rel="permalink">Дублировать</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'true_duplicate_post_link', 10, 2 );

// Конец финкции дублирования

?>