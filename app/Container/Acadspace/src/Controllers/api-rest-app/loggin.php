<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    //PARAMETROS DE LA BASE DE DATOS
    include_once 'database.php';
    /*
    $dns = "mysql:host=localhost;dbname=acadspace";
    $user = "root";
    $pass = "";*/
    //RECUPERAR DATOS DEL FORMULARIO
    $data = file_get_contents("php://input");
    $objData = json_decode($data);

    // ASIGNAR LOS VALORES A LA VARIABLE
    $name = $objData->user;
    $token = $objData->token;
    $pass = $objData->pass;

    // lIMPIAR LOS DATOS
    $name = stripslashes($name);
    $token = stripslashes($token);
    $pass = stripslashes($pass);

    if($token == 'abc479f4-eb76-494d-9873-5191c3ac5e9d'){
      try {
        $database = new Database();
        $con = $database->getConnection("developer");
        //$con = new PDO($dns, $user, $pass);
        if(!$con){
          echo "No se puede conectar a la base de datos";
        }

        $sql = " SELECT * FROM users_udec  WHERE email='".$name."' AND number_document='".$pass."' ";
       // $sql = " SELECT numbert_document,username,email FROM users_udec";

        $query = $con->prepare($sql);

          $query->execute();

          $registros = "[";

          while($result = $query->fetch()){
            if ($registros != "[") {
              $registros .= ",";
            }
            $registros .= '{"id": "'.$result["number_document"].'",';
            $registros .= '"name": "'.$result["username"].'",';
            $registros .= '"lastname": "'.$result["lastname"].'",';
            $registros .= '"email": "'.$result["email"].'",';
            $registros .= '"type_user": "'.$result["type_user"].'",';
            $registros .= '"place": "'.$result["place"].'",';
            $registros .= '"number_phone": "'.$result["number_phone"].'",';
            $registros .= '"company": "'.$result["company"].'",';
            $registros .= '"code": "'.$result["code"].'"}';
          }
          $registros .= "]";
          echo json_encode($registros);



      } catch (Exception $e) {
        echo "Erro: ". $e->getMessage();
      };
    }






