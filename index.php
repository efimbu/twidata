<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>


<center>Профиль сторонника Дунцовой</center>


<?php

    $client_id = '51825201'; 
    $client_secret = 'Jp4IbC0ZbWKKp26HTKOu';
    $redirect_uri = 'https://twidata.ru/vktest/';

    $url = 'https://oauth.vk.com/authorize';

    // 'scope' => 0+4 - Photos
    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'scope' => 0+4,
        'response_type' => 'code',
        'v' => 5.199
    );

    $link = '<br/><center><p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Авторизироваться через ВКонтакте</a></p></center><br/>';
    echo $link;

?>


<br/><br/><br/><br/><br/><center><small><a href="https://vk.com/efim.bushmanov">(c) Ефим Бушманов</a></small></center>
</body>
</html>
