<?php

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

    /**
     * Process comment data to store
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request )
    {
        $comment = new Comment([
            comment()   =>  $request->comment,
            user_fk()   =>  auth()->user()->id
        ]);
        return $model->comments()->save( $comment );
    }

    /**
     * Store new comments for extensions
     *
     * @param $request
     * @return mixed
     */
    public function saveExtensionComment($request )
    {
        $extension = $this->extensionRepository->get([], $request->id );
        return $this->process( $extension, $request );
    }

    /**
     * Store new comments for additions and subtractions
     *
     * @param $request
     * @return mixed
     */
    public function saveAddSubComment($request )
    {
        $additionSubtraction = $this->addSubRepository->get([], $request->id );
        return $this->process( $additionSubtraction, $request );
    }

    /**
     * Store new comments for validations
     *
     * @param $request
     * @return mixed
     */
    public function saveValidationComment($request )
    {
        $validation = $this->validationRepository->get([], $request->id );
        return $this->process( $validation, $request );
    }

    /**
     * Store new comments for intersemestrals
     *
     * @param $request
     * @return mixed
     */
    public function saveIntersemestralComment($request )
    {
        $validation = $this->intersemestralRepository->get([], $request->id );
        return $this->process( $validation, $request );
    }

    /**
     * @param $comment
     * @return array
     */
    public function transform( $comment )
    {
        return [
            'id'                    =>  isset( $comment->{ primaryKey() } ) ? $comment->{ primaryKey() } : 0,
            'comment'               =>  isset( $comment->{ comment() } ) ? $comment->{ comment() } : null,
            'comment_class'         =>  isset( $comment->{ 'comment_class' } ) ? $comment->{ 'comment_class' } : 'in',
            'created_at'            =>  isset( $comment->{ created_at() } ) ? $comment->{ created_at() }->format('Y-m-d H:i:s') : null,
            'user'                  => [
                'id'                =>  isset( $comment->user->id ) ? $comment->user->id : 0,
                'full_name'         =>  isset( $comment->user->full_name ) ? $comment->user->full_name : __('financial.generic.empty'),
                'profile_picture'   =>  isset( $comment->user->profile_picture ) ? $comment->user->profile_picture : iconHash(),
            ],
        ];
    }
}