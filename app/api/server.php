<?php

    $mysqli = new mysqli('localhost', 'root', '', 'movies');
    $mysqli->set_charset('utf8');
    /* $mysqli = mysqli_connect('localhost', 'root', '', 'movies'); */

    if (mysqli_connect_errno()) {
        printf("Erorrrr", mysqli_connect_error());
        exit();
    }

    /* $inputJSON = file_get_contents('php://input'); */
    $input = json_decode(file_get_contents('php://input'), true) ?? [];


    $repa = $mysqli->query("SELECT EXISTS(SELECT `email` FROM `persons` WHERE `email` = '" . $input["email"] . "')");
    $repa_name = $mysqli->query("SELECT EXISTS(SELECT `name` FROM `persons` WHERE `email` = '" . $input["email"] . "')");
    $repa2 = $repa->fetch_array();
    $repa_name2 = $repa_name->fetch_array();
    var_dump($repa_name2);


    function getIp() {
        $keys = [
          'HTTP_CLIENT_IP',
          'HTTP_X_FORWARDED_FOR',
          'REMOTE_ADDR'
        ];
        foreach ($keys as $key) {
          if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
              return $ip;
            }
          }
        }
      }
      
    $ip = getIp();


    if($repa2[0] == 1) {
        echo "Email is exist";
    } else if($repa_name2[0] == 1) {
        echo "Name is exist";
    } else {
        $password = md5(md5(trim($input["psw"])));

        mail('SergeyFishss@yandex.ru', 'My Subject', "edjbfdibc");

        $query = "INSERT INTO persons VALUES('" . $input["nameS"] . "', '" . $input["email"] . "', '" . $password . "', '" . $ip . "',NULL)";
        $mysqli->query($query);
    }

    

    /* $ip_server = $_SERVER['SERVER_ADDR'];
    echo $ip_server; */

    $mysqli->close(); 

    /* $query = "UPDATE persons SET category_id = 1 WHERE pin = 256";
    $mysqli->query($query); */

    /* $query = "DELETE FROM persons WHERE pin = 321";
    $mysqli->query($query); */

?>