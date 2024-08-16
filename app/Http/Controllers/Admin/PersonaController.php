<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.persona.index');
    }


    public function render()
    {
        $personas = Personas::with('direccion')->paginate(10);
        return view('livewire.personas', compact('personas'));
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');

        $results = Personas::where('nombres', 'LIKE', '%' . $term . '%')
                    ->orWhere('apellidos', 'LIKE', '%' . $term . '%')
                    ->select('id', 'nombres', 'apellidos')
                    ->get();

        return response()->json($results);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validateData = $request->validate([
        'dni' => 'required',
        'nombres' => 'required',
        'apellidos' => 'required',
        'nro_celular' => '',
        'tipo_persona' => 'required',
    ]);

    $persona = new Personas();
    $persona->dni = $validateData['dni'];
    $persona->nombres = $validateData['nombres'];
    $persona->apellidos = $validateData['apellidos'];
    $persona->nro_celular = $validateData['nro_celular'];
    $persona->tipo_persona = $validateData['tipo_persona'];

    try {
        $persona->save();
        return redirect()->route('admin.persona.index')->with('success', 'La persona fue registrada correctamente.');
    } catch (\Illuminate\Database\QueryException $e) {
        if($e->getCode() == '23000'){ // Código de error para violación de restricción de integridad
            return redirect()->back()->withErrors('Ya existe una persona con ese DNI.');
        }
        return redirect()->back()->withErrors('Ocurrió un error al registrar la persona.');
    }
}

    public function update(Request $request, string $dni)
    {
        $validateData = $request->validate([
            'dni' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'nro_celular' => '',
            'tipo_persona' => 'required',
        ]);

        $persona =Personas::findOrFail($dni);
        $persona->dni = $validateData['dni'];
        $persona->nombres = $validateData['nombres'];
        $persona->apellidos = $validateData['apellidos'];
        $persona->nro_celular = $validateData['nro_celular'];
        $persona->tipo_persona = $validateData['tipo_persona'];

        $persona->save();

        if ($persona){
            return redirect()->route('admin.persona.index')->with('success', 'La persona fue actualizada correctamente.');
        }else {
            return redirect()->back()->withErrors('No se actualizo correctamente la persona.'. $persona->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Personas::find($id)->delete();
        return redirect()->route('admin.persona.index')->with('success', 'La persona fue eliminado correctamente.');
        
    }
}
