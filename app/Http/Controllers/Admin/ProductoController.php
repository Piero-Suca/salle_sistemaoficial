<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return view('admin.producto.index');
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $validateData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $producto = new Product();
        $producto->category_id = $validateData['category_id'];
        $producto->name = $validateData['name'];
        $producto->description = $validateData['description'];
        $producto->precio = $validateData['precio'];
        $producto->stock = $validateData['stock'];

        // Manejo del archivo de imagen
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('images', 'public');
            $producto->image = $imagePath;
        }

        // Manejo del archivo de manual
        if ($request->hasFile('manual')) {
            $manualFile = $request->file('manual');
            $manualPath = $manualFile->store('manuals', 'public');
            $producto->manual = $manualPath;
        }

        $producto->save();

        if ($producto) {
            return redirect()->route('admin.producto.index')->with('success', 'El producto fue registrado correctamente.');
        } else {
            return redirect()->back()->withErrors('No se registró correctamente el producto.');
        }
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required',
            'manual' => 'required|file|mimes:pdf',
        ]);

        $producto = Product::findOrFail($id);
        $producto->category_id = $validateData['category_id'];
        $producto->name = $validateData['name'];
        $producto->description = $validateData['description'];
        $producto->precio = $validateData['precio'];
        $producto->stock = $validateData['stock'];

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('image', 'public');
            $producto->image = $imagePath;
        }

        if ($request->hasFile('manual')) {
            $manualFile = $request->file('manual');
            $manualPath = $manualFile->store('manual', 'public');
            $producto->manual = $manualPath;
        }

        $producto->save();

        if ($producto){
            return redirect()->route('admin.producto.index')->with('success', 'El producto fue actualizada correctamente.');
        }else {
            return redirect()->back()->withErrors('No se actualizo correctamente el producto.'. $producto->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.producto.index')->with('success', 'El producto fue eliminado correctamente.');
    }
}
