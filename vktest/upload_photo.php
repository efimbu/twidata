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

<center>Профиль сторонника Дунцовой</center>

<?php


$debug = 0;

if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
    }
}

$access_token = "";
if (isset($_GET['token'])) {
    $access_token = $_GET['token'];
}


    $url = 'https://api.vk.com/method/photos.getOwnerPhotoUploadServer';
    $result = false;


    	$params = array(
        		'access_token'     => $access_token,
        		'v' 		   => 5.131
	);

        $userInfo = json_decode(file_get_contents($url . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response']['upload_url'])) {
            $upload_url = $userInfo['response']['upload_url'];
            $result = true;
        }


    if (!$result) {
        echo 'Failed! (code 1)<br/>';
    }


////////// 111


    $photo_name = "./kotik.jpg";
    $result = false;

    //$photo_name = "./kotik2.jpg";
    //$photo_name = "/var/www/twiuser/data/www/twidata.ru/vktest/duntsova.jpg";
    //$photo_name = "./duntsova.jpg";

    $content = file_get_contents($photo_name, true);

$ch = curl_init($upload_url);

$cfile = curl_file_create($photo_name, 'image/jpeg', $photo_name);
$data = array('photo' => $cfile);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$user = curl_exec($ch);

curl_close($ch);



    $user = json_decode($user, true);

    if ($result) {
        echo '<br />';
        echo "Server: " . $user['server'] . '<br />';
        echo "HASH: " . $user['hash'] . '<br />';
        echo "Photo: " . $user['photo'] . '<br />';
    }



// 22222
// 22222
// 22222

    $url = 'https://api.vk.com/method/photos.saveOwnerPhoto';
    $result = false;

    	$params = array(
        		'access_token'     => $access_token,
        		'server'	   => $user['server'],
        		'hash'	           => $user['hash'],
        		'photo'	  	   => $user['photo'],
        		'v' 		   => 5.131
	);

        $user2all = json_decode(file_get_contents($url . '?' . urldecode(http_build_query($params))), true);

        if (isset($user2all['response'])) {
            $user2 = $user2all['response'];
            $result = true;
        }

    if ($debug) {
        var_dump($user2all);
        var_dump($user2);
    }

    if ($result) {
        echo "<br/>";
        echo '<center><p><a href="https://vk.com/"><img style="border: 2px solid black;" src="' . $user2['photo_src'] . '"/></a></p></center>';
        echo "<br/>";
	echo '<center><p><a href="https://vk.com/"><font color="red">Успешно!</font></a></p></center>';
        echo "<br/>";

    }

?>

<center>
<p>
Рассказать другим:<br/>
<textarea rows="3" cols="35" readonly>Стань сторонником Дунцовой в ВК! - https://twidata.ru/ #дунцова2024</textarea><br/>
</p>
</center>


<br/><br/><br/><br/><br/><center><small><a style="color: black" href="https://vk.com/efim.bushmanov">(c) Ефим Бушманов</a></small></center>
</body>
</html>
