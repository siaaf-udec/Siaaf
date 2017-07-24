<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 20/07/17
 * Time: 11:43 PM
 */

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddSubRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = $this->returnProgram();
        $teachers = $this->returnTeacher();
        $subjects = $this->returnSubject();
        return view('financial.requests.student.addsub.index', compact('programs', 'teachers', 'subjects'));
    }

    protected function returnProgram($id = null)
    {
        $program = [
            0 => 'Ingeniería de Sistemas',
            1 => 'Ingeniería de Agronómica',
            2 => 'Ingeniería de Ambiental'
        ];

        if ( $id ) {
            return $program[$id];
        }
        return $program;
    }

    protected function returnTeacher($id = null)
    {
        $teachers = [
            0 => 'Alexander Espinosa',
            1 => 'Francisco Lanza',
            2 => 'Alejandro Ayure',
        ];

        if ( $id ) {
            return $teachers[$id];
        }
        return $teachers;
    }

    protected function returnSubject($id = null)
    {
        $subjects = [
            0 => 'Matemáticas',
            1 => 'Biología',
            2 => 'Robótica'
        ];

        if ( $id ) {
            return $subjects[$id];
        }
        return $subjects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = $this->returnProgram($request->program);
        $teacher = $this->returnTeacher($request->teacher);
        $subject = $this->returnSubject($request->subject_matter);
        return redirect()->route('financial.requests.student.add.sub.index')
                ->with('program', $program)
                ->with('teacher', $teacher)
                ->with('subject', $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}