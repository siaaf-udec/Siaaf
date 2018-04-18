<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialIntersemestralStudentInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\IntersemestralStudents;

class IntersemestralStudentRepository extends Methods implements FinancialIntersemestralStudentInterface
{
    /**
     * IntersemestralStudentRepository constructor.
     */
    public function __construct()
    {
        parent::__construct( IntersemestralStudents::class );
    }

    /**
     * Set paid status
     *
     * @param $request
     * @return mixed
     */
    public function updatePaidStatus( $request )
    {
        $model = $this->getModel()->findOrFail( $request->id );
        $model->{ paid() }  =   $request->paid;
        return $model->save();
    }

    /**
     * Subscribe student in an intersemestral
     *
     * @param $intersemestral
     * @return mixed
     */
    public function subscribe( $intersemestral )
    {
        if ( !$this->exists( $intersemestral ) ) {
            $model = $this->getModel();
            $model->{ paid() }              =   false;
            $model->{ intersemestral_fk() } =   $intersemestral;
            $model->{ student_fk() }        =   auth()->user()->id;
            return $model->save();
        }

        return false;
    }

    /**
     * Check if an intersemestral exist
     *
     * @param $intersemestral
     * @return mixed
     */
    public function exists( $intersemestral )
    {
        $model = $this->getModel()->currentSubscribers()
                        ->select( primaryKey() )
                        ->where([
                            [ intersemestral_fk(), $intersemestral ],
                            [ student_fk(), auth()->user()->id ]
                        ])->first();

        return (isset($model->{primaryKey()})) ? true : false;
    }

    /**
     * Store a new intersemestral
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process( $model, $request )
    {
        $model->{ paid() }              =   $request->paid;
        $model->{ intersemestral_fk() } =   $request->intersemestral;
        $model->{ student_fk() }        =   auth()->user()->id;
        return $model->save();
    }
}