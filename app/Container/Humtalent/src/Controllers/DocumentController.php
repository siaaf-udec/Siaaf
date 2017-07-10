<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 28/06/2017
 * Time: 2:04 PM
 */

namespace App\Container\Humtalent\src\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\DocumentacionPersona;
use Illuminate\Support\Facades\DB;


class DocumentController extends Controller
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
    public function index()
    {
        $documentos = DocumentacionPersona::all();
        return view('humtalent.documentacion.listaDocumentos', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('humtalent.documentacion.registroDocumento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DocumentacionPersona::create([
            'DCMTP_Nombre_Documento'  => $request['DCMTP_Nombre_Documento'],
        ]);
        $notification=array(
            'message'=>'La información del documento fue almacenada',
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
    public function edit($id)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        DocumentacionPersona::destroy($id);
        return "Eliminando  ";
    }


}