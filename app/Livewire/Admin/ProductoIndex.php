<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductoIndex extends Component
{
    public function render()
    {
        // $productos = Product::all();
        $productos = Product::with('category')->get();
        $categories = Category::all();
        return view('livewire.admin.producto-index', compact('productos', 'categories'));
    }
}
