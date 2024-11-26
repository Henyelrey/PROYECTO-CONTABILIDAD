<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // Mostrar todos los proveedores
    public function index()
    {
        $proveedores = Proveedor::all(); // Obtener todos los proveedores
        return view('proveedores.index', compact('proveedores'));
    }

    // Mostrar el formulario para crear un nuevo proveedor
    public function create()
    {
        return view('proveedores.create');
    }

    // Guardar un nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        Proveedor::create($request->all()); // Crear el nuevo proveedor

        return redirect()->route('proveedores.index'); // Redirigir a la lista de proveedores
    }

    // Mostrar los detalles de un proveedor
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id); // Buscar proveedor por ID
        return view('proveedores.show', compact('proveedor'));
    }

    // Mostrar el formulario para editar un proveedor
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id); // Buscar proveedor por ID
        return view('proveedores.edit', compact('proveedor'));
    }

    // Actualizar un proveedor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $proveedor = Proveedor::findOrFail($id); // Buscar proveedor por ID
        $proveedor->update($request->all()); // Actualizar proveedor

        return redirect()->route('proveedores.index'); // Redirigir a la lista de proveedores
    }

    // Eliminar un proveedor
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id); // Buscar proveedor por ID
        $proveedor->delete(); // Eliminar proveedor

        return redirect()->route('proveedores.index'); // Redirigir a la lista de proveedores
    }
}
