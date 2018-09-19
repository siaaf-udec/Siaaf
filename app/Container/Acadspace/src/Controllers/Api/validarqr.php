<?php
header("Access-Control-Allow-Origin:*");
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
    $id = $objData->id;
    $hash = $objData->hash;
    $token = $objData->token;
    $fecha = $objData->fecha;

    // lIMPIAR LOS DATOS
    $id = stripslashes($id);
    $hash = stripslashes($hash);
    $token = stripslashes($token);
    //$fecha = stripslashes($fecha);

    if($token == 'abc479f4-eb76-494d-9873-5191c3ac5e9d'){
      try {
        $database = new Database();
        $con = $database->getConnection("developer");
        //$con = new PDO($dns, $user, $pass);
        if(!$con){
          echo "No se puede conectar a la base de datos";
        }

        $flag;

        $sql = " SELECT * FROM users_udec  WHERE company ='".$hash."' AND number_document='".$id."' ";
       // $sql = " SELECT numbert_document,username,email FROM users_udec";

        $query = $con->prepare($sql);

          $query->execute();


          while($result = $query->fetch()){
            if($result == null){
              $flag = true;
            }
            else{
              if(substr($fecha, 0, -13) == substr($result["updated_at"], 0, -9)){
                $flag = false;
              }
              else{
                $flag = true;
              }


            }
          }

          echo json_encode($flag);



      } catch (Exception $e) {
        echo "Erro: ". $e->getMessage();
      };

    }
  ?>




