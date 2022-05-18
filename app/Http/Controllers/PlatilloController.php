<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatilloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texto=($request->get('texto'));
        $datos['platillos'] = Platillo::paginate(2);
        return view('platillo.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('platillo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validarCampos=[
            'nombre'=>'required|string|max:100',
            'descripcion'=>'required|string|max:300',
            'foto'=>'required|max:10000|mimes:jpeg,jpg,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es obligatorio',
            'nombre.required'=>'El Nombre es obligatorio',
            'descripcion.required'=>'La Descripción es obligatoria',
            'foto.required'=>'La Foto es obligatoria'
        ];

        $this->validate($request, $validarCampos, $mensaje);

        $datosPlatillo = $request->except('_token'); //Tomamamos todos los datos excepto el token
        if ($request->hasFile('foto')) {
            $datosPlatillo['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Platillo::insert($datosPlatillo);
        //return response()->json($datosPlatillo);
        return redirect('platillo')->with('mensaje', 'Platillo agregado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Platillo  $platillo
     * @return \Illuminate\Http\Response
     */
    public function show(Platillo $platillo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Platillo  $platillo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $platillo = Platillo::findOrFail($id); // Buscamos un id con el que nos están pidiendo
        return view('platillo.edit', compact('platillo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Platillo  $platillo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validarCampos=[
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'correo'=>'required|email'            
        ];
        $mensaje=[
            'required'=>'El :attribute es obligatorio'
        ];
        if ($request->hasFile('foto')) {
            $campos=['foto'=>'required|max:10000|mimes:jpeg,jpg,jpg'];
            $mensaje=['foto.required'=>'La Foto es obligatoria'];
        }
        $this->validate($request, $validarCampos, $mensaje);

        $datosPlatillo = $request->except(['_token', '_method']); //No recibimos tampoco el metodo
        if ($request->hasFile('foto')) {
            $platillo = Platillo::findOrFail($id);
            Storage::delete('public/'.$platillo->foto);
            $datosPlatillo['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Platillo::where('id','=',$id)->update($datosPlatillo); // buscamos el registro que tenga la misma id que me pasan
        $platillo = Platillo::findOrFail($id); 
        //return view('platillo.edit', compact('platillo')); // se retorna con los datos actualizados
        return redirect('platillo')->with('mensaje', 'Se ha editado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Platillo  $platillo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $platillo = Platillo::findOrFail($id);
        if (Storage::delete('public/'.$platillo->foto)) {
            Platillo::destroy($id);
        }
        return redirect('platillo')->with('mensaje', 'Se ha eliminado satisfactoriamente.');
    }
}
