<?php

namespace App\Container\Users\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Container\Overall\Src\Facades\AjaxResponse;

use App\Container\Users\Src\Country;
use App\Container\Users\Src\Region;
use App\Container\Users\Src\City;

class LocationController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function to_list_countries(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $countries = Country::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $countries
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function to_list_regions(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $countries = Region::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $countries
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function to_list_cities(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $countries = City::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $countries
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function to_list_regions_find(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $regions = Region::where('country_id', $id)->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $regions
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    public function to_list_cities_find(Request $request, $id_region, $id_city)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $regions = City::where('country_id','=', $id_city)
                           ->where('region_id','=', $id_region)
                           ->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $regions
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }



}
