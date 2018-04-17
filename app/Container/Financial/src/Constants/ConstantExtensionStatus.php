<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 5/04/18
 * Time: 11:04 AM
 */

namespace App\Container\Financial\src\Constants;


use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;

class ConstantExtensionStatus
{
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;

    /**
     * ConstantExtensionStatus constructor.
     * @param ExtensionRepository $extensionRepository
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct(ExtensionRepository $extensionRepository, StatusRequestRepository $statusRequestRepository)
    {
        $this->extensionRepository = $extensionRepository;
        $this->statusRequestRepository = $statusRequestRepository;
    }

    /**
     * @return array
     */
    public function arrayForSelect()
    {
        return $this->statusRequestRepository->options( primaryKey(), status_name());
    }

    public function arrayExcept( $name )
    {
        return $this->statusRequestRepository->getModel()
                    ->select( primaryKey().' AS id', status_name(). ' AS text' )
                    ->where( [
                        [status_type(), 'EXTENSION'],
                        [status_name(), $name]
                    ])-get()->toArray();
    }
}