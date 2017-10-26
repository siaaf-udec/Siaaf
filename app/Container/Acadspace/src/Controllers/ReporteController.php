<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Asistencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Aulas;
use App\Container\Acadspace\src\Espacios;
use App\Container\Overall\Src\Facades\AjaxResponse;

class ReporteController extends Controller
{

    /**
     * Retorna la vista de reportes docente
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $espa = new espacios();
        $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
        return view('acadspace.Reportes.reportesIndex',
            [
                'espacios' => $espacios->toArray()
            ]);
    }

    /**
     * Retorna la vista de reportes estudiantes
     * @return \Illuminate\View\View
     */
    public function repIndexEst()
    {
        $espa = new espacios();
        $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
        return view('acadspace.Reportes.reportesIndexEst',
            [
                'espacios' => $espacios->toArray()
            ]);
    }

    /**
     * Retorna la vista de reportes carrera
     * @return \Illuminate\View\View
     */
    public function repIndexCarr()
    {
        return view('acadspace.Reportes.reportesIndexCarr');
    }


    /**
     * Recibe el parametro espacio y retorna un json con las aulas
     * disponibles de acuerdo al espacio
     * @param Request $request
     * @param $espacio
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargarSalasReportes(Request $request, $espacio)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $aula = Aulas::where('FK_SAL_Id_Espacio', '=', $espacio)
                ->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos recibidos correctamente.', $aula
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Recibe el formato de fecha del data_range_picker
     * y lo cambia por el formato usado en BD
     * @param $fech
     * @return string
     */
    public function changeForm($fech)
    {
        //10-05-2101
        $aaaa = substr($fech, -4);
        $dd = substr($fech, -7, -5);
        $mm = substr($fech, -10, -8);
        return $aaaa . '-' . $mm . '-' . $dd;
    }


    /**
     * Obtiene los rangos de fecha, el nombre del laboratorio, el id de la carrera
     * (1-Sistemas, 2-Ambiental, 3-Agronomia, 4-Administracion, 5-Contaduria, 6-Psicologia)
     * y el id de tipo de practica (1-libre, 2-grupal)
     * para retornar la cantidad de estudiantes que han ingresado
     * @param $fech1
     * @param $fech2
     * @param $id_Lab
     * @param $id_carr
     * @param $id_tipPrac
     * @return int
     */
    public function obtenerTotalEstLab($fech1, $fech2, $id_Lab, $id_carr, $id_tipPrac)
    {
        //10-05-2101
        $estudiantes = Asistencia::whereBetween('created_at', [$fech1, $fech2])
            ->where('ASIS_Id_Carrera', '=', $id_carr)
            ->where('ASIS_Tipo_Practica', '=', $id_tipPrac)
            ->where('FK_ASIS_Id_Espacio', '=', $id_Lab)
            ->get();

        $total = count($estudiantes);
        return $total;
    }

    /**
     * Obtiene los rangos de fecha, el nombre del laboratorio, el id de la carrera
     * (1-Sistemas, 2-Ambiental, 3-Agronomia, 4-Administracion, 5-Contaduria, 6-Psicologia)
     * y el id de tipo de practica (1-libre, 2-grupal)
     * para retornar la cantidad de estudiantes que han ingresado
     * @param $fech1
     * @param $fech2
     * @param $id_Lab
     * @param $id_carr
     * @param $id_tipPrac
     * @return int
     */
    public function obtenerTotalEstPracGrupal($fech1, $fech2, $id_Lab, $id_carr, $id_tipPrac)
    {
        //10-05-2101
        $total = 0;
        $estudiantes = Asistencia::whereBetween('created_at', [$fech1, $fech2])
            ->where('ASIS_Id_Carrera', '=', $id_carr)
            ->where('ASIS_Tipo_Practica', '=', $id_tipPrac)
            ->where('FK_ASIS_Id_Espacio', '=', $id_Lab)
            ->get();

        foreach ($estudiantes as $estudiante) {
            $tot = $estudiante->ASIS_Cant_Estudiantes;
            $total = $total + $tot;
        }

        return $total;
    }

