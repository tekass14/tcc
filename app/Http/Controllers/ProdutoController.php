<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        return view('produto.index', [
            'produtos' => Produto::orderBy('created_at', 'desc')->paginate(10),
            'categorias' => Categoria::all()]);
    }

    public function create(Request $request)
    {
        return view('produto.create',['categorias' => Categoria::all()]);
    }

     public function store(Request $request)
    {
        //return $request->all();

        $validated = $request->validate([
            'categoria'      => 'required',
            'nome'  => 'required|min:2',
            'marca'  => 'nullable',
            'modelo'  => 'nullable',
            'valor'  => 'required',
            'descricao'  => 'nullable',
        ]);

        $obj            = new Produto();
        $obj->categoria_id      = $request->categoria;
        $obj->nome = $request->nome;
        $obj->marca = $request->marca;
        $obj->modelo = $request->modelo;
        $obj->preco = $request->valor;
        $obj->descricao  = $request->descricao;
        $obj->save();
        
        return redirect()->route('produto.index')->with('success', 'Dados salvos com sucesso!');
    }

    public function update(Request $request, $id) 
    {
        $obj            = Produto::findOrFail($id);
        $obj->categoria_id      = $request->categoria;
        $obj->nome = $request->nome;
        $obj->marca = $request->marca;
        $obj->modelo = $request->modelo;
        $obj->preco = $request->valor;
        $obj->descricao  = $request->descricao;
        $obj->save();
        
        return redirect()->route('produto.index')->with('success', 'Dados salvos com sucesso!');
    }

    public function delete(Request $request, $id) 
    {
        $obj = produto::findOrFail($id);
        $obj->delete();

        return redirect()->route('produto.index');
    }

    public function edit(Request $request, $id) 
    {
        $produto = produto::findOrFail($id);
        $categorias = Categoria::all();
        return view('produto.edit', ['produto' => $produto], ['categorias' => $categorias]);
    }

}
