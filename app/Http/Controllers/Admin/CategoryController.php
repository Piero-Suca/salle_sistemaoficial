<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categoria.index');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->name = $validateData['name'];
        $category->description = $validateData['description'];

        $category->save();

        if ($category){
            return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue registrado correctamente.');
        }else {
            return redirect()->back()->withErrors('No se registro correctamente la categoria.'. $category->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validateData['name'];
        $category->description = $validateData['description'];

        $category->save();

        if ($category){
            return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue actualizada correctamente.');
        }else {
            return redirect()->back()->withErrors('No se actualizo correctamente la categoria.'. $category->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.categoria.index')->with('success', 'La categoria fue eliminado correctamente.');
    }
}
