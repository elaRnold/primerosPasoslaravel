<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return Product::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($validated);
        return response()->json($product,201);
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        // Encuentra el post que deseas actualizar
        $Product = Product::findOrFail($id);

        // Actualiza los campos del post
        $Product->name = $request->input('name');
        $Product->description = $request->input('description');
        $Product->price = $request->input('price');

        // Guarda los cambios en la base de datos
        $Product->save();

        // Prepara una respuesta JSON con un campo de estado
        $response = [
            'status' => 'success',
            'message' => 'El producto ha sido actualizado correctamente.',
        ];

        // Retorna la respuesta JSON con un código de estado HTTP 200 (Éxito)
        return response()->json($response, 200);
    }

    public function show(Product $product) {
        return response()->json($product, 200);
    }

    public function destroy(Product $product) {
        $product->delete();
        return response('Deleted', 200);
    }
}