    /**
     * Recibe los campos de la vista ReportesIndexEst y llama las funcion "changeform" para obtener
     * la fecha en el formato necesario. Obtiene la cantidad de estudiantes por carrera y tipo de practica
     * que han ingresado al laboratorio elegido
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function cargarRepEst(Request $request)
    {
        $data = $request->all();
        $code = $data['date_range'];
        $lab = $request['SOL_laboratorios'];

        $f2 = substr($code, -10);
        $f1 = substr($code, -23, -13);
        $fech1 = $this->changeForm($f1);
        $fech2 = $this->changeForm($f2);
        $date = date("d/m/Y");
        $time = date("h:i A");
        $totSistemasLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 1, 1);
        $totSistemasGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, $lab, 1, 2);
        $totAmbientalLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 2, 1);
        $totAmbientalGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, $lab, 2, 2);
        $totAgronomicaLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 3, 1);
        $totAgronomicaGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, $lab, 3, 2);
        $totAdminLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 4, 1);
        $totAdminGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, $lab, 4, 2);
        $totContaduriaLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 5, 1);
        $totContaduriaGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, $lab, 5, 2);
        $totPiscologiaLibre = $this->obtenerTotalEstLab($fech1, $fech2, $lab, 6, 1);
        $totPiscologiaaGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, $lab, 6, 2);

        $totalTot = $totSistemasLibre + $totSistemasGrup + $totAmbientalLibre + $totAmbientalGrup
            + $totAgronomicaLibre + $totAgronomicaGrup + $totAdminLibre + $totAdminGrup + $totContaduriaLibre
            + $totContaduriaGrup + $totPiscologiaLibre + $totPiscologiaaGrup;

        $nomEsp = Espacios::where('PK_ESP_Id_Espacio', '=', $lab)->get();
        foreach ($nomEsp as $nomEsps) {
            $lab = $nomEsps->ESP_Nombre_Espacio;
        }

        $cont = 1;
        return view('acadspace.Reportes.ReportesEstudiantes',
            compact('totSistemasLibre', 'totSistemasGrup',
                'totAmbientalLibre', 'totAmbientalGrup',
                'totAgronomicaLibre', 'totAgronomicaGrup',
                'totAdminLibre', 'totAdminGrup',
                'totContaduriaLibre', 'totContaduriaGrup',
                'totPiscologiaLibre', 'totPiscologiaaGrup',
                'totalTot', 'cont', 'date', 'time', 'fech1', 'fech2', 'lab', 'code')
        );


    }


    /**
     * Recibe los campos de la vista ReportesIndexCarr y llama las funcion "changeform" para obtener
     * la fecha en el formato necesario. Obtiene la cantidad de estudiantes por carrera y tipo de practica
     * que han ingresado a todos los espacios academicos
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function reporCarrera(Request $request)
    {
        $data = $request->all();
        $fecha = $data['date_range'];
        $carr = $data['SOL_carrera'];
        switch ($carr) {
            case 1:
                $carrera = 'Ingeniería de Sistemas';
                break;
            case 2:
                $carrera = 'Ingeniería Ambiental';
                break;
            case 3:
                $carrera = 'Ingeniería Agronomica';
                break;
            case 4:
                $carrera = 'Administración';
                break;
            case 5:
                $carrera = 'Psicología';
                break;
            case 6:
                $carrera = 'Contaduría';
                break;

        }
        $f2 = substr($fecha, -10);
        $f1 = substr($fecha, -23, -13);

        $fech1 = $this->changeForm($f1);//Cambia el formato de la fecha
        $fech2 = $this->changeForm($f2);

        $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
        $time = date("h:i A");

        $sistLibre = $this->obtenerTotalEstLab($fech1, $fech2, 'Aulas de computo', $carr, 1);
        $sistGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, 2, $carr, 2);
        $psicLibre = $this->obtenerTotalEstLab($fech1, $fech2, 3, $carr, 1);
        $psicGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, 3, $carr, 2);
        $ciencLibre = $this->obtenerTotalEstLab($fech1, $fech2, 1, $carr, 1);
        $ciencGrup = $this->obtenerTotalEstPracGrupal($fech1, $fech2, 1, $carr, 2);


        $totalTot = $sistLibre + $sistGrup + $psicLibre + $psicGrup + $ciencLibre + $ciencGrup;

        $cont = 1;
        return view('acadspace.Reportes.reportesCarrera',
            compact('docentes', 'cont', 'date', 'time', 'fech1', 'fech2', 'carr', 'totalTot', 'fecha', 'carrera',
                'sistLibre', 'sistGrup', 'psicLibre', 'psicGrup', 'ciencLibre', 'ciencGrup')
        );

    }

    /**
     * Recibe los campos de la vista ReportesIndex y llama las funcion "changeform" para obtener
     * la fecha en el formato necesario. Obtiene la cantidad de docentes que han ingresado
     * al laboratorio elegido entre las fechas proporcionadas
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function reporDocente(Request $request)
    {

        $data = $request->all();

        $fecha = $request['date_range'];
        $lab = $request['SOL_laboratorios'];
        $aula = $request['aula'];

        $f2 = substr($fecha, -10);
        $f1 = substr($fecha, -23, -13);

        $fech1 = $this->changeForm($f1);//Cambia el formato de la fecha
        $fech2 = $this->changeForm($f2);

        $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
        $time = date("h:i A");

        $nomAula = Aulas::where('PK_SAL_Id_Sala', '=', $aula)->get();
        foreach ($nomAula as $nombAula) {
            $nombreAula = $nombAula->SAL_Nombre_Sala;
        }
        $nomEsp = Espacios::where('PK_ESP_Id_Espacio', '=', $lab)->get();
        foreach ($nomEsp as $nomEsps) {
            $nomEspacio = $nomEsps->ESP_Nombre_Espacio;
        }


        $docentes = Asistencia::whereBetween('created_at', [$fech1, $fech2])
            ->where('FK_ASIS_Id_Aula', '=', $aula)
            ->where('ASIS_Tipo_Practica', '=', 2)
            ->orderBy('created_at', 'asc')
            ->get();

        $totalTot = count($docentes);

        $cont = 1;
        return view('acadspace.Reportes.ReportesDocentes',
            compact('docentes', 'cont', 'nomEspacio', 'date', 'time', 'fech1', 'fech2', 'lab', 'aula', 'totalTot', 'fecha', 'nombreAula')
        );


    }


}