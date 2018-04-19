<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\FileType;
use App\Container\Financial\src\Interfaces\FinancialFileTypeInterface;
use App\Container\Financial\src\Interfaces\Methods;

class FileTypeRepository extends Methods implements FinancialFileTypeInterface
{
    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * FileTypeRepository constructor.
     * @param FileRepository $fileRepository
     */
    public function __construct(FileRepository $fileRepository)
    {
        parent::__construct( FileType::class );
        $this->fileRepository = $fileRepository;
    }

    /**
     * Get statistics by semester
     *
     * @return mixed
     */
    public function stats()
    {
        return $this->getModel()
                    ->select( primaryKey(), file_types() )
                    ->withCount(['files' => function ($query) {
                        //Evaluate if the request is in actual semester
                        $files = isFirstSemester( today()->month ) ?
                                $query->whereMonth( created_at(), '<', '7') :
                                $query->whereMonth( created_at(), '>', '6');
                        //Evaluate if the request is in actual year
                        $files = $files->whereYear(created_at(), today()->year);
                        //Evaluate if the status is approved
                        $files = $files->whereHas('status', function ($query) {
                            $query->where([
                                [status_name(), approved_status()],
                                [status_type(), status_type_file()],
                            ]);
                        });
                        return $files;
                    }])
                    ->get();
    }

    /**
     * Store new data in database
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request)
    {
        $model->{ file_types() } = $request->file_type;
        return $model->save();
    }
}