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
    $hash = $objData->hash;
    $fecha = $objData->fecha;
    $token = $objData->token;
    $id = $objData->id;

    // lIMPIAR LOS DATOS
    $hash = stripslashes($hash);
    $token = stripslashes($token);
    $id = stripslashes($id);

    if($token == 'abc479f4-eb76-494d-9873-5191c3ac5e9d'){
      try {
        $database = new Database();
        $con = $database->getConnection("developer");
        //$con = new PDO($dns, $user, $pass);
        if(!$con){
          echo "No se puede conectar a la base de datos";
        }
        $sql = " UPDATE users_udec SET company ='".$hash."', updated_at = '".$fecha."' WHERE number_document = ".$id;
       // $sql = " SELECT numbert_document,username,email FROM users_udec";

        $query = $con->prepare($sql);

        $query->execute();

        if(!$query){
          $dados = array('mensaje' => "No es posible editar los datos");
          echo json_encode($dados);
        }
        else{
          $dados = array('mensaje' => $id);
          echo json_encode($dados);
        };



      } catch (Exception $e) {
        echo "Erro BD: ". $e->getMessage();
      };
    }


  ?>
