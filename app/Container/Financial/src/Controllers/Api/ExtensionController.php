<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Extension;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\ExtensionTransformer;
use Yajra\DataTables\DataTables;

class ExtensionController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;

    /**
     * ExtensionController constructor.
     * @param ExtensionRepository $extensionRepository
     */
    public function __construct(ExtensionRepository $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }

    /**
     * Return extensions query from auth user
     *
     * @return mixed
     */
    public function query()
    {
        return auth()->user()->extensions()
            ->with([
                'subject' => function ($query) {
                    return $query->with('teachers:id,name,lastname');
                },
                'status',
                'cost'
            ])->orderBy(created_at(), 'DESC');
    }

    /**
     * Return a Datatable query format
     *
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return DataTables::of( $this->query() )
                        ->setTransformer( new ExtensionTransformer )
                        ->toJson();
    }

    /**
     * Return an specific source in datatable format
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function show( $id )
    {
        $relation = [
            'subject' => function ($q) {
                return $q->with([
                    'programs',
                    'teachers:id,name,lastname,phone,email'
                ]);
            },
            'status',
            'secretary:id,name,lastname',
            'student:id,name,lastname,phone,email',
        ];
        if ( auth()->user()->hasRole( student_role() ) ) {
            $extension = $this->extensionRepository->getAuth( $relation, $id );
        } else if ( auth()->user()->hasRole( access_roles() ) ) {
            $extension = $this->extensionRepository->get( $relation, $id );
        }

        $array = [];
        $array[] = $this->extensionRepository->fillArray( $extension );

        return DataTables::of( $array )->toJson();
    }
}