<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search'); 

    $clientes = Cliente::when($search, function ($query) use ($search) {
        return $query->where('nome', 'like', '%' . $search . '%');
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10); 

    return view('cliente.index', compact('clientes'));
    }

    public function create(Request $request)
    {
        return view('cliente.create');
    }

     public function store(Request $request)
    {
        //return $request->all();

        $validated = $request->validate([
            'nome'      => 'required|max:100',
            'cpf' => 'max:11|nullable',
            'endereço'  => 'max:80|nullable',
        ]);

        $obj            = new Cliente();
        $obj->nome      = $request->nome;
        $obj->cpf = $request->cpf;
        $obj->endereco  = $request->endereco;
        $obj->save();
        
        return redirect()->route('cliente.index')->with('success', 'Dados salvos com sucesso!');
    }

    public function update(Request $request, $id) 
    {
        $obj            = Cliente::findOrFail($id);
        $obj->nome      = $request->nome;
        $obj->cpf = $request->cpf;
        $obj->endereco  = $request->endereco;
        $obj->save();

        return redirect()->route('cliente.index')->with('success', 'Dados salvos com sucesso!');
    }

    public function delete(Request $request, $id) 
    {
        $obj = Cliente::findOrFail($id);
        $obj->delete();

        return redirect()->route('cliente.index');
    }

    public function edit(Request $request, $id) 
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', ['cliente' => $cliente]);
    }

}
