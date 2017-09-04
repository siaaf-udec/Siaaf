<?php

namespace App\Container\Users\Src\Controllers;

use App\Notifications\HeaderSiaaf;

use Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Permissions\Src\Interfaces\ModuleInterface;
use App\Container\Permissions\Src\Interfaces\RoleInterface;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Users\Src\Country;

class UserController extends Controller
{

    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_ajax(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            return view('users.content-ajax.ajax-user');
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $roles =  $this->roleRepository->index([]);
            return view('users.content-ajax.ajax-create-user', [
                    'roles' => $roles
            ]);
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            /*
             * Forma Incorrecta
             * $users = $this->userRepository->index([]);
             * $users = $this->userRepository->getModel()::with('roles')->get();
             * */
            $users = Cache::remember('roles', 1, function () {
                return $this->userRepository->index(['roles']);
            });
            return DataTables::of($users)
                ->addColumn('roles', function ($users){
                    if ( !empty($users->roles)) {
                        foreach ($users->roles as $role) {
                            $aux[] = $role->display_name;
                        }
                        if(!empty($aux)){
                            return implode(',', $aux);
                        }else{
                            return 'No Definido';
                        }
                    }
                })
                ->addColumn('state', function ($users){
                    if(!strcmp($users->state, 'Aprobado')){
                        return "<span class='label label-sm label-success'>".$users->state. "</span>";
                    }elseif (!strcmp($users->state, 'Pendiente')){
                        return "<span class='label label-sm label-warning'>".$users->state. "</span>";
                    }else{
                        return "<span class='label label-sm label-danger'>".$users->state. "</span>";
                    }
                })
                ->rawColumns(['state'])
                ->removeColumn('birthday')
                ->removeColumn('identity_type')
                ->removeColumn('identity_no')
                ->removeColumn('identity_expe_place')
                ->removeColumn('identity_expe_date')
                ->removeColumn('sexo')
                ->removeColumn('phone')
                ->removeColumn('password')
                ->removeColumn('cities_id')
                ->removeColumn('countries_id')
                ->removeColumn('regions_id')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){

            /*Guarda Usuario*/
            $user = $this->userRepository->store($request->all());

            /*Guarda la imagen */
            $img = $request->file('image_profile_create');
            if($img !== null){
                $url = Storage::disk('developer')->putFile('avatars', $img);
                $user->images()->create([
                    'url' => $url
                ]);
            }else{
                $user->images()->create([
                    'url' => $request->get('identicon')
                ]);
            }

            /*Guarda los Roles*/
            $roles =  $request->get('multi_select_roles_create');
            $user->roles()->sync(
                ($roles !== null) ? explode(',', $roles) : []
            );

            /*Crea Notificacion*/
            $data = [
                'url' => 'https://www.google.com.co/',
                'description' => '¡Bienvenidos a Siaaf!',
                'image' => 'assets/layouts/layout2/img/avatar3.jpg'
            ];
            $user->notify(new HeaderSiaaf($data));

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){

            $validator = Validator::make($request->all(), [
                'email_create' => 'unique:users,email'
            ]);

            if(empty($validator->errors()->all())){
                return response('true');
            }else{
                return response('false');
            }

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $user = $this->userRepository->show($id,[]);

            return view('users.content-ajax.ajax-update-user', [
                    'user' => $user,
                    'roles' => $this->roleRepository->index([]),
            ]);

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
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
        if($request->ajax() && $request->isMethod('POST')){
            $module = [
                'id' => $id,
                'name'=> $request->get('name'),
                'display_name'=> $request->get('display_name'),
                'description'=> $request->get('description'),
            ];
            $this->userRepository->update($module);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('DELETE')){

            $this->userRepository->destroy($id);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
}
