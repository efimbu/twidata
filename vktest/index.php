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

$debug = 0;

$client_id = '1'; 
$client_secret = 'u';
$redirect_uri = 'https://twidata.ru/vktest/';

if (!isset($_GET['code'])) {

    $url = 'https://oauth.vk.com/authorize';
    // 'scope' => 0+4 -- Photos

    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'scope' => 0+4,
        'response_type' => 'code',
        'v' => 5.199
    );

    $link = '<br/><center><p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Авторизироваться через ВКонтакте</a></p></center><br/>';
    echo $link;
}

?>

<?php

if (isset($_GET['code'])) {

    $url = 'https://oauth.vk.com/access_token';
    $result = false;

    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    );

    if ($debug) {
	echo $url . '?' . urldecode(http_build_query($params))."\n";
    }
	
    $tokenjson = file_get_contents($url . '?' . urldecode(http_build_query($params)));

    if ($debug) {
        var_dump($tokenjson);
    }

    $token = json_decode($tokenjson, true);

    if (isset($token['access_token'])) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v' => 5.199
        );

        $userInfoA = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfoA['response'][0]['id'])) {
            $userInfo = $userInfoA['response'][0];
            $result = true;
        }
    }

    if ($debug) {
        var_dump($userInfoA);
        var_dump($userInfo);
    }

    if ($result) {
        echo '<center>';
        echo '<br />';
        echo "ID пользователя: " . $userInfo['id'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
        echo "Пол пользователя: " . $userInfo['sex'] . '<br />';  //2 - mujskoy 1 -jen 0- ne ukazan
        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
        echo '<br />';
        echo '<img style="border: 2px solid;" src="' . $userInfo['photo_big'] . '" />'; echo "<br />";

        echo '<br />';
	echo "Изменить профиль на:";
        echo "<br/>\n";
        echo '<img style="border: 2px solid;" src="' . $userInfo['photo_big'] . '" />'; 
        echo "<br/>\n";
        echo "</center>\n";

        echo '<br/><center><p><a href="upload_photo.php?token='.$token['access_token'].'">ПОДТВЕРЖДАЮ</a></p></center><br/>';
    } else {	
        echo '<br/><center><p><a href="/">Ошибка токена!</a></p></center><br/>';
    }


}

?>

<br/><br/><br/><br/><br/><center><small><a href="https://vk.com/efim.bushmanov">(c) Ефим Бушманов</a></small></center>

</body>
</html>

