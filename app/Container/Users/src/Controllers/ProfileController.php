<?php

namespace App\Container\Users\Src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Overall\Src\Facades\AjaxResponse;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $user = $this->userRepository->show(Auth::id(), []);
            $img = $user->images[0]->url;
            return view('users.profile', [
                'user' => $user,
                'img' => $img
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $this->userRepository->update($request->all());

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $password = [
                'id' => $id,
                'password' => $request->get('password'),
            ];
            $this->userRepository->update($password);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $user = $this->userRepository->show(Auth::id(), []);

            /*Guarda la imagen */
            $img = $request->file('image_profile');
            if ($img !== null) {
                foreach ($user->images as $image) {
                    Storage::disk('developer')->delete($image->url);
                }
                $url = Storage::disk('developer')->putFile('avatars', $img);
                $user->images()->update([
                    'url' => $url
                ]);
            } else {
                $user->images()->update([
                    'url' => $request->get('identicon')
                ]);
            }

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

}