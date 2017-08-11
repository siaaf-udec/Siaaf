<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\Src\Interfaces\UsuarioAudiovisualesInterface;
use App\Container\Audiovisuals\src\Phone;
use App\Container\Audiovisuals\src\Userpractice;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsuarioAudiovisualesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $usuarioAudiovisualesRepository;
    protected $usuarioDeveloperRepository;

    public function __construct(UsuarioAudiovisualesInterface $usuarioAudiovisualesRepository,
        UserInterface $usuarioDeveloperRepository) {
        $this->usuarioAudiovisualesRepository = $usuarioAudiovisualesRepository;
        $this->usuarioDeveloperRepository     = $usuarioDeveloperRepository;
    }
    public function index()
    {
		//$phone =Userpractice::find(1)->comentarios;//()->where('nombre','319')->get();
		//$phone =Userpractice::doesnthave('comentarios')->get();
		//$phone =Userpractice::withCount('comentarios')->get();
		/*$phone = Userpractice::withCount([
			'comentarios',
			'comentarios AS pending_comments' => function ($query) {
				$query->where('nombre', '319');
			}
		])->get();*/
		//$phone = Phone::all();
		/*$phone = Phone::with('consultaUsuario')->get();
		return view('audiovisuals.prueba',
			['programas' => $phone
			]);
        //
		*/

        $user     = Auth::id();
        $prueba   = $this->usuarioDeveloperRepository->index([]);
        $carreras = $this->carrerasRepository->index([])->pluck('Nombre', 'id');
        return view('audiovisuals.prueba',
            ['usuarioId' => $prueba,
            ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
