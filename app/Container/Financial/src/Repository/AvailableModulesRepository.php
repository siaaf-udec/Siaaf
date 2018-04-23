<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\AvailableModules;
use App\Container\Financial\src\Interfaces\FinancialAvailableModulesInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Transformers\Financial\AvailableModuleTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class AvailableModulesRepository extends Methods implements FinancialAvailableModulesInterface
{

    /**
     * AvailableModulesRepository constructor.
     */
    public function __construct()
    {
        parent::__construct( AvailableModules::class );
    }

    /**
     * Get all resources stored
     *
     * @return array
     */
    public function getAll()
    {
        $manager = new Manager;
        $model = $this->getModel()->all();
        $model = new Collection( $model, new AvailableModuleTransformer() );
        return $manager->createData( $model )->toArray();
    }

    /**
     * Update or create a module available
     *
     * @param $request
     * @return mixed
     */
    public function updateOrCreate( $request )
    {
        $model = $this->getModel()->where( module_name(), $request->module_name )->first();
        if ( !$model ) {
            return $this->store( $request );
        }
        return $this->process( $model, $request );
    }

    /**
     * Process available dates for modules and data to store
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process( $model, $request )
    {
        $model->{ module_name() }       =   $request->module_name;
        $model->{ available_from() }    =   $request->available_from;
        $model->{ available_until() }   =   $request->available_until;
        return $model->save();
    }
}