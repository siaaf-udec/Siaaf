<?php

namespace App\Container\Overall\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Interfaces\ControllerInterface;

/*
 * Facades
 */
use Illuminate\Support\Facades\App;

/*
 * Modelos
 */


abstract class ControllerRepository implements ControllerInterface
{

    private $model = null;

    public function __construct($model = '')
    {
        $this->model = App::make($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($relations = [])
    {
        $models = $this->model->all();

        if (count($relations))
            $models->load($relations);
        return $models;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        //Crear una nueva instancia del modelo dado.
        $model = $this->model->newInstance([]);
        return $this->process($model, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $relations = [])
    {
        $model = $this->model->find($id);
        if (count($relations))
            $model->load($relations);
        return $model;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($data)
    {
        $model = $this->model->find($data['id']);
        return $this->process($model, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function getModel()
    {
        return $this->model;
}

    protected abstract function process($model, $data);
}