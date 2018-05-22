<?php

namespace App\Container\Permissions\Src\Controllers;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Permissions\Src\Interfaces\AuditInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AuditsController extends Controller
{

    protected $auditRepository;

    public function __construct(AuditInterface $auditRepository)
    {
        $this->auditRepository = $auditRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audits.general-audit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_ajax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('audits.content-ajax.ajax-general-audit');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $audit = $this->auditRepository->show($id, []);
            return view('audits.content-ajax.ajax-show-audit', [
                'audit' => $audit,
            ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $audit = $this->auditRepository->index([]);

            return DataTables::of($audit)
                ->removeColumn('auditable_id')
                ->removeColumn('old_values')
                ->removeColumn('new_values')
                ->removeColumn('url')
                ->removeColumn('url')
                ->removeColumn('ip_address')
                ->removeColumn('user_agent')
                ->removeColumn('tags')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
