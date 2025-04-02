<?php 
    $weatherAPI = array();
    include('simple_html_dom.php');
    $url = 'https://www.24h.com.vn/du-bao-thoi-tiet-c568.html';
    $html = file_get_html($url);
    $table = $html->find('.tabBottomScroll',0);
    foreach($table->find('tr') as $tr) {
        $pushObj = array();
        $pushObj['City'] = $tr->find('h3' , 0)->plaintext;
        $pushObj['Current'] = clearHTML($tr->find('.bgColor' , 0)->plaintext);
        $pushObj['Today'] = clearHTML($tr->find('.cont' , 0));
        $pushObj['Tomorrow'] = clearHTML($tr->find('.cont' , 1));
        $pushObj['Next Day'] = clearHTML($tr->find('.cont' , 2));
        array_push($weatherAPI , $pushObj);
    }
    echo json_encode($weatherAPI , JSON_UNESCAPED_UNICODE);

    function clearHTML($text){
        $text = strip_tags($text);
        $text = preg_replace("~(?:&nbsp;|\h)+~u", " ", $text);
        $text = preg_replace('~\h*(\R)\s*~u', '$1', $text);
        return str_replace("\r\n", " ", trim($text));   
    }
?>