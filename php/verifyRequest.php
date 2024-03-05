<?php
    date_default_timezone_set('America/Guatemala');//colocamos la zona horario de Guatemala

    //verificamos los datos recibidos y formateamos
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $cel = $_POST['cel'];
    $campus = $_POST['campus'];
    $jornada = $_POST['jornada'];
    $modalidad = $_POST['modalidad'];
    $fecha = date('Y-m-d h:i:s', time());
    $est = 1;


    //validaciones de back-end

    if($nombre=="" || $nombre == null || strlen($nombre) < 0 || strlen($nombre) > 250){
        echo "No ha ingresado su nombre";
        return;//nombre no válido
    }

    if($mail == "" || $mail == null || strlen($mail) < 0 || strlen($mail)>300 || strpos($mail, '@') === false || strpos($mail, '.') === false){
        echo "El correo electrónico ingresado no es válido";
        return;//correo no válido
    }

    if($cel == "" || $cel == null || strlen($cel) > 15){
        echo "El número de celular ingresado no es válido";
        return;//cel no válido
    }

    if($campus == "" || $campus == null || strlen($campus) > 3){
        echo "Debe seleccionar un campus";
        return;
    }

    if($jornada == "" || $jornada == null || strlen($jornada) > 3){
        echo "Debe seleccionar una jornada";
        return;
    }

    if($modalidad == "" || $modalidad == null || strlen($modalidad) > 3){
        echo "Debe seleccionar una modalidad";
        return;
    }

    //Y luego la conexión e insert
    include 'conexion.php';
    
    if(!$mysqli){
        echo "500";//No hay conexión a la base de datos
        exit();
    }
    else{
        $mysqli->set_charset("utf8");
        $estado = 1;
        $query = $mysqli->prepare("INSERT INTO `tbl_eci_data`
        (`des_nombre`, `des_cell`, 
        `des_email`, `des_campus`, `des_jornada`, 
        `des_modalidad`, `dt_fecha_envio`, `ind_estado`) VALUES (
            ?,?,
            ?,?,?,
            ?,?,?
        )");

        $query->bind_param("sssssssi",
        $nombre,$cel,
        $mail,$campus,$jornada,
        $modalidad,$fecha,$est);

        $resultado = $query->execute();
        if(!$resultado){
            echo "500";//fallo en registro a BD
        }
        else{
            echo "100";//éxito
        }

        $query->close();
    }
?>