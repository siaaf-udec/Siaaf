<?php

namespace App\Container\Gesap\Src\Controllers;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Permissions\Src\Interfaces\RoleInterface;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use App\Notifications\HeaderSiaaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Validator;
use Yajra\DataTables\DataTables;
use App\Container\Users\src\User;
use App\Container\Gesap\src\Usuarios;
use App\Container\Users\src\UsersUdec;
use App\Container\Permissions\src\Role;

class UserControllerGesap extends Controller
{

    protected $userRepository;
    protected $roleRepository;
    protected $user;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->user           = Auth::user();
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
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('users.content-ajax.ajax-user');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $roles = $this->roleRepository->index([]);
            return view('users.content-ajax.ajax-create-user', [
                'roles' => $roles,
            ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            /*
             * Forma Incorrecta
             * $users = $this->userRepository->index([]);
             * $users = $this->userRepository->getModel()::with('roles')->get();
             * */
            $users = $this->userRepository->index(['roles']);
            return DataTables::of($users)
                ->addColumn('roles', function ($users) {
                    if (!empty($users->roles)) {
                        foreach ($users->roles as $role) {
                            $aux[] = $role->display_name;
                        }
                        if (!empty($aux)) {
                            return implode(',', $aux);
                        } else {
                            return 'No Definido';
                        }
                    }
                })
                ->addColumn('state', function ($users) {
                    if (!strcmp($users->state, 'Aprobado')) {
                        return "<span class='label label-sm label-success'>" . $users->state . "</span>";
                    } elseif (!strcmp($users->state, 'Pendiente')) {
                        return "<span class='label label-sm label-warning'>" . $users->state . "</span>";
                    } else {
                        return "<span class='label label-sm label-danger'>" . $users->state . "</span>";
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
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function role_assign(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user_roles = $this->userRepository->show($id, []);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $user_roles->roles
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            /*Guarda Usuario*/
            $validacionUsuario = User::where('identity_no',$request['identity_no'])->first();
            $validacionUsuarioCorreo = User::where('email',$request['email'])->first();
            if($request['multi_select_roles_create']==1){
                $rolgesap = Role::Where('name','=','EstudianteGesap')->first();
                $request['multi_select_roles_create'] = $rolgesap->id;
            }elseif($request['multi_select_roles_create']==2){
                $rolgesap = Role::Where('name','=','DocenteGesap')->first();
                $request['multi_select_roles_create'] = $rolgesap->id;
            }elseif($request['multi_select_roles_create']==3){
                $rolgesap = Role::Where('name','=','AdminGesap')->first();
                $request['multi_select_roles_create'] = $rolgesap->id;
            }

            if($validacionUsuarioCorreo != null){
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Error!',
                    'Ese Correo Ya se encuentra registrado!.',
                    $IdError
                );
            }else{

            if($validacionUsuario == null){
                    
                $request['password'] = substr( $request['identity_no'], 0,5);
                $user = $this->userRepository->store($request->all());

                /*Guarda la imagen */
                $img = $request->file('image_profile_create');
                if ($img !== null) {
                    $url = Storage::disk('developer')->putFile('avatars', $img);
                    $user->images()->create([
                        'url' => $url,
                    ]);
                } else {
                    $user->images()->create([
                        'url' => $request->get('identicon'),
                    ]);
                }

                /*Guarda los Roles*/
            /*  busca cual rol es gesap user_errortrae idatequema el idate
                [2]
                2 */
                //$roles = $request->get('multi_select_roles_create');
                $roles = $request->get('multi_select_roles_create');
                $user->roles()->sync(
                    ($roles !== null) ? explode(',', $roles) : []
                );

                /*Crea Notificacion*/
                $data = [
                    'url'         => 'https://www.google.com.co/',
                    'description' => '¡Bienvenidos a Siaaf!',
                    'image'       => 'assets/layouts/layout2/img/avatar3.jpg',
                ];
                $user->notify(new HeaderSiaaf($data));

                UsersUdec::create([

                    'number_document' => $request['identity_no'],
                    'code' => $request['User_Codigo'],
                    'username' => $request['name'],               
                    'lastname' => $request['lastname'],
                    'type_user'=>$request['rol_gesap'],
                    'place'=>"Facatativá",
                    'email' => $request['email'],
                    
                ]);
           

                Usuarios::create([
                    'PK_User_Codigo' => $request['identity_no'],
                    'User_Codigo' => $request['User_Codigo'],
                    'User_Nombre1' => $request['name'],
                    'User_Apellido1' => $request['lastname'],
                    'User_Correo' => $request['email'],
                    'User_Contra' => substr( $request['identity_no'], 0,5),
                    'User_Direccion' => $request['address_create'],
                    'FK_User_IdEstado' => 1,
                    'FK_User_IdRol' => $request['rol_gesap'],
                ]);

              
               


                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos creados correctamente.'
                );
        }else{
            if($validacionUsuario->email != $request['email']){
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Error!',
                    'Ya Estas Registrado Pero Con Correos Diferentes, !revisa!.',
                    $IdError
                );
            }else{
                    // aca los datos de developer estan duplicados//
                    $validarusuariogesap = Usuarios::where('PK_User_Codigo', $request['identity_no'])->first();
                    $i = 0 ;
                    foreach ($validacionUsuario ->roles as $role){
                        if($i == 0){
                            $aux = $role->id;
                            $i = 1 ;
                        }else{
                            $aux = $aux.",".$role->id;
                        }
                    }
                    
                    
                
                    $aux =$aux.','.$request['multi_select_roles_create'];
                    $roles = $aux;
                    $validacionUsuario->roles()->sync(
                        ($roles !== null) ? explode(',', $roles) : []
                    );

                    Usuarios::create([
                    'PK_User_Codigo' => $request['identity_no'],
                    'User_Codigo' => $request['User_Codigo'],
                    'User_Nombre1' => $request['name'],
                    'User_Apellido1' => $request['lastname'],
                    'User_Correo' => $request['email'],
                    'User_Contra' => 12345,
                    'User_Direccion' => $request['address_create'],
                    'FK_User_IdEstado' => 1,
                    'FK_User_IdRol' => $request['rol_gesap'],
                    ]);

                      
                    
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );

            }
       
        }
    }
            }


        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email_create' => 'unique:users,email',
            ]);
            if (empty($validator->errors()->all())) {
                return response('true');
            }
            return response('false');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkEmailAuth(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email_create' => 'unique:users,email,'. $id,
            ]);
            if (empty($validator->errors()->all())) {
                return response('true');
            }
            return response('false');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkEmailExisting(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email_forget' => 'exists:users,email',
            ]);
            if (empty($validator->errors()->all())) {
                return response('true');
            }
            return response('false');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkPassword(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'password_update' => 'current_password',
            ]);
            if (empty($validator->errors()->all())) {
                return response('true');
            }
            return response('false');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user = $this->userRepository->show($id, []);
            $img  = $user->images[0]->url;
            if (strcmp(substr($img, 0, 4), 'data') !== 0 && Storage::disk('developer')->has('avatars', $img)) {
                $img = Storage::disk('developer')->url($img);
            }

            return view('users.content-ajax.ajax-update-user', [
                'user'  => $user,
                'img'   => $img,
                'roles' => $this->roleRepository->index([])
            ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            /*Modifica Usuario*/
            if (!empty($request->get('password'))) {
                $request->merge(['password' => $request->get('password_new')]);
            }
            $user = $this->userRepository->update($request->all());

            /*Guarda la imagen */
            $img = $request->file('image_profile_create');
            if ($img !== null) {
                foreach ($user->images as $image) {
                    Storage::disk('developer')->delete($image->url);
                }
                $url = Storage::disk('developer')->putFile('avatars', $img);
                $user->images()->update([
                    'url' => $url,
                ]);
            } 
            
            /*Guarda los Roles*/
            $roles = $request->get('multi_select_roles_create');
            $user->roles()->sync(
              //  array eno s nulo? split por comitas, []
              
                ($roles !== null) ? explode(',', $roles) : []
            );

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $this->userRepository->destroy($id);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
