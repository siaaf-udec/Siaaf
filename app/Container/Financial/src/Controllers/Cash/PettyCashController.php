<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 14/09/17
 * Time: 11:54 PM
 */

namespace app\Container\Financial\src\Controllers\Cash;


use App\Container\Financial\src\Repository\CashRepository;
use App\Container\Financial\src\Requests\Cash\PettyCashRequest;
use App\Http\Controllers\Controller;

class PettyCashController extends Controller
{
    /**
     * @var CashRepository
     */
    private $cashRepository;

    /**
     * PettyCashController constructor.
     * @param CashRepository $cashRepository
     */
    public function __construct(CashRepository $cashRepository)
    {
        $this->cashRepository = $cashRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.petty-cash.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PettyCashRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PettyCashRequest $request)
    {
        return ( $this->cashRepository->store( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'processed_fail', 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PettyCashRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PettyCashRequest $request, $id)
    {
        return ( $this->cashRepository->update($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ( $this->cashRepository->destroy( $id ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);
    }
}