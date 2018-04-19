<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 14/09/17
 * Time: 11:54 PM
 */

namespace app\Container\Financial\src\Controllers\Cash;


use App\Http\Controllers\Controller;

class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.petty-cash.index');
    }
}