<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>

<style>
a:link, a:visited {
  text-decoration: none;
  color: red;
}
</style>

<center>DEV MODE</center>

<?php

    $debug = 1;

    $access_token = "";
    if (isset($_GET['token'])) {
        $access_token = $_GET['token'];
    }

    $url = 'https://api.vk.com/method/wall.get';
    $result = false;


    $post_id = 12788;
    $text = "Я - За Дунцову! #дунцова2024\n\nСтать сторонником Дунцовой в ВК! - https://twidata.ru/ AAA! ABCD!!!";

    	$params = array(
        		'access_token'     => $access_token,
                        'count'          => 3,
                     //   'message'          => $text, 
        		'v' 		   => 5.199
	);

        if ($debug) {
          echo "debug data:<br/>\n";
          $str = $url . '?' . urldecode(http_build_query($params));
          var_dump($str);
        }

	$jsonTmp = file_get_contents($url . '?' . urldecode(http_build_query($params)));
        $userInfo = json_decode($jsonTmp, true);
        //if (isset($userInfo['response']['upload_url'])) {
            //$upload_url = $userInfo['response']['upload_url'];
            //$result = true;
        //}


	
    if ($debug) {
        echo "debug data:<br/>\n";
        var_dump($jsonTmp);
        var_dump($userInfo);
    }



    if ($result) {
        echo 'Failed! (code 1)<br/>';
    }



?>

</body>
</html>
