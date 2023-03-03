<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\Contact;
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
        return view('contacts/index', ['contacts' => Contact::all()]);
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
        if (!is_null($file = $request->file("profile"))) {
            $data['profile'] = $file->store('profiles');
        }
        Contact::create([...$data, 'user_id' => auth()->id()]);
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
     * @param  Contact $contact
     * @param  \Baubyte\Http\Request  $request
     * @return \Baubyte\Http\Response
     */
    public function edit(Contact $contact, Request $request){
        return view('contacts/edit', ['contact' => $contact]);
    }

    /**
     * Actualice el recurso especificado.
     *
     * @param  Contact $contact
     * @param  \Baubyte\Http\Request  $request
     * @return \Baubyte\Http\Response
     */
    public function update(Contact $contact, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required'
        ]);
        if (!is_null($file = $request->file("profile"))) {
            $data['profile'] = $file->store('profiles');
        }
        $contact->name = $data['name'];
        $contact->phone_number = $data['phone_number'];
        $contact->profile = $data['profile'];
        $contact->update();

        return redirect('/contacts');
    }

    /**
     * Elimina el recurso especificado.
     *
     * @param  Contact  $contact
     * @return \Baubyte\Http\Response
     */
    public function destroy(Contact $contact){
        $contact->delete();
        session()->flash('alert', "Contacto $contact->name eliminado correctamente.");

        return redirect('/contacts');
    }
}
