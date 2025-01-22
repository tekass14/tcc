<?php

namespace App\Http\Controllers;

use \App\Models\Produto;
use \App\Models\Venda;
use \App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function index(Request $request, $idVenda)
    {
        
        return view('itemVenda.index', [
            'itemVendas' => ItemVenda::orderBy('created_at', 'desc')->paginate(10),
            'produtos' => Produto::all(),
            'venda' => $idVenda
        ]);
    }

    public function create(Request $request, $idVenda)
    {
        return view('itemVenda.create', [
            'produtos' => Produto::all(),
            'idVenda' => $idVenda,
        ]);
    }

    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'produtos'    => 'required|array',
            'quantidades' => 'required|array',
            'venda'       => 'required|exists:vendas,id',
        ]);
    
        // Verificar se os arrays de produtos e quantidades têm o mesmo tamanho
        if (count($request->produtos) !== count($request->quantidades)) {
            return redirect()->back()->withErrors(['error' => 'Produtos e quantidades devem estar alinhados.']);
        }
    
        // Loop para salvar cada produto na venda
        foreach ($request->produtos as $index => $produtoId) {
            $quantidade = $request->quantidades[$index];
    
            // Verificar se a quantidade é válida
            if ($quantidade < 1) {
                return redirect()->back()->withErrors(['error' => 'Todas as quantidades devem ser pelo menos 1.']);
            }
    
            // Criar e salvar o registro
            ItemVenda::create([
                'produto_id' => $produtoId,
                'venda_id'   => $request->venda,
                'quantidade' => $quantidade,
            ]);
        }
    
        // Redirecionar com mensagem de sucesso
        return redirect()->route('venda.show',[$request->venda])->with('success', 'Produtos adicionados à venda com sucesso!');
    }
    

    public function update(Request $request, $id)
{
    // Validação
    $validated = $request->validate([
        'produto'    => 'required|exists:produtos,id',  
        'quantidade' => 'required|integer|min:1',      
        'venda'      => 'required|exists:vendas,id',    
    ]);

    $itemVenda = ItemVenda::findOrFail($id);

    $itemVenda->produto_id = $request->produto;
    $itemVenda->quantidade = $request->quantidade;
    $itemVenda->venda_id   = $request->venda;
    $itemVenda->save();

    return redirect()->route('venda.show', [$request->venda])->with('success', 'Produto atualizado com sucesso!');
}

    public function delete($id)
    {
        $itemVenda = ItemVenda::findOrFail($id);
        $itemVenda->delete();

        return redirect()->route('venda.show', [$idVenda = $itemVenda->venda_id]);
    }

    //edita um produto de uma venda
    public function edit(Request $request, $id){

        $itemVenda = ItemVenda::findOrFail($id);
        $venda = $itemVenda->venda_id;
        $produtos = Produto::all();

        return view('itemVenda.edit', [
            'itemVenda' => $itemVenda,
            'venda' => $venda,
            'produtos' => $produtos,
        ]);
    }
}
