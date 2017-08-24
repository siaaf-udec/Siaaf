<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\Src\Interfaces\CarrerasInterface;
use App\Container\Audiovisuals\Src\Interfaces\FuncionarioInterface;
use App\Container\Audiovisuals\src\Solicitudes;
use App\Container\Audiovisuals\src\TipoArticulo;
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{

    protected $funcionarioRepository;
    protected $carrerasRepository;

    public function __construct(FuncionarioInterface $funcionarioRepository, CarrerasInterface $carrerasRepository)
    {
        $this->funcionarioRepository = $funcionarioRepository;
        $this->carrerasRepository    = $carrerasRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $carreras = $this->carrerasRepository->index([])->pluck('PRO_Nombre', 'id');
        //$carreras = $this->carrerasRepository->create(['id'=>2,'PRO_Nombre'=>'psicologia']);
        return view('audiovisuals.funcionario.gestionReservas', ['programas' => $carreras->toArray(),

        ]);
    }

    public function modal()
    {
        $bandera = 1;
        $user    = Auth::user();
        $userid  = $user->id;
        $phone   = UsuarioAudiovisuales::where('USER_FK_User', $userid)->first();
        if ($phone == null) {
            $bandera = 0;
        }
        return $bandera;
        //consulta usario ya ingreso programa

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
			$admins = $this->funcionarioRepository->index([]);
			return Datatables::of($admins)
			->removeColumn('created_at')
			->removeColumn('updated_at')
			->removeColumn('deleted_at')
			->removeColumn('remember_token')
			->removeColumn('FUNCIONARIO_Clave')
			->removeColumn('FK_FUNCIONARIO_Rol')
			->removeColumn('FUNCIONARIO_Direccion')
			->removeColumn('FUNCIONARIO_Apellidos')
			->removeColumn('FK_FUNCIONARIO_Estado')
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
		$tipo   = TipoArticulo::all()->pluck('TPART_Nombre', 'id');
		return view('audiovisuals.funcionario.reservaKit',[
			'tipos' =>$tipo->toArray(),
		]);
        /*if ($request->ajax() && $request->isMethod('GET')) {
            //$admins = $this->funcionarioRepository->index([]);
            $admins =Solicitudes::all();//where('PRT_FK_Tipo_Solicitud', '2')->first();
            return Datatables::of($admins)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }*/
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {
			$x = json_decode($request->get('info'));
			//return dd($x->group);
			foreach ($x->group as $reserva){
				Solicitudes::create([
					'PRT_FK_Articulos_id' => $reserva->PRT_FK_Articulos_id,
					'PRT_FK_Funcionario_id'=> 1,
					'PRT_FK_Kits_id'=> $reserva->PRT_FK_Articulos_id,
					'PRT_Fecha_Inicio'=> $reserva->PRT_Fecha_Inicio,
					'PRT_Fecha_Fin'=> $reserva->PRT_Fecha_Fin,
					'PRT_Observacion_Entrega'=> '',
					'PRT_Observacion_Recibe'=> '',
					'PRT_FK_Estado'=> 1,
					'PRT_FK_Tipo_Solicitud'=> 1,
					'PRT_FK_Administrador_Entrega_id'=>1,
					'PRT_FK_Administrador_Recibe_id'=>1
				]);


			}
			return AjaxResponse::success(
				'¡Bien hecho!',
				'Funcionario registrado correctamente.'
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

}
