<?php

namespace App\Container\Users\src\Controllers;


use Yajra\DataTables\DataTables;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Users\src\Interfaces\UsersUdecInterface;
use App\Container\Users\src\UsersUdec;

class UsersUdecController extends Controller
{
    protected $usersudecRepository;

    public function __construct(UsersUdecInterface $usersudecRepository)
    {
        $this->usersudecRepository = $usersudecRepository;
    }

    public function index(){
        return view('users.users-udec');
    }

    public function index_ajax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('users.content-ajax.ajax-users-udec');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $user = UsersUdec::query();

            return DataTables::of($user)
                ->removeColumn('company')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->removeColumn('deleted_at')
                ->addIndexColumn()
                ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function checkDocument(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'number_document' => 'unique:developer.users_udec'
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

    public function checkCode(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'code' => 'unique:developer.users_udec'
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

    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('users.content-ajax.ajax-create-user-udec');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            /*Guarda Usuario*/
            $user = $this->usersudecRepository->store($request->all());

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos guardados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function register(){
        return view('users.register-user-udec');
    }

}