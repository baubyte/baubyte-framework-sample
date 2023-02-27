<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\ContactModel;
use Baubyte\Http\Controller;
use Baubyte\Http\Request;

class ContactController extends Controller {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->setMiddlewares([AuthMiddleware::class]);
    }
    /**
     * Mostrar una lista del recurso.
     *
     * @return \Baubyte\Http\Response
     */
    public function index(){
        return view('contacts/index', ['contacts' => ContactModel::all()]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Baubyte\Http\Response
     */
    public function create(){
        return view('contacts/create');
    }

    /**
     * Almacene un recurso recién creado.
     *
     * @param  \Baubyte\Http\Request  $request
     * @return \Baubyte\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
        ]);
        ContactModel::create([...$data, 'user_id' => auth()->id()]);
        return redirect('/contacts');
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
