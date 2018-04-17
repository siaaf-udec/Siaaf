<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Repository\CommentRepository;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Financial\src\Requests\Comments\CommentRequest;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;
    /**
     * @var AddSubRepository
     */
    private $addSubRepository;
    /**
     * @var ValidationRepository
     */
    private $validationRepository;
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;

    /**
     * CommentController constructor.
     * @param CommentRepository $commentRepository
     * @param AddSubRepository $addSubRepository
     * @param IntersemestralRepository $intersemestralRepository
     * @param ValidationRepository $validationRepository
     * @param ExtensionRepository $extensionRepository
     */
    public function __construct(CommentRepository $commentRepository,
                                AddSubRepository $addSubRepository,
                                IntersemestralRepository $intersemestralRepository,
                                ValidationRepository $validationRepository,
                                ExtensionRepository $extensionRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->extensionRepository = $extensionRepository;
        $this->addSubRepository = $addSubRepository;
        $this->validationRepository = $validationRepository;
        $this->intersemestralRepository = $intersemestralRepository;
    }

    public function getExtensionComments( $id )
    {
        $comments = $this->extensionRepository->get(['comments.user:id,name,lastname'], $id);
        return response()->json( ( isset( $comments->comments ) ) ? $comments->comments : [] , 200 );
    }

    public function storeExtensionComments( CommentRequest $request )
    {
        $status = ( $this->commentRepository->saveExtensionComment( $request )  ) ? 200 : 422;
        return response()->json(null, $status);
    }

    public function getAddSubComments($id)
    {
        $comments = $this->addSubRepository->get(['comments.user:id,name,lastname'], $id);
        return response()->json( ( isset( $comments->comments ) ) ? $comments->comments : [] , 200 );
    }

    public function storeAddSubComments( CommentRequest $request )
    {
        $status = ( $this->commentRepository->saveAddSubComment( $request )  ) ? 200 : 422;
        return response()->json(null, $status);
    }

    public function getValidationComments($id)
    {
        $comments = $this->validationRepository->get(['comments.user:id,name,lastname'], $id);
        return response()->json( ( isset( $comments->comments ) ) ? $comments->comments : [] , 200 );
    }

    public function storeValidationComments( CommentRequest $request )
    {
        $status = ( $this->commentRepository->saveValidationComment( $request )  ) ? 200 : 422;
        return response()->json(null, $status);
    }

    public function getIntersemestralComments($id)
    {
        $comments = $this->intersemestralRepository->get(['comments.user:id,name,lastname'], $id);
        return response()->json( ( isset( $comments->comments ) ) ? $comments->comments : [] , 200 );
    }

    public function storeIntersemestralComments( CommentRequest $request )
    {
        $status = ( $this->commentRepository->saveIntersemestralComment( $request )  ) ? 200 : 422;
        return response()->json(null, $status);
    }
}