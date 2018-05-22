<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialCashInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\PettyCash;
use App\Transformers\Financial\CashTransformer;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CashRepository extends Methods implements FinancialCashInterface
{

    /**
     * CheckRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(PettyCash::class);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return DataTables::of( $this->getModel()->latest() )
                            ->setTransformer( new CashTransformer() )
                            ->toJson();
    }

    public function counter()
    {
        $counter = [
            'cash' =>   (int) $this->getModel()->sumIn() - (int) $this->getModel()->sumOut(),
            'in'   =>   $this->getModel()->sumIn(),
            'out'  =>   $this->getModel()->sumOut(),
            'all'  =>   $this->getModel()->count()
        ];

        return $counter;
    }

    /**
     * Store data in database
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request )
    {
        if ( $request->has('delete_file') && (int) $request->delete_file === 1 ) {
            if ( isset( $model->{ support() } ) && Storage::disk('financial')->exists( $model->{ support() } ) ) {
                Storage::disk('financial')->delete( $model->{ support() } );
            }
            $model->{ support() } = null;
        }

        if ( $request->method('PUT') && $request->need_file === '1' ) {
            if ( $request->has('file') ) {
                if ( isset( $model->{ support() } ) && Storage::disk('financial')->exists( $model->{ support() } ) ) {
                    Storage::disk('financial')->delete( $model->{ support() } );
                }
                $model->{ support() } = $request->file('file')->store('', 'financial');
            }
        }

        if ( $request->method('POST') && $request->need_file === '1' ) {
            $model->{ support() } = $request->file('file')->store('', 'financial');
        }

        $model->{ concept() }       =   $request->concept;
        $model->{ cost() }          =   $request->cost;
        $model->{ status() }        =   $request->status;
        return $model->save();
    }
}