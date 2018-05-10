<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\UserRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;

class TeacherController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TeacherController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource in options format.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod( 'GET') )
            return response()->json( $this->userRepository->teachersAsOptions() , 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}