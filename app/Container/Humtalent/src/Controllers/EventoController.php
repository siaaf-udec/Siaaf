<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 11/07/2017
 * Time: 10:49 PM
 */

namespace App\Container\Humtalent\src\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Event;
use App\Container\Humtalent\src\Persona;


class EventoController
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//muestra todos los documentos que esten registrados
    {

        //return view('humtalent.documentacion.listaDocumentos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//preseta el formulario para registrar un documento
    {
        //$empleados=Persona::all();
        return view('humtalent.eventos.registrarEvento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//almacena un documento enviado desde el formulario del la funcion create
    {
        $hora=$request['EVNT_Hora'];
        $hora=strtotime($hora);
        $hora=date("H:i",$hora);
        Event::create([
            'EVNT_Descripcion'  => $request['EVNT_Descripcion'],
            'EVNT_Fecha'        => $request['EVNT_Fecha'],
            'EVNT_Hora'         => $hora,//$request['EVNT_Hora'],
        ]);
        $notification=array(
            'message'=>'La información del evento fue almacenada',
            'alert-type'=>'success'
        );
        return back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//presenta el formulario para editar un documento deseado
    {
        $documento = DocumentacionPersona::find($id);
        return view('humtalent.documentacion.editarDocumento', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//se realiza la actulización de datos de los documentos
    {

        $documento= DocumentacionPersona::find($id);
        $documento->fill($request->all());
        $documento->save();
        $notification=array(
            'message'=>'La información del documento fue modificada',
            'alert-type'=>'info'
        );
        return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//se elimina el registro de un documento
    {
        StatusOfDocument::where('FK_Personal_Documento',$id)->delete();
        DocumentacionPersona::destroy($id);

        $notification=array(
            'message'=>'La información del documento fue eliminada correctamente',
            'alert-type'=>'error'
        );
        return back()->with($notification);
    }
}