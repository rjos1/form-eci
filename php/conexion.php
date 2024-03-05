<?php
    //$mysqli = new mysqli("localhost","finedugt_catform_helper","ew;?zVr4hgt4","finedugt_catedraticos");
    //$mysqli = new mysqli("localhost","root","","formularios");
    $mysqli = new mysqli("localhost","finedugt_form_colegio_user","ToLl}n^G7P#l","finedugt_form_colegio");


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