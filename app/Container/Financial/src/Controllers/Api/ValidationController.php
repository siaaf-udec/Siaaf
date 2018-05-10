<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\SubjectProgramTransformer;
use App\Transformers\Financial\ValidationTransformer;
use Yajra\DataTables\DataTables;

class ValidationController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    private $validationRepository;

    /**
     * ExtensionController constructor.
     * @param ValidationRepository $validationRepository
     */
    public function __construct(ValidationRepository $validationRepository)
    {
        $this->validationRepository = $validationRepository;
    }

    /**
     * Return a query of auth user validations
     *
     * @return mixed
     */
    public function query()
    {
        return auth()->user()->validations()
            ->with([
                'subject' => function ($query) {
                    return $query->with([
                        'programs',
                        'teachers:id,name,lastname,phone,email'
                    ]);
                },
                'status',
                'secretary:id,name,lastname',
                'student:id,name,lastname,phone,email',
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
        if ( request()->isMethod('GET') )
            return DataTables::of( $this->query() )
                            ->setTransformer( new ValidationTransformer )
                            ->toJson();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
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
        if ( request()->isMethod('GET') ) {
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
            if (auth()->user()->hasRole(student_role()) || auth()->user()->can(permission_validation())) {
                $model = $this->validationRepository->getAuth($relation, $id);
            } else if (auth()->user()->hasRole(access_roles()) || auth()->user()->can(permission_validation_approval())) {
                $model = $this->validationRepository->get($relation, $id);
            }

            $array[] = isset($model) ? $model : [];

            return DataTables::of($array)
                ->setTransformer(new ValidationTransformer)
                ->toJson();
        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);

    }

    /**
     * Return the subject primary keys relation to edit the source
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        if ( request()->isMethod('GET') )
            return response()->json( ( new SubjectProgramTransformer )->transform( $this->validationRepository->subjectRelation( $id ) ) , 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}