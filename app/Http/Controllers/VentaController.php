<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return response()->json($ventas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
            'cliente' => 'required',
            'total' => 'required',
        ]);

        $venta = Venta::create($request->all());

        return response()->json($venta, 201);
    }

    public function show($id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }
        return response()->json($venta);
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        $request->validate([
            'fecha' => 'required',
            'cliente' => 'required',
            'total' => 'required',
        ]);

        $venta->update($request->all());

        return response()->json($venta);
    }

    public function destroy($id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        $venta->delete();

        return response()->json(['message' => 'Venta eliminada']);
    }
}
