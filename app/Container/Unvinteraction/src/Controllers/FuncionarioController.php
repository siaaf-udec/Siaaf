<?php
/**
 * Created by Brackets.
 * User: Jonathan velasquez and Jesus Castellanos
 * Date: 04/07/2017
 * Time: 1:20 PM
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Container\Users\Src\Interfaces\UserInterface;

class FuncionarioController extends Controller
{
   protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
     public function index()
    {
        return view('');
    }
    public function create()
    {
        return view('Unvinteraction.funcionario.registroUsuarios');
    }

}
