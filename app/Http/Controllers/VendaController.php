<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\ItemVenda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function index(Request $request)
    {
    return view('venda.index', [
        'vendas' => Venda::orderBy('created_at', 'desc')->paginate(10),
        'clientes' => Cliente::all(),
        'users' => User::all()
    ]);
    }

    public function create(Request $request)
    {
        return view('venda.create', ['clientes' => Cliente::all()], ['users' => User::all()]);
    }

     public function store(Request $request)
    {
        //return $request->all();

        $validated = $request->validate([
            'responsavel'      => 'required',
            'cliente' => 'required',
        ]);

        $obj            = new Venda();
        $obj->responsavel_id      = $request->responsavel;
        $obj->cliente_id = $request->cliente;
        $obj->save();
        
        return redirect()->route('itemVenda.create', [$idVenda = $obj->id]);
    }

    public function update(Request $request, $id) 
    {
        $obj            = Venda::findOrFail($id);
        $obj->responsavel_id      = $request->responsavel;
        $obj->cliente_id  = $request->cliente;
        $obj->save();

        return redirect()->route('venda.index')->with('success', 'Dados salvos com sucesso!');
    }

    public function delete(Request $request, $id) 
    {
        $obj = Venda::findOrFail($id);
        $obj->delete();

        return redirect()->route('venda.index');
    }

    public function show($idVenda){
        $itemVendas = ItemVenda::where('venda_id',$idVenda)->get();
        $venda = Venda::findOrFail($idVenda);
        $produtos = Produto::all();

        return view('venda.show', [
            'itemVendas' => $itemVendas,
            'venda' => $venda,
            'produtos' => $produtos]);
    }

    public function edit(Request $request, $id) 
    {
        $venda = Venda::findOrFail($id);
        $users = User::all();
        $clientes = Cliente::all();
        return view('venda.edit', [
            'venda' => $venda,
            'users' => $users,
            'clientes' => $clientes
        ]);
    }

}
