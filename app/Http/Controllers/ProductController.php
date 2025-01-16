<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        // Obtém todos os produtos do banco de dados
        $products = Product::all();
        return view('products.index', compact('products')); // Passa os produtos para a view
    }

    public function create()
    {
        return view('products.create'); // Renderiza a view de criação do produto
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Salvar imagem localmente
        $imagePath = $request->file('image')->store('images', 'public');

        // Enviar para o Mercado Livre via API
        $response = Http::withToken(env('MERCADO_LIVRE_ACCESS_TOKEN'))->post('https://api.mercadolibre.com/items', [
            'title' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'currency_id' => 'BRL',
            'available_quantity' => $validated['stock'],
            'description' => ['plain_text' => $validated['description']],
            'pictures' => [['source' => asset('storage/' . $imagePath)]],
        ]);

        // Log da resposta da API para diagnóstico
        Log::error('Resposta do Mercado Livre:', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        // Verifica se a requisição para o Mercado Livre foi bem-sucedida
        if ($response->successful()) {
            // Salva o produto no banco de dados local
            Product::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'category_id' => $validated['category_id'],
                'image' => $imagePath,
            ]);

            // Redireciona para a lista de produtos com mensagem de sucesso
            return redirect()->route('product.index')->with('success', 'Produto cadastrado com sucesso!');
        }

        // Caso a requisição falhe, retorna com erro detalhado
        $error = $response->json()['message'] ?? 'Erro desconhecido';
        return back()->withErrors(['error' => "Erro ao cadastrar o produto no Mercado Livre: $error"]);
    }

    public function callback(Request $request)
{
    // Captura o código de autorização enviado pelo Mercado Livre
    $code = $request->input('code');
    
    if (!$code) {
        return redirect()->route('product.index')->withErrors(['error' => 'Código de autorização não recebido.']);
    }

    // Enviar o código para obter o access token
    $response = Http::post('https://api.mercadolibre.com/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('MERCADO_LIVRE_CLIENT_ID'),
        'client_secret' => env('MERCADO_LIVRE_CLIENT_SECRET'),
        'code' => $code,
        'redirect_uri' => env('MERCADO_LIVRE_REDIRECT_URI'), // Use o valor do .env ou verifique se o valor está correto
    ]);

    // Log da resposta para diagnóstico
    Log::error('Resposta do Mercado Livre (callback):', [
        'status' => $response->status(),
        'body' => $response->body(),
    ]);

    if ($response->successful()) {
        // Obter o access token
        $accessToken = $response->json()['access_token'];

        // Armazenar o token em algum local seguro, ou atualizar no .env
        config(['services.mercadolivre.access_token' => $accessToken]);

        return redirect()->route('product.index')->with('success', 'Autorização bem-sucedida!');
    }

    return back()->withErrors(['error' => 'Erro ao trocar o código por um token de acesso']);
}

}
