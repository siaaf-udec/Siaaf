<?php
namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;
use Yajra\DataTables\DataTables;

use Illuminate\Http\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use Illuminate\Support\Facades\DB;

use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;
use App\Container\Users\Src\User;

use Carbon\Carbon;

class ReportController extends Controller
{
    
    private $path='gesap.Reportes.';

    public function allProject()
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
            //->whereNotBetween('NPRY_FechaR',["2017-07-05","2017-07-11"])
//            ->groupBy(['NPRY_FechaR',''])
            ->get();
            //return $proyectos->toSql();
        return view($this->path.'pdf.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
    
    public function allProjectPrint()
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')->get();
        
        return SnappyPdf::loadView($this->path.'pdf.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ])->download('ReporteAnteproyectosGesap.pdf');
    }
}
