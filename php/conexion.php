<?php
    $mysqli = new mysqli("localhost","finedugt_eci_usr","k-vm{j4q~]n2","finedugt_formEci");
    //$mysqli = new mysqli("localhost","root","","finedugt_formeci");


    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Falló la conexión a MySQL: " . $mysqli -> connect_error;
        exit();
    }
    if (!$mysqli->set_charset("utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
        exit();
    } else {
        // printf("Conjunto de caracteres actual: %s\n", $mysqli->character_set_name());
    }
    $localIP = getHostByName(getHostName());

?>