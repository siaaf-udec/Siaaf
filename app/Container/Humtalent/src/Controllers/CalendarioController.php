<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 8/08/2017
 * Time: 9:03 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\StatusOfDocument;
use App\Container\Humtalent\src\Event;
use App\Container\Overall\Src\Facades\AjaxResponse;

class CalendarioController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getEvent(Request $request){
        $eventos = Event::all();//->get(['EVNT_Descripcion', 'EVNT_Fecha','EVNT_Hora']);
        $events=array();
        foreach ($eventos as $evento){
            $e=array();
            $e['title']=$evento['EVNT_Descripcion'];
            $e['start']=$evento['EVNT_Fecha_Inicio'];
            $e['end']=$evento['EVNT_Fecha_Fin'];
            $e['allDay']="true";
            array_push($events,$e);
        }
        return json_encode($events);

    }

}