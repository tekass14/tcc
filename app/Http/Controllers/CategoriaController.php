<?php

namespace App\Http\Controllers;

use \App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        return view('categoria.index', ['categorias' => Categoria::all()]);
    }

    public function create(Request $request)
    {
        return view('categoria.create');
    }

     public function store(Request $request)
    {
        //return $request->all();

        $validated = $request->validate([
            'nome' => 'required|max:80|min:2',
        ]);

        $obj            = new Categoria();
        $obj->nome = $request->nome;
        $obj->save();
        
        return redirect()->route('categoria.index')->with('success', 'Dados salvos com sucesso!');
    }


    public function update(Request $request, $id) 
    {
        $obj            = Categoria::findOrFail($id);
        $obj->nome      = $request->nome;
        $obj->save();

        return redirect()->route('categoria.index')->with('success', 'Dados salvos com sucesso!');
    }

    public function delete(Request $request, $id) 
    {
        $obj = Categoria::findOrFail($id);
        $obj->delete();

        return redirect()->route('categoria.index')->with('success', 'Dados excluídos com sucesso!');
    }

    public function edit(Request $request, $id) 
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit', ['categoria' => $categoria]);
    }
}
