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
use App\Container\Humtalent\src\Notification;
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
            $e['id']=$evento['PK_EVNT_IdEvento'];
            $e['allDay']="true";
            $e['color']='#1988E3';
            $e['type']="Evento";
            $e['hora']=$evento['EVNT_Hora'];
            $e['notif']=$evento['EVNT_Fecha_Notificacion'];
            array_push($events,$e);
        }
        $recordatorios = Notification::all();
        foreach ($recordatorios as $recordatorio){
            $e=array();
            $e['title']=$recordatorio['NOTIF_Descripcion'];
            $e['start']=$recordatorio['NOTIF_Fecha_Inicio'];
            $e['end']=$recordatorio['NOTIF_Fecha_Fin'];
            $e['id']=$recordatorio['PK_NOTIF_Id_Notificacion'];
            $e['allDay']="true";
            $e['color']='#25C279';
            $e['type']="Recordatorio";
            $e['notif']=$recordatorio['NOTIF_Fecha_Notificacion'];
            array_push($events,$e);
        }
        return json_encode($events);

    }

    public function index(){
        return view('humtalent.calendario.calendario');
    }

    public function store(Request $request){
        //return json_encode($request['startdate']);
        if($request['type'] == 'new') {
            Notification::create([
                'NOTIF_Descripcion' => $request['title'],
                'NOTIF_Fecha_Inicio' => $request['startdate'],
                'NOTIF_Fecha_Fin' => $request['startdate'],
                'NOTIF_Estado_Notificacion' => "Activa",
            ]);
            $idNotif=Notification::where('NOTIF_Descripcion',$request['title'])
                                            ->get(['PK_NOTIF_Id_Notificacion'])->last();
            return json_encode($idNotif['PK_NOTIF_Id_Notificacion']);
        }
    }
    public function storeDate(Request $request){
        Notification::where('PK_NOTIF_Id_Notificacion', $request['PK_NOTIF_Id_Notificacion'])
                        ->update(['NOTIF_Fecha_Notificacion'=>$request['NOTIF_Fecha_Notificacion']]);
        $notification=array(
            'message'=>'El recordatorio fue actualizado correctamente',
            'alert-type'=>'success'
        );
        return back()->with($notification);

    }
    public function storeDateEvent(Request $request){
        Event::where('PK_EVNT_IdEvento', $request['PK_EVNT_IdEvento'])
             ->update(['EVNT_Fecha_Notificacion'=>$request['EVNT_Fecha_Notificacion']]);
        $notification=array(
            'message'=>'El evento fue actualizado correctamente',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function updateDateNotification(Request $request){
        if($request['type']== 'endDateUpdate'){
            if($request['eventType'] == 'Recordatorio') {
                Notification::where('PK_NOTIF_Id_Notificacion', $request['eventId'])
                    ->update(['NOTIF_Fecha_Fin' => $request['endDate']]);
            }else{
                Event::where('PK_EVNT_IdEvento',$request['eventId'])
                     ->update(['EVNT_Fecha_Fin' => $request['endDate']]);
            }
        }elseif ($request['type'] == 'resetDate'){
            if($request['eventType'] == 'Recordatorio') {
                Notification::where('PK_NOTIF_Id_Notificacion', $request['eventId'])
                    ->update(['NOTIF_Fecha_Inicio' => $request['startdate'], 'NOTIF_Fecha_Fin' => $request['endDate']]);
            }else{
                Event::where('PK_EVNT_IdEvento',$request['eventId'])
                    ->update(['EVNT_Fecha_Inicio'=> $request['startdate'],'EVNT_Fecha_Fin' => $request['endDate']]);
            }
            return json_encode(array('id'=>$request['eventId'],'eventType'=>$request['eventType']));
        }
    }
    public function updateNotification(Request $request){
        Notification::where('PK_NOTIF_Id_Notificacion', $request['PK_NOTIF_Id_Notificacion'])
                    ->update(['NOTIF_Descripcion'=>$request['NOTIF_Descripcion'],
                              'NOTIF_Fecha_Notificacion'=>$request['NOTIF_Fecha_Notificacion'] ]);
        $notification=array(
            'message'=>'El recordatorio fue editado correctamente',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function updateEvent(Request $request){
        $request['EVNT_Hora']=strtotime($request['EVNT_Hora']);
        $request['EVNT_Hora']=date("H:i",$request['EVNT_Hora']);

        $documento= Event::find($request['PK_NOTIF_Id_Notificacion']);
        $documento->fill($request->all());
        $documento->save();
        $notification=array(
            'message'=>'La información del Evento fue modificada',
            'alert-type'=>'info'
        );
        return back()->with($notification);
    }
    public function deleteNotification(Request $request){
        if($request->ajax()) {
            if ($request['eventType'] == 'Recordatorio') {
                Notification::where('PK_NOTIF_Id_Notificacion', $request['eventId'])
                    ->delete();
            } else {
                Event::where('PK_EVNT_IdEvento', $request['eventId'])
                    ->delete();
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /*$notification=array(
            'message'=>'La información fue eliminada correctamente',
            'alert-type'=>'info'
        );
        return back()->with($notification);*/

    }

}