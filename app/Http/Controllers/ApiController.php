<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\ItemVenda;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function getCategorias(): JsonResponse
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function getProdutos(): JsonResponse
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    public function getClientes(): JsonResponse
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function getUsuarios(): JsonResponse
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    public function getVendas(): JsonResponse
    {
        $vendas = Venda::with(['responsavel', 'cliente'])
    ->orderBy('created_at', 'desc') 
    ->get();
        return response()->json($vendas);
    }

    public function postVenda(Request $request): JsonResponse
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'responsavel_id' => 'required|exists:users,id',
        ]);

        $venda = Venda::create([
            'cliente_id' => $data['cliente_id'],
            'responsavel_id' => $data['responsavel_id'],
            'data' => now(),
        ]);

        return response()->json($venda, 201);
    }

    public function deletarVenda($idVenda)
    {
        try {
            $venda = Venda::findOrFail($idVenda);
            $venda->delete();

            return response()->json(['message' => 'Venda deletada com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar venda: ' . $e->getMessage()], 500);
        }
    }

    public function editarVenda(Request $request, $idVenda)
{
    try {
        $venda = Venda::findOrFail($idVenda);

        $venda->cliente_id = $request->input('cliente_id');
        $venda->save();

        return response()->json(['message' => 'Venda atualizada com sucesso!'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao atualizar venda: ' . $e->getMessage()], 500);
    }
}

public function postItemVenda(Request $request, $idVenda): JsonResponse
{
    $validated = $request->validate([
        'produtos' => 'required|array',
        'quantidades' => 'required|array',
    ]);

    // Verificar se os arrays de produtos e quantidades têm o mesmo tamanho
    if (count($validated['produtos']) !== count($validated['quantidades'])) {
        return response()->json(['error' => 'Os arrays de produtos e quantidades devem ter o mesmo tamanho.'], 400);
    }

    $venda = Venda::findOrFail($idVenda);

    foreach ($validated['produtos'] as $index => $produtoId) {
        $quantidade = $validated['quantidades'][$index];

        if ($quantidade < 1) {
            return response()->json(['error' => 'Todas as quantidades devem ser pelo menos 1.'], 400);
        }

        ItemVenda::create([
            'produto_id' => $produtoId,
            'venda_id' => $idVenda,
            'quantidade' => $quantidade,
        ]);
    }

    // Retorna a resposta de sucesso com status 201
    return response()->json(['message' => 'Produtos adicionados à venda com sucesso!'], 201);
}

public function getItemsVenda($idVenda): JsonResponse
{
    try {
        // Obtendo os itens da venda, incluindo os detalhes do produto
        $itensVenda = ItemVenda::with('produto')->where('venda_id', $idVenda)->get();

        return response()->json($itensVenda);
        
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao buscar os itens da venda: ' . $e->getMessage()], 500);
    }
}

public function deleteProdutoVenda($vendaId, $produtoId): JsonResponse
{
    try {
        // Encontrar o item da venda usando venda_id e produto_id
        $itemVenda = ItemVenda::where('venda_id', $vendaId)
                              ->where('produto_id', $produtoId)
                              ->first();

        // Verifica se o item foi encontrado
        if (!$itemVenda) {
            return response()->json(['error' => 'Produto não encontrado na venda'], 404);
        }

        // Deletar o item da venda
        $itemVenda->delete();

        // Retorna uma mensagem de sucesso
        return response()->json(['message' => 'Produto excluído com sucesso!'], 200);
    } catch (\Exception $e) {
        // Loga o erro completo para depuração
        Log::error($e->getMessage());
        return response()->json(['error' => 'Erro ao excluir o produto: ' . $e->getMessage()], 500);
    }
}


}
