<?php

namespace App\Container\Acadspace\src\Controllers\Api;
use App\Container\Acadspace\src\Controllers\Api\database;
use Illuminate\Support\Facades\DB;
use App\Container\Users\src\UsersUdec;

class Conection{

	public function getDataLoggin($data){
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
      $result=DB::table('users_udec')->select('users_udec.*')->where('email', '=', $name )->where('number_document', '=', $pass)->get();
      return json_encode($result);
		  } catch (Exception $e) {
			return json_encode("Erro: ". $e->getMessage());
		  };
	    }
    }
  public function setQr($data){
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
          $result=DB::table('users_udec')->where('number_document', '=', $id )->update(['company' => $hash,'updated_at' => $fecha]);
          if($result == null){
            $dados = array('mensaje' => "No es posible editar los datos");
            return json_encode($dados);
          }
          else{
            $dados = array('mensaje' => $id);
            return json_encode($dados);
          };
          } catch (Exception $e) {
          return json_encode("Erro: ". $e->getMessage());
          };
          }
    }
  public function modificardatos($data){
    $objData = json_decode($data);
    // ASIGNAR LOS VALORES A LA VARIABLE
    $email = $objData->email;
    $token = $objData->token;
    $id = $objData->id;
    $newcode = $objData->codigo;
    $telefono = $objData->telefono;
    // lIMPIAR LOS DATOS
    $email = stripslashes($email);
    $newcode = stripslashes($newcode);
    $telefono = stripslashes($telefono);
    $token = stripslashes($token);
    $id = stripslashes($id);
    
    if($token == 'abc479f4-eb76-494d-9873-5191c3ac5e9d'){
      try {
        $result=DB::table('users_udec')->where('number_document', $id )->update(['number_phone' => $telefono,'code'=>$newcode]);
        if(!$result){
          $dados = array('mensaje' => $result);
          return json_encode($dados);
        }
        else{
          $dados = array('mensaje' => $id);
          return json_encode($dados);
        };
        } catch (Exception $e) {
        return json_encode("Erro: ". $e->getMessage());
        };
    }


   }
  public function validarqr($data){
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
    $flag;
    if($token == 'abc479f4-eb76-494d-9873-5191c3ac5e9d'){
      try {
        $result=DB::table('users_udec')->select('users_udec.updated_at')->where('company', '=', $hash )->where('number_document', '=', $id)->get();
        foreach ($result as $dat){
          $valor = $dat->updated_at;
        }
        if($result == null){
          $flag = true;
        }
        else{
          if(substr($fecha, 0, -13) == substr($valor, 0, -9)){
            $flag = false;
          }
          else{
            $flag = true;
          }


        }
        return json_encode($flag);
      } catch (Exception $e) {
        return json_encode("Erro: ". $e->getMessage());
      };
    }

   }

}


