<?php

namespace App\Container\Audiovisuals\src\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Container\Audiovisuals\src\Requests\FuncionarioRequest;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Audiovisuals\src\Funcionario;

class FuncionarioController extends Controller
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
    public function listing(Request $request){

        if($request->ajax()){
            return Datatables::of(
            Funcionario::select(
                'PK_FNS_Cedula', 
                'FNS_Nombres', 
                'FNS_Correo', 
                'FK_FNS_Programa')->get()
                )->addIndexColumn()
                 ->make(true);
         }else{
                return response()->json([
                    'message' => 'Incorrect request',
                    'code' => 412
                ],412);
         }

    }

    public function all(Request $request, $id){

        if($request->ajax()){
            return Funcionario::find($id);

         }else{
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ],412);
         }

    }

    public function index()
    {
        return view('audiovisuals.funcionario.gestionfuncionarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('audiovisuals.funcionario.registroFuncionario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionarioRequest $request)
    {
        if($request->ajax()){
            Funcionario::create($request->all());
            return response()->json([
                    "mensaje" => "creado",
                ]);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //return "en el show";
       // return view('humtalent.empleado.consultaEmpleado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $funcionario = Funcionario::find($id);
        return response()->json(
                $funcionario->toArray()
            );
        // return view('audiovisuals.funcionario.editarFuncionario', compact('funcionario'));
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

        $funcionario= Funcionario::find($id);
        $funcionario->fill($request->all());
        $funcionario->save();
        return response()->json([
            "mensaje"=>"listo"

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Funcionario::destroy($id);
        return response()->json(["mensaje"=>"borrado"]);
    }

}