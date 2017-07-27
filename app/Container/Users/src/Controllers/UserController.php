<?php

namespace App\Container\Users\Src\Controllers;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $modules = $this->userRepository->index([]);
            return Datatables::of($modules)
                ->addColumn('roles', function ($roles){
                    if ( !empty($roles->roles) ) {
                        foreach ($roles->roles as $role) {
                            $aux[] = $role->display_name;
                        }
                        return implode(',', $aux);
                    }
                    return '';
                })
                ->addColumn('state', function ($state){
                    if(strcmp($state->display_name, 'Aprobado')){
                        return "<span class='label label-sm label-warning'>dfsf".$state->display_name. "</span>";
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
            $url = Storage::disk('developer')->putFile('avatars', $request->file('image_profile_create'));
            $user->images()->create([
                'url' => $url
            ]);

            /*Guarda los Roles*/
            $roles =  $request->get('multi_select_roles_create');
            $user->roles()->sync(
                ($roles !== null) ? explode(',', $roles) : []
            );

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
