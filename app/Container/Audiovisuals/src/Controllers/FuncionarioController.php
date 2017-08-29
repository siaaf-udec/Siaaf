<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\Src\Interfaces\CarrerasInterface;
use App\Container\Audiovisuals\Src\Interfaces\FuncionarioInterface;
use App\Container\Audiovisuals\src\Solicitudes;
use App\Container\Audiovisuals\src\TipoArticulo;
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class FuncionarioController extends Controller
{

    protected $funcionarioRepository;
    protected $carrerasRepository;

    public function __construct(FuncionarioInterface $funcionarioRepository, CarrerasInterface $carrerasRepository)
    {
        $this->funcionarioRepository = $funcionarioRepository;
        $this->carrerasRepository    = $carrerasRepository;
    }
    public function index()
	{
        $carreras = $this->carrerasRepository->index([])->pluck('PRO_Nombre', 'id');
        return view('audiovisuals.funcionario.gestionReservas',
			[
				'programas' => $carreras->toArray()
			]
		);
    }

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            //solicitudes con el usuario autenticado
            $solicitudes   = Solicitudes::all();
			//$admins = $this->funcionarioRepository->index([]);
			return Datatables::of($solicitudes)

			->addIndexColumn()
			->make(true);

			} else {
				return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
				);
			}
    }
    public function reserva(Request $request)
    {
		$user    = Auth::user();
		$userid  = $user->id;
		$usuario  = UsuarioAudiovisuales::where('USER_FK_User', $userid)->first();
		$bandera=1;
		if ($usuario == null) {
			$bandera = 0;
		}
		$carreras = $this->carrerasRepository->index([])->pluck('PRO_Nombre', 'id');
		$tipo   = TipoArticulo::all()->pluck('TPART_Nombre', 'id');

		return view('audiovisuals.funcionario.reservarArticulo',[
			'tipos' =>$tipo->toArray(),
			'programas'=>$carreras->toArray(),
			'numero'=>$bandera

		]);

    }

    public function store(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {
//			$x = json_decode($request->get('info'));
			$user=Auth::user();
            $id=$user->id;
//			foreach ($x->group as $reserva){
				//$valores=$this->consultarArticulo($reserva->PRT_FK_Articulos_id);
            Solicitudes::create([
                    'PRT_FK_Articulos_id'               => $request['PRT_FK_Articulos_id'],
                    'PRT_Fecha_Inicio'  => $request['PRT_Fecha_Inicio'],
                    'PRT_Fecha_Fin'     => $request['PRT_Fecha_Fin'],
					'PRT_FK_Funcionario_id'=> $id,
					'PRT_FK_Kits_id'=> 1,
					'PRT_Observacion_Entrega'=> '',
					'PRT_Observacion_Recibe'=> '',
					'PRT_FK_Estado'=> 1,
					'PRT_FK_Tipo_Solicitud'=> 1,
					'PRT_FK_Administrador_Entrega_id'=>0,
					'PRT_FK_Administrador_Recibe_id'=>0
            ]);
//		}
        return AjaxResponse::success(
				'¡Bien hecho!',
				'Reserva registrada correctamente.'
			);
		} else {
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}


    }
	public function storePrograma(Request $request){

		if ($request->ajax() && $request->isMethod('POST')) {
			$user = Auth::user();
			$user->audiovisual()->create(['USER_FK_Programa' => $request->get('FK_FUNCIONARIO_Programa')]);

			return AjaxResponse::success(
				'¡Bien hecho!',
				'Programa registrado correctamente.'
			);
		} else {
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $this->funcionarioRepository->destroy($id);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Funcionario eliminado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function consultarArticulo($reserva){
		$query=Articulo::where([
			['FK_ART_Tipo_id','=',$reserva],
			['FK_ART_Estado_id','=',1]

		])->first();
		Articulo::where([
			['id','=',$query['id']],

		])->update(['FK_ART_Estado_id'=>3]);
    	return $query;

	}

}
