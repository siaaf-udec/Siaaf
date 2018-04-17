<?php

namespace App\Container\Financial\src\Interfaces;


use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

abstract class Methods implements MethodsInterface
{
    /**
     * @var $model
     */
    private $model = null;

    /**
     * @var $resources
     */
    private $resources = [];

    /**
     * Methods constructor.
     * @param string $model
     */
    public function __construct( $model )
    {

        $this->model = App::make( $model );
    }

    /**
     * Display a listing of all the resources.
     *
     * @param array $relations
     * @return mixed
     */
    public function all( array $relations = [] )
    {
        foreach ( $this->model->cursor() as $resource ) {
            $this->resources[] = ( $this->hasRelations( $relations ) ) ? $resource->with( $relations ) : $resource ;
        }

        return $this->resources;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @param array $relations
     * @return mixed
     */
    public function get(array $relations = [], $id)
    {
        return ( $this->hasRelations( $relations ) ) ? $this->model->with( $relations )->findOrFail( $id ) : $this->model->findOrFail( $id );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->process( $this->model->newInstance([]), $request );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $resource = $this->model->find( $id );
        return ( $resource ) ? $this->process( $resource, $request ) : false;
    }

    /**
     * Remove the specified resource from storage logically.
     *
     * @param $id
     * @return mixed
     */
    public function destroy( $id )
    {
         $resource = $this->model->find( $id );
         return ( $resource ) ? $resource->delete() : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return mixed
     */
    public function forceDestroy($id)
    {
        $resource =  $this->model->find( $id );
        return ( $resource ) ? $resource->forceDelete() : false;
    }

    /**
     * Process resource data from models
     *
     * @param $model
     * @param $request
     * @return mixed
     * @internal param $request
     */
    protected abstract function process($model, $request);

    /**
     * Retrieve Model
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    public function dataTables( $relations = [] )
    {
        return DataTables::of( $this->model->with( $relations ) );
    }

    /**
     * Retrieve an array for input selects options
     *
     * @param string $key
     * @param null $value
     * @param bool $pluck
     * @param bool $condition
     * @param $relation
     * @param $function
     * @return array
     */
    public function options($key = SchemaConstant::PRIMARY_KEY, $value = null, $pluck = false, $condition = false, $relation = null, $function = null)
    {
        $options = $this->getModel()->select( $key, $value );

        $options = ( $condition && $relation && $function ) ? $options->whereHas($relation, $function) : $options;

        foreach ( $options->cursor() as $option ) {
            $items[] = [
                'id'    => $option[ $key ],
                'text'  => $option[ $value ]
            ];
        }

        if ($pluck && isset( $items ) ) return array_pluck( $items, 'text', 'id' );

        return ( isset( $items ) ) ? $items : [] ;
    }

    /**
     * Check if a model is set
     *
     * @param $resource
     * @return bool
     * @internal param $model
     */
    public function hasResources( $resource ) { return ( $resource ) ? true : false; }

    /**
     * Check if need add related data to the query
     *
     * @param array $relations
     * @return bool
     */
    public function hasRelations(array $relations = []) { return ( count( $relations ) ) ? true : false; }

}