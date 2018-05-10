<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Comment;
use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Financial\src\File;
use App\Container\Financial\src\Interfaces\FinancialFileTypeInterface;
use App\Container\Financial\src\Interfaces\Methods;
use Illuminate\Support\Facades\Storage;

class FileRepository extends Methods implements FinancialFileTypeInterface
{
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;

    /**
     * FileTypeRepository constructor.
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct(StatusRequestRepository $statusRequestRepository)
    {
        parent::__construct( File::class );
        $this->statusRequestRepository = $statusRequestRepository;
    }

    /**
     * Retrieve auth user files
     *
     * @return mixed
     */
    public function ownFiles()
    {
        $columnsFileType = primaryKey().','.file_types();
        $columnsStatus = primaryKey().','.status_name();
        return auth()->user()->filesUploaded()
                    ->with(["status:$columnsStatus", "file_type:$columnsFileType"])
                    ->withCount( 'comments' )
                    ->latest()->get();
    }

    /**
     * Get all files
     *
     * @return mixed
     */
    public function allFiles()
    {
        $columnsFileType = primaryKey().','.file_types();
        $columnsStatus = primaryKey().','.status_name();
        return $this->getModel()
                    ->with([
                        "status:$columnsStatus",
                        "file_type:$columnsFileType",
                        "user:id,name,lastname"
                    ])
                    ->withCount( 'comments' )
                    ->latest();
    }

    /**
     *  Get query files by semester
     *
     * @param int $startMonth
     * @param int $endMonth
     * @param int $startYear
     * @param int $endYear
     * @return mixed
     */
    public function bySemester($startMonth = 1, $endMonth = 6, $startYear = 2008, $endYear = 2018 )
    {
        return $this->getModel()->whereRaw( "MONTH(".created_at().") BETWEEN $startMonth AND $endMonth" )
            ->whereRaw( "YEAR(".created_at().") BETWEEN $startYear AND $endYear" )
            ->whereHas('status', function ($query) {
                $query->where([
                    [status_name(), approved_status()],
                    [status_type(), status_type_file()],
                ]);
            });
    }
    /**
     * Store new resource from student
     *
     * @param $request
     * @return mixed
     */
    public function studentUpload( $request )
    {
        $status = $this->statusRequestRepository->getId( status_type_file(), sent_status() );

        if ( isset( $status->{ primaryKey() } ) ) {
            $model = $this->getModel();
            $model->{file_name()} = $request->file('file')->getClientOriginalName();
            $model->{file_route()} = $request->file('file')->store('', 'financial');
            $model->{user_fk()} = auth()->user()->id;
            $model->{file_type_fk()} = $request->file_type;
            $model->{status_fk()} = $status->{primaryKey()};
            return $model->save();
        }
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showFile( $id )
    {
        $columnsFileType = primaryKey().','.file_types();
        $columnsStatus = primaryKey().','.status_name();

        if ( auth()->user()->hasRole( student_role() ) ) {
            return auth()->user()->filesUploaded()->with([
                "status:$columnsStatus",
                "file_type:$columnsFileType",
                "user:id,name,lastname"
            ])->find( $id );
        }

        return $this->getModel()->with([
            "status:$columnsStatus",
            "file_type:$columnsFileType",
            "user:id,name,lastname"
        ])->find( $id );
    }

    /**
     * Check if an user uploaded a file
     *
     * @return bool
     */
    public function checkLatestRequest()
    {
        $files = auth()->user()->filesUploaded()->latest()->first();
        if ( $files ) {
            return $files->dropzone_status;
        }
        return false;
    }

    /**
     * Update student request
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function studentUpdate($request, $id ) {
        $model = $this->getAuth([], $id);
        if ( $model && Storage::disk('financial')->exists( $model->{ file_route() } ) ) {
            Storage::disk('financial')->delete( $model->{ file_route() } );
        }
        $model->{ file_name() }     = $request->file('file')->getClientOriginalName();
        $model->{ file_route() }    = $request->file('file')->store('', 'financial');
        $model->{ file_type_fk() }  = $request->file_type;
        return $model->save();
    }

    /**
     * Update status requests
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function managementUpdate($request, $id)
    {
        $model = $this->getModel()->findOrFail( $id );
        $model->{ status_fk() } = $request->status;
        return $model->save();
    }

    /**
     * Retrieve a specific resource with optional relations
     *
     * @param array $relations
     * @param $id
     * @return mixed
     */
    public function getAuth($relations = [], $id)
    {
        return auth()->user()->filesUploaded()->with( $relations )->findOrFail( $id );
    }

    /**
     * Comment a status file request
     *
     * @param $request
     * @return mixed
     */
    public function comment($request )
    {
        $files = $this->getModel()->findOrFail( $request->id );
        $comment = new Comment([
            comment()   =>  $request->comment,
            user_fk()   =>  auth()->user()->id
        ]);

        return $files->comments()->save( $comment );
    }

    /**
     * Store a new data
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request)
    {
        return $model->save();
    }
}