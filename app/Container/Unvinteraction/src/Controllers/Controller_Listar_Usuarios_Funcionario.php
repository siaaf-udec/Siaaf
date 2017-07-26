<?php

namespace App\Container\Unvinteraction\src\Controllers;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\Container\Unvinteraction\src\TBL_Usuarios;
use App\Container\Unvinteraction\src\TBL_Tipo_Usuario;
use App\Container\Unvinteraction\src\TBL_Estado_Usuario;
use App\Container\Unvinteraction\src\TBL_Carrera;
use App\Container\Unvinteraction\src\TBL_Documentacion_Extra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Controller_Listar_Usuarios_Funcionario extends Controller
{
    
    private $path='unvinteraction.funcionario';
    public function index()
    {                
      return view($this->path.'.Listar_Usuarios');
         
    }
public function listar()
    {
 $usuario= TBL_Usuarios::join('TBL_Tipo_Usuario','TBL_Usuarios.FK_TBL_Tipo_Usuario','=','TBL_Tipo_Usuario.PK_Tipo_Usuario')
            ->join('TBL_Carrera','TBL_Usuarios.FK_TBL_Carrera','=','TBL_Carrera.PK_Carrera')
            ->join('TBL_Estado_Usuario','TBL_Usuarios.FK_TBL_Estado_Usuario','=','TBL_Estado_Usuario.PK_Estado_Usuario')
            ->select('TBL_Usuarios.PK_Usuario','TBL_Usuarios.Usuario','TBL_Usuarios.Contraseña','TBL_Usuarios.Nombre','TBL_Usuarios.Apellido','TBL_Usuarios.Correo','TBL_Usuarios.Telefono', 'TBL_Tipo_Usuario.Descripcion','TBL_Carrera.Carrera', 'TBL_Estado_Usuario.Estado')
            ->get();
        
      //return view($this->path.'.Listar_Usuarios');
        return Datatables::of( $usuario)->addIndexColumn()->make(true); 
        
    }
  
    public function create()
    {
        //
        $opcion = TBL_Tipo_Usuario::all();
        $opciond = TBL_Carrera::all();
        return view($this->path.'.agregar_usuarios', compact('opcion','opciond'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $convenio = new TBL_Usuarios();
            $convenio->PK_Usuario = $request->PK_Usuario;
            $convenio->Usuario = $request->Usuario;
            $convenio->Contraseña = $request->Contraseña;
            $convenio->Nombre= $request->Nombre;
            $convenio->Apellido = $request->Apellido;
            $convenio->Correo = $request->Correo;
            $convenio->telefono = $request->PK_Usuario;
            $convenio->FK_TBL_Tipo_Usuario = $request->FK_TBL_Tipo_Usuario;
            $convenio->FK_TBL_Carrera = $request->FK_TBL_Carrera;
            $convenio->FK_TBL_Estado_Usuario = 1 ;
            $convenio->save();
            return redirect()->route('Listar_Usuarios.index');
            
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuario= TBL_Usuarios::findOrFail($id);
        $opcion = TBL_Tipo_Usuario::all();
        $opciont = TBL_Estado_Usuario::all();
        $opciond = TBL_Carrera::all();
        return view($this->path.'.Editar_Usuarios', compact('usuario','opcion','opciond','opciont'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $usuario= TBL_Usuarios::findOrFail($id);
        $usuario->Usuario =$request->Usuario;
        $usuario->Contraseña =$request->Contraseña;
        $usuario->Nombre =$request->Nombre;
        $usuario->Apellido =$request->Apellido;
        $usuario->Correo =$request->Correo;
        $usuario->Telefono =$request->Telefono;
        $usuario->FK_TBL_Tipo_Usuario =$request->FK_TBL_Tipo_Usuario;
        $usuario->FK_TBL_Carrera =$request->FK_TBL_Carrera;
        $usuario->FK_TBL_Estado_Usuario =$request->FK_TBL_Estado_Usuario;
        $usuario->save();
        return redirect()->route('Listar_Usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function documentacion($id)
    {
        return view($this->path.'.Listar_Documentos_Usuarios',compact('id'));
       
    }
    public function ListarD( $id)
    {
        
        $documento = TBL_Documentacion_Extra::where('FK_TBL_Usuarios',$id)->get();
        return Datatables::of( $documento)->addIndexColumn()->make(true);
    }
    
    
}
