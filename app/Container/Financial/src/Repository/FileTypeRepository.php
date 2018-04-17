<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 5/02/18
 * Time: 8:50 PM
 */

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\File;
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
                                [status_name(), 'APROBADO'],
                                [status_type(), 'FILE'],
                            ]);
                        });
                        return $files;
                    }])
                    ->get();
    }

    /**
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