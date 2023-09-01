<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
            'proveedor' => 'required',
            'total' => 'required',
        ]);

        $compra = Compra::create($request->all());

        return response()->json($compra, 201);
    }

    public function show($id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }
        return response()->json($compra);
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $request->validate([
            'fecha' => 'required',
            'proveedor' => 'required',
            'total' => 'required',
        ]);

        $compra->update($request->all());

        return response()->json($compra);
    }

    public function destroy($id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        $compra->delete();

        return response()->json(['message' => 'Compra eliminada']);
    }
}
