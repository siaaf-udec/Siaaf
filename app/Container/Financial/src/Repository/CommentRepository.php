<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 28/10/17
 * Time: 2:14 PM
 */

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Comment;
use App\Container\Financial\src\Interfaces\FinancialCommentInterface;
use App\Container\Financial\src\Interfaces\Methods;

class CommentRepository extends Methods implements FinancialCommentInterface
{

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
     * CommentRepository constructor.
     * @param ExtensionRepository $extensionRepository
     * @param IntersemestralRepository $intersemestralRepository
     * @param ValidationRepository $validationRepository
     * @param AddSubRepository $addSubRepository
     */
    public function __construct(ExtensionRepository $extensionRepository,
                                IntersemestralRepository $intersemestralRepository,
                                ValidationRepository $validationRepository,
                                AddSubRepository $addSubRepository)
    {
        parent::__construct(Comment::class);
        $this->extensionRepository = $extensionRepository;
        $this->addSubRepository = $addSubRepository;
        $this->validationRepository = $validationRepository;
        $this->intersemestralRepository = $intersemestralRepository;
    }

    public function process( $model, $request )
    {
        $comment = new Comment([
            comment()   =>  $request->comment,
            user_fk()   =>  auth()->user()->id
        ]);
        return $model->comments()->save( $comment );
    }

    public function saveExtensionComment( $request )
    {
        $extension = $this->extensionRepository->get([], $request->id );
        return $this->process( $extension, $request );
    }

    public function saveAddSubComment( $request )
    {
        $additionSubtraction = $this->addSubRepository->get([], $request->id );
        return $this->process( $additionSubtraction, $request );
    }

    public function saveValidationComment( $request )
    {
        $validation = $this->validationRepository->get([], $request->id );
        return $this->process( $validation, $request );
    }

    public function saveIntersemestralComment( $request )
    {
        $validation = $this->intersemestralRepository->get([], $request->id );
        return $this->process( $validation, $request );
    }
}