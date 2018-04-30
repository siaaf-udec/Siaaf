<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Repository\CommentRepository;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Financial\src\Requests\Comments\CommentRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
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

    /**
     * Get all comments for specific resource
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getExtensionComments($id )
    {
        if (request()->isMethod('GET')) {
            $comments = $this->extensionRepository->get(['comments.user:id,name,lastname'], $id);
            return response()->json((isset($comments->comments)) ? $comments->comments : [], 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Store a comment for specific resource
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeExtensionComments( CommentRequest $request )
    {
        if (request()->isMethod('POST')) {
            $status = ($this->commentRepository->saveExtensionComment($request)) ? 200 : 422;
            return response()->json(null, $status);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Get all comments for specific resource
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getAddSubComments($id)
    {
        if (request()->isMethod('GET')) {
            $comments = $this->addSubRepository->get(['comments.user:id,name,lastname'], $id);
            return response()->json((isset($comments->comments)) ? $comments->comments : [], 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Store a comment for specific resource
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeAddSubComments(CommentRequest $request )
    {
        if (request()->isMethod('POST')) {
            $status = ($this->commentRepository->saveAddSubComment($request)) ? 200 : 422;
            return response()->json(null, $status);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Get all comments for specific resource
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getValidationComments($id)
    {
        if (request()->isMethod('GET')) {
            $comments = $this->validationRepository->get(['comments.user:id,name,lastname'], $id);
            return response()->json((isset($comments->comments)) ? $comments->comments : [], 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Store a comment for specific resource
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeValidationComments( CommentRequest $request )
    {
        if (request()->isMethod('POST')) {
            $status = ($this->commentRepository->saveValidationComment($request)) ? 200 : 422;
            return response()->json(null, $status);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Get all comments for specific resource
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getIntersemestralComments($id)
    {
        if (request()->isMethod('GET')) {
            $comments = $this->intersemestralRepository->get(['comments.user:id,name,lastname'], $id);
            return response()->json((isset($comments->comments)) ? $comments->comments : [], 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Store a comment for specific resource
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeIntersemestralComments( CommentRequest $request )
    {
        if (request()->isMethod('POST')) {
            $status = ($this->commentRepository->saveIntersemestralComment($request)) ? 200 : 422;
            return response()->json(null, $status);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }
}