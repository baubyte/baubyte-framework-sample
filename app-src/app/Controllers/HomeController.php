<?php

namespace App\Controllers;

use Baubyte\Http\Controller;
use Baubyte\Http\Request;

class HomeController extends Controller {

    /**
     * Mostrar una lista del recurso.
     *
     * @return \Baubyte\Http\Response
     */
    public function index(){
        return view('home');
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Baubyte\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Almacene un recurso recién creado.
     *
     * @param  \Baubyte\Http\Request  $request
     * @return \Baubyte\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  int  $id
     * @return \Baubyte\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return \Baubyte\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Actualice el recurso especificado.
     *
     * @param  \Baubyte\Http\Request  $request
     * @param  int  $id
     * @return \Baubyte\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Elimina el recurso especificado.
     *
     * @param  int  $id
     * @return \Baubyte\Http\Response
     */
    public function destroy($id){
        //
    }
}
