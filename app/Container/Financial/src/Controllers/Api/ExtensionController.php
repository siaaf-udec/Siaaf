<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Extension;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\ExtensionTransformer;
use App\Transformers\Financial\SubjectProgramTransformer;
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
                    return $query->with('teachers:id,name,lastname,phone,email');
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
        if ( request()->isMethod('GET') )
            return DataTables::of( $this->query() )
                            ->setTransformer( new ExtensionTransformer )
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
                'secretary:id,name,lastname,phone,email',
                'student:id,name,lastname,phone,email',
            ];
            if (auth()->user()->hasRole(student_role()) || auth()->user()->can(permission_extension())) {
                $extension = $this->extensionRepository->getAuth($relation, $id);
            } else if (auth()->user()->hasRole(access_roles()) || auth()->user()->can(permission_extension_approval())) {
                $extension = $this->extensionRepository->get($relation, $id);
            }
            $array = [];
            $array[] = $this->extensionRepository->fillArray(isset($extension) ? $extension : null);

            return DataTables::of($array)->toJson();
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
        if ( request()->isMethod( 'GET' ) )
            return response()->json( ( new SubjectProgramTransformer )->transform( $this->extensionRepository->subjectRelation( $id ) ) , 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}