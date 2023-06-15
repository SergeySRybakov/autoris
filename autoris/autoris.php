<?php

    $mysqli = new mysqli('localhost', 'root', '', 'movies');
    $mysqli->set_charset('utf8');

    if (mysqli_connect_errno()) {
        printf("Erorrrr", mysqli_connect_error());
        exit();
    }

    $input = json_decode(file_get_contents('php://input'), true) ?? [];

    $repa = $mysqli->query("SELECT EXISTS(SELECT `email` FROM `persons` WHERE `email` = '" . $input["email"] . "')");
    $repa2 = $repa->fetch_array();

    if($repa2[0] == 1) {
        $query = 'SELECT * FROM `persons` WHERE `email` = "' . $input["email"] . '"';
        $man_info = mysqli_fetch_assoc(mysqli_query($mysqli, $query));
        $man_pass = $man_info["pass"];
        $man_id = $man_info["id"];
        $man_email = $man_info["email"];

        /* var_dump($man_info);
		var_dump($man_pass);
		var_dump(md5(md5(trim($input["psw"])))); */

        if($man_pass == md5(md5(trim($input["psw"])))) {
            printf("Succes");

            session_start();

            $_SESSION["auth"] = true;

            $_SESSION["id"] = $man_id;
			$_SESSION["name"] = $man_email;



        } else {
            printf("wrong password");
        }
        
    } else {
        printf("email is not exist");
    }

    $mysqli->close(); 

?>