<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\UserRepository;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( $this->userRepository->teachersAsOptions() , 200 );
    }
}