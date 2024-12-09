<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'required|url',
        ]);

        $producto = Producto::create($request->all());

        return response()->json([
            'message' => 'Producto creado con exito',
            'producto' => $producto,
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'required|url',
        ]);

        $producto = Producto::create($request->all());

        return response()->json([
            'message' => 'Producto creado con exito',
            'producto' => $producto,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            $producto = Producto::find($id);
            if(!$producto){
                $data = ['message' => 'Producto no encontrado'];
                return response()->json($data, 404);
            }
            $data = ['producto' => $producto];
            return response()->json($data, 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::find($id);

        if(!$producto){
            $data = ['message' => 'Producto no encontrado'];
            return response()->json($data, 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'required|url',
        ]);

        $producto->update($request->all());

        $data = [
            'message' => 'Producto actualizado con exito',
            'producto' => $producto
        ];

        return response()->json($data, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        if(!$producto){
            $data = ['message' => 'Producto no encontrado'];
            return response()->json($data, 404);
        }

        $producto->delete();

        $data = [
            'message' => 'Producto actualizado con exito',
        ];

        return response()->json($data, 200);

    }
}
