<?php
    date_default_timezone_set('America/Guatemala');//colocamos la zona horario de Guatemala

    //verificamos los datos recibidos y formateamos
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $telf = $_POST['telf'];
    $career = $_POST['career'];
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

    if($telf != "" && $telf != null && strlen($telf) > 15){
        echo "El número telefónico ingresado no es válido";
        return;//telf no válido
    }

    //Formateo de carreras y modalidades en el formato 1;1...

    $careerStr = explode(";", $career);
    $careerJson="";
    //1 - Ingeniería Civil
    //2 - Ingeniería Industrial
    //3 - Ingeniería Mecánica
    //4 - Ingeniería Química
    //5 - Ingeniería Eléctrica
    //6 - Ingeniería Electrónica
    //7 - Ingeniería en Sistemas
    //8 - Licenciatura en Matemática
    //9 - Licenciatura en Física
    //10- Ingeniería en Alimentos
    //11- Ingeniería Biomédica
    //12- Ingeniería Ciencia de Datos y Analítica
    if(in_array("1", $careerStr)){
        $careerJson .= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("2", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("3", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("4", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("5", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("6", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("7", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("8", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("9", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("10", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("11", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    if(in_array("12", $careerStr)){
        $careerJson.= "1;";
    }
    else{
        $careerJson.= "0;";
    }

    $modalidadStr = explode(";", $modalidad);
    $modalidadJson="";
    //1 - Híbrida
    //2 - En línea
    if(in_array("1", $modalidadStr)){
        $modalidadJson .= "1;";
    }
    else{
        $modalidadJson.= "0;";
    }

    if(in_array("2", $modalidadStr)){
        $modalidadJson.= "1;";
    }
    else{
        $modalidadJson.= "0;";
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
        $query = $mysqli->prepare("INSERT INTO `tbl_student_data`
        (`des_nombre`, `des_telf`, `des_email`, 
        `des_carreras`, `des_modalidad`, `dt_fecha_envio`, 
        `ind_estado`) 
        VALUES (
            ?,?,?,
            ?,?,?,
            ?
        )");

        $query->bind_param("ssssssi",
        $nombre,$telf,$mail,
        $careerJson,$modalidadJson,$fecha,
        $est);

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