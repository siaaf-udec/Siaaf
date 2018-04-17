<?php

namespace App\Container\Financial\src\Interfaces;


use Illuminate\Http\Request;

interface MethodsInterface
{
    /**
     * Display a listing of all the resources.
     *
     * @param array $relations
     * @return mixed
     */
    public function all( array $relations = [] );

    /**
     * Display the specified resource.
     *
     * @param array $relations
     * @param $id
     * @return mixed
     */
    public function get( array $relations = [], $id );

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return mixed
     * @internal param array $resource
     */
    public function store( Request $request );


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     * @internal param array $resource
     */
    public function update( Request $request, $id );

    /**
     * Remove the specified resource from storage logically.
     *
     * @param $id
     * @return mixed
     */
    public function destroy( $id );

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return mixed
     */
    public function forceDestroy( $id );
}