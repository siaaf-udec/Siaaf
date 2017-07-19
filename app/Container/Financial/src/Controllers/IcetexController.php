<?php

namespace App\Container\Financial\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IcetexController extends Controller
{
  public function index()
  {
    $users = [0 => 'Miguel'];
    return view('financial.icetex', ['users' => $users]);
  }
}
